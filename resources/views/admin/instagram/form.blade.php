@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-instagram me-2 text-primary"></i>
                {{ isset($gallery) ? 'Edit Instagram Image' : 'Add Instagram Image' }}
            </h4>
            <p class="text-muted small mb-0">Homepage Instagram gallery</p>
        </div>
        <a href="{{ route('admin.instagram.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ isset($gallery)
                        ? route('admin.instagram.update', $gallery->id)
                        : route('admin.instagram.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($gallery))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <!-- Image Upload -->
                    <div class="col-12">
                        <label for="image" class="form-label fw-semibold">Instagram Image <span class="text-danger">{{ isset($gallery) ? '' : '*' }}</span></label>
                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control rounded-3 @error('image') is-invalid @enderror"
                               accept="image/*"
                               {{ isset($gallery) ? '' : 'required' }}>
                        <div class="form-text">JPG, PNG or WebP – Max 2MB. Recommended size: 600 x 600 pixels.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Image Preview -->
                    @if(isset($gallery) && $gallery->image)
                        <div class="col-12">
                            <label class="form-label fw-semibold d-block">Current Image</label>
                            <img src="{{ asset('uploads/instagram/' . $gallery->image) }}"
                                 width="150"
                                 height="150"
                                 class="rounded-2 border shadow-sm"
                                 style="object-fit: cover;"
                                 alt="Instagram">
                        </div>
                    @endif

                    <!-- Instagram Link -->
                    <div class="col-12">
                        <label for="link" class="form-label fw-semibold">Instagram Post Link</label>
                        <input type="url"
                               id="link"
                               name="link"
                               class="form-control rounded-3 @error('link') is-invalid @enderror"
                               placeholder="https://www.instagram.com/p/..."
                               value="{{ old('link', $gallery->link ?? '') }}">
                        @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-6">
                        <label for="display_order" class="form-label fw-semibold">Display Order</label>
                        <input type="number"
                               id="display_order"
                               name="display_order"
                               min="0"
                               class="form-control rounded-3"
                               value="{{ old('display_order', $gallery->display_order ?? 0) }}">
                        <div class="form-text">Lower number will appear first.</div>
                    </div>

                    <!-- Status (Checkbox) -->
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   name="status"
                                   id="status"
                                   value="1"
                                   class="form-check-input"
                                   {{ old('status', isset($gallery) ? $gallery->status : 1) ? 'checked' : '' }}>
                            <label for="status" class="form-check-label fw-semibold">Active</label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ isset($gallery) ? 'Update Image' : 'Save Image' }}
                        </button>
                        <a href="{{ route('admin.instagram.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 ms-2">
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
    .form-control:focus {
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
</style>
@endpush