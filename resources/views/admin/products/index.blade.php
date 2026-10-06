@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-box-seam me-2 text-primary"></i>Products
            </h4>
            <p class="text-muted small mb-0">Manage your product inventory</p>
        </div>
        <div class="d-flex gap-2">
            <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           class="form-control border-start-0" 
                           placeholder="Search Product...">
                </div>
            </form>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
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

    <!-- Products Table -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
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
                                        <img src="{{ asset('uploads/products/' . $product->images->first()->image) }}" 
                                             width="60" 
                                             height="60" 
                                             class="rounded-2 border object-fit-cover"
                                             alt="{{ $product->name }}">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>
                                <td class="fw-medium">{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td class="fw-semibold">₹ {{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->sale_price)
                                        <span class="text-danger fw-semibold">₹ {{ number_format($product->sale_price, 2) }}</span>
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
                                        <!-- <a href="{{ route('admin.products.show',$product->id) }}"
                                           class="btn btn-outline-info btn-sm rounded-pill px-3">
                                            <i class="bi bi-eye"></i> View
                                        </a> -->
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                           class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Delete Product?');">
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
                                    <p class="text-muted small mb-0">Click "Add Product" to create your first product.</p>
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-4 mt-3">
                                        <i class="bi bi-plus-circle me-1"></i> Add Product
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 px-4">
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
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
    .input-group .form-control:focus {
        border-color: #667eea;
        box-shadow: none;
    }
    .input-group .form-control:focus + .input-group-text {
        border-color: #667eea;
    }
    .input-group .input-group-text {
        background-color: #fff;
        color: #6c757d;
        border-right: 0;
    }
</style>
@endpush