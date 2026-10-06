<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurStory;
use Illuminate\Http\Request;

class OurStoryController extends Controller
{
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
        $request->validate([
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

        $ourStory->tag = $request->tag;
        $ourStory->title = $request->title;
        $ourStory->highlight_text = $request->highlight_text;
        $ourStory->description = $request->description;

        if ($request->hasFile('main_image')) {
            if ($ourStory->main_image && file_exists(public_path('uploads/about/' . $ourStory->main_image))) {
                unlink(public_path('uploads/about/' . $ourStory->main_image));
            }

            $mainImage = time() . '_main.' . $request->main_image->extension();
            $request->main_image->move(public_path('uploads/about'), $mainImage);
            $ourStory->main_image = $mainImage;
        }

        if ($request->hasFile('floating_image')) {
            if ($ourStory->floating_image && file_exists(public_path('uploads/about/' . $ourStory->floating_image))) {
                unlink(public_path('uploads/about/' . $ourStory->floating_image));
            }

            $floatingImage = time() . '_floating.' . $request->floating_image->extension();
            $request->floating_image->move(public_path('uploads/about'), $floatingImage);
            $ourStory->floating_image = $floatingImage;
        }

        $ourStory->save();

        return redirect()
            ->route('admin.our-story.index')
            ->with('success', 'Our Story updated successfully.');
    }
}