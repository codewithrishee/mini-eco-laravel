
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 why-us-form-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fas fa-thumbs-up me-2 text-primary"></i>
                {{ $whyUs->exists ? 'Edit' : 'Add' }} Why Us Item
            </h4>
            <p class="text-muted small mb-0">Manage feature card information.</p>
        </div>

        <a href="{{ route('admin.why-us.index') }}"
           class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Error Alert -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-lg-5">

            <form action="{{ $whyUs->exists ? route('admin.why-us.update', $whyUs->id) : route('admin.why-us.store') }}"
                  method="POST">

                @csrf

                @if($whyUs->exists)
                    @method('PUT')
                @endif

                <div class="row g-4">

                    <!-- Title -->
                    <div class="col-12">
                        <label for="title" class="form-label fw-semibold">
                            Title <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="title"
                               name="title"
                               class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror"
                               value="{{ old('title', $whyUs->title) }}"
                               placeholder="Enter feature title"
                               required>

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Icon -->
                    <div class="col-12">
                        <label for="icon" class="form-label fw-semibold">
                            Bootstrap Icon Class
                        </label>

                        <input type="text"
                               id="icon"
                               name="icon"
                               class="form-control rounded-3 @error('icon') is-invalid @enderror"
                               value="{{ old('icon', $whyUs->icon) }}"
                               placeholder="bi bi-gem">

                        <div class="form-text">
                            Example:
                            <code>bi bi-gem</code>,
                            <code>bi bi-truck</code>,
                            <code>bi bi-tree</code>
                        </div>

                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">
                            Description <span class="text-danger">*</span>
                        </label>

                        <textarea id="description"
                                  name="description"
                                  class="form-control rounded-3 @error('description') is-invalid @enderror"
                                  rows="5"
                                  placeholder="Describe this feature..."
                                  required>{{ old('description', $whyUs->description) }}</textarea>

                        @error('description')
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
                               class="form-control rounded-3"
                               min="0"
                               value="{{ old('display_order', $whyUs->display_order ?? 0) }}">

                        <div class="form-text">Lower number will appear first.</div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   class="form-check-input"
                                   id="status"
                                   {{ old('status', $whyUs->exists ? $whyUs->status : 1) ? 'checked' : '' }}>

                            <label class="form-check-label fw-semibold" for="status">
                                Active
                            </label>

                            <div class="form-text">Uncheck to mark as inactive.</div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 mt-3">
                        <div class="d-flex flex-wrap gap-2 why-us-form-actions">

                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                                <i class="fas fa-check-circle me-1"></i>
                                {{ $whyUs->exists ? 'Update Item' : 'Add Item' }}
                            </button>

                            <a href="{{ route('admin.why-us.index') }}"
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
    .why-us-form-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .why-us-form-page .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .why-us-form-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .why-us-form-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .why-us-form-page .btn-outline-secondary {
        border-width: 1.5px;
    }

    .why-us-form-page .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: #2c3e50;
    }

    .why-us-form-page .card-body {
        background: #ffffff;
    }

    .why-us-form-page .invalid-feedback {
        font-size: 0.85rem;
    }

    .why-us-form-page .alert-danger {
        background-color: #fde8e8;
        border-left: 4px solid #dc3545;
        color: #842029;
    }

    .why-us-form-page .form-switch .form-check-input {
        width: 3rem;
        height: 1.5rem;
        cursor: pointer;
    }

    .why-us-form-page .form-switch .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .why-us-form-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .why-us-form-page h4 {
            font-size: 1.2rem;
        }

        .why-us-form-page > .d-flex > a {
            width: 100%;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .why-us-form-page .card-body {
            padding: 1.25rem !important;
        }

        .why-us-form-page .why-us-form-actions {
            flex-direction: column;
        }

        .why-us-form-page .why-us-form-actions .btn {
            width: 100%;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .why-us-form-page .form-switch {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
    }
</style>
@endpush
