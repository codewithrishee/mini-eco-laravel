@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-pencil-square me-2 text-primary"></i>Edit Mission & Vision
            </h4>
            <p class="text-muted small mb-0">Update About page content.</p>
        </div>
        <a href="{{ route('admin.mission-vision.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
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

    <!-- Form -->
    <form action="{{ route('admin.mission-vision.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Mission Card -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="fw-semibold text-dark mb-0">
                    <i class="bi bi-flag-fill me-2 text-primary"></i>Our Mission
                </h5>
            </div>
            <div class="card-body pt-3">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="mission_title" class="form-label fw-semibold">Mission Title <span class="text-danger">*</span></label>
                        <input type="text"
                               id="mission_title"
                               name="mission_title"
                               class="form-control form-control-lg rounded-3 @error('mission_title') is-invalid @enderror"
                               value="{{ old('mission_title', $missionVision->mission_title) }}"
                               placeholder="Enter mission title"
                               required>
                        @error('mission_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="mission_description" class="form-label fw-semibold">Mission Description <span class="text-danger">*</span></label>
                        <textarea id="mission_description"
                                  name="mission_description"
                                  class="form-control rounded-3 @error('mission_description') is-invalid @enderror"
                                  rows="5"
                                  placeholder="Describe your mission..."
                                  required>{{ old('mission_description', $missionVision->mission_description) }}</textarea>
                        @error('mission_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Press Enter for new paragraphs.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision Card -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="fw-semibold text-dark mb-0">
                    <i class="bi bi-eye-fill me-2 text-primary"></i>Our Vision
                </h5>
            </div>
            <div class="card-body pt-3">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="vision_title" class="form-label fw-semibold">Vision Title <span class="text-danger">*</span></label>
                        <input type="text"
                               id="vision_title"
                               name="vision_title"
                               class="form-control form-control-lg rounded-3 @error('vision_title') is-invalid @enderror"
                               value="{{ old('vision_title', $missionVision->vision_title) }}"
                               placeholder="Enter vision title"
                               required>
                        @error('vision_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="vision_description" class="form-label fw-semibold">Vision Description <span class="text-danger">*</span></label>
                        <textarea id="vision_description"
                                  name="vision_description"
                                  class="form-control rounded-3 @error('vision_description') is-invalid @enderror"
                                  rows="5"
                                  placeholder="Describe your vision..."
                                  required>{{ old('vision_description', $missionVision->vision_description) }}</textarea>
                        @error('vision_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Press Enter for new paragraphs.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="d-flex flex-wrap gap-2 mt-4">
            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                <i class="bi bi-check-circle me-1"></i> Update Mission & Vision
            </button>
            <a href="{{ route('admin.mission-vision.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                Cancel
            </a>
        </div>
    </form>
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
    .alert-danger {
        background-color: #fde8e8;
        border-left: 4px solid #dc3545;
        color: #842029;
    }
</style>
@endpush