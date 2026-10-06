@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-chat-quote me-2 text-primary"></i>Testimonials
            </h4>
            <p class="text-muted small mb-0">Manage customer reviews and testimonials.</p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Add Testimonial
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Testimonials Table -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="py-3 ps-4">ID</th>
                            <th scope="col" class="py-3">Image</th>
                            <th scope="col" class="py-3">Name</th>
                            <th scope="col" class="py-3">Designation</th>
                            <th scope="col" class="py-3">Review</th>
                            <th scope="col" class="py-3">Rating</th>
                            <th scope="col" class="py-3">Order</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3 pe-4 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testimonial)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $testimonial->id }}</td>
                                <td>
                                    @if($testimonial->image)
                                        <img src="{{ asset('uploads/testimonials/'.$testimonial->image) }}"
                                             width="70"
                                             height="70"
                                             class="rounded-2 border object-fit-cover"
                                             alt="{{ $testimonial->name }}">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-medium">{{ $testimonial->name }}</td>
                                <td>{{ $testimonial->designation }}</td>
                                <td>
                                    <span title="{{ $testimonial->review }}">
                                        {{ \Illuminate\Support\Str::limit($testimonial->review, 60) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-warning">
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
    .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
    }
    .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }
    .table tbody tr {
        transition: background 0.15s ease;
    }
    .table tbody tr:hover {
        background-color: #f8f9fc;
    }
    .btn-outline-warning {
        border-width: 1.5px;
    }
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
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush