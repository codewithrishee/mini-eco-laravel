@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-chat-dots-fill me-2 text-primary"></i>
                Product Queries
            </h4>

            <p class="text-muted small mb-0">
                View and manage customer inquiries received from product pages.
            </p>
        </div>

        <div>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                <i class="bi bi-inbox me-1"></i>
                {{ $queries->total() }} Queries
            </span>
        </div>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm"
             role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- QUERIES CARD --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 px-4 pt-4 pb-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="fw-semibold mb-1">
                        Customer Product Inquiries
                    </h5>

                    <p class="text-muted small mb-0">
                        Queries submitted through the Product Query form.
                    </p>

                </div>

            </div>

        </div>


        <div class="card-body p-0">

            @if($queries->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="ps-4">
                                    #
                                </th>

                                <th>
                                    Customer
                                </th>

                                <th>
                                    Product
                                </th>

                                <th>
                                    Phone
                                </th>

                                <th>
                                    Subject
                                </th>

                                <th>
                                    Date
                                </th>

                                <th class="text-end pe-4">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($queries as $query)

                                <tr>

                                    {{-- ID --}}
                                    <td class="ps-4">

                                        <span class="text-muted small">
                                            #{{ $query->id }}
                                        </span>

                                    </td>


                                    {{-- CUSTOMER --}}
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


                                    {{-- PRODUCT --}}
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


                                    {{-- PHONE --}}
                                    <td>

                                        <a href="tel:{{ $query->phone }}"
                                           class="text-decoration-none text-dark">

                                            <i class="bi bi-telephone me-1 text-muted"></i>

                                            {{ $query->phone }}

                                        </a>

                                    </td>


                                    {{-- SUBJECT --}}
                                    <td>

                                        @if($query->subject)

                                            <span class="query-subject">
                                                {{ \Illuminate\Support\Str::limit($query->subject, 35) }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- DATE --}}
                                    <td>

                                        <div class="small fw-semibold">
                                            {{ $query->created_at->format('d M Y') }}
                                        </div>

                                        <div class="small text-muted">
                                            {{ $query->created_at->format('h:i A') }}
                                        </div>

                                    </td>


                                    {{-- ACTIONS --}}
                                    <td class="text-end pe-4">

                                        <div class="d-inline-flex gap-2">


                                            {{-- VIEW --}}
                                            <a href="{{ route('admin.product-queries.show', $query) }}"
                                               class="btn btn-sm btn-outline-primary rounded-pill px-3">

                                                <i class="bi bi-eye me-1"></i>

                                                View

                                            </a>


                                            {{-- DELETE --}}
                                            <form
                                                action="{{ route('admin.product-queries.destroy', $query) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this product query?')">

                                                @csrf
                                                @method('DELETE')


                                                <button
                                                    type="submit"
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

                    <h5 class="fw-semibold mt-3 mb-2">
                        No Product Queries Yet
                    </h5>

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

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }


    /* TABLE */

    .table > :not(caption) > * > * {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .table thead th {
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #6c757d;
        font-weight: 600;
        white-space: nowrap;
        border-bottom: 1px solid #e9ecef;
    }

    .table tbody td {
        font-size: 0.9rem;
        border-color: #f0f0f0;
    }


    /* CUSTOMER */

    .customer-avatar {
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


    /* PRODUCT IMAGE */

    .product-query-image {
        width: 48px;
        height: 48px;
        min-width: 48px;

        object-fit: cover;

        border-radius: 10px;

        border: 1px solid #e9ecef;
    }


    .product-image-placeholder {
        width: 48px;
        height: 48px;
        min-width: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: #f5f5f5;

        color: #adb5bd;

        font-size: 1.1rem;
    }


    .product-name {
        max-width: 180px;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    /* SUBJECT */

    .query-subject {
        display: inline-block;

        max-width: 180px;

        color: #495057;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    /* ACTION */

    .action-delete-btn {
        width: 32px;
        height: 32px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 0;
    }


    /* EMPTY */

    .empty-query-icon {
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


    /* RESPONSIVE */

    @media (max-width: 767px) {

        .container-fluid {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

    }

</style>

@endpush