
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 instagram-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 instagram-header">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-instagram me-2 text-primary"></i>Instagram Gallery
            </h4>
            <p class="text-muted small mb-0">Manage homepage Instagram gallery</p>
        </div>

        <a href="{{ route('admin.instagram.create') }}"
           class="btn btn-primary rounded-pill px-4 shadow-sm instagram-add-btn">
            <i class="bi bi-plus-circle me-1"></i> Add Image
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
    <div class="card border-0 shadow-sm rounded-4 instagram-desktop">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="py-3 ps-4">ID</th>
                            <th scope="col" class="py-3">Image</th>
                            <th scope="col" class="py-3">Instagram Link</th>
                            <th scope="col" class="py-3">Order</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3 pe-4 text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($galleries as $gallery)
                            @php
                                $imageUrl = function ($image) {
                                    if (empty($image)) return '';

                                    if (
                                        str_starts_with($image, 'http://') ||
                                        str_starts_with($image, 'https://') ||
                                        str_starts_with($image, '//')
                                    ) {
                                        return $image;
                                    }

                                    return asset('uploads/instagram/' . $image);
                                };
                            @endphp

                            <tr>
                                <td class="ps-4 fw-semibold">{{ $gallery->id }}</td>

                                <td>
                                    @if($gallery->image)
                                        <img src="{{ $imageUrl($gallery->image) }}"
                                             alt="Instagram"
                                             width="70"
                                             height="70"
                                             class="rounded-2 border instagram-table-image">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>

                                <td>
                                    @if($gallery->link)
                                        <a href="{{ $gallery->link }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="text-decoration-none fw-medium">
                                            <i class="bi bi-box-arrow-up-right me-1"></i>View Post
                                        </a>
                                    @else
                                        <span class="text-muted small">No Link</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                        {{ $gallery->display_order }}
                                    </span>
                                </td>

                                <td>
                                    @if($gallery->status)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="bi bi-check-circle-fill me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                            <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.instagram.edit', $gallery->id) }}"
                                           class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.instagram.destroy', $gallery->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Delete this image?');">
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
                                    <i class="bi bi-instagram display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No Instagram images found.</h5>
                                    <p class="text-muted small mb-0">Click "Add Image" to upload your first Instagram photo.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Mobile Cards -->
    <div class="instagram-mobile">
        @forelse($galleries as $gallery)
            @php
                $imageUrl = function ($image) {
                    if (empty($image)) return '';

                    if (
                        str_starts_with($image, 'http://') ||
                        str_starts_with($image, 'https://') ||
                        str_starts_with($image, '//')
                    ) {
                        return $image;
                    }

                    return asset('uploads/instagram/' . $image);
                };
            @endphp

            <div class="card border-0 shadow-sm rounded-4 mb-3 instagram-mobile-card">
                <div class="card-body p-3">

                    <div class="d-flex gap-3 align-items-start">
                        @if($gallery->image)
                            <img src="{{ $imageUrl($gallery->image) }}"
                                 alt="Instagram"
                                 class="instagram-card-image">
                        @else
                            <div class="instagram-card-placeholder">
                                <i class="bi bi-instagram"></i>
                            </div>
                        @endif

                        <div class="flex-grow-1 min-width-0">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <h6 class="fw-bold text-dark mb-2">
                                    Instagram Image #{{ $gallery->id }}
                                </h6>

                                <span class="badge bg-light text-dark border rounded-pill px-2 py-1">
                                    #{{ $gallery->display_order }}
                                </span>
                            </div>

                            <div class="mb-2">
                                @if($gallery->status)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                        <i class="bi bi-check-circle-fill me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                        <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                    </span>
                                @endif
                            </div>

                            @if($gallery->link)
                                <a href="{{ $gallery->link }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="text-decoration-none fw-medium">
                                    <i class="bi bi-box-arrow-up-right me-1"></i>View Post
                                </a>
                            @else
                                <span class="text-muted small">No Link</span>
                            @endif
                        </div>
                    </div>

                    <div class="instagram-card-actions">
                        <a href="{{ route('admin.instagram.edit', $gallery->id) }}"
                           class="btn btn-outline-warning rounded-pill">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>

                        <form action="{{ route('admin.instagram.destroy', $gallery->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this image?');">
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
                    <i class="bi bi-instagram display-3 text-muted opacity-25 d-block mb-3"></i>
                    <h5 class="fw-light text-muted">No Instagram images found.</h5>
                    <p class="text-muted small mb-0">Click "Add Image" to upload your first Instagram photo.</p>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection

@push('styles')
<style>
    .instagram-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .instagram-page .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .instagram-page .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
        white-space: nowrap;
    }

    .instagram-page .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }

    .instagram-page .table tbody tr {
        transition: background 0.15s ease;
    }

    .instagram-page .table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .instagram-table-image {
        object-fit: cover;
    }

    .instagram-page .btn-outline-warning,
    .instagram-page .btn-outline-danger {
        border-width: 1.5px;
    }

    .instagram-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff;
        transition: all 0.3s ease;
    }

    .instagram-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .instagram-page .alert-success {
        background-color: #e8f5e9;
        border-left: 4px solid #28a745;
        color: #1e7e34;
    }

    .instagram-mobile {
        display: none;
    }

    .instagram-card-image,
    .instagram-card-placeholder {
        width: 105px;
        height: 78px;
        flex-shrink: 0;
        border-radius: 0.5rem;
        object-fit: cover;
        border: 1px solid #e9ecef;
    }

    .instagram-card-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        color: #adb5bd;
        font-size: 1.8rem;
    }

    .instagram-card-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .instagram-card-actions > a,
    .instagram-card-actions form {
        flex: 1;
        min-width: 0;
    }

    .instagram-card-actions .btn {
        width: 100%;
        min-height: 40px;
    }

    .instagram-page .min-width-0 {
        min-width: 0;
    }

    @media (max-width: 767.98px) {
        .instagram-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .instagram-header {
            gap: 15px;
        }

        .instagram-header h4 {
            font-size: 1.2rem;
        }

        .instagram-add-btn {
            width: 100%;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .instagram-desktop {
            display: none;
        }

        .instagram-mobile {
            display: block;
        }
    }

    @media (max-width: 400px) {
        .instagram-card-image,
        .instagram-card-placeholder {
            width: 88px;
            height: 72px;
        }

        .instagram-card-actions {
            gap: 8px;
        }
    }
</style>
@endpush
