<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
{
    return view('admin.faqs.form');
}

public function edit(Faq $faq)
{
    return view('admin.faqs.form', compact('faq'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'status'   => 'nullable|boolean',
        ]);

        Faq::create([
            'question' => $validated['question'],
            'answer'   => $validated['answer'],
            'status'   => $request->boolean('status'),
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ added successfully.');
    }


    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer'   => 'required|string',
            'status'   => 'nullable|boolean',
        ]);

        $faq->update([
            'question' => $validated['question'],
            'answer'   => $validated['answer'],
            'status'   => $request->boolean('status'),
        ]);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }


    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }
}