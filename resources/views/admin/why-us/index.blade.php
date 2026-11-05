
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 why-us-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fas fa-thumbs-up me-2 text-primary"></i>Why Choose Us
            </h4>
            <p class="text-muted small mb-0">Manage About page feature cards.</p>
        </div>

        <a href="{{ route('admin.why-us.create') }}"
           class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-1"></i> Add Item
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Desktop Table -->
    <div class="card border-0 shadow-sm rounded-4 desktop-table">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="py-3 ps-4">#</th>
                            <th scope="col" class="py-3">Icon</th>
                            <th scope="col" class="py-3">Title</th>
                            <th scope="col" class="py-3">Description</th>
                            <th scope="col" class="py-3">Order</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3 pe-4 text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($whyUsItems as $item)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $item->id }}</td>

                                <td>
                                    @if($item->icon)
                                        <i class="{{ $item->icon }} fs-4 text-primary"></i>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="fw-medium">{{ $item->title }}</td>

                                <td>
                                    <span title="{{ $item->description }}">
                                        {{ \Illuminate\Support\Str::limit($item->description, 60) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                        {{ $item->display_order }}
                                    </span>
                                </td>

                                <td>
                                    @if($item->status)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                            <i class="fas fa-times-circle me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.why-us.edit', $item->id) }}"
                                           class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.why-us.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Delete this item?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-thumbs-up display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No Why Us items found.</h5>
                                    <p class="text-muted small mb-0">Click "Add Item" to create your first feature.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Mobile Cards -->
    <div class="mobile-cards">
        @forelse($whyUsItems as $item)
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-3">

                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div class="why-icon">
                            @if($item->icon)
                                <i class="{{ $item->icon }}"></i>
                            @else
                                <i class="fas fa-thumbs-up"></i>
                            @endif
                        </div>

                        <div class="flex-grow-1 min-width-0">
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                <h6 class="fw-bold text-dark mb-0">{{ $item->title }}</h6>

                                @if($item->status)
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill">
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">
                                        Inactive
                                    </span>
                                @endif
                            </div>

                            <p class="text-muted small mb-2">
                                {{ \Illuminate\Support\Str::limit($item->description, 110) }}
                            </p>

                            <span class="badge bg-light text-dark border rounded-pill">
                                Order: {{ $item->display_order }}
                            </span>

                            <span class="text-muted small ms-2">#{{ $item->id }}</span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mobile-actions">
                        <a href="{{ route('admin.why-us.edit', $item->id) }}"
                           class="btn btn-outline-warning rounded-pill flex-fill">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>

                        <form action="{{ route('admin.why-us.destroy', $item->id) }}"
                              method="POST"
                              class="flex-fill"
                              onsubmit="return confirm('Delete this item?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-danger rounded-pill w-100">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center py-5">
                    <i class="fas fa-thumbs-up display-3 text-muted opacity-25 d-block mb-3"></i>
                    <h5 class="fw-light text-muted">No Why Us items found.</h5>
                    <p class="text-muted small mb-0">Click "Add Item" to create your first feature.</p>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection

@push('styles')
<style>
    .why-us-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .why-us-page .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .why-us-page .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
        white-space: nowrap;
    }

    .why-us-page .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }

    .why-us-page .table tbody tr {
        transition: background 0.15s ease;
    }

    .why-us-page .table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .why-us-page .btn-outline-warning,
    .why-us-page .btn-outline-danger {
        border-width: 1.5px;
    }

    .why-us-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .why-us-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .why-us-page .alert-success {
        background-color: #e8f5e9;
        border-left: 4px solid #28a745;
        color: #1e7e34;
    }

    .why-us-page .mobile-cards {
        display: none;
    }

    .why-us-page .why-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 12px;
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .why-us-page .min-width-0 {
        min-width: 0;
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .why-us-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .why-us-page h4 {
            font-size: 1.2rem;
        }

        .why-us-page > .d-flex > a {
            width: 100%;
            min-height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .why-us-page .desktop-table {
            display: none;
        }

        .why-us-page .mobile-cards {
            display: block;
        }

        .why-us-page .mobile-cards .card-body {
            padding: 1rem !important;
        }

        .why-us-page .mobile-actions {
            gap: 10px;
        }

        .why-us-page .mobile-actions .btn {
            min-height: 40px;
            font-size: 0.875rem;
        }
    }

    @media (max-width: 400px) {
        .why-us-page .why-icon {
            width: 42px;
            height: 42px;
            min-width: 42px;
            font-size: 1.15rem;
        }

        .why-us-page .mobile-actions {
            gap: 8px;
        }
    }
</style>
@endpush
