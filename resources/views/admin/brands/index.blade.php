
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-3 px-md-4 brands-page">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 brands-header">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-building me-2 text-primary"></i>Brands
            </h4>
            <p class="text-muted small mb-0">Manage your store brands</p>
        </div>

        <a href="{{ route('admin.brands.create') }}"
           class="btn btn-primary rounded-pill px-4 shadow-sm add-brand-btn">
            <i class="bi bi-plus-circle me-1"></i> Add Brand
        </a>
    </div>

    {{-- Success Alert --}}
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
    <div class="card border-0 shadow-sm rounded-4 brands-desktop-table">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 ps-4">ID</th>
                            <th class="py-3">Logo</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Order</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 pe-4 text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($brands as $brand)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $brand->id }}</td>

                                <td>
                                    @if($brand->logo)
                                        <img
                                            src="{{ \Illuminate\Support\Str::startsWith($brand->logo, ['http://', 'https://', '//']) ? $brand->logo : asset('uploads/brands/' . $brand->logo) }}"
                                            width="80"
                                            height="50"
                                            class="border rounded-2 brand-logo"
                                            alt="{{ $brand->name }}">
                                    @else
                                        <span class="text-muted small">No Logo</span>
                                    @endif
                                </td>

                                <td class="fw-medium">{{ $brand->name }}</td>

                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                        {{ $brand->display_order }}
                                    </span>
                                </td>

                                <td>
                                    @if($brand->status)
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
                                        <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                           class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.brands.destroy', $brand->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Delete this brand?');">
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
                                    <i class="bi bi-building display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No brands found.</h5>
                                    <p class="text-muted small mb-0">Click "Add Brand" to create your first brand.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Mobile Cards --}}
    <div class="brands-mobile-cards">
        @forelse($brands as $brand)
            <div class="card border-0 shadow-sm rounded-4 brand-mobile-card">
                <div class="card-body p-3">

                    <div class="d-flex align-items-center gap-3">

                        {{-- Brand Logo --}}
                        <div class="brand-mobile-logo">
                            @if($brand->logo)
                                <img
                                    src="{{ \Illuminate\Support\Str::startsWith($brand->logo, ['http://', 'https://', '//']) ? $brand->logo : asset('uploads/brands/' . $brand->logo) }}"
                                    alt="{{ $brand->name }}">
                            @else
                                <div class="no-logo">
                                    <i class="bi bi-building"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Brand Details --}}
                        <div class="flex-grow-1 min-width-0">
                            <div class="text-muted small mb-1">
                                Brand #{{ $brand->id }}
                            </div>

                            <h6 class="fw-bold mb-2 brand-mobile-title">
                                {{ $brand->name }}
                            </h6>

                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                    Order: {{ $brand->display_order }}
                                </span>

                                @if($brand->status)
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                        <i class="bi bi-check-circle-fill me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                        <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    {{-- Mobile Actions --}}
                    <div class="brand-mobile-actions mt-3 pt-3 border-top">

                        <a href="{{ route('admin.brands.edit', $brand->id) }}"
                           class="btn btn-outline-warning rounded-pill">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>

                        <form action="{{ route('admin.brands.destroy', $brand->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this brand?');">
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
                    <i class="bi bi-building display-3 text-muted opacity-25 d-block mb-3"></i>
                    <h5 class="fw-light text-muted">No brands found.</h5>
                    <p class="text-muted small mb-0">Click "Add Brand" to create your first brand.</p>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection

@push('styles')
<style>
    .brands-page {
        min-width: 0;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .brands-desktop-table .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
        white-space: nowrap;
    }

    .brands-desktop-table .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }

    .brands-desktop-table tbody tr {
        transition: background 0.15s ease;
    }

    .brands-desktop-table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .brand-logo {
        object-fit: contain;
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

    .brands-mobile-cards {
        display: none;
    }

    .min-width-0 {
        min-width: 0;
    }

    .brand-mobile-logo {
        width: 105px;
        height: 78px;
        flex-shrink: 0;
        border-radius: 9px;
        overflow: hidden;
        background: #f1f3f5;
        border: 1px solid #dee2e6;
    }

    .brand-mobile-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        display: block;
        padding: 5px;
    }

    .no-logo {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
        font-size: 26px;
    }

    .brand-mobile-title {
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    .brand-mobile-actions {
        display: flex;
        gap: 10px;
    }

    .brand-mobile-actions form {
        flex: 1;
        min-width: 0;
    }

    .brand-mobile-actions a,
    .brand-mobile-actions button {
        width: 100%;
        min-height: 40px;
    }

    .brand-mobile-actions a {
        flex: 1;
    }

    @media (max-width: 767.98px) {
        .brands-header {
            flex-direction: column;
            align-items: stretch !important;
            gap: 15px;
        }

        .brands-header h4 {
            font-size: 1.2rem;
        }

        .add-brand-btn {
            width: 100%;
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .brands-desktop-table {
            display: none;
        }

        .brands-mobile-cards {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .brand-mobile-card {
            width: 100%;
            border-radius: 14px !important;
            overflow: hidden;
        }
    }

    @media (max-width: 400px) {
        .brands-page {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }

        .brand-mobile-logo {
            width: 88px;
            height: 72px;
        }

        .brand-mobile-actions {
            gap: 8px;
        }
    }
</style>
@endpush
