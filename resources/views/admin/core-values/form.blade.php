
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 core-values-form-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fas fa-heart me-2 text-primary"></i>
                {{ $coreValue->exists ? 'Edit' : 'Add' }} Core Value
            </h4>
            <p class="text-muted small mb-0">Manage Core Value information.</p>
        </div>

        <a href="{{ route('admin.core-values.index') }}"
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

            <form action="{{ $coreValue->exists ? route('admin.core-values.update', $coreValue->id) : route('admin.core-values.store') }}"
                  method="POST">

                @csrf

                @if($coreValue->exists)
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
                               value="{{ old('title', $coreValue->title) }}"
                               placeholder="Enter core value title"
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
                               value="{{ old('icon', $coreValue->icon) }}"
                               placeholder="bi bi-heart">

                        <div class="form-text">
                            Example:
                            <code>bi bi-heart</code>,
                            <code>bi bi-star</code>,
                            <code>bi bi-lightbulb</code>,
                            <code>bi bi-people</code>
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
                                  placeholder="Describe this core value..."
                                  required>{{ old('description', $coreValue->description) }}</textarea>

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
                               value="{{ old('display_order', $coreValue->display_order ?? 0) }}">

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
                                   {{ old('status', $coreValue->exists ? $coreValue->status : 1) ? 'checked' : '' }}>

                            <label class="form-check-label fw-semibold" for="status">
                                Active
                            </label>

                            <div class="form-text">Uncheck to mark as inactive.</div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 mt-3">
                        <div class="d-flex flex-wrap gap-2 core-values-form-actions">

                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                                <i class="fas fa-check-circle me-1"></i>
                                {{ $coreValue->exists ? 'Update Core Value' : 'Add Core Value' }}
                            </button>

                            <a href="{{ route('admin.core-values.index') }}"
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
    .core-values-form-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .core-values-form-page .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .core-values-form-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .core-values-form-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .core-values-form-page .btn-outline-secondary {
        border-width: 1.5px;
    }

    .core-values-form-page .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: #2c3e50;
    }

    .core-values-form-page .card-body {
        background: #ffffff;
    }

    .core-values-form-page .invalid-feedback {
        font-size: 0.85rem;
    }

    .core-values-form-page .alert-danger {
        background-color: #fde8e8;
        border-left: 4px solid #dc3545;
        color: #842029;
    }

    .core-values-form-page .form-switch .form-check-input {
        width: 3rem;
        height: 1.5rem;
        cursor: pointer;
    }

    .core-values-form-page .form-switch .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .core-values-form-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .core-values-form-page h4 {
            font-size: 1.2rem;
        }

        .core-values-form-page > .d-flex > a {
            width: 100%;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .core-values-form-page .card-body {
            padding: 1.25rem !important;
        }

        .core-values-form-page .core-values-form-actions {
            flex-direction: column;
        }

        .core-values-form-page .core-values-form-actions .btn {
            width: 100%;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .core-values-form-page .form-switch {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
    }
</style>
@endpush
