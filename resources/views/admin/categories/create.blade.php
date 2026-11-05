
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-md-4 category-form-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 category-form-header">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-tag-plus me-2 text-primary"></i>Add Category
            </h4>
            <p class="text-muted small mb-0">Create a new product category.</p>
        </div>

        <a href="{{ route('admin.categories.index') }}"
           class="btn btn-outline-secondary rounded-pill px-4 shadow-sm category-back-btn">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4 category-form-card">
        <div class="card-body p-3 p-md-4">

            <form action="{{ route('admin.categories.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row g-3">

                    <!-- Name -->
                    <div class="col-12">
                        <label for="name" class="form-label fw-semibold">
                            Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="Category name"
                               required>

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="col-12">
                        <label for="image" class="form-label fw-semibold">
                            Image <span class="text-danger">*</span>
                        </label>

                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control rounded-3 @error('image') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp"
                               required>

                        <div class="form-text">
                            Recommended size: 300 x 300 pixels. JPG, PNG or WebP. Maximum 2 MB.
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
                               value="{{ old('display_order', 0) }}"
                               min="0">

                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">
                            Status
                        </label>

                        <select id="status"
                                name="status"
                                class="form-select rounded-3 @error('status') is-invalid @enderror">

                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
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
                                <i class="bi bi-check-circle me-1"></i> Save Category
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
        background: #ffffff;
    }

    .invalid-feedback {
        font-size: 0.85rem;
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
            margin: 0;
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
