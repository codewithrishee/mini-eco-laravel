@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-building me-2 text-primary"></i>
                {{ isset($brand) ? 'Edit Brand' : 'Add Brand' }}
            </h4>
            <p class="text-muted small mb-0">
                {{ isset($brand) ? 'Update brand details.' : 'Create a new brand.' }}
            </p>
        </div>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back to Brands
        </a>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ isset($brand)
                        ? route('admin.brands.update', $brand->id)
                        : route('admin.brands.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($brand))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <!-- Brand Name -->
                    <div class="col-12">
                        <label for="name" class="form-label fw-semibold">Brand Name <span class="text-danger">*</span></label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                               value="{{ old('name', $brand->name ?? '') }}"
                               required
                               placeholder="Enter brand name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Logo Upload -->
                    <div class="col-12">
                        <label for="logo" class="form-label fw-semibold">Brand Logo <span class="text-danger">{{ isset($brand) ? '' : '*' }}</span></label>
                        <input type="file"
                               id="logo"
                               name="logo"
                               class="form-control rounded-3 @error('logo') is-invalid @enderror"
                               accept="image/*"
                               {{ isset($brand) ? '' : 'required' }}>
                        <div class="form-text">Recommended size: 200 x 100 pixels.</div>
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Logo Preview -->
                    @if(isset($brand) && $brand->logo)
                        <div class="col-12">
                            <label class="form-label fw-semibold">Current Logo</label>
                            <div>
                                <img src="{{ asset('uploads/brands/' . $brand->logo) }}"
                                     width="150"
                                     height="80"
                                     style="object-fit: contain;"
                                     class="border rounded-2 shadow-sm"
                                     alt="{{ $brand->name }}">
                            </div>
                        </div>
                    @endif

                    <!-- Display Order -->
                    <div class="col-md-6">
                        <label for="display_order" class="form-label fw-semibold">Display Order</label>
                        <input type="number"
                               id="display_order"
                               name="display_order"
                               class="form-control rounded-3"
                               min="0"
                               value="{{ old('display_order', $brand->display_order ?? 0) }}">
                    </div>

                    <!-- Status (Checkbox) -->
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   id="status"
                                   class="form-check-input"
                                   {{ old('status', isset($brand) ? $brand->status : 1) ? 'checked' : '' }}>
                            <label for="status" class="form-check-label fw-semibold">
                                Active
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ isset($brand) ? 'Update Brand' : 'Save Brand' }}
                        </button>
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 ms-2">
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
    /* Switch styling for better visibility */
    .form-switch .form-check-input {
        width: 3rem;
        height: 1.5rem;
        cursor: pointer;
    }
    .form-switch .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }
</style>
@endpush