<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $blog = new Blog();

        return view('admin.blogs.form', compact('blog'));
    }

    private function uploadBlogImage($file): array
    {
        $result = Cloudinary::uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'rv-store/blogs',
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
            'title' => 'required|max:255',
            'author' => 'nullable|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'required',
            'content' => 'required',
            'read_time' => 'required|integer|min:1',
        ]);

        $uploadedImage = $this->uploadBlogImage($request->file('image'));

        Blog::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'author' => $validated['author'] ?? null,
            'image' => $uploadedImage['url'],
            'image_public_id' => $uploadedImage['public_id'],
            'short_description' => $validated['short_description'],
            'content' => $validated['content'],
            'read_time' => $validated['read_time'],
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog Added Successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.form', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'required',
            'content' => 'required',
            'read_time' => 'required|integer|min:1',
        ]);

        $oldPublicId = $blog->image_public_id;
        $uploadedImage = null;

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'author' => $validated['author'] ?? null,
            'short_description' => $validated['short_description'],
            'content' => $validated['content'],
            'read_time' => $validated['read_time'],
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'status' => $request->has('status') ? 1 : 0,
        ];

        if ($request->hasFile('image')) {
            $uploadedImage = $this->uploadBlogImage(
                $request->file('image')
            );

            $data['image'] = $uploadedImage['url'];
            $data['image_public_id'] = $uploadedImage['public_id'];
        }

        $blog->update($data);

        if ($uploadedImage && $oldPublicId) {
            $this->deleteCloudinaryImage($oldPublicId);
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog Updated Successfully.');
    }

    public function destroy(Blog $blog)
    {
        $publicId = $blog->image_public_id;

        $blog->delete();

        if ($publicId) {
            $this->deleteCloudinaryImage($publicId);
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog Deleted Successfully.');
    }
}
