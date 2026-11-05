
@extends('layouts.admin')

@section('content')

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

        return asset('uploads/hero-sliders/' . $image);
    };
@endphp

<div class="container-fluid px-3 px-md-4 hero-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 hero-header">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-sliders2 me-2 text-primary"></i>Hero Sliders
            </h4>
            <p class="text-muted small mb-0">Manage your home page hero sliders.</p>
        </div>

        <a href="{{ route('admin.hero-sliders.create') }}"
           class="btn btn-primary rounded-pill px-4 shadow-sm add-slider-btn">
            <i class="bi bi-plus-circle me-1"></i> Add Slider
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
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Desktop Table -->
    <div class="card border-0 shadow-sm rounded-4 hero-desktop-table">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 ps-4">#</th>
                            <th class="py-3">Image</th>
                            <th class="py-3">Title</th>
                            <th class="py-3">Order</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 pe-4 text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($sliders as $slider)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $loop->iteration }}</td>

                                <td>
                                    @if($slider->image)
                                        <img
                                            src="{{ $imageUrl($slider->image) }}"
                                            width="100"
                                            height="60"
                                            class="rounded-2 border hero-image"
                                            alt="{{ $slider->title }}"
                                        >
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>

                                <td class="fw-medium">{{ $slider->title }}</td>

                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                        {{ $slider->display_order }}
                                    </span>
                                </td>

                                <td>
                                    @if($slider->status)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="bi bi-check-circle-fill me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                            <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.hero-sliders.edit', $slider->id) }}"
                                           class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.hero-sliders.destroy', $slider->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this slider?');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                <i class="bi bi-trash3"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-images display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No Hero Slider Found.</h5>
                                    <p class="text-muted small mb-0">Click "Add Slider" to create your first slide.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Mobile Cards -->
    <div class="hero-mobile-cards">

        @forelse($sliders as $slider)
            <div class="card border-0 shadow-sm rounded-4 hero-mobile-card">

                <div class="card-body p-3">

                    <div class="d-flex align-items-start gap-3">

                        <!-- Image -->
                        <div class="hero-mobile-image">
                            @if($slider->image)
                                <img src="{{ $imageUrl($slider->image) }}"
                                     alt="{{ $slider->title }}">
                            @else
                                <div class="no-image">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Title and Number -->
                        <div class="flex-grow-1 min-width-0">
                            <div class="text-muted small mb-1">
                                Slider #{{ $loop->iteration }}
                            </div>

                            <h6 class="fw-bold mb-2 hero-mobile-title">
                                {{ $slider->title }}
                            </h6>

                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                    Order: {{ $slider->display_order }}
                                </span>

                                @if($slider->status)
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle-fill me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                                        <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <!-- Mobile Actions -->
                    <div class="hero-mobile-actions mt-3 pt-3 border-top">

                        <a href="{{ route('admin.hero-sliders.edit', $slider->id) }}"
                           class="btn btn-outline-primary rounded-pill">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>

                        <form action="{{ route('admin.hero-sliders.destroy', $slider->id) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this slider?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-danger rounded-pill">
                                <i class="bi bi-trash3 me-1"></i> Delete
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        @empty
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center py-5">
                    <i class="bi bi-images display-3 text-muted opacity-25 d-block mb-3"></i>
                    <h5 class="fw-light text-muted">No Hero Slider Found.</h5>
                    <p class="text-muted small mb-0">Click "Add Slider" to create your first slide.</p>
                </div>
            </div>
        @endforelse

    </div>

</div>
@endsection

@push('styles')
<style>
    .hero-page {
        min-width: 0;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .hero-desktop-table .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
        white-space: nowrap;
    }

    .hero-desktop-table .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }

    .hero-desktop-table tbody tr {
        transition: background 0.15s ease;
    }

    .hero-desktop-table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .hero-image {
        object-fit: cover;
    }

    .btn-outline-primary,
    .btn-outline-danger {
        border-width: 1.5px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff;
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

    /* Mobile cards hidden on desktop */
    .hero-mobile-cards {
        display: none;
    }

    .min-width-0 {
        min-width: 0;
    }

    /* Mobile Responsive */
    @media (max-width: 767.98px) {

        .hero-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .hero-header {
            flex-direction: column;
            align-items: stretch !important;
            gap: 15px;
        }

        .hero-header h4 {
            font-size: 1.2rem;
        }

        .add-slider-btn {
            width: 100%;
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .hero-desktop-table {
            display: none;
        }

        .hero-mobile-cards {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .hero-mobile-card {
            width: 100%;
            border-radius: 14px !important;
            overflow: hidden;
        }

        .hero-mobile-image {
            width: 105px;
            height: 78px;
            flex-shrink: 0;
            border-radius: 9px;
            overflow: hidden;
            background: #f1f3f5;
        }

        .hero-mobile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-size: 26px;
        }

        .hero-mobile-title {
            font-size: 0.95rem;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .hero-mobile-actions {
            display: flex;
            gap: 10px;
        }

        .hero-mobile-actions form {
            flex: 1;
            min-width: 0;
        }

        .hero-mobile-actions a,
        .hero-mobile-actions button {
            width: 100%;
            min-height: 40px;
            font-size: 0.85rem;
        }

        .hero-mobile-actions a {
            flex: 1;
        }
    }

    @media (max-width: 400px) {

        .hero-page {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }

        .hero-mobile-image {
            width: 88px;
            height: 72px;
        }

        .hero-mobile-title {
            font-size: 0.88rem;
        }

        .hero-mobile-actions {
            gap: 8px;
        }
    }
</style>
@endpush
