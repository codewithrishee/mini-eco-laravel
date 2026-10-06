@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-bullseye me-2 text-primary"></i>Mission & Vision
            </h4>
            <p class="text-muted small mb-0">Manage About page Mission & Vision section.</p>
        </div>
        <a href="{{ route('admin.mission-vision.edit') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-pencil-square me-1"></i> Edit
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Content Cards -->
    @if($missionVision)
        <div class="row g-4">
            <!-- Mission Card -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-flag-fill text-primary fs-4"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-0">{{ $missionVision->mission_title }}</h4>
                        </div>
                        <div class="text-muted lh-lg">
                            @php
                                $missionParagraphs = preg_split('/\n+/', trim($missionVision->mission_description));
                            @endphp
                            @foreach($missionParagraphs as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vision Card -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4 p-lg-5">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-eye-fill text-success fs-4"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-0">{{ $missionVision->vision_title }}</h4>
                        </div>
                        <div class="text-muted lh-lg">
                            @php
                                $visionParagraphs = preg_split('/\n+/', trim($missionVision->vision_description));
                            @endphp
                            @foreach($visionParagraphs as $paragraph)
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
                <i class="bi bi-bullseye display-2 text-muted opacity-25 d-block mb-4"></i>
                <h5 class="fw-light text-muted mb-3">Mission & Vision content has not been added yet.</h5>
                <p class="text-muted small mb-4">Click the "Edit" button to add content for this section.</p>
                <a href="{{ route('admin.mission-vision.edit') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-pencil-square me-1"></i> Edit
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
    .card-body .bg-opacity-10 {
        transition: all 0.3s ease;
    }
    .card:hover .bg-opacity-10 {
        transform: scale(1.05);
    }
</style>
@endpush