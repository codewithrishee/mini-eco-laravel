<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::latest()->paginate(10);

        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'nullable|max:20',
            'display_order' => 'nullable|integer',
            'status' => 'required'
        ]);

        Color::create($request->all());

        return redirect()
            ->route('admin.colors.index')
            ->with('success', 'Color added successfully.');
    }

    public function edit(Color $color)
    {
        return view('admin.colors.form', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'nullable|max:20',
            'display_order' => 'nullable|integer',
            'status' => 'required'
        ]);

        $color->update($request->all());

        return redirect()
            ->route('admin.colors.index')
            ->with('success', 'Color updated successfully.');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()
            ->route('admin.colors.index')
            ->with('success', 'Color deleted successfully.');
    }
}