<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;

class HeroSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = HeroSlider::latest()->get();
        return view('admin.hero-sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hero-sliders.form');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $request->validate([
        'badge' => 'nullable|string|max:255',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',

        'button1_text' => 'nullable|string|max:255',
        'button1_link' => 'nullable|string|max:255',

        'button2_text' => 'nullable|string|max:255',
        'button2_link' => 'nullable|string|max:255',

        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

        'display_order' => 'required|integer',

        'status' => 'required|boolean',
    ]);

    $imageName = null;

    if ($request->hasFile('image')) {

        $image = $request->file('image');

        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('uploads/hero-sliders'), $imageName);
    }

    HeroSlider::create([

        'badge' => $request->badge,
        'title' => $request->title,
        'description' => $request->description,

        'button1_text' => $request->button1_text,
        'button1_link' => $request->button1_link,

        'button2_text' => $request->button2_text,
        'button2_link' => $request->button2_link,

        'image' => $imageName,

        'display_order' => $request->display_order,

        'status' => $request->status,

    ]);

    return redirect()
            ->route('admin.hero-sliders.index')
            ->with('success', 'Hero Slider Added Successfully.');
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
  public function edit(HeroSlider $hero_slider)
{
    $slider = $hero_slider;

    return view('admin.hero-sliders.form', compact('slider'));
}

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, HeroSlider $hero_slider)
{
    $request->validate([

        'badge' => 'nullable|string|max:255',

        'title' => 'required|max:255',

        'description' => 'nullable',

        'button1_text' => 'nullable|max:255',

        'button1_link' => 'nullable|max:255',

        'button2_text' => 'nullable|max:255',

        'button2_link' => 'nullable|max:255',

        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'display_order' => 'required|integer',

        'status' => 'required|boolean',

    ]);

    $imageName = $hero_slider->image;

    if ($request->hasFile('image')) {

        if ($hero_slider->image &&
            file_exists(public_path('uploads/hero-sliders/'.$hero_slider->image))) {

            unlink(public_path('uploads/hero-sliders/'.$hero_slider->image));
        }

        $image = $request->file('image');

        $imageName = time().'.'.$image->getClientOriginalExtension();

        $image->move(public_path('uploads/hero-sliders'),$imageName);
    }

    $hero_slider->update([

        'badge'=>$request->badge,

        'title'=>$request->title,

        'description'=>$request->description,

        'button1_text'=>$request->button1_text,

        'button1_link'=>$request->button1_link,

        'button2_text'=>$request->button2_text,

        'button2_link'=>$request->button2_link,

        'image'=>$imageName,

        'display_order'=>$request->display_order,

        'status'=>$request->status,

    ]);

    return redirect()
            ->route('admin.hero-sliders.index')
            ->with('success','Hero Slider Updated Successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(HeroSlider $hero_slider)
{

    if ($hero_slider->image &&
        file_exists(public_path('uploads/hero-sliders/'.$hero_slider->image)))
    {

        unlink(public_path('uploads/hero-sliders/'.$hero_slider->image));

    }

    $hero_slider->delete();

    return redirect()
            ->route('admin.hero-sliders.index')
            ->with('success','Hero Slider Deleted Successfully.');
}
}
