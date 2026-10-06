<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'nullable|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'required',
            'content' => 'required',
            'read_time' => 'required|integer|min:1',
        ]);

        $image = time().'.'.$request->image->extension();

        $request->image->move(
            public_path('uploads/blogs'),
            $image
        );

        Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),

            'author' => $request->author,
            'image' => $image,
            'short_description' => $request->short_description,
            'content' => $request->content,
            'read_time' => $request->read_time,
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
        $request->validate([
            'title' => 'required|max:255',
            
            'author' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'required',
            'content' => 'required',
            'read_time' => 'required|integer|min:1',
        ]);

        $image = $blog->image;

        if ($request->hasFile('image')) {
            if (
                $blog->image &&
                file_exists(public_path('uploads/blogs/'.$blog->image))
            ) {
                unlink(public_path('uploads/blogs/'.$blog->image));
            }

            $image = time().'.'.$request->image->extension();

            $request->image->move(
                public_path('uploads/blogs'),
                $image
            );
        }

        $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            
            'author' => $request->author,
            'image' => $image,
            'short_description' => $request->short_description,
            'content' => $request->content,
            'read_time' => $request->read_time,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog Updated Successfully.');
    }

    public function destroy(Blog $blog)
    {
        if (
            $blog->image &&
            file_exists(public_path('uploads/blogs/'.$blog->image))
        ) {
            unlink(public_path('uploads/blogs/'.$blog->image));
        }

        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog Deleted Successfully.');
    }
}