
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fas fa-pen-fancy me-2 text-primary"></i>Edit Our Story
            </h4>
            <p class="text-muted small mb-0">Manage the Our Story section of your About page.</p>
        </div>

        <a href="{{ route('admin.our-story.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
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

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-lg-5">

            <form action="{{ route('admin.our-story.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    <!-- Left Column: Images -->
                    <div class="col-lg-5">
                        <h5 class="fw-semibold text-dark mb-3">
                            <i class="fas fa-images me-2 text-primary"></i>Story Images
                        </h5>

                        <!-- Main Image -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Main Image</label>

                            <div class="mb-2">
                                @if($ourStory->main_image)
                                    <img
                                        src="{{ \Illuminate\Support\Str::startsWith($ourStory->main_image, ['http://', 'https://']) ? $ourStory->main_image : asset('uploads/about/' . $ourStory->main_image) }}"
                                        alt="Main Story Image"
                                        class="img-fluid rounded-3 border shadow-sm"
                                        style="width:100%; height:280px; object-fit:cover;">
                                @else
                                    <div class="border rounded-3 bg-light d-flex align-items-center justify-content-center"
                                         style="height:280px;">
                                        <div class="text-center text-muted">
                                            <i class="fas fa-image fa-3x mb-2 d-block"></i>
                                            <p class="mb-0 small">No Main Image</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <input type="file"
                                   name="main_image"
                                   class="form-control rounded-3 @error('main_image') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png,.webp">

                            <small class="text-muted">
                                JPEG, PNG or WebP – max 5MB. Leave empty to keep current image.
                            </small>

                            @error('main_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Floating Image -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Floating Image</label>

                            <div class="mb-2">
                                @if($ourStory->floating_image)
                                    <img
                                        src="{{ \Illuminate\Support\Str::startsWith($ourStory->floating_image, ['http://', 'https://']) ? $ourStory->floating_image : asset('uploads/about/' . $ourStory->floating_image) }}"
                                        alt="Floating Story Image"
                                        class="rounded-circle border shadow-sm"
                                        style="width:140px; height:140px; object-fit:cover;">
                                @else
                                    <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center"
                                         style="width:140px; height:140px;">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                @endif
                            </div>

                            <input type="file"
                                   name="floating_image"
                                   class="form-control rounded-3 @error('floating_image') is-invalid @enderror"
                                   accept=".jpg,.jpeg,.png,.webp">

                            <small class="text-muted">
                                JPEG, PNG or WebP – max 5MB. Leave empty to keep current image.
                            </small>

                            @error('floating_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column: Content -->
                    <div class="col-lg-7">
                        <h5 class="fw-semibold text-dark mb-3">
                            <i class="fas fa-pencil-alt me-2 text-primary"></i>Story Content
                        </h5>

                        <!-- Section Tag -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Section Tag</label>
                            <input type="text"
                                   name="tag"
                                   class="form-control rounded-3 @error('tag') is-invalid @enderror"
                                   value="{{ old('tag', $ourStory->tag) }}"
                                   placeholder="About Us">

                            @error('tag')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Heading & Highlight -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Heading <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="title"
                                       class="form-control rounded-3 @error('title') is-invalid @enderror"
                                       value="{{ old('title', $ourStory->title) }}"
                                       placeholder="Our"
                                       required>

                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Highlight Text</label>

                                <input type="text"
                                       name="highlight_text"
                                       class="form-control rounded-3 @error('highlight_text') is-invalid @enderror"
                                       value="{{ old('highlight_text', $ourStory->highlight_text) }}"
                                       placeholder="Story">

                                @error('highlight_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Story Description -->
                        <div class="mb-3 mt-3">
                            <label class="form-label fw-semibold">
                                Story Content <span class="text-danger">*</span>
                            </label>

                            <textarea name="description"
                                      class="form-control rounded-3 @error('description') is-invalid @enderror"
                                      rows="14"
                                      placeholder="Write your story here..."
                                      required>{{ old('description', $ourStory->description) }}</textarea>

                            <small class="text-muted">
                                Press Enter after each paragraph. They will appear separately on the frontend.
                            </small>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                                <i class="fas fa-save me-1"></i> Update Our Story
                            </button>
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

    .alert-danger {
        background-color: #fde8e8;
        border-left: 4px solid #dc3545;
        color: #842029;
    }
</style>
@endpush
