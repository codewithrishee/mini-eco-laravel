<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
// use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
public function index()
{
    $categories = Category::latest()->get();

    return view('admin.categories.index', compact('categories'));
}

    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    return view('admin.categories.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $image = time().'.'.$request->image->extension();
    $request->image->move(public_path('uploads/categories'), $image);

    Category::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'image' => $image,
        'status' => $request->status,
        'display_order' => $request->display_order,
    ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category Added Successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Category $category)
{
    return view('admin.categories.edit', compact('category'));
}

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $image = $category->image;

    if ($request->hasFile('image')) {

        if (file_exists(public_path('uploads/categories/'.$category->image))) {
            unlink(public_path('uploads/categories/'.$category->image));
        }

        $image = time().'.'.$request->image->extension();

        $request->image->move(
            public_path('uploads/categories'),
            $image
        );
    }

    $category->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'image' => $image,
        'status' => $request->status,
        'display_order' => $request->display_order,
    ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success','Category Updated Successfully.');
}
    /**
     * Remove the specified resource from storage.
     */
public function destroy(Category $category)
{
    if (file_exists(public_path('uploads/categories/'.$category->image))) {
        unlink(public_path('uploads/categories/'.$category->image));
    }

    $category->delete();

    return redirect()
        ->route('admin.categories.index')
        ->with('success','Category Deleted Successfully.');
}
}
