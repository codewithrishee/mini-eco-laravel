<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $logoName = null;

        if ($request->hasFile('logo')) {

            $logo = $request->file('logo');

            $logoName = time() . '_' . uniqid() . '.' .
                $logo->getClientOriginalExtension();

            $logo->move(
                public_path('uploads/brands'),
                $logoName
            );
        }

        Brand::create([
            'name' => $request->name,
            'logo' => $logoName,
            'status' => $request->has('status') ? 1 : 0,
            'display_order' => $request->display_order ?? 0,
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
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $logoName = $brand->logo;

        if ($request->hasFile('logo')) {

            if ($brand->logo) {

                $oldLogo = public_path(
                    'uploads/brands/' . $brand->logo
                );

                if (File::exists($oldLogo)) {
                    File::delete($oldLogo);
                }
            }

            $logo = $request->file('logo');

            $logoName = time() . '_' . uniqid() . '.' .
                $logo->getClientOriginalExtension();

            $logo->move(
                public_path('uploads/brands'),
                $logoName
            );
        }

        $brand->update([
            'name' => $request->name,
            'logo' => $logoName,
            'status' => $request->has('status') ? 1 : 0,
            'display_order' => $request->display_order ?? 0,
        ]);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->logo) {

            $logoPath = public_path(
                'uploads/brands/' . $brand->logo
            );

            if (File::exists($logoPath)) {
                File::delete($logoPath);
            }
        }

        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }
}