<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'review' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'display_order' => 'required|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('uploads/testimonials'), $imageName);
        }

        Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'review' => $request->review,
            'rating' => $request->rating,
            'display_order' => $request->display_order,
            'status' => $request->status,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial Added Successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'review' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'display_order' => 'required|integer',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = $testimonial->image;

        if ($request->hasFile('image')) {

            if ($testimonial->image && File::exists(public_path('uploads/testimonials/'.$testimonial->image))) {
                File::delete(public_path('uploads/testimonials/'.$testimonial->image));
            }

            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('uploads/testimonials'), $imageName);
        }

        $testimonial->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'review' => $request->review,
            'rating' => $request->rating,
            'display_order' => $request->display_order,
            'status' => $request->status,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial Updated Successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image && File::exists(public_path('uploads/testimonials/'.$testimonial->image))) {
            File::delete(public_path('uploads/testimonials/'.$testimonial->image));
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial Deleted Successfully.');
    }
}