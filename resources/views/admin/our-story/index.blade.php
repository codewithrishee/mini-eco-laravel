
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 our-story-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 our-story-header">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-book me-2 text-primary"></i>Our Story
            </h4>
            <p class="text-muted small mb-0">Manage About page Our Story section.</p>
        </div>

        <a href="{{ route('admin.our-story.edit') }}"
           class="btn btn-primary rounded-pill px-4 shadow-sm our-story-edit-btn">
            <i class="bi bi-pencil-square me-1"></i> Edit Our Story
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Error Alert -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Content Card -->
    @if($ourStory)
        @php
            $imageUrl = function ($image) {
                if (empty($image)) {
                    return '';
                }

                if (
                    str_starts_with($image, 'http://') ||
                    str_starts_with($image, 'https://') ||
                    str_starts_with($image, '//')
                ) {
                    return $image;
                }

                return asset('uploads/about/' . $image);
            };
        @endphp

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4 p-lg-5">
                <div class="row g-5 align-items-start">

                    <!-- Images -->
                    <div class="col-lg-5">
                        <div class="position-relative">

                            <!-- Main Image -->
                            @if($ourStory->main_image)
                                <div class="rounded-3 overflow-hidden shadow-sm our-story-main-image">
                                    <img
                                        src="{{ $imageUrl($ourStory->main_image) }}"
                                        class="w-100"
                                        alt="Our Story">
                                </div>
                            @else
                                <div class="bg-light rounded-3 text-center text-muted our-story-no-image">
                                    <i class="bi bi-image display-3 d-block mb-3"></i>
                                    <span>No Main Image</span>
                                </div>
                            @endif

                        </div>

                        <!-- Floating Image -->
                        @if($ourStory->floating_image)
                            <div class="mt-3 text-center">
                                <span class="fw-semibold text-muted small d-block mb-2">
                                    Floating Image
                                </span>

                                <img
                                    src="{{ $imageUrl($ourStory->floating_image) }}"
                                    width="110"
                                    height="110"
                                    class="rounded-circle border border-3 border-white shadow-sm our-story-floating-image"
                                    alt="Floating">
                            </div>
                        @endif
                    </div>

                    <!-- Text Content -->
                    <div class="col-lg-7 our-story-content">

                        @if($ourStory->tag)
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">
                                {{ $ourStory->tag }}
                            </span>
                        @endif

                        <h3 class="fw-bold mb-3 our-story-title">
                            {{ $ourStory->title }}

                            @if($ourStory->highlight_text)
                                <span class="text-success">{{ $ourStory->highlight_text }}</span>
                            @endif
                        </h3>

                        <div class="text-muted lh-lg our-story-description">
                            @php
                                $paragraphs = preg_split('/\n+/', trim($ourStory->description));
                            @endphp

                            @foreach($paragraphs as $paragraph)
                                @if(trim($paragraph) !== '')
                                    <p>{{ $paragraph }}</p>
                                @endif
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @else

        <!-- Empty State -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-5 text-center">
                <i class="bi bi-book display-2 text-muted opacity-25 d-block mb-4"></i>

                <h5 class="fw-light text-muted mb-3">
                    Our Story content has not been added yet.
                </h5>

                <p class="text-muted small mb-4">
                    Click the "Edit Our Story" button to add content for this section.
                </p>

                <a href="{{ route('admin.our-story.edit') }}"
                   class="btn btn-primary rounded-pill px-4 our-story-empty-btn">
                    <i class="bi bi-pencil-square me-1"></i> Edit Our Story
                </a>
            </div>
        </div>

    @endif

</div>
@endsection

@push('styles')
<style>
    /* Our Story Page */

    .our-story-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .our-story-page .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .our-story-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff;
        transition: all 0.3s ease;
    }

    .our-story-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .our-story-page .alert-success {
        background-color: #e8f5e9;
        border-left: 4px solid #28a745;
        color: #1e7e34;
    }

    .our-story-page .card-body {
        background: #ffffff;
    }

    .our-story-page .lh-lg {
        line-height: 1.8;
    }

    /* Main Image */
    .our-story-main-image {
        background: #f8f9fa;
        width: 100%;
    }

    .our-story-main-image img {
        display: block;
        width: 100%;
        height: 380px;
        object-fit: cover;
    }

    .our-story-no-image {
        min-height: 380px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 2rem;
    }

    .our-story-floating-image {
        object-fit: cover;
        max-width: 100%;
    }

    .our-story-title {
        overflow-wrap: anywhere;
    }

    .our-story-description {
        overflow-wrap: anywhere;
    }

    .our-story-description p:last-child {
        margin-bottom: 0;
    }

    /* Mobile Responsive */
    @media (max-width: 767.98px) {
        .our-story-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .our-story-header {
            gap: 15px;
        }

        .our-story-header h4 {
            font-size: 1.2rem;
        }

        .our-story-edit-btn {
            width: 100%;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: center;
        }

        .our-story-page .card-body {
            padding: 1rem !important;
        }

        .our-story-page .row {
            --bs-gutter-y: 1.5rem;
        }

        .our-story-main-image img {
            height: 280px;
        }

        .our-story-no-image {
            min-height: 280px;
        }

        .our-story-content {
            width: 100%;
        }

        .our-story-title {
            font-size: 1.35rem;
            line-height: 1.4;
        }

        .our-story-description {
            line-height: 1.8;
        }

        .our-story-empty-btn {
            width: 100%;
            padding-top: 10px;
            padding-bottom: 10px;
        }
    }

    @media (max-width: 400px) {
        .our-story-main-image img {
            height: 240px;
        }

        .our-story-no-image {
            min-height: 240px;
        }

        .our-story-title {
            font-size: 1.2rem;
        }
    }
</style>
@endpush
