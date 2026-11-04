<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstagramGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class InstagramGalleryController extends Controller
{
    public function index()
    {
        $galleries = InstagramGallery::orderBy('display_order')->get();

        return view('admin.instagram.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.instagram.form');
    }

    private function uploadInstagramImage($image): array
    {
        $result = Cloudinary::uploadApi()->upload(
            $image->getRealPath(),
            [
                'folder' => 'rv-store/instagram',
                'resource_type' => 'image',
            ]
        );

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id'],
        ];
    }

    private function deleteInstagramImage(?string $publicId): void
    {
        if (!$publicId) {
            return;
        }

        try {
            Cloudinary::uploadApi()->destroy($publicId);
        } catch (\Throwable $e) {
            Log::error('Instagram Cloudinary Delete Failed', [
                'public_id' => $publicId,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function deleteLegacyImage(?string $image): void
    {
        if (
            !$image ||
            Str::startsWith($image, ['http://', 'https://'])
        ) {
            return;
        }

        $imagePath = public_path('uploads/instagram/' . $image);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link' => 'nullable|url',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $uploadedImage = null;

        try {
            $uploadedImage = $this->uploadInstagramImage(
                $request->file('image')
            );

            InstagramGallery::create([
                'image' => $uploadedImage['url'],
                'image_public_id' => $uploadedImage['public_id'],
                'link' => $request->link,
                'status' => $request->has('status') ? 1 : 0,
                'display_order' => $request->display_order ?? 0,
            ]);

            return redirect()
                ->route('admin.instagram.index')
                ->with('success', 'Instagram image added successfully.');

        } catch (\Throwable $e) {
            if ($uploadedImage) {
                $this->deleteInstagramImage($uploadedImage['public_id']);
            }

            Log::error('Instagram Image Store Failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Instagram image upload failed. Please try again.');
        }
    }

    public function edit(InstagramGallery $instagram)
    {
        return view('admin.instagram.form', [
            'gallery' => $instagram,
        ]);
    }

    public function update(Request $request, InstagramGallery $instagram)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link' => 'nullable|url',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $uploadedImage = null;

        $oldImage = $instagram->image;
        $oldPublicId = $instagram->image_public_id;

        try {
            $imageUrl = $oldImage;
            $imagePublicId = $oldPublicId;

            if ($request->hasFile('image')) {
                $uploadedImage = $this->uploadInstagramImage(
                    $request->file('image')
                );

                $imageUrl = $uploadedImage['url'];
                $imagePublicId = $uploadedImage['public_id'];
            }

            $instagram->update([
                'image' => $imageUrl,
                'image_public_id' => $imagePublicId,
                'link' => $request->link,
                'status' => $request->has('status') ? 1 : 0,
                'display_order' => $request->display_order ?? 0,
            ]);

            if ($uploadedImage) {
                if ($oldPublicId) {
                    $this->deleteInstagramImage($oldPublicId);
                } else {
                    $this->deleteLegacyImage($oldImage);
                }
            }

            return redirect()
                ->route('admin.instagram.index')
                ->with('success', 'Instagram image updated successfully.');

        } catch (\Throwable $e) {
            if ($uploadedImage) {
                $this->deleteInstagramImage($uploadedImage['public_id']);
            }

            Log::error('Instagram Image Update Failed', [
                'gallery_id' => $instagram->id,
                'message' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Instagram image update failed. Please try again.');
        }
    }

    public function destroy(InstagramGallery $instagram)
    {
        $publicId = $instagram->image_public_id;
        $image = $instagram->image;

        try {
            $instagram->delete();

            if ($publicId) {
                $this->deleteInstagramImage($publicId);
            } else {
                $this->deleteLegacyImage($image);
            }

            return redirect()
                ->route('admin.instagram.index')
                ->with('success', 'Instagram image deleted successfully.');

        } catch (\Throwable $e) {
            Log::error('Instagram Image Delete Failed', [
                'gallery_id' => $instagram->id,
                'message' => $e->getMessage(),
            ]);

            return back()
                ->with('error', 'Instagram image delete failed.');
        }
    }
}
