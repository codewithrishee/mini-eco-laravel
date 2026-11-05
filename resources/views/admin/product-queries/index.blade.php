
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4 product-queries-page">

    {{-- PAGE HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-chat-dots-fill me-2 text-primary"></i>
                Product Queries
            </h4>
            <p class="text-muted small mb-0">
                View and manage customer inquiries received from product pages.
            </p>
        </div>

        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
            <i class="bi bi-inbox me-1"></i>
            {{ $queries->total() }} Queries
        </span>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- QUERIES CARD --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 px-4 pt-4 pb-3">
            <h5 class="fw-semibold mb-1">Customer Product Inquiries</h5>
            <p class="text-muted small mb-0">
                Queries submitted through the Product Query form.
            </p>
        </div>

        <div class="card-body p-0">
            @if($queries->count() > 0)

                {{-- DESKTOP TABLE --}}
                <div class="table-responsive desktop-query-table">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($queries as $query)
                                <tr>
                                    <td class="ps-4">
                                        <span class="text-muted small">#{{ $query->id }}</span>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="customer-avatar">
                                                {{ strtoupper(substr($query->name, 0, 1)) }}
                                            </div>

                                            <div>
                                                <div class="fw-semibold text-dark">
                                                    {{ $query->name }}
                                                </div>

                                                @if($query->email)
                                                    <div class="small text-muted">
                                                        {{ $query->email }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @if($query->product)
                                            <div class="d-flex align-items-center gap-2">
                                                @if($query->product->image)
                                                    <img
                                                        src="{{ asset('uploads/products/' . $query->product->image) }}"
                                                        alt="{{ $query->product->name }}"
                                                        class="product-query-image">
                                                @else
                                                    <div class="product-image-placeholder">
                                                        <i class="bi bi-box-seam"></i>
                                                    </div>
                                                @endif

                                                <div>
                                                    <div class="fw-semibold product-name">
                                                        {{ $query->product->name }}
                                                    </div>
                                                    <small class="text-muted">
                                                        Product #{{ $query->product->id }}
                                                    </small>
                                                </div>
                                            </div>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                Product Removed
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="tel:{{ $query->phone }}" class="text-decoration-none text-dark">
                                            <i class="bi bi-telephone me-1 text-muted"></i>
                                            {{ $query->phone }}
                                        </a>
                                    </td>

                                    <td>
                                        @if($query->subject)
                                            <span class="query-subject">
                                                {{ \Illuminate\Support\Str::limit($query->subject, 35) }}
                                            </span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="small fw-semibold">
                                            {{ $query->created_at->format('d M Y') }}
                                        </div>
                                        <div class="small text-muted">
                                            {{ $query->created_at->format('h:i A') }}
                                        </div>
                                    </td>

                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex align-items-center gap-2">
                                            <a href="{{ route('admin.product-queries.show', $query) }}"
                                               class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                <i class="bi bi-eye me-1"></i> View
                                            </a>

                                            <form
                                                action="{{ route('admin.product-queries.destroy', $query) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this product query?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger rounded-circle action-delete-btn"
                                                        title="Delete">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- MOBILE CARDS --}}
                <div class="mobile-query-cards">
                    @foreach($queries as $query)
                        <div class="query-mobile-card">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                                <div class="d-flex align-items-center gap-2 min-w-0">
                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($query->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">
                                        <div class="fw-semibold text-dark text-break">
                                            {{ $query->name }}
                                        </div>
                                        @if($query->email)
                                            <div class="small text-muted text-break">
                                                {{ $query->email }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <span class="badge bg-light text-muted border flex-shrink-0">
                                    #{{ $query->id }}
                                </span>
                            </div>

                            <div class="query-mobile-product mb-3">
                                @if($query->product)
                                    @if($query->product->image)
                                        <img
                                            src="{{ asset('uploads/products/' . $query->product->image) }}"
                                            alt="{{ $query->product->name }}"
                                            class="product-query-image">
                                    @else
                                        <div class="product-image-placeholder">
                                            <i class="bi bi-box-seam"></i>
                                        </div>
                                    @endif

                                    <div class="min-w-0">
                                        <div class="small text-muted">Product</div>
                                        <div class="fw-semibold product-name">
                                            {{ $query->product->name }}
                                        </div>
                                        <small class="text-muted">
                                            Product #{{ $query->product->id }}
                                        </small>
                                    </div>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger">
                                        Product Removed
                                    </span>
                                @endif
                            </div>

                            <div class="query-mobile-details">
                                <div>
                                    <span class="detail-label">Phone</span>
                                    <a href="tel:{{ $query->phone }}" class="text-decoration-none text-dark">
                                        <i class="bi bi-telephone me-1"></i>{{ $query->phone }}
                                    </a>
                                </div>

                                <div>
                                    <span class="detail-label">Subject</span>
                                    <div class="text-break">
                                        {{ $query->subject ?: '—' }}
                                    </div>
                                </div>

                                <div>
                                    <span class="detail-label">Date</span>
                                    <div class="small fw-semibold">
                                        {{ $query->created_at->format('d M Y') }}
                                    </div>
                                    <div class="small text-muted">
                                        {{ $query->created_at->format('h:i A') }}
                                    </div>
                                </div>
                            </div>

                            <div class="mobile-query-actions">
                                <a href="{{ route('admin.product-queries.show', $query) }}"
                                   class="btn btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>

                                <form
                                    action="{{ route('admin.product-queries.destroy', $query) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this product query?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i class="bi bi-trash3 me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- PAGINATION --}}
                @if($queries->hasPages())
                    <div class="px-4 py-4 border-top">
                        {{ $queries->links() }}
                    </div>
                @endif

            @else
                {{-- EMPTY STATE --}}
                <div class="text-center py-5 px-3">
                    <div class="empty-query-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>

                    <h5 class="fw-semibold mt-3 mb-2">No Product Queries Yet</h5>
                    <p class="text-muted mb-0">
                        Customer product inquiries will appear here once they submit the Product Query form.
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.product-queries-page .rounded-4 {
    border-radius: 1rem !important;
}

.product-queries-page .bg-opacity-10 {
    --bs-bg-opacity: 0.1;
}

.product-queries-page .table th {
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    border-bottom: 2px solid #e9ecef;
    white-space: nowrap;
}

.product-queries-page .table td {
    vertical-align: middle;
    padding: 0.75rem 0.5rem;
}

.product-queries-page .table tbody tr {
    transition: background 0.15s ease;
}

.product-queries-page .table tbody tr:hover {
    background-color: #f8f9fc;
}

.product-queries-page .customer-avatar {
    width: 42px;
    height: 42px;
    min-width: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(102, 126, 234, 0.12);
    color: #667eea;
    font-weight: 700;
    font-size: 1rem;
}

.product-queries-page .product-query-image,
.product-queries-page .product-image-placeholder {
    width: 48px;
    height: 48px;
    min-width: 48px;
    border-radius: 10px;
}

.product-queries-page .product-query-image {
    object-fit: cover;
    border: 1px solid #e9ecef;
}

.product-queries-page .product-image-placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
    color: #adb5bd;
    font-size: 1.1rem;
}

.product-queries-page .product-name {
    max-width: 180px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.product-queries-page .query-subject {
    display: inline-block;
    max-width: 180px;
    color: #495057;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.product-queries-page .action-delete-btn {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.product-queries-page .empty-query-icon {
    width: 70px;
    height: 70px;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
    font-size: 1.8rem;
}

.product-queries-page .mobile-query-cards {
    display: none;
}

.product-queries-page .min-w-0 {
    min-width: 0;
}

.product-queries-page .query-mobile-card {
    padding: 18px;
    border-bottom: 1px solid #edf0f2;
}

.product-queries-page .query-mobile-product {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 12px;
    min-width: 0;
}

.product-queries-page .query-mobile-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    font-size: 0.88rem;
    overflow-wrap: anywhere;
}

.product-queries-page .detail-label {
    display: block;
    color: #8a9097;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    margin-bottom: 5px;
}

.product-queries-page .mobile-query-actions {
    display: flex;
    gap: 10px;
    margin-top: 18px;
}

.product-queries-page .mobile-query-actions > * {
    flex: 1;
    min-width: 0;
}

.product-queries-page .mobile-query-actions .btn {
    width: 100%;
    min-height: 40px;
    border-width: 1.5px;
    border-radius: 50rem;
}

@media (max-width: 767px) {
    .product-queries-page.container-fluid {
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    .product-queries-page h4 {
        font-size: 1.2rem;
    }

    .product-queries-page .desktop-query-table {
        display: none;
    }

    .product-queries-page .mobile-query-cards {
        display: block;
    }

    .product-queries-page .card-header {
        padding: 18px !important;
    }

    .product-queries-page .query-mobile-card {
        padding: 16px;
    }

    .product-queries-page .product-name {
        max-width: 220px;
    }
}

@media (max-width: 400px) {
    .product-queries-page .mobile-query-actions {
        gap: 8px;
    }

    .product-queries-page .query-mobile-card {
        padding: 14px;
    }
}
</style>
@endpush
