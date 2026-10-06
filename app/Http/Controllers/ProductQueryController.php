<?php

namespace App\Http\Controllers;

use App\Models\ProductQuery;
use Illuminate\Http\Request;

class ProductQueryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:50',
            'email'      => 'nullable|email|max:255',
            'subject'    => 'nullable|string|max:255',
            'message'    => 'required|string|max:2000',
        ]);

        ProductQuery::create($validated);

        return back()->with(
            'query_success',
            'Your product query has been submitted successfully.'
        );
    }
}