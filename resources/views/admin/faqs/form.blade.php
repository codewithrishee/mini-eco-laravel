@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-question-circle me-2 text-primary"></i>
                {{ isset($faq) ? 'Edit FAQ' : 'Add FAQ' }}
            </h4>
            <p class="text-muted small mb-0">
                {{ isset($faq) ? 'Update the FAQ information.' : 'Add a new frequently asked question.' }}
            </p>
        </div>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Error Alert -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
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
        <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
            <h5 class="fw-semibold text-dark mb-0">
                <i class="bi bi-pencil-square me-2 text-primary"></i>
                FAQ Information
            </h5>
        </div>
        <div class="card-body p-4 p-lg-5">
            <form action="{{ isset($faq) ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}" method="POST">
                @csrf
                @if(isset($faq))
                    @method('PUT')
                @endif

                <div class="row g-4">
                    <!-- Question -->
                    <div class="col-12">
                        <label for="question" class="form-label fw-semibold">Question <span class="text-danger">*</span></label>
                        <input type="text"
                               id="question"
                               name="question"
                               class="form-control form-control-lg rounded-3 @error('question') is-invalid @enderror"
                               value="{{ old('question', $faq->question ?? '') }}"
                               placeholder="Example: What is your return policy?"
                               required>
                        @error('question')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Answer -->
                    <div class="col-12">
                        <label for="answer" class="form-label fw-semibold">Answer <span class="text-danger">*</span></label>
                        <textarea id="answer"
                                  name="answer"
                                  class="form-control rounded-3 @error('answer') is-invalid @enderror"
                                  rows="6"
                                  placeholder="Enter the answer..."
                                  required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                        @error('answer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                   type="checkbox"
                                   role="switch"
                                   name="status"
                                   value="1"
                                   id="status"
                                   {{ old('status', $faq->status ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-medium" for="status">Active</label>
                        </div>
                        <small class="text-muted">Only active FAQs will be displayed on the Contact page.</small>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                        <i class="bi {{ isset($faq) ? 'bi-check-lg' : 'bi-plus-lg' }} me-1"></i>
                        {{ isset($faq) ? 'Update FAQ' : 'Add FAQ' }}
                    </button>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                        Cancel
                    </a>
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
        transition: all 0.3s ease;
    }
    .btn-outline-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.2);
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
    .alert-danger {
        background-color: #fde8e8;
        border-left: 4px solid #dc3545;
        color: #842029;
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