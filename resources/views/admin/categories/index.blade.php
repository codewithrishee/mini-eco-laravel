
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

        return asset('uploads/categories/' . $image);
    };
@endphp

<div class="container-fluid px-3 px-md-4 categories-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 categories-header">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-tags me-2 text-primary"></i>Categories
            </h4>
            <p class="text-muted small mb-0">Manage your product categories.</p>
        </div>

        <a href="{{ route('admin.categories.create') }}"
           class="btn btn-primary rounded-pill px-4 shadow-sm add-category-btn">
            <i class="bi bi-plus-circle me-1"></i> Add Category
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Desktop Categories Table -->
    <div class="card border-0 shadow-sm rounded-4 categories-desktop-table">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Image</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Display Order</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 pe-4 text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $category->id }}</td>

                                <td>
                                    @if($category->image)
                                        <img
                                            src="{{ $imageUrl($category->image) }}"
                                            width="70"
                                            height="70"
                                            class="border category-image"
                                            alt="{{ $category->name }}">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>

                                <td class="fw-medium">{{ $category->name }}</td>

                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                        {{ $category->display_order }}
                                    </span>
                                </td>

                                <td>
                                    @if($category->status)
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

                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                           class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Delete this category?');">
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
                                    <i class="bi bi-tags display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No Categories Found.</h5>
                                    <p class="text-muted small mb-0">
                                        Click "Add Category" to create your first category.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Mobile Category Cards -->
    <div class="categories-mobile-cards">

        @forelse($categories as $category)
            <div class="card border-0 shadow-sm rounded-4 category-mobile-card">
                <div class="card-body p-3">

                    <div class="d-flex align-items-center gap-3">

                        <!-- Category Image -->
                        <div class="category-mobile-image">
                            @if($category->image)
                                <img src="{{ $imageUrl($category->image) }}"
                                     alt="{{ $category->name }}">
                            @else
                                <div class="category-no-image">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Category Details -->
                        <div class="flex-grow-1 category-details">

                            <div class="text-muted small mb-1">
                                Category #{{ $category->id }}
                            </div>

                            <h6 class="fw-bold mb-2 category-mobile-title">
                                {{ $category->name }}
                            </h6>

                            <div class="d-flex flex-wrap gap-2 align-items-center">

                                <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                    Order: {{ $category->display_order }}
                                </span>

                                @if($category->status)
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
                    <div class="category-mobile-actions mt-3 pt-3 border-top">

                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                           class="btn btn-outline-warning rounded-pill">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this category?');">
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
                    <i class="bi bi-tags display-3 text-muted opacity-25 d-block mb-3"></i>
                    <h5 class="fw-light text-muted">No Categories Found.</h5>
                    <p class="text-muted small mb-0">
                        Click "Add Category" to create your first category.
                    </p>
                </div>
            </div>
        @endforelse

    </div>

</div>
@endsection

@push('styles')
<style>
    .categories-page {
        min-width: 0;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    /* Desktop Table */
    .categories-desktop-table .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
        white-space: nowrap;
    }

    .categories-desktop-table .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }

    .categories-desktop-table tbody tr {
        transition: background 0.15s ease;
    }

    .categories-desktop-table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .category-image {
        object-fit: cover;
        border-radius: 8px;
    }

    .btn-outline-warning,
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

    /* Mobile Cards Hidden on Desktop */
    .categories-mobile-cards {
        display: none;
    }

    .category-details {
        min-width: 0;
    }

    /* Mobile Responsive */
    @media (max-width: 767.98px) {

        .categories-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .categories-header {
            flex-direction: column;
            align-items: stretch !important;
            gap: 15px;
        }

        .categories-header h4 {
            font-size: 1.2rem;
        }

        .add-category-btn {
            width: 100%;
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .categories-desktop-table {
            display: none;
        }

        .categories-mobile-cards {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .category-mobile-card {
            width: 100%;
            border-radius: 14px !important;
            overflow: hidden;
        }

        .category-mobile-image {
            width: 90px;
            height: 90px;
            flex-shrink: 0;
            border-radius: 10px;
            overflow: hidden;
            background: #f1f3f5;
        }

        .category-mobile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .category-no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: #adb5bd;
        }

        .category-mobile-title {
            font-size: 0.95rem;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .category-mobile-actions {
            display: flex;
            gap: 10px;
        }

        .category-mobile-actions form,
        .category-mobile-actions a {
            flex: 1;
            min-width: 0;
        }

        .category-mobile-actions .btn {
            width: 100%;
            min-height: 40px;
            font-size: 0.85rem;
            white-space: nowrap;
        }
    }

    /* Small Mobile */
    @media (max-width: 400px) {

        .categories-page {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }

        .category-mobile-image {
            width: 76px;
            height: 76px;
        }

        .category-mobile-title {
            font-size: 0.88rem;
        }

        .category-mobile-actions {
            gap: 8px;
        }
    }
</style>
@endpush
