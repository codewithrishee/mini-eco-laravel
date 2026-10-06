<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

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

  public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp',
        'position' => 'required',
    ]);

    $imageName = time().'.'.$request->image->extension();

    $request->image->move(public_path('uploads/banners'), $imageName);

    Banner::create([
        'title'         => $request->title,
        'subtitle'      => $request->subtitle,
        'button_text'   => $request->button_text,
        'button_link'   => $request->button_link,
        'image'         => $imageName,
        'position'      => $request->position,
        'display_order' => $request->display_order,
        'status'        => $request->status,
    ]);

    return redirect()->route('admin.banners.index')
        ->with('success', 'Banner Added Successfully');
}

public function show(Banner $banner)
{
    return redirect()->route('banners.index');
}

public function edit(Banner $banner)
{
    return view('admin.banners.form', compact('banner'));
}

public function update(Request $request, Banner $banner)
{
    $request->validate([
        'title' => 'required',
        'position' => 'required',
    ]);

    $imageName = $banner->image;

    if ($request->hasFile('image')) {

        if (file_exists(public_path('uploads/banners/' . $banner->image))) {
            unlink(public_path('uploads/banners/' . $banner->image));
        }

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('uploads/banners'), $imageName);
    }

    $banner->update([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'button_text' => $request->button_text,
        'button_link' => $request->button_link,
        'image' => $imageName,
        'position' => $request->position,
        'display_order' => $request->display_order,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.banners.index')
        ->with('success', 'Banner Updated Successfully');
}

public function destroy(Banner $banner)
{
    if (file_exists(public_path('uploads/banners/' . $banner->image))) {
        unlink(public_path('uploads/banners/' . $banner->image));
    }

    $banner->delete();

    return redirect()->route('admin.banners.index')
        ->with('success', 'Banner Deleted Successfully');
}
}