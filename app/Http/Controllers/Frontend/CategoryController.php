<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    // ALL CATEGORIES PAGE
    public function index()
    {
        $allCategories = Category::where('status', 1)
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', 1);
                }
            ])
            ->orderBy('display_order')
            ->get();

        return view('frontend.categories', compact('allCategories'));
    }


    // SINGLE CATEGORY PRODUCTS PAGE
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $products = Product::with(['category', 'images'])
            ->where('category_id', $category->id)
            ->where('status', 1)
            ->latest()
            ->paginate(12);

        return view('frontend.category', compact(
            'category',
            'products'
        ));
    }
}