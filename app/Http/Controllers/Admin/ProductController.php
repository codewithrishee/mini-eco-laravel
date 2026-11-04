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
use Illuminate\Support\Facades\DB;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'images'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', [
            'categories' => Category::where('status', 1)->get(),
            'colors' => Color::where('status', 1)->get(),
            'sizes' => Size::where('status', 1)->get(),
            'materials' => Material::where('status', 1)->get(),
            'tags' => Tag::where('status', 1)->get(),
        ]);
    }

    private function uploadProductImage($file): array
    {
        $result = Cloudinary::uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder' => 'rv-store/products',
                'resource_type' => 'image',
            ]
        );

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id'],
        ];
    }

    private function deleteCloudinaryImage(?string $publicId): void
    {
        if (!$publicId) {
            return;
        }

        Cloudinary::uploadApi()->destroy($publicId, [
            'resource_type' => 'image',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'sizes' => 'nullable|array',
            'sizes.*' => 'exists:sizes,id',
            'materials' => 'nullable|array',
            'materials.*' => 'exists:materials,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validated['slug'] = !empty($validated['slug'])
            ? $validated['slug']
            : Str::slug($validated['name']);

        $uploadedPublicIds = [];

        try {
            DB::beginTransaction();

            $product = Product::create([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'sku' => $validated['sku'] ?? null,
                'price' => $validated['price'],
                'sale_price' => $validated['sale_price'] ?? null,
                'stock' => $validated['stock'],
                'short_description' => $validated['short_description'] ?? null,
                'description' => $validated['description'] ?? null,
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'status' => $request->has('status') ? 1 : 0,
                'is_featured' => $request->has('is_featured') ? 1 : 0,
                'is_best_seller' => $request->has('is_best_seller') ? 1 : 0,
                'is_new_arrival' => $request->has('is_new_arrival') ? 1 : 0,
                'is_flash_sale' => $request->has('is_flash_sale') ? 1 : 0,
            ]);

            $product->colors()->sync($validated['colors'] ?? []);
            $product->sizes()->sync($validated['sizes'] ?? []);
            $product->materials()->sync($validated['materials'] ?? []);
            $product->tags()->sync($validated['tags'] ?? []);

            foreach ($request->file('images', []) as $image) {
                $uploaded = $this->uploadProductImage($image);
                $uploadedPublicIds[] = $uploaded['public_id'];

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $uploaded['url'],
                    'image_public_id' => $uploaded['public_id'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product added successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();

            foreach ($uploadedPublicIds as $publicId) {
                try {
                    $this->deleteCloudinaryImage($publicId);
                } catch (\Throwable $deleteError) {
                    report($deleteError);
                }
            }

            report($e);

            return back()
                ->withInput()
                ->with('error', 'Product could not be saved. Please try again.');
        }
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'colors', 'sizes', 'materials', 'tags']);

        return view('admin.products.form', [
            'product' => $product,
            'categories' => Category::where('status', 1)->get(),
            'colors' => Color::where('status', 1)->get(),
            'sizes' => Size::where('status', 1)->get(),
            'materials' => Material::where('status', 1)->get(),
            'tags' => Tag::where('status', 1)->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'sizes' => 'nullable|array',
            'sizes.*' => 'exists:sizes,id',
            'materials' => 'nullable|array',
            'materials.*' => 'exists:materials,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $validated['slug'] = !empty($validated['slug'])
            ? $validated['slug']
            : Str::slug($validated['name']);

        $uploadedPublicIds = [];

        try {
            DB::beginTransaction();

            $product->update([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'sku' => $validated['sku'] ?? null,
                'price' => $validated['price'],
                'sale_price' => $validated['sale_price'] ?? null,
                'stock' => $validated['stock'],
                'short_description' => $validated['short_description'] ?? null,
                'description' => $validated['description'] ?? null,
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'status' => $request->has('status') ? 1 : 0,
                'is_featured' => $request->has('is_featured') ? 1 : 0,
                'is_best_seller' => $request->has('is_best_seller') ? 1 : 0,
                'is_new_arrival' => $request->has('is_new_arrival') ? 1 : 0,
                'is_flash_sale' => $request->has('is_flash_sale') ? 1 : 0,
            ]);

            $product->colors()->sync($validated['colors'] ?? []);
            $product->sizes()->sync($validated['sizes'] ?? []);
            $product->materials()->sync($validated['materials'] ?? []);
            $product->tags()->sync($validated['tags'] ?? []);

            foreach ($request->file('images', []) as $image) {
                $uploaded = $this->uploadProductImage($image);
                $uploadedPublicIds[] = $uploaded['public_id'];

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $uploaded['url'],
                    'image_public_id' => $uploaded['public_id'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product updated successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();

            foreach ($uploadedPublicIds as $publicId) {
                try {
                    $this->deleteCloudinaryImage($publicId);
                } catch (\Throwable $deleteError) {
                    report($deleteError);
                }
            }

            report($e);

            return back()
                ->withInput()
                ->with('error', 'Product could not be updated. Please try again.');
        }
    }

    public function destroy(Product $product)
    {
        $images = $product->images;
        $publicIds = $images->pluck('image_public_id')->filter()->all();

        try {
            DB::transaction(function () use ($images, $product) {
                foreach ($images as $image) {
                    $image->delete();
                }

                $product->delete();
            });
        } catch (\Throwable $e) {
            report($e);

            return back()->with('error', 'Product could not be deleted.');
        }

        foreach ($publicIds as $publicId) {
            try {
                $this->deleteCloudinaryImage($publicId);
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
