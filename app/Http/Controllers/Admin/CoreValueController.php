<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use Illuminate\Http\Request;

class CoreValueController extends Controller
{
    public function index()
    {
        $coreValues = CoreValue::orderBy('display_order')->get();
        return view('admin.core-values.index', compact('coreValues'));
    }

    public function create()
    {
        $coreValue = new CoreValue();
        return view('admin.core-values.form', compact('coreValue'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'required|string',
            'display_order' => 'nullable|integer|min:0',
        ]);

        CoreValue::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description,
            'display_order' => $request->display_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.core-values.index')
            ->with('success', 'Core Value added successfully.');
    }

    public function edit(CoreValue $coreValue)
    {
        return view('admin.core-values.form', compact('coreValue'));
    }

    public function update(Request $request, CoreValue $coreValue)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'required|string',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $coreValue->update([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description,
            'display_order' => $request->display_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.core-values.index')
            ->with('success', 'Core Value updated successfully.');
    }

    public function destroy(CoreValue $coreValue)
    {
        $coreValue->delete();

        return redirect()
            ->route('admin.core-values.index')
            ->with('success', 'Core Value deleted successfully.');
    }
}