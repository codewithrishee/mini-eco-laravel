
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-md-4 py-3 py-md-4 testimonial-form-page">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 testimonial-form-header">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-chat-quote me-2 text-primary"></i>
                {{ isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial' }}
            </h4>

            <p class="text-muted small mb-0">
                {{ isset($testimonial) ? 'Update customer testimonial details.' : 'Create a new customer testimonial.' }}
            </p>
        </div>

        <a href="{{ route('admin.testimonials.index') }}"
           class="btn btn-outline-secondary rounded-pill px-4 shadow-sm back-btn">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    {{-- Error Alert --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-3 p-md-4">

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

                    {{-- Customer Name --}}
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label fw-semibold">
                            Customer Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                               value="{{ old('name', $testimonial->name ?? '') }}"
                               placeholder="Enter customer name"
                               required>

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Designation --}}
                    <div class="col-12 col-md-6">
                        <label for="designation" class="form-label fw-semibold">
                            Designation <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="designation"
                               name="designation"
                               class="form-control form-control-lg rounded-3 @error('designation') is-invalid @enderror"
                               value="{{ old('designation', $testimonial->designation ?? '') }}"
                               placeholder="e.g. CEO, Company"
                               required>

                        @error('designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Customer Review --}}
                    <div class="col-12">
                        <label for="review" class="form-label fw-semibold">
                            Customer Review <span class="text-danger">*</span>
                        </label>

                        <textarea id="review"
                                  name="review"
                                  rows="5"
                                  class="form-control rounded-3 @error('review') is-invalid @enderror"
                                  placeholder="Write customer review here..."
                                  required>{{ old('review', $testimonial->review ?? '') }}</textarea>

                        @error('review')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Rating --}}
                    <div class="col-12 col-md-6">
                        <label for="rating" class="form-label fw-semibold">
                            Rating <span class="text-danger">*</span>
                        </label>

                        <select id="rating"
                                name="rating"
                                class="form-select rounded-3 @error('rating') is-invalid @enderror"
                                required>
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

                    {{-- Display Order --}}
                    <div class="col-12 col-md-6">
                        <label for="display_order" class="form-label fw-semibold">
                            Display Order
                        </label>

                        <input type="number"
                               id="display_order"
                               name="display_order"
                               class="form-control rounded-3 @error('display_order') is-invalid @enderror"
                               value="{{ old('display_order', $testimonial->display_order ?? 0) }}"
                               min="0"
                               required>

                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Customer Image --}}
                    <div class="col-12">
                        <label for="image" class="form-label fw-semibold">
                            Customer Image
                        </label>

                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control rounded-3 @error('image') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp">

                        <div class="form-text">
                            JPG, JPEG, PNG or WebP. Maximum size 2MB.
                            @if(isset($testimonial))
                                Leave empty to keep the current image.
                            @endif
                        </div>

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Current Image --}}
                        @if(isset($testimonial) && $testimonial->image)
                            <div class="mt-3">
                                <label class="form-label fw-semibold">Current Image</label>

                                <div>
                                    <img
                                        src="{{ \Illuminate\Support\Str::startsWith($testimonial->image, ['http://', 'https://', '//']) ? $testimonial->image : asset('uploads/testimonials/' . $testimonial->image) }}"
                                        width="120"
                                        height="120"
                                        class="rounded-2 border shadow-sm current-image"
                                        style="object-fit: cover;"
                                        alt="{{ $testimonial->name }}">
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Status --}}
                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label fw-semibold">
                            Status
                        </label>

                        <select id="status"
                                name="status"
                                class="form-select rounded-3"
                                required>
                            <option value="1" {{ old('status', $testimonial->status ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ old('status', $testimonial->status ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                    {{-- Submit Buttons --}}
                    <div class="col-12 mt-4">
                        <div class="testimonial-form-actions">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ isset($testimonial) ? 'Update Testimonial' : 'Save Testimonial' }}
                            </button>

                            <a href="{{ route('admin.testimonials.index') }}"
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
    .testimonial-form-page {
        min-width: 0;
    }

    .rounded-4 {
        border-radius: 1rem !important;
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

    .testimonial-form-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
    }

    .current-image {
        object-fit: cover;
    }

    @media (max-width: 767.98px) {
        .testimonial-form-header {
            flex-direction: column;
            align-items: stretch !important;
            gap: 15px;
        }

        .testimonial-form-header h4 {
            font-size: 1.2rem;
        }

        .back-btn {
            align-self: flex-start;
        }

        .testimonial-form-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .testimonial-form-actions .btn {
            width: 100%;
            min-height: 40px;
        }
    }

    @media (max-width: 400px) {
        .testimonial-form-page {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }
    }
</style>
@endpush
