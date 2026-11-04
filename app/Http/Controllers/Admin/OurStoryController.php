<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurStory;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OurStoryController extends Controller
{
    private function uploadImage($image, $folder): array
    {
        $result = Cloudinary::uploadApi()->upload(
            $image->getRealPath(),
            [
                'folder' => 'rv-store/' . $folder,
                'resource_type' => 'image',
            ]
        );

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id'],
        ];
    }

    private function deleteCloudinaryImage($publicId): void
    {
        if (!$publicId) {
            return;
        }

        try {
            Cloudinary::uploadApi()->destroy($publicId);
        } catch (\Throwable $e) {
            Log::error('Cloudinary image deletion failed', [
                'public_id' => $publicId,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function deleteLegacyImage($image): void
    {
        if (
            !$image ||
            Str::startsWith($image, ['http://', 'https://'])
        ) {
            return;
        }

        $path = public_path('uploads/about/' . $image);

        if (file_exists($path)) {
            unlink($path);
        }
    }

    private function deleteOldImage($image, $publicId): void
    {
        if ($publicId) {
            $this->deleteCloudinaryImage($publicId);
        } else {
            $this->deleteLegacyImage($image);
        }
    }

    public function index()
    {
        $ourStory = OurStory::first();

        return view('admin.our-story.index', compact('ourStory'));
    }

    public function edit()
    {
        $ourStory = OurStory::first();

        if (!$ourStory) {
            $ourStory = new OurStory();
        }

        return view('admin.our-story.form', compact('ourStory'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'tag' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'description' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'floating_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $ourStory = OurStory::first();

        if (!$ourStory) {
            $ourStory = new OurStory();
        }

        $oldMainImage = $ourStory->main_image;
        $oldMainPublicId = $ourStory->main_image_public_id;

        $oldFloatingImage = $ourStory->floating_image;
        $oldFloatingPublicId = $ourStory->floating_image_public_id;

        $uploadedImages = [];
        $replaceMainImage = $request->hasFile('main_image');
        $replaceFloatingImage = $request->hasFile('floating_image');

        try {
            $ourStory->tag = $validated['tag'] ?? null;
            $ourStory->title = $validated['title'];
            $ourStory->highlight_text = $validated['highlight_text'] ?? null;
            $ourStory->description = $validated['description'];

            if ($replaceMainImage) {
                $upload = $this->uploadImage(
                    $request->file('main_image'),
                    'our-story'
                );

                $uploadedImages[] = $upload['public_id'];

                $ourStory->main_image = $upload['url'];
                $ourStory->main_image_public_id = $upload['public_id'];
            }

            if ($replaceFloatingImage) {
                $upload = $this->uploadImage(
                    $request->file('floating_image'),
                    'our-story'
                );

                $uploadedImages[] = $upload['public_id'];

                $ourStory->floating_image = $upload['url'];
                $ourStory->floating_image_public_id = $upload['public_id'];
            }

            $ourStory->save();

        } catch (\Throwable $e) {
            foreach ($uploadedImages as $publicId) {
                $this->deleteCloudinaryImage($publicId);
            }

            Log::error('Our Story update failed', [
                'message' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Our Story update failed. Please try again.');
        }

        if ($replaceMainImage) {
            $this->deleteOldImage($oldMainImage, $oldMainPublicId);
        }

        if ($replaceFloatingImage) {
            $this->deleteOldImage($oldFloatingImage, $oldFloatingPublicId);
        }

        return redirect()
            ->route('admin.our-story.index')
            ->with('success', 'Our Story updated successfully.');
    }
}
