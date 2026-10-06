@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-box-seam me-2 text-primary"></i>
                {{ isset($product) ? 'Edit Product' : 'Add Product' }}
            </h4>
            <p class="text-muted small mb-0">
                {{ isset($product) ? 'Update product details and manage inventory.' : 'Create a new product for your store.' }}
            </p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Main Form -->
    <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
          method="POST"
          enctype="multipart/form-data"
          novalidate>
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif

        <div class="row g-4">
            <!-- Left Column: Main Info -->
            <div class="col-lg-8">
                <!-- Product Information Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="fw-semibold text-dark mb-0">
                            <i class="bi bi-info-circle me-2 text-primary"></i>Product Information
                        </h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3">
                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select rounded-3 @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Product Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                       class="form-control rounded-3 @error('name') is-invalid @enderror"
                                       value="{{ old('name', $product->name ?? '') }}" placeholder="Enter product name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div class="col-md-6">
                                <label for="slug" class="form-label fw-semibold">Slug</label>
                                <input type="text" name="slug" id="slug"
                                       class="form-control rounded-3 @error('slug') is-invalid @enderror"
                                       value="{{ old('slug', $product->slug ?? '') }}" placeholder="auto-generated if empty">
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SKU -->
                            <div class="col-md-6">
                                <label for="sku" class="form-label fw-semibold">SKU</label>
                                <input type="text" name="sku" id="sku"
                                       class="form-control rounded-3 @error('sku') is-invalid @enderror"
                                       value="{{ old('sku', $product->sku ?? '') }}" placeholder="Stock Keeping Unit">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="col-md-6">
                                <label for="price" class="form-label fw-semibold">Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">$</span>
                                    <input type="number" step="0.01" name="price" id="price"
                                           class="form-control rounded-end-3 @error('price') is-invalid @enderror"
                                           value="{{ old('price', $product->price ?? '') }}" placeholder="0.00">
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sale Price -->
                            <div class="col-md-6">
                                <label for="sale_price" class="form-label fw-semibold">Sale Price</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">$</span>
                                    <input type="number" step="0.01" name="sale_price" id="sale_price"
                                           class="form-control rounded-end-3 @error('sale_price') is-invalid @enderror"
                                           value="{{ old('sale_price', $product->sale_price ?? '') }}" placeholder="0.00">
                                </div>
                                @error('sale_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stock -->
                            <div class="col-md-6">
                                <label for="stock" class="form-label fw-semibold">Stock <span class="text-danger">*</span></label>
                                <input type="number" name="stock" id="stock"
                                       class="form-control rounded-3 @error('stock') is-invalid @enderror"
                                       value="{{ old('stock', $product->stock ?? '') }}" placeholder="Quantity">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold d-block">Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input type="checkbox" name="status" id="status" class="form-check-input"
                                           value="1"
                                           {{ old('status', $product->status ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-medium" for="status">Active</label>
                                    <small class="text-muted d-block">Uncheck to mark as inactive.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="fw-semibold text-dark mb-0">
                            <i class="bi bi-file-text me-2 text-primary"></i>Product Description
                        </h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3">
                            <!-- Short Description -->
                            <div class="col-12">
                                <label for="short_description" class="form-label fw-semibold">Short Description</label>
                                <textarea name="short_description" id="short_description" rows="3"
                                          class="form-control rounded-3 @error('short_description') is-invalid @enderror"
                                          placeholder="Brief summary of the product">{{ old('short_description', $product->short_description ?? '') }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Long Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">Long Description</label>
                                <textarea name="description" id="description" rows="6"
                                          class="form-control rounded-3 @error('description') is-invalid @enderror"
                                          placeholder="Detailed product description">{{ old('description', $product->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Attributes Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="fw-semibold text-dark mb-0">
                            <i class="bi bi-tags me-2 text-primary"></i>Product Attributes
                        </h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3">
                            <!-- Colors -->
                            <div class="col-md-6">
                                <label for="colors" class="form-label fw-semibold">Colors</label>
                                <select name="colors[]" id="colors" class="form-select rounded-3 @error('colors') is-invalid @enderror" multiple size="4">
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}"
                                            @if(isset($product) && $product->colors->contains($color->id)) selected @endif
                                            {{ in_array($color->id, old('colors', [])) ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('colors')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</small>
                            </div>

                            <!-- Sizes -->
                            <div class="col-md-6">
                                <label for="sizes" class="form-label fw-semibold">Sizes</label>
                                <select name="sizes[]" id="sizes" class="form-select rounded-3 @error('sizes') is-invalid @enderror" multiple size="4">
                                    @foreach($sizes as $size)
                                        <option value="{{ $size->id }}"
                                            @if(isset($product) && $product->sizes->contains($size->id)) selected @endif
                                            {{ in_array($size->id, old('sizes', [])) ? 'selected' : '' }}>
                                            {{ $size->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sizes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</small>
                            </div>

                            <!-- Materials -->
                            <div class="col-md-6">
                                <label for="materials" class="form-label fw-semibold">Materials</label>
                                <select name="materials[]" id="materials" class="form-select rounded-3 @error('materials') is-invalid @enderror" multiple size="4">
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}"
                                            @if(isset($product) && $product->materials->contains($material->id)) selected @endif
                                            {{ in_array($material->id, old('materials', [])) ? 'selected' : '' }}>
                                            {{ $material->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('materials')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</small>
                            </div>

                            <!-- Tags -->
                            <div class="col-md-6">
                                <label for="tags" class="form-label fw-semibold">Tags</label>
                                <select name="tags[]" id="tags" class="form-select rounded-3 @error('tags') is-invalid @enderror" multiple size="4">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            @if(isset($product) && $product->tags->contains($tag->id)) selected @endif
                                            {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="fw-semibold text-dark mb-0">
                            <i class="bi bi-google me-2 text-primary"></i>SEO
                        </h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="meta_title" class="form-label fw-semibold">Meta Title</label>
                                <input type="text" name="meta_title" id="meta_title"
                                       class="form-control rounded-3 @error('meta_title') is-invalid @enderror"
                                       value="{{ old('meta_title', $product->meta_title ?? '') }}" placeholder="Page title for search engines">
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="meta_description" class="form-label fw-semibold">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" rows="3"
                                          class="form-control rounded-3 @error('meta_description') is-invalid @enderror"
                                          placeholder="Brief description for search results">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="meta_keywords" class="form-label fw-semibold">Meta Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords"
                                       class="form-control rounded-3 @error('meta_keywords') is-invalid @enderror"
                                       value="{{ old('meta_keywords', $product->meta_keywords ?? '') }}" placeholder="Comma separated keywords">
                                @error('meta_keywords')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Images & Sections -->
            <div class="col-lg-4">
                <!-- Images Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="fw-semibold text-dark mb-0">
                            <i class="bi bi-image me-2 text-primary"></i>Product Images
                        </h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="mb-3">
                            <label for="images" class="form-label fw-semibold">Upload Images</label>
                            <input type="file" name="images[]" id="images"
                                   class="form-control rounded-3 @error('images.*') is-invalid @enderror"
                                   multiple accept="image/*">
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">JPEG, PNG, WebP – max 5MB each</small>
                        </div>

                        <!-- Existing Images Preview -->
                        @if(isset($product) && $product->images->count())
                            <div class="mt-2">
                                <label class="form-label fw-semibold">Current Images</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($product->images as $image)
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $image->path) }}"
                                                 alt="Product image"
                                                 width="70" height="70"
                                                 class="rounded-3 border object-fit-cover">
                                            @if($image->is_primary)
                                                <span class="badge bg-primary position-absolute top-0 start-0 m-1">Primary</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Sections Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="fw-semibold text-dark mb-0">
                            <i class="bi bi-grid-3x3-gap-fill me-2 text-primary"></i>Product Sections
                        </h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="d-flex flex-wrap gap-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input"
                                       value="1"
                                       {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="is_best_seller" id="is_best_seller" class="form-check-input"
                                       value="1"
                                       {{ old('is_best_seller', $product->is_best_seller ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_best_seller">Best Seller</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="is_new_arrival" id="is_new_arrival" class="form-check-input"
                                       value="1"
                                       {{ old('is_new_arrival', $product->is_new_arrival ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_new_arrival">New Arrival</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="is_flash_sale" id="is_flash_sale" class="form-check-input"
                                       value="1"
                                       {{ old('is_flash_sale', $product->is_flash_sale ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_flash_sale">Flash Sale</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="mt-4 d-flex flex-wrap gap-2">
            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                <i class="bi bi-check-circle me-1"></i>
                {{ isset($product) ? 'Update Product' : 'Save Product' }}
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 ms-2">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .rounded-4 {
        border-radius: 1rem !important;
    }
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }
    .btn-outline-secondary {
        border-width: 1.5px;
    }
    .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: #2c3e50;
    }
    .card-body {
        background: #ffffff;
    }
    .invalid-feedback {
        font-size: 0.85rem;
    }
    .form-switch .form-check-input {
        width: 3rem;
        height: 1.5rem;
        cursor: pointer;
    }
    .form-switch .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }
    .input-group .input-group-text {
        background-color: #fff;
        color: #6c757d;
        border-right: 0;
    }
    .input-group .form-control:focus {
        border-left-color: #667eea;
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush