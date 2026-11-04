<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreInformation;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StoreInformationController extends Controller
{
    private function uploadImage($image)
    {
        $result = Cloudinary::uploadApi()->upload(
            $image->getRealPath(),
            [
                'folder' => 'rv-store/store-information',
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
            Log::error('Store Information Cloudinary deletion failed: ' . $e->getMessage());
        }
    }

    private function deleteLegacyImage($image)
    {
        if (
            $image &&
            !Str::startsWith($image, ['http://', 'https://'])
        ) {
            $imagePath = public_path('uploads/store/' . $image);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
    }

    /**
     * Show Store / Customer Assistance Settings
     */
    public function index()
    {
        $store = StoreInformation::first();

        return view('admin.store-information.index', compact('store'));
    }

    /**
     * Add / Update Store Information
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'heading' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'product_query_text' => 'nullable|string|max:255',
            'availability_text' => 'nullable|string|max:255',
            'whatsapp_text' => 'nullable|string|max:255',
            'support_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'map_url' => 'nullable|string',
        ]);

        $store = StoreInformation::first();

        if (!$store) {
            $store = new StoreInformation();
        }

        // Capture old image details before updating.
        $oldImage = $store->image;
        $oldPublicId = $store->image_public_id;

        $newPublicId = null;

        try {
            // Upload replacement image to Cloudinary.
            if ($request->hasFile('image')) {
                $upload = $this->uploadImage($request->file('image'));

                $newPublicId = $upload['public_id'];

                $store->image = $upload['url'];
                $store->image_public_id = $upload['public_id'];
            }

            // Customer Assistance Information
            $store->heading = $validated['heading'] ?? null;
            $store->description = $validated['description'] ?? null;
            $store->product_query_text = $validated['product_query_text'] ?? null;
            $store->availability_text = $validated['availability_text'] ?? null;
            $store->whatsapp_text = $validated['whatsapp_text'] ?? null;

            // Contact Information
            $store->support_email = $validated['support_email'] ?? null;
            $store->phone = $validated['phone'] ?? null;

            // Google Map
            $store->map_url = $validated['map_url'] ?? null;

            // Save database record.
            $store->save();

        } catch (\Throwable $e) {
            // Remove newly uploaded image if database save fails.
            if ($newPublicId) {
                $this->deleteCloudinaryImage($newPublicId);
            }

            Log::error('Store Information update failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Store information update failed. Please try again.');
        }

        // Delete old image only after successful database save.
        if ($newPublicId && $oldImage) {
            if ($oldPublicId) {
                $this->deleteCloudinaryImage($oldPublicId);
            } else {
                $this->deleteLegacyImage($oldImage);
            }
        }

        return redirect()
            ->route('admin.store-information.index')
            ->with('success', 'Customer assistance information updated successfully.');
    }
public function destroy()
{
    $store = StoreInformation::first();

    if (!$store) {
        return redirect()
            ->route('admin.store-information.index')
            ->with('success', 'Customer assistance information deleted successfully.');
    }

    $image = $store->image;
    $publicId = $store->image_public_id;

    try {
        $store->delete();

        if ($publicId) {
            $this->deleteCloudinaryImage($publicId);
        } else {
            $this->deleteLegacyImage($image);
        }

        return redirect()
            ->route('admin.store-information.index')
            ->with('success', 'Customer assistance information deleted successfully.');

    } catch (\Throwable $e) {
        Log::error('Store Information Delete Failed', [
            'message' => $e->getMessage(),
        ]);

        return back()
            ->with('error', 'Customer assistance information could not be deleted.');
    }
}

}
