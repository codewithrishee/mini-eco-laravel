<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyUs;
use Illuminate\Http\Request;

class WhyUsController extends Controller
{
    public function index()
    {
        $whyUsItems = WhyUs::orderBy('display_order')->get();
        return view('admin.why-us.index', compact('whyUsItems'));
    }

    public function create()
    {
        $whyUs = new WhyUs();
        return view('admin.why-us.form', compact('whyUs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'required|string',
            'display_order' => 'nullable|integer|min:0',
        ]);

        WhyUs::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description,
            'display_order' => $request->display_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.why-us.index')
            ->with('success', 'Why Us item added successfully.');
    }

    public function edit(WhyUs $whyUs)
    {
        return view('admin.why-us.form', compact('whyUs'));
    }

    public function update(Request $request, WhyUs $whyUs)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'required|string',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $whyUs->update([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description,
            'display_order' => $request->display_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('admin.why-us.index')
            ->with('success', 'Why Us item updated successfully.');
    }

    public function destroy(WhyUs $whyUs)
    {
        $whyUs->delete();

        return redirect()
            ->route('admin.why-us.index')
            ->with('success', 'Why Us item deleted successfully.');
    }
}