<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductQuery;

class ProductQueryController extends Controller
{
    /**
     * Show all product queries
     */
    public function index()
    {
        $queries = ProductQuery::with('product')
            ->latest()
            ->paginate(10);

        return view('admin.product-queries.index', compact('queries'));
    }


    /**
     * Show single product query
     */
    public function show(ProductQuery $productQuery)
    {
        $productQuery->load('product');

        return view(
            'admin.product-queries.show',
            compact('productQuery')
        );
    }


    /**
     * Delete product query
     */
    public function destroy(ProductQuery $productQuery)
    {
        $productQuery->delete();

        return redirect()
            ->route('admin.product-queries.index')
            ->with('success', 'Product query deleted successfully.');
    }
}