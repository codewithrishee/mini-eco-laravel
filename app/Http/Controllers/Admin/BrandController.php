<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('display_order')->get();

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.form');
    }

    private function uploadBrandLogo($file): array
    {
        $result = Cloudinary::uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'rv-store/brands',
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
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $uploadedLogo = $this->uploadBrandLogo($request->file('logo'));

        Brand::create([
            'name' => $validated['name'],
            'logo' => $uploadedLogo['url'],
            'logo_public_id' => $uploadedLogo['public_id'],
            'status' => $request->has('status') ? 1 : 0,
            'display_order' => $validated['display_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand added successfully.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.form', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $oldPublicId = $brand->logo_public_id;
        $uploadedLogo = null;

        $data = [
            'name' => $validated['name'],
            'status' => $request->has('status') ? 1 : 0,
            'display_order' => $validated['display_order'] ?? 0,
        ];

        if ($request->hasFile('logo')) {
            $uploadedLogo = $this->uploadBrandLogo(
                $request->file('logo')
            );

            $data['logo'] = $uploadedLogo['url'];
            $data['logo_public_id'] = $uploadedLogo['public_id'];
        }

        $brand->update($data);

        if ($uploadedLogo && $oldPublicId) {
            $this->deleteCloudinaryImage($oldPublicId);
        }

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $publicId = $brand->logo_public_id;

        $brand->delete();

        if ($publicId) {
            $this->deleteCloudinaryImage($publicId);
        }

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }
}
