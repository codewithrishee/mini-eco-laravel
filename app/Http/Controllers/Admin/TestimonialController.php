<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    private function uploadImage($image)
    {
        $result = Cloudinary::uploadApi()->upload(
            $image->getRealPath(),
            [
                'folder' => 'rv-store/testimonials',
                'resource_type' => 'image',
            ]
        );

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id'],
        ];
    }

    private function deleteCloudinaryImage($publicId)
    {
        if (!$publicId) {
            return;
        }

        try {
            Cloudinary::uploadApi()->destroy($publicId);
        } catch (\Throwable $e) {
            Log::error('Testimonial Cloudinary deletion failed: ' . $e->getMessage());
        }
    }

    private function deleteLegacyImage($image)
    {
        if (
            $image &&
            !Str::startsWith($image, ['http://', 'https://'])
        ) {
            $path = public_path('uploads/testimonials/' . $image);

            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }

    public function index()
    {
        $testimonials = Testimonial::latest()->get();

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'display_order' => 'required|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploadedPublicId = null;

        try {
            $imageUrl = null;
            $imagePublicId = null;

            if ($request->hasFile('image')) {
                $upload = $this->uploadImage($request->file('image'));

                $imageUrl = $upload['url'];
                $imagePublicId = $upload['public_id'];
                $uploadedPublicId = $imagePublicId;
            }

            Testimonial::create([
                'name' => $validated['name'],
                'designation' => $validated['designation'],
                'review' => $validated['review'],
                'rating' => $validated['rating'],
                'display_order' => $validated['display_order'],
                'status' => $validated['status'],
                'image' => $imageUrl,
                'image_public_id' => $imagePublicId,
            ]);

        } catch (\Throwable $e) {
            if ($uploadedPublicId) {
                $this->deleteCloudinaryImage($uploadedPublicId);
            }

            Log::error('Testimonial creation failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Testimonial could not be added. Please try again.');
        }

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial Added Successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'display_order' => 'required|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $oldImage = $testimonial->image;
        $oldPublicId = $testimonial->image_public_id;
        $newPublicId = null;

        try {
            $data = [
                'name' => $validated['name'],
                'designation' => $validated['designation'],
                'review' => $validated['review'],
                'rating' => $validated['rating'],
                'display_order' => $validated['display_order'],
                'status' => $validated['status'],
            ];

            if ($request->hasFile('image')) {
                $upload = $this->uploadImage($request->file('image'));

                $newPublicId = $upload['public_id'];

                $data['image'] = $upload['url'];
                $data['image_public_id'] = $upload['public_id'];
            }

            $testimonial->update($data);

        } catch (\Throwable $e) {
            if ($newPublicId) {
                $this->deleteCloudinaryImage($newPublicId);
            }

            Log::error('Testimonial update failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Testimonial could not be updated. Please try again.');
        }

        // Delete old image only after successful update.
        if ($newPublicId && $oldImage) {
            if ($oldPublicId) {
                $this->deleteCloudinaryImage($oldPublicId);
            } else {
                $this->deleteLegacyImage($oldImage);
            }
        }

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial Updated Successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $image = $testimonial->image;
        $publicId = $testimonial->image_public_id;

        try {
            $testimonial->delete();

            if ($publicId) {
                $this->deleteCloudinaryImage($publicId);
            } else {
                $this->deleteLegacyImage($image);
            }

        } catch (\Throwable $e) {
            Log::error('Testimonial deletion failed: ' . $e->getMessage());

            return back()->with('error', 'Testimonial could not be deleted.');
        }

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial Deleted Successfully.');
    }
}
