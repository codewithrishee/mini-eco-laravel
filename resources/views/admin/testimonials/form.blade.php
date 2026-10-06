@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-chat-quote me-2 text-primary"></i>
                {{ isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial' }}
            </h4>
            <p class="text-muted small mb-0">
                {{ isset($testimonial) ? 'Update customer testimonial details.' : 'Create a new customer testimonial.' }}
            </p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ isset($testimonial)
                        ? route('admin.testimonials.update', $testimonial->id)
                        : route('admin.testimonials.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($testimonial))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <!-- Name -->
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-semibold">Customer Name <span class="text-danger">*</span></label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                               value="{{ old('name', $testimonial->name ?? '') }}"
                               placeholder="Enter customer name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Designation -->
                    <div class="col-md-6">
                        <label for="designation" class="form-label fw-semibold">Designation</label>
                        <input type="text"
                               id="designation"
                               name="designation"
                               class="form-control form-control-lg rounded-3 @error('designation') is-invalid @enderror"
                               value="{{ old('designation', $testimonial->designation ?? '') }}"
                               placeholder="e.g. CEO, Company">
                        @error('designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Review -->
                    <div class="col-12">
                        <label for="review" class="form-label fw-semibold">Customer Review <span class="text-danger">*</span></label>
                        <textarea id="review"
                                  name="review"
                                  rows="5"
                                  class="form-control rounded-3 @error('review') is-invalid @enderror"
                                  placeholder="Write customer review here...">{{ old('review', $testimonial->review ?? '') }}</textarea>
                        @error('review')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Rating -->
                    <div class="col-md-6">
                        <label for="rating" class="form-label fw-semibold">Rating <span class="text-danger">*</span></label>
                        <select id="rating" name="rating" class="form-select rounded-3 @error('rating') is-invalid @enderror">
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>
                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                        @error('rating')
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
                               value="{{ old('display_order', $testimonial->display_order ?? 0) }}"
                               min="0">
                    </div>

                    <!-- Image -->
                    <div class="col-12">
                        <label for="image" class="form-label fw-semibold">Customer Image</label>
                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control rounded-3 @error('image') is-invalid @enderror"
                               accept="image/*">
                        <div class="form-text">Recommended size: 200 x 200 pixels.</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if(isset($testimonial) && $testimonial->image)
                            <div class="mt-3">
                                <label class="form-label fw-semibold">Current Image</label>
                                <div>
                                    <img src="{{ asset('uploads/testimonials/'.$testimonial->image) }}"
                                         width="120"
                                         class="rounded-2 border shadow-sm"
                                         alt="{{ $testimonial->name }}">
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="col-12">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select id="status" name="status" class="form-select rounded-3">
                            <option value="1" {{ old('status', $testimonial->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $testimonial->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ isset($testimonial) ? 'Update Testimonial' : 'Save Testimonial' }}
                        </button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 ms-2">
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