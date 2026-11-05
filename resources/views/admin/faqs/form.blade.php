@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4 faqs-form-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-question-circle me-2 text-primary"></i>
                {{ isset($faq) ? 'Edit FAQ' : 'Add FAQ' }}
            </h4>

            <p class="text-muted small mb-0">
                {{ isset($faq) ? 'Update the FAQ information.' : 'Add a new frequently asked question.' }}
            </p>
        </div>

        <a href="{{ route('admin.faqs.index') }}"
           class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
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

            <form action="{{ isset($faq) ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}"
                  method="POST">

                @csrf

                @if(isset($faq))
                    @method('PUT')
                @endif

                <div class="row g-4">

                    <!-- Question -->
                    <div class="col-12">
                        <label for="question" class="form-label fw-semibold">
                            Question <span class="text-danger">*</span>
                        </label>

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
                        <label for="answer" class="form-label fw-semibold">
                            Answer <span class="text-danger">*</span>
                        </label>

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
                        <div class="status-box p-3 rounded-3 border">
                            <div class="form-check form-switch mb-1">
                                <input class="form-check-input"
                                       type="checkbox"
                                       role="switch"
                                       name="status"
                                       value="1"
                                       id="status"
                                       {{ old('status', $faq->status ?? true) ? 'checked' : '' }}>

                                <label class="form-check-label fw-medium" for="status">
                                    Active
                                </label>
                            </div>

                            <small class="text-muted">
                                Only active FAQs will be displayed on the Contact page.
                            </small>
                        </div>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="faq-form-actions mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                        <i class="bi {{ isset($faq) ? 'bi-check-lg' : 'bi-plus-lg' }} me-1"></i>
                        {{ isset($faq) ? 'Update FAQ' : 'Add FAQ' }}
                    </button>

                    <a href="{{ route('admin.faqs.index') }}"
                       class="btn btn-outline-secondary rounded-pill px-4 py-2">
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
    .faqs-form-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .faqs-form-page .card {
        border-radius: 1rem !important;
        overflow: hidden;
    }

    .faqs-form-page .card-body {
        background: #fff;
    }

    .faqs-form-page .form-control {
        border-radius: 0.6rem !important;
    }

    .faqs-form-page .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .faqs-form-page .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: #2c3e50;
    }

    .faqs-form-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .faqs-form-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .faqs-form-page .btn-outline-secondary {
        border-width: 1.5px;
        transition: all 0.3s ease;
    }

    .faqs-form-page .btn-outline-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.2);
    }

    .faqs-form-page .invalid-feedback {
        font-size: 0.85rem;
    }

    .faqs-form-page .alert-danger {
        background-color: #fde8e8;
        border-left: 4px solid #dc3545;
        color: #842029;
    }

    .faqs-form-page .status-box {
        border-color: #e9ecef !important;
        background: #f8f9fa;
    }

    .faqs-form-page .form-switch .form-check-input {
        width: 3rem;
        height: 1.5rem;
        cursor: pointer;
    }

    .faqs-form-page .form-switch .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .faqs-form-page .faq-form-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    @media (max-width: 767px) {
        .faqs-form-page {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        .faqs-form-page h4 {
            font-size: 1.2rem;
        }

        .faqs-form-page .card-header {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .faqs-form-page .card-body {
            padding: 1rem !important;
        }

        .faqs-form-page .faq-form-actions {
            flex-direction: column;
        }

        .faqs-form-page .faq-form-actions .btn {
            width: 100%;
            min-height: 40px;
        }

        .faqs-form-page > .d-flex > a {
            min-height: 40px;
        }
    }

    @media (max-width: 400px) {
        .faqs-form-page {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
    }
</style>
@endpush