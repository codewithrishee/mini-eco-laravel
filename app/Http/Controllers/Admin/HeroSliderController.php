<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class HeroSliderController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::latest()->get();

        return view('admin.hero-sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.hero-sliders.form');
    }

    /**
     * Upload image to Cloudinary.
     */
    private function uploadSliderImage($image): array
    {
        $result = Cloudinary::uploadApi()->upload(
            $image->getRealPath(),
            [
                'folder' => 'rv-store/hero-sliders',
                'resource_type' => 'image',
            ]
        );

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id'],
        ];
    }

    /**
     * Delete image from Cloudinary.
     */
    private function deleteSliderImage(?string $publicId): void
    {
        if (!$publicId) {
            return;
        }

        try {
            Cloudinary::uploadApi()->destroy($publicId);
        } catch (\Throwable $e) {
            Log::error('Hero Slider Cloudinary Delete Failed', [
                'public_id' => $publicId,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created slider.
     */
    public function store(Request $request)
    {
        $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'button1_text' => 'nullable|string|max:255',
            'button1_link' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:255',
            'button2_link' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'display_order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $uploadedImage = null;

        try {
            $uploadedImage = $this->uploadSliderImage(
                $request->file('image')
            );

            HeroSlider::create([
                'badge' => $request->badge,
                'title' => $request->title,
                'description' => $request->description,
                'button1_text' => $request->button1_text,
                'button1_link' => $request->button1_link,
                'button2_text' => $request->button2_text,
                'button2_link' => $request->button2_link,
                'image' => $uploadedImage['url'],
                'image_public_id' => $uploadedImage['public_id'],
                'display_order' => $request->display_order,
                'status' => $request->boolean('status'),
            ]);

            return redirect()
                ->route('admin.hero-sliders.index')
                ->with('success', 'Hero Slider Added Successfully.');

        } catch (\Throwable $e) {

            if ($uploadedImage) {
                $this->deleteSliderImage($uploadedImage['public_id']);
            }

            Log::error('Hero Slider Store Failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Hero slider save failed. Please check application logs.');
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(HeroSlider $hero_slider)
    {
        $slider = $hero_slider;

        return view('admin.hero-sliders.form', compact('slider'));
    }

    /**
     * Update slider.
     */
    public function update(Request $request, HeroSlider $hero_slider)
    {
        $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'button1_text' => 'nullable|string|max:255',
            'button1_link' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:255',
            'button2_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'display_order' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $uploadedImage = null;

        $oldPublicId = $hero_slider->image_public_id;

        try {

            $imageUrl = $hero_slider->image;
            $imagePublicId = $hero_slider->image_public_id;

            if ($request->hasFile('image')) {

                $uploadedImage = $this->uploadSliderImage(
                    $request->file('image')
                );

                $imageUrl = $uploadedImage['url'];
                $imagePublicId = $uploadedImage['public_id'];
            }

            $hero_slider->update([
                'badge' => $request->badge,
                'title' => $request->title,
                'description' => $request->description,
                'button1_text' => $request->button1_text,
                'button1_link' => $request->button1_link,
                'button2_text' => $request->button2_text,
                'button2_link' => $request->button2_link,
                'image' => $imageUrl,
                'image_public_id' => $imagePublicId,
                'display_order' => $request->display_order,
                'status' => $request->boolean('status'),
            ]);

            if ($uploadedImage && $oldPublicId) {
                $this->deleteSliderImage($oldPublicId);
            }

            return redirect()
                ->route('admin.hero-sliders.index')
                ->with('success', 'Hero Slider Updated Successfully.');

        } catch (\Throwable $e) {

            if ($uploadedImage) {
                $this->deleteSliderImage($uploadedImage['public_id']);
            }

            Log::error('Hero Slider Update Failed', [
                'slider_id' => $hero_slider->id,
                'message' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Hero slider update failed. Please check application logs.');
        }
    }

    /**
     * Delete slider.
     */
    public function destroy(HeroSlider $hero_slider)
    {
        $publicId = $hero_slider->image_public_id;

        try {
            $hero_slider->delete();

            $this->deleteSliderImage($publicId);

            return redirect()
                ->route('admin.hero-sliders.index')
                ->with('success', 'Hero Slider Deleted Successfully.');

        } catch (\Throwable $e) {

            Log::error('Hero Slider Delete Failed', [
                'slider_id' => $hero_slider->id,
                'message' => $e->getMessage(),
            ]);

            return back()
                ->with('error', 'Hero slider delete failed.');
        }
    }
}
