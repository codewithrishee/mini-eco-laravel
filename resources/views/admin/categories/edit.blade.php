
@extends('layouts.admin')

@section('content')

@php
    $imageUrl = function ($image) {
        if (empty($image)) {
            return '';
        }

        if (
            str_starts_with($image, 'http://') ||
            str_starts_with($image, 'https://') ||
            str_starts_with($image, '//')
        ) {
            return $image;
        }

        return asset('uploads/categories/' . $image);
    };
@endphp

<div class="container-fluid px-3 px-md-4 category-form-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 category-form-header">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-pencil-square me-2 text-primary"></i>Edit Category
            </h4>
            <p class="text-muted small mb-0">Update category details.</p>
        </div>

        <a href="{{ route('admin.categories.index') }}"
           class="btn btn-outline-secondary rounded-pill px-4 shadow-sm category-back-btn">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4 category-form-card">
        <div class="card-body p-3 p-md-4">

            <form action="{{ route('admin.categories.update', $category->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row g-3">

                    <!-- Category Name -->
                    <div class="col-12">
                        <label for="name" class="form-label fw-semibold">
                            Category Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                               value="{{ old('name', $category->name) }}"
                               placeholder="Category name"
                               required>

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Image -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">Current Image</label>

                        <div>
                            @if($category->image)
                                <img
                                    src="{{ $imageUrl($category->image) }}"
                                    width="120"
                                    height="120"
                                    class="border shadow-sm current-category-image"
                                    alt="{{ $category->name }}"
                                >
                            @else
                                <p class="text-muted small">No image available.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Change Image -->
                    <div class="col-12">
                        <label for="image" class="form-label fw-semibold">Change Image</label>

                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control rounded-3 @error('image') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp">

                        <div class="form-text">
                            Leave empty to keep the current image. JPG, PNG or WebP. Maximum 2 MB.
                        </div>

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-6">
                        <label for="display_order" class="form-label fw-semibold">
                            Display Order
                        </label>

                        <input type="number"
                               id="display_order"
                               name="display_order"
                               class="form-control rounded-3 @error('display_order') is-invalid @enderror"
                               value="{{ old('display_order', $category->display_order) }}"
                               min="0">

                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Status</label>

                        <select id="status"
                                name="status"
                                class="form-select rounded-3 @error('status') is-invalid @enderror">

                            <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 mt-4">
                        <div class="d-flex flex-wrap gap-2 category-form-actions">

                            <button type="submit"
                                    class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                                <i class="bi bi-check-circle me-1"></i> Update Category
                            </button>

                            <a href="{{ route('admin.categories.index') }}"
                               class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                Cancel
                            </a>

                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .category-form-page {
        min-width: 0;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .form-control-lg,
    .form-select-lg {
        font-size: 0.95rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff;
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

    .category-form-card .card-body {
        background: #fff;
    }

    .invalid-feedback {
        font-size: 0.85rem;
    }

    .current-category-image {
        object-fit: cover;
        border-radius: 8px;
        max-width: 100%;
    }

    /* Mobile Responsive */
    @media (max-width: 767.98px) {

        .category-form-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .category-form-header {
            flex-direction: column;
            align-items: stretch !important;
        }

        .category-form-header h4 {
            font-size: 1.2rem;
        }

        .category-back-btn {
            width: 100%;
            text-align: center;
        }

        .category-form-card {
            border-radius: 14px !important;
        }

        .category-form-card .card-body {
            padding: 16px !important;
        }

        .category-form-actions {
            flex-direction: column;
        }

        .category-form-actions .btn {
            width: 100%;
            min-height: 44px;
            margin: 0 !important;
        }

        .category-form-page .form-control,
        .category-form-page .form-select {
            width: 100%;
            min-width: 0;
            font-size: 16px;
        }

        .category-form-page input[type="file"] {
            font-size: 13px;
        }

        .current-category-image {
            width: 110px;
            height: 110px;
        }
    }

    /* Small Mobile */
    @media (max-width: 400px) {

        .category-form-page {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }

        .category-form-card .card-body {
            padding: 13px !important;
        }
    }
</style>
@endpush
