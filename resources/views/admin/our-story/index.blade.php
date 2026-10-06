@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-book me-2 text-primary"></i>Our Story
            </h4>
            <p class="text-muted small mb-0">Manage About page Our Story section.</p>
        </div>
        <a href="{{ route('admin.our-story.edit') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
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

    <!-- Content Card -->
    @if($ourStory)
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-4 p-lg-5">
                <div class="row g-5 align-items-start">
                    <!-- Main Image with fixed container -->
                    <div class="col-lg-5">
                        <div class="position-relative">
                            @if($ourStory->main_image)
                                <div class="rounded-3 overflow-hidden shadow-sm" style="background: #f8f9fa;">
                                    <img src="{{ asset('uploads/about/' . $ourStory->main_image) }}"
                                         class="w-100"
                                         style="height: 380px; object-fit: cover;"
                                         alt="Our Story">
                                </div>
                            @else
                                <div class="bg-light rounded-3 p-5 text-center text-muted" style="height: 380px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                    <i class="bi bi-image display-3 d-block mb-3"></i>
                                    <span>No Image</span>
                                </div>
                            @endif

                            <!-- Floating Image - positioned absolute if needed, but we'll keep it below for simplicity -->
                        </div>

                        @if($ourStory->floating_image)
                            <div class="mt-3 text-center">
                                <span class="fw-semibold text-muted small d-block mb-2">Floating Image</span>
                                <img src="{{ asset('uploads/about/' . $ourStory->floating_image) }}"
                                     width="110"
                                     height="110"
                                     style="object-fit: cover;"
                                     class="rounded-circle border border-3 border-white shadow-sm"
                                     alt="Floating">
                            </div>
                        @endif
                    </div>

                    <!-- Text Content -->
                    <div class="col-lg-7">
                        <!-- Tag as Badge -->
                        @if($ourStory->tag)
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-3">
                                {{ $ourStory->tag }}
                            </span>
                        @endif

                        <!-- Title with Highlight -->
                        <h3 class="fw-bold mb-3">
                            {{ $ourStory->title }}
                            @if($ourStory->highlight_text)
                                <span class="text-success">{{ $ourStory->highlight_text }}</span>
                            @endif
                        </h3>

                        <!-- Description with paragraphs -->
                        <div class="text-muted lh-lg">
                            @php
                                $paragraphs = preg_split('/\n+/', trim($ourStory->description));
                            @endphp
                            @foreach($paragraphs as $paragraph)
                                <p>{{ $paragraph }}</p>
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
                <h5 class="fw-light text-muted mb-3">Our Story content has not been added yet.</h5>
                <p class="text-muted small mb-4">Click the "Edit Our Story" button to add content for this section.</p>
                <a href="{{ route('admin.our-story.edit') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-pencil-square me-1"></i> Edit Our Story
                </a>
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .rounded-4 {
        border-radius: 1rem !important;
    }
    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
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
    .alert-success {
        background-color: #e8f5e9;
        border-left: 4px solid #28a745;
        color: #1e7e34;
    }
    .card-body {
        background: #ffffff;
    }
    .lh-lg {
        line-height: 1.8;
    }
    /* Responsive image height */
    @media (max-width: 768px) {
        .col-lg-5 img {
            height: 280px !important;
        }
    }
</style>
@endpush