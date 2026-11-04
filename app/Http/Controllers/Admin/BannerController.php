<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.form');
    }

    private function uploadBannerImage($file): array
    {
        $result = Cloudinary::uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'rv-store/banners',
                'resource_type' => 'image',
            ]
        );

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id'],
        ];
    }

    private function deleteCloudinaryImage(?string $publicId): void
    {
        if ($publicId) {
            Cloudinary::uploadApi()->destroy($publicId, [
                'resource_type' => 'image',
            ]);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'position' => 'required|string',
            'display_order' => 'nullable|integer',
            'status' => 'nullable',
        ]);

        $uploadedImage = $this->uploadBannerImage($request->file('image'));

        Banner::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'button_text' => $validated['button_text'] ?? null,
            'button_link' => $validated['button_link'] ?? null,
            'image' => $uploadedImage['url'],
            'image_public_id' => $uploadedImage['public_id'],
            'position' => $validated['position'],
            'display_order' => $validated['display_order'] ?? 0,
            'status' => $validated['status'] ?? 1,
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner Added Successfully');
    }

    public function show(Banner $banner)
    {
        return redirect()->route('admin.banners.index');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.form', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'position' => 'required|string',
            'display_order' => 'nullable|integer',
            'status' => 'nullable',
        ]);

        $oldPublicId = $banner->image_public_id;

        $data = [
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'button_text' => $validated['button_text'] ?? null,
            'button_link' => $validated['button_link'] ?? null,
            'position' => $validated['position'],
            'display_order' => $validated['display_order'] ?? 0,
            'status' => $validated['status'] ?? 1,
        ];

        $uploadedImage = null;

        if ($request->hasFile('image')) {
            $uploadedImage = $this->uploadBannerImage(
                $request->file('image')
            );

            $data['image'] = $uploadedImage['url'];
            $data['image_public_id'] = $uploadedImage['public_id'];
        }

        $banner->update($data);

        if ($uploadedImage && $oldPublicId) {
            $this->deleteCloudinaryImage($oldPublicId);
        }

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner Updated Successfully');
    }

    public function destroy(Banner $banner)
    {
        $publicId = $banner->image_public_id;

        $banner->delete();

        if ($publicId) {
            $this->deleteCloudinaryImage($publicId);
        }

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner Deleted Successfully');
    }
}
