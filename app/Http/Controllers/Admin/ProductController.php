<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Color;
use App\Models\Size;
use App\Models\Material;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with(['category', 'images'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.form', [
            'categories' => Category::where('status', 1)->get(),
            'colors'     => Color::where('status', 1)->get(),
            'sizes'      => Size::where('status', 1)->get(),
            'materials'  => Material::where('status', 1)->get(),
            'tags'       => Tag::where('status', 1)->get(),
        ]);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'        => 'required|exists:categories,id',
            'name'               => 'required|string|max:255',
            'slug'               => 'nullable|string|max:255|unique:products,slug',
            'sku'                => 'nullable|string|max:100|unique:products,sku',
            'price'              => 'required|numeric|min:0',
            'sale_price'         => 'nullable|numeric|min:0|lt:price',
            'stock'              => 'required|integer|min:0',
            'short_description'  => 'nullable|string',
            'description'        => 'nullable|string',
            'meta_title'         => 'nullable|string|max:255',
            'meta_description'   => 'nullable|string',
            'meta_keywords'      => 'nullable|string|max:255',
            'status'             => 'nullable|boolean',
            'is_featured'        => 'nullable|boolean',
            'is_best_seller'     => 'nullable|boolean',
            'is_new_arrival'     => 'nullable|boolean',
            'is_flash_sale'      => 'nullable|boolean',
            'colors'             => 'nullable|array',
            'colors.*'           => 'exists:colors,id',
            'sizes'              => 'nullable|array',
            'sizes.*'            => 'exists:sizes,id',
            'materials'          => 'nullable|array',
            'materials.*'        => 'exists:materials,id',
            'tags'               => 'nullable|array',
            'tags.*'             => 'exists:tags,id',
            'images.*'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Create product
        $product = Product::create([
            'category_id'      => $validated['category_id'],
            'name'             => $validated['name'],
            'slug'             => $validated['slug'],
            'sku'              => $validated['sku'] ?? null,
            'price'            => $validated['price'],
            'sale_price'       => $validated['sale_price'] ?? null,
            'stock'            => $validated['stock'],
            'short_description'=> $validated['short_description'] ?? null,
            'description'      => $validated['description'] ?? null,
            'meta_title'       => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords'    => $validated['meta_keywords'] ?? null,
            'status'           => $request->has('status') ? 1 : 0,
            'is_featured'      => $request->has('is_featured') ? 1 : 0,
            'is_best_seller'   => $request->has('is_best_seller') ? 1 : 0,
            'is_new_arrival'   => $request->has('is_new_arrival') ? 1 : 0,
            'is_flash_sale'    => $request->has('is_flash_sale') ? 1 : 0,
        ]);

        // Sync attributes
        if (isset($validated['colors'])) {
            $product->colors()->sync($validated['colors']);
        }
        if (isset($validated['sizes'])) {
            $product->sizes()->sync($validated['sizes']);
        }
        if (isset($validated['materials'])) {
            $product->materials()->sync($validated['materials']);
        }
        if (isset($validated['tags'])) {
            $product->tags()->sync($validated['tags']);
        }

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $imageName,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        // Optional: return a detail view
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $product->load(['images', 'colors', 'sizes', 'materials', 'tags']);

        return view('admin.products.form', [
            'product'    => $product,
            'categories' => Category::where('status', 1)->get(),
            'colors'     => Color::where('status', 1)->get(),
            'sizes'      => Size::where('status', 1)->get(),
            'materials'  => Material::where('status', 1)->get(),
            'tags'       => Tag::where('status', 1)->get(),
        ]);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id'        => 'required|exists:categories,id',
            'name'               => 'required|string|max:255',
            'slug'               => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'sku'                => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'price'              => 'required|numeric|min:0',
            'sale_price'         => 'nullable|numeric|min:0|lt:price',
            'stock'              => 'required|integer|min:0',
            'short_description'  => 'nullable|string',
            'description'        => 'nullable|string',
            'meta_title'         => 'nullable|string|max:255',
            'meta_description'   => 'nullable|string',
            'meta_keywords'      => 'nullable|string|max:255',
            'status'             => 'nullable|boolean',
            'is_featured'        => 'nullable|boolean',
            'is_best_seller'     => 'nullable|boolean',
            'is_new_arrival'     => 'nullable|boolean',
            'is_flash_sale'      => 'nullable|boolean',
            'colors'             => 'nullable|array',
            'colors.*'           => 'exists:colors,id',
            'sizes'              => 'nullable|array',
            'sizes.*'            => 'exists:sizes,id',
            'materials'          => 'nullable|array',
            'materials.*'        => 'exists:materials,id',
            'tags'               => 'nullable|array',
            'tags.*'             => 'exists:tags,id',
            'images.*'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Update product
        $product->update([
            'category_id'      => $validated['category_id'],
            'name'             => $validated['name'],
            'slug'             => $validated['slug'],
            'sku'              => $validated['sku'] ?? null,
            'price'            => $validated['price'],
            'sale_price'       => $validated['sale_price'] ?? null,
            'stock'            => $validated['stock'],
            'short_description'=> $validated['short_description'] ?? null,
            'description'      => $validated['description'] ?? null,
            'meta_title'       => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords'    => $validated['meta_keywords'] ?? null,
            'status'           => $request->has('status') ? 1 : 0,
            'is_featured'      => $request->has('is_featured') ? 1 : 0,
            'is_best_seller'   => $request->has('is_best_seller') ? 1 : 0,
            'is_new_arrival'   => $request->has('is_new_arrival') ? 1 : 0,
            'is_flash_sale'    => $request->has('is_flash_sale') ? 1 : 0,
        ]);

        // Sync attributes
        $product->colors()->sync($validated['colors'] ?? []);
        $product->sizes()->sync($validated['sizes'] ?? []);
        $product->materials()->sync($validated['materials'] ?? []);
        $product->tags()->sync($validated['tags'] ?? []);

        // Upload new images (append to existing)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $imageName,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete associated images from storage and database
        foreach ($product->images as $image) {
            $path = public_path('uploads/products/' . $image->image);
            if (File::exists($path)) {
                File::delete($path);
            }
            $image->delete();
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}