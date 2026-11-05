@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 product-index-page">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h4 class="page-title fw-bold text-dark mb-1">
                <i class="bi bi-box-seam me-2 text-primary"></i>Products
            </h4>
            <p class="text-muted small mb-0">Manage your product inventory</p>
        </div>

        <div class="header-actions">
            <form action="{{ route('admin.products.index') }}" method="GET" class="search-form">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control border-start-0"
                        placeholder="Search Product..."
                    >
                </div>
            </form>

            <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm add-product-btn">
                <i class="bi bi-plus-circle me-1"></i> Add Product
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Products Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <!-- ================= DESKTOP TABLE ================= -->
            <div class="table-responsive d-none d-lg-block">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="py-3 ps-4">#</th>
                            <th scope="col" class="py-3">Image</th>
                            <th scope="col" class="py-3">Name</th>
                            <th scope="col" class="py-3">Category</th>
                            <th scope="col" class="py-3">Price</th>
                            <th scope="col" class="py-3">Sale Price</th>
                            <th scope="col" class="py-3">Stock</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3">Sections</th>
                            <th scope="col" class="py-3">Created</th>
                            <th scope="col" class="py-3 pe-4 text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $loop->iteration }}</td>

                                <td>
                                    @if($product->images->count())
                                        <img
                                            src="{{ \Illuminate\Support\Str::startsWith($product->images->first()->image, ['http://', 'https://'])
                                                ? $product->images->first()->image
                                                : asset('uploads/products/' . $product->images->first()->image) }}"
                                            width="60"
                                            height="60"
                                            class="rounded-2 border object-fit-cover"
                                            alt="{{ $product->name }}"
                                        >
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>

                                <td class="fw-medium">{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td class="fw-semibold">₹ {{ number_format($product->price, 2) }}</td>

                                <td>
                                    @if($product->sale_price)
                                        <span class="text-danger fw-semibold">
                                            ₹ {{ number_format($product->sale_price, 2) }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                        {{ $product->stock }}
                                    </span>
                                </td>

                                <td>
                                    @if($product->status)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="bi bi-check-circle-fill me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                            <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @if($product->is_featured)
                                            <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill">
                                                Featured
                                            </span>
                                        @endif

                                        @if($product->is_best_seller)
                                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill">
                                                Best Seller
                                            </span>
                                        @endif

                                        @if($product->is_new_arrival)
                                            <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill">
                                                New Arrival
                                            </span>
                                        @endif

                                        @if($product->is_flash_sale)
                                            <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 rounded-pill">
                                                Flash Sale
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td>{{ $product->created_at->format('d M Y') }}</td>

                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a
                                            href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-outline-warning btn-sm rounded-pill px-3"
                                        >
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.products.destroy', $product->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Delete Product?');"
                                        >
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
                                <td colspan="11" class="text-center py-5">
                                    <i class="bi bi-box-seam display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No Products Found</h5>
                                    <p class="text-muted small mb-0">
                                        Click "Add Product" to create your first product.
                                    </p>

                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-4 mt-3">
                                        <i class="bi bi-plus-circle me-1"></i> Add Product
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- ================= MOBILE CARDS ================= -->
            <div class="d-lg-none mobile-products p-3">
                @forelse($products as $product)
                    <div class="product-card card border-0 shadow-sm rounded-3 mb-3">
                        <div class="card-body p-3">
                            <div class="d-flex gap-3 align-items-start">
                                <div class="product-thumb">
                                    @if($product->images->count())
                                        <img
                                            src="{{ \Illuminate\Support\Str::startsWith($product->images->first()->image, ['http://', 'https://'])
                                                ? $product->images->first()->image
                                                : asset('uploads/products/' . $product->images->first()->image) }}"
                                            alt="{{ $product->name }}"
                                            class="product-thumb-img rounded-2 border"
                                        >
                                    @else
                                        <div class="product-thumb-placeholder rounded-2 border d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex-grow-1 product-info">
                                    <div class="product-name fw-semibold text-dark">{{ $product->name }}</div>
                                    <div class="product-category small text-muted mt-1">
                                        <i class="bi bi-tag me-1"></i>{{ $product->category->name ?? '-' }}
                                    </div>
                                    <div class="product-prices mt-1">
                                        <span class="fw-semibold">₹ {{ number_format($product->price, 2) }}</span>
                                        @if($product->sale_price)
                                            <span class="text-danger fw-semibold ms-2">₹ {{ number_format($product->sale_price, 2) }}</span>
                                        @endif
                                    </div>

                                    <div class="product-status-row mt-2 d-flex flex-wrap gap-2">
                                        <span class="badge bg-light text-dark border px-2 py-1 rounded-pill">
                                            <i class="bi bi-box me-1"></i>Stock: {{ $product->stock }}
                                        </span>
                                        @if($product->status)
                                            <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill">
                                                <i class="bi bi-check-circle-fill me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 rounded-pill">
                                                <i class="bi bi-x-circle-fill me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($product->is_featured || $product->is_best_seller || $product->is_new_arrival || $product->is_flash_sale)
                                <div class="product-sections mt-2 d-flex flex-wrap gap-1">
                                    @if($product->is_featured)
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1 rounded-pill">Featured</span>
                                    @endif
                                    @if($product->is_best_seller)
                                        <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill">Best Seller</span>
                                    @endif
                                    @if($product->is_new_arrival)
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill">New Arrival</span>
                                    @endif
                                    @if($product->is_flash_sale)
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 rounded-pill">Flash Sale</span>
                                    @endif
                                </div>
                            @endif

                            <div class="product-date small text-muted mt-2">
                                <i class="bi bi-calendar me-1"></i>{{ $product->created_at->format('d M Y') }}
                            </div>

                            <div class="row g-2 mt-2">
                                <div class="col-6">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="btn btn-outline-warning btn-sm rounded-pill w-100 action-btn">
                                        <i class="bi bi-pencil-square me-1"></i>Edit
                                    </a>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                          method="POST"
                                          class="m-0 w-100"
                                          onsubmit="return confirm('Delete Product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill w-100 action-btn">
                                            <i class="bi bi-trash3 me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-box-seam display-3 text-muted opacity-25 d-block mb-3"></i>
                        <h5 class="fw-light text-muted">No Products Found</h5>
                        <p class="text-muted small mb-0">
                            Click "Add Product" to create your first product.
                        </p>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-4 mt-3">
                            <i class="bi bi-plus-circle me-1"></i> Add Product
                        </a>
                    </div>
                @endforelse
            </div>

        </div>

        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="pagination-wrapper d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* ============ SCOPED: Product Index Page ============ */

    .product-index-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .product-index-page .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .product-index-page .page-title {
        font-size: 1.5rem;
    }

    /* Desktop table styles preserved */
    .product-index-page .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
    }

    .product-index-page .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }

    .product-index-page .table tbody tr {
        transition: background 0.15s ease;
    }

    .product-index-page .table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .product-index-page .btn-outline-warning {
        border-width: 1.5px;
    }

    .product-index-page .btn-outline-danger {
        border-width: 1.5px;
    }

    .product-index-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff;
        transition: all 0.3s ease;
    }

    .product-index-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .product-index-page .alert-success {
        background-color: #e8f5e9;
        border-left: 4px solid #28a745;
        color: #1e7e34;
    }

    .product-index-page .object-fit-cover {
        object-fit: cover;
    }

    .product-index-page .input-group .form-control:focus {
        border-color: #667eea;
        box-shadow: none;
    }

    .product-index-page .input-group .input-group-text {
        background-color: #fff;
        color: #6c757d;
        border-right: 0;
    }

    /* Header actions layout */
    .product-index-page .header-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Pagination horizontally scrollable */
    .product-index-page .pagination-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .product-index-page .pagination-wrapper .pagination {
        flex-wrap: nowrap;
        margin-bottom: 0;
    }

    /* Mobile product cards */
    .product-index-page .product-card {
        border-radius: 0.75rem !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06) !important;
    }

    .product-index-page .product-thumb {
        flex-shrink: 0;
    }

    .product-index-page .product-thumb-img {
        width: 105px;
        height: 78px;
        object-fit: cover;
    }

    .product-index-page .product-thumb-placeholder {
        width: 105px;
        height: 78px;
        background: #f8f9fa;
    }

    .product-index-page .product-info {
        min-width: 0;
    }

    .product-index-page .product-name {
        font-size: 0.95rem;
        line-height: 1.3;
        word-break: break-word;
    }

    .product-index-page .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
    }

    /* Mobile adjustments */
    @media (max-width: 767.98px) {
        .product-index-page .page-title {
            font-size: 1.2rem;
        }

        .product-index-page .header-actions {
            flex-direction: column;
            align-items: stretch;
            width: 100%;
            gap: 0.5rem;
        }

        .product-index-page .search-form,
        .product-index-page .search-form .input-group {
            width: 100%;
        }

        .product-index-page .add-product-btn {
            width: 100%;
            text-align: center;
        }

        .product-index-page .card-footer {
            padding-left: 0.75rem !important;
            padding-right: 0.75rem !important;
        }

        .product-index-page .action-btn {
            min-height: 40px;
        }
    }

    @media (max-width: 400px) {
        .product-index-page .product-thumb-img,
        .product-index-page .product-thumb-placeholder {
            width: 88px;
            height: 72px;
        }
    }
</style>
@endpush