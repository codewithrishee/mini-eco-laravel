
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-md-4 py-3 py-md-4 testimonial-page">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 testimonial-header">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-chat-quote me-2 text-primary"></i>Testimonials
            </h4>
            <p class="text-muted small mb-0">Manage customer reviews and testimonials.</p>
        </div>

        <a href="{{ route('admin.testimonials.create') }}"
           class="btn btn-primary rounded-pill px-4 shadow-sm add-testimonial-btn">
            <i class="bi bi-plus-circle me-1"></i> Add Testimonial
        </a>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Desktop Table --}}
    <div class="card border-0 shadow-sm rounded-4 testimonial-desktop">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Image</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Designation</th>
                            <th class="py-3">Review</th>
                            <th class="py-3">Rating</th>
                            <th class="py-3">Order</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 pe-4 text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($testimonials as $testimonial)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $testimonial->id }}</td>

                                <td>
                                    @if($testimonial->image)
                                        <img
                                            src="{{ \Illuminate\Support\Str::startsWith($testimonial->image, ['http://', 'https://', '//']) ? $testimonial->image : asset('uploads/testimonials/' . $testimonial->image) }}"
                                            width="70"
                                            height="70"
                                            class="rounded-2 border testimonial-image"
                                            alt="{{ $testimonial->name }}">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>

                                <td class="fw-medium">{{ $testimonial->name }}</td>
                                <td>{{ $testimonial->designation }}</td>

                                <td class="review-cell">
                                    <span title="{{ $testimonial->review }}">
                                        {{ \Illuminate\Support\Str::limit($testimonial->review, 60) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="text-warning text-nowrap">
                                        @for($i = 1; $i <= $testimonial->rating; $i++)
                                            <i class="bi bi-star-fill"></i>
                                        @endfor

                                        @for($i = $testimonial->rating + 1; $i <= 5; $i++)
                                            <i class="bi bi-star text-muted opacity-25"></i>
                                        @endfor
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                        {{ $testimonial->display_order }}
                                    </span>
                                </td>

                                <td>
                                    @if($testimonial->status)
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
                                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                           class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Delete this testimonial?');">
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
                                <td colspan="9" class="text-center py-5">
                                    <i class="bi bi-chat-quote display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No Testimonials Found</h5>
                                    <p class="text-muted small mb-0">Click "Add Testimonial" to create your first review.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Mobile Cards --}}
    <div class="testimonial-mobile">
        @forelse($testimonials as $testimonial)
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-3">

                    <div class="d-flex align-items-start gap-3">
                        <div class="testimonial-mobile-image">
                            @if($testimonial->image)
                                <img
                                    src="{{ \Illuminate\Support\Str::startsWith($testimonial->image, ['http://', 'https://', '//']) ? $testimonial->image : asset('uploads/testimonials/' . $testimonial->image) }}"
                                    alt="{{ $testimonial->name }}">
                            @else
                                <div class="no-image">
                                    <i class="bi bi-person"></i>
                                </div>
                            @endif
                        </div>

                        <div class="flex-grow-1 min-width-0">
                            <div class="text-muted small mb-1">
                                Testimonial #{{ $testimonial->id }}
                            </div>

                            <h6 class="fw-bold mb-1 testimonial-mobile-title">
                                {{ $testimonial->name }}
                            </h6>

                            <p class="text-muted small mb-2">
                                {{ $testimonial->designation }}
                            </p>

                            @if($testimonial->status)
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                    <i class="bi bi-check-circle-fill me-1"></i> Active
                                </span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                    <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="testimonial-review mt-3">
                        {{ $testimonial->review }}
                    </div>

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-3">
                        <span class="text-warning text-nowrap">
                            @for($i = 1; $i <= $testimonial->rating; $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor

                            @for($i = $testimonial->rating + 1; $i <= 5; $i++)
                                <i class="bi bi-star text-muted opacity-25"></i>
                            @endfor
                        </span>

                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                Order: {{ $testimonial->display_order }}
                            </span>
                        </div>
                    </div>

                    <div class="testimonial-mobile-actions mt-3 pt-3 border-top">
                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                           class="btn btn-outline-warning rounded-pill">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>

                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this testimonial?');">
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
                    <i class="bi bi-chat-quote display-3 text-muted opacity-25 d-block mb-3"></i>
                    <h5 class="fw-light text-muted">No Testimonials Found</h5>
                    <p class="text-muted small mb-0">Click "Add Testimonial" to create your first review.</p>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection

@push('styles')
<style>
    .testimonial-page {
        min-width: 0;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .testimonial-desktop .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
        white-space: nowrap;
    }

    .testimonial-desktop .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }

    .testimonial-desktop tbody tr {
        transition: background 0.15s ease;
    }

    .testimonial-desktop tbody tr:hover {
        background-color: #f8f9fc;
    }

    .testimonial-image {
        object-fit: cover;
    }

    .review-cell {
        max-width: 220px;
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

    .testimonial-mobile {
        display: none;
    }

    .min-width-0 {
        min-width: 0;
    }

    .testimonial-mobile-image {
        width: 105px;
        height: 78px;
        flex-shrink: 0;
        border-radius: 9px;
        overflow: hidden;
        background: #f1f3f5;
    }

    .testimonial-mobile-image img {
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

    .testimonial-mobile-title {
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .testimonial-review {
        background: #f8f9fa;
        padding: 10px 12px;
        border-radius: 10px;
        overflow-wrap: anywhere;
    }

    .testimonial-mobile-actions {
        display: flex;
        gap: 10px;
    }

    .testimonial-mobile-actions form {
        flex: 1;
        min-width: 0;
    }

    .testimonial-mobile-actions a,
    .testimonial-mobile-actions button {
        width: 100%;
        min-height: 40px;
    }

    .testimonial-mobile-actions a {
        flex: 1;
    }

    @media (max-width: 767.98px) {
        .testimonial-header {
            flex-direction: column;
            align-items: stretch !important;
            gap: 15px;
        }

        .testimonial-header h4 {
            font-size: 1.2rem;
        }

        .add-testimonial-btn {
            width: 100%;
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .testimonial-desktop {
            display: none;
        }

        .testimonial-mobile {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .testimonial-mobile .card {
            width: 100%;
            border-radius: 14px !important;
            overflow: hidden;
        }
    }

    @media (max-width: 400px) {
        .testimonial-page {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }

        .testimonial-mobile-image {
            width: 88px;
            height: 72px;
        }

        .testimonial-mobile-actions {
            gap: 8px;
        }
    }
</style>
@endpush
