<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstagramGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link' => 'nullable|url',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/instagram'),
                $imageName
            );
        }

        InstagramGallery::create([
            'image' => $imageName,
            'link' => $request->link,
            'status' => $request->has('status') ? 1 : 0,
            'display_order' => $request->display_order ?? 0,
        ]);

        return redirect()
            ->route('admin.instagram.index')
            ->with('success', 'Instagram image added successfully.');
    }

    public function edit(InstagramGallery $instagram)
    {
        return view('admin.instagram.form', [
            'gallery' => $instagram
        ]);
    }

    public function update(Request $request, InstagramGallery $instagram)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link' => 'nullable|url',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $imageName = $instagram->image;

        if ($request->hasFile('image')) {

            $oldImage = public_path(
                'uploads/instagram/' . $instagram->image
            );

            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }

            $image = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/instagram'),
                $imageName
            );
        }

        $instagram->update([
            'image' => $imageName,
            'link' => $request->link,
            'status' => $request->has('status') ? 1 : 0,
            'display_order' => $request->display_order ?? 0,
        ]);

        return redirect()
            ->route('admin.instagram.index')
            ->with('success', 'Instagram image updated successfully.');
    }

    public function destroy(InstagramGallery $instagram)
    {
        $imagePath = public_path(
            'uploads/instagram/' . $instagram->image
        );

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $instagram->delete();

        return redirect()
            ->route('admin.instagram.index')
            ->with('success', 'Instagram image deleted successfully.');
    }
}