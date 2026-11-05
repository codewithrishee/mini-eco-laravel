
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 blogs-form-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fas fa-blog me-2 text-primary"></i>
                {{ $blog->exists ? 'Edit Blog' : 'Add Blog' }}
            </h4>

            <p class="text-muted small mb-0">
                {{ $blog->exists ? 'Update blog article.' : 'Create a new Rv-Store blog article.' }}
            </p>
        </div>

        <a href="{{ route('admin.blogs.index') }}"
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

            <form action="{{ $blog->exists ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                @if($blog->exists)
                    @method('PUT')
                @endif

                <div class="row g-4">

                    <!-- Title -->
                    <div class="col-12">
                        <label for="title" class="form-label fw-semibold">
                            Blog Title <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="title"
                               name="title"
                               class="form-control form-control-lg rounded-3 @error('title') is-invalid @enderror"
                               value="{{ old('title', $blog->title) }}"
                               placeholder="Enter blog title"
                               required>

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div class="col-md-6">
                        <label for="author" class="form-label fw-semibold">Author</label>

                        <input type="text"
                               id="author"
                               name="author"
                               class="form-control rounded-3 @error('author') is-invalid @enderror"
                               value="{{ old('author', $blog->author) }}"
                               placeholder="e.g. Rv-Store Team">

                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Read Time -->
                    <div class="col-md-6">
                        <label for="read_time" class="form-label fw-semibold">
                            Read Time (Minutes) <span class="text-danger">*</span>
                        </label>

                        <input type="number"
                               id="read_time"
                               name="read_time"
                               class="form-control rounded-3 @error('read_time') is-invalid @enderror"
                               value="{{ old('read_time', $blog->read_time ?: 5) }}"
                               min="1"
                               required>

                        @error('read_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="col-12">
                        <label for="short_description" class="form-label fw-semibold">
                            Short Description <span class="text-danger">*</span>
                        </label>

                        <textarea id="short_description"
                                  name="short_description"
                                  class="form-control rounded-3 @error('short_description') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Short summary for blog cards..."
                                  required>{{ old('short_description', $blog->short_description) }}</textarea>

                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Blog Content -->
                    <div class="col-12">
                        <label for="content" class="form-label fw-semibold">
                            Blog Content <span class="text-danger">*</span>
                        </label>

                        <textarea id="content"
                                  name="content"
                                  class="form-control rounded-3 @error('content') is-invalid @enderror"
                                  rows="10"
                                  placeholder="Write complete blog content..."
                                  required>{{ old('content', $blog->content) }}</textarea>

                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="col-md-6">
                        <label for="image" class="form-label fw-semibold">
                            Blog Image
                            @if(!$blog->exists)
                                <span class="text-danger">*</span>
                            @endif
                        </label>

                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control rounded-3 @error('image') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp"
                               {{ $blog->exists ? '' : 'required' }}>

                        <div class="form-text">
                            JPG, JPEG, PNG or WebP. Max 2MB.
                        </div>

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Image -->
                    @if($blog->exists && $blog->image)
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Current Image</label>

                            <div class="current-blog-image">
                                <img
                                    src="{{ \Illuminate\Support\Str::startsWith($blog->image, ['http://', 'https://']) ? $blog->image : asset('uploads/blogs/' . $blog->image) }}"
                                    alt="{{ $blog->title }}"
                                    class="rounded-2 border shadow-sm object-fit-cover">
                            </div>
                        </div>
                    @endif

                    <!-- Featured & Status -->
                    <div class="col-md-6">
                        <div class="d-flex flex-column gap-2 mt-2">

                            <div class="form-check form-switch">
                                <input type="checkbox"
                                       name="is_featured"
                                       value="1"
                                       class="form-check-input"
                                       id="is_featured"
                                       {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>

                                <label class="form-check-label fw-medium" for="is_featured">
                                    Featured Blog
                                </label>
                            </div>

                            <div class="form-check form-switch">
                                <input type="checkbox"
                                       name="status"
                                       value="1"
                                       class="form-check-input"
                                       id="status"
                                       {{ old('status', $blog->exists ? $blog->status : 1) ? 'checked' : '' }}>

                                <label class="form-check-label fw-medium" for="status">
                                    Active
                                </label>
                            </div>

                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 mt-3">
                        <div class="d-flex flex-wrap gap-2 blogs-form-actions">

                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                                <i class="fas fa-save me-1"></i>
                                {{ $blog->exists ? 'Update Blog' : 'Save Blog' }}
                            </button>

                            <a href="{{ route('admin.blogs.index') }}"
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
    .blogs-form-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .blogs-form-page .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .blogs-form-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .blogs-form-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .blogs-form-page .btn-outline-secondary {
        border-width: 1.5px;
    }

    .blogs-form-page .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: #2c3e50;
    }

    .blogs-form-page .card-body {
        background: #ffffff;
    }

    .blogs-form-page .invalid-feedback {
        font-size: 0.85rem;
    }

    .blogs-form-page .alert-danger {
        background-color: #fde8e8;
        border-left: 4px solid #dc3545;
        color: #842029;
    }

    .blogs-form-page .form-switch .form-check-input {
        width: 3rem;
        height: 1.5rem;
        cursor: pointer;
    }

    .blogs-form-page .form-switch .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .blogs-form-page .object-fit-cover {
        object-fit: cover;
    }

    .blogs-form-page .current-blog-image img {
        width: 140px;
        height: 90px;
        max-width: 100%;
        object-fit: cover;
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .blogs-form-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .blogs-form-page h4 {
            font-size: 1.2rem;
        }

        .blogs-form-page > .d-flex > a {
            width: 100%;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blogs-form-page .card-body {
            padding: 1.25rem !important;
        }

        .blogs-form-page .blogs-form-actions {
            flex-direction: column;
        }

        .blogs-form-page .blogs-form-actions .btn {
            width: 100%;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blogs-form-page .current-blog-image img {
            width: 100%;
            max-width: 220px;
            height: auto;
            aspect-ratio: 14 / 9;
        }

        .blogs-form-page .form-switch {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }
    }
</style>
@endpush
