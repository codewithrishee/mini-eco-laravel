<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    private function uploadCategoryImage($file): array
    {
        $result = Cloudinary::uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'rv-store/categories',
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
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $uploadedImage = $this->uploadCategoryImage(
            $request->file('image')
        );

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'image' => $uploadedImage['url'],
            'image_public_id' => $uploadedImage['public_id'],
            'status' => $request->has('status') ? 1 : 0,
            'display_order' => $validated['display_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category Added Successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $oldPublicId = $category->image_public_id;
        $uploadedImage = null;

        $data = [
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'status' => $request->has('status') ? 1 : 0,
            'display_order' => $validated['display_order'] ?? 0,
        ];

        if ($request->hasFile('image')) {
            $uploadedImage = $this->uploadCategoryImage(
                $request->file('image')
            );

            $data['image'] = $uploadedImage['url'];
            $data['image_public_id'] = $uploadedImage['public_id'];
        }

        $category->update($data);

        if ($uploadedImage && $oldPublicId) {
            $this->deleteCloudinaryImage($oldPublicId);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category Updated Successfully.');
    }

    public function destroy(Category $category)
    {
        $publicId = $category->image_public_id;

        $category->delete();

        if ($publicId) {
            $this->deleteCloudinaryImage($publicId);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category Deleted Successfully.');
    }
}
