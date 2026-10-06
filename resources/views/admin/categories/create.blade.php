@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-tag-plus me-2 text-primary"></i>Add Category
            </h4>
            <p class="text-muted small mb-0">Create a new product category.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('admin.categories.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- Name -->
                    <div class="col-12">
                        <label for="name" class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="Category name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="col-12">
                        <label for="image" class="form-label fw-semibold">Image</label>
                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control rounded-3 @error('image') is-invalid @enderror"
                               accept="image/*">
                        <div class="form-text">Recommended size: 300 x 300 pixels.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-6">
                        <label for="display_order" class="form-label fw-semibold">Display Order</label>
                        <input type="number"
                               id="display_order"
                               name="display_order"
                               class="form-control rounded-3"
                               value="0"
                               min="0">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select id="status" name="status" class="form-select rounded-3">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> Save Category
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 ms-2">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .rounded-4 {
        border-radius: 1rem !important;
    }
    .form-control-lg, .form-select-lg {
        font-size: 0.95rem;
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
</style>
@endpush