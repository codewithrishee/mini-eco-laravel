@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>
            <a href="{{ route('admin.product-queries.index') }}"
               class="text-decoration-none text-muted small">

                <i class="bi bi-arrow-left me-1"></i>
                Back to Product Queries

            </a>

            <h4 class="fw-bold text-dark mt-2 mb-1">
                <i class="bi bi-chat-dots-fill me-2 text-primary"></i>
                Product Query Details
            </h4>

            <p class="text-muted small mb-0">
                View customer inquiry and related product information.
            </p>
        </div>

        <div>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                Query #{{ $productQuery->id }}
            </span>
        </div>

    </div>


    <div class="row g-4">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">

            {{-- CUSTOMER INFORMATION --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white border-0 px-4 pt-4 pb-0">

                    <h5 class="fw-semibold mb-1">
                        <i class="bi bi-person-circle me-2 text-primary"></i>
                        Customer Information
                    </h5>

                    <p class="text-muted small mb-0">
                        Contact details provided by the customer.
                    </p>

                </div>

                <div class="card-body p-4">

                    <div class="row g-4">

                        {{-- NAME --}}
                        <div class="col-md-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Name
                                </span>

                                <div class="detail-value">
                                    {{ $productQuery->name }}
                                </div>

                            </div>

                        </div>


                        {{-- PHONE --}}
                        <div class="col-md-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Phone Number
                                </span>

                                <div class="detail-value">

                                    <a href="tel:{{ $productQuery->phone }}"
                                       class="text-decoration-none">

                                        <i class="bi bi-telephone me-1"></i>
                                        {{ $productQuery->phone }}

                                    </a>

                                </div>

                            </div>

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Email Address
                                </span>

                                <div class="detail-value">

                                    @if($productQuery->email)

                                        <a href="mailto:{{ $productQuery->email }}"
                                           class="text-decoration-none">

                                            <i class="bi bi-envelope me-1"></i>
                                            {{ $productQuery->email }}

                                        </a>

                                    @else

                                        <span class="text-muted">
                                            Not provided
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- DATE --}}
                        <div class="col-md-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Submitted On
                                </span>

                                <div class="detail-value">

                                    <i class="bi bi-calendar3 me-1 text-muted"></i>

                                    {{ $productQuery->created_at->format('d M Y, h:i A') }}

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- QUERY DETAILS --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 px-4 pt-4 pb-0">

                    <h5 class="fw-semibold mb-1">
                        <i class="bi bi-chat-left-text me-2 text-primary"></i>
                        Query Details
                    </h5>

                    <p class="text-muted small mb-0">
                        Message submitted by the customer.
                    </p>

                </div>

                <div class="card-body p-4">

                    {{-- SUBJECT --}}
                    <div class="mb-4">

                        <span class="detail-label">
                            Subject
                        </span>

                        <div class="query-subject-box">

                            {{ $productQuery->subject ?: 'No subject provided' }}

                        </div>

                    </div>


                    {{-- MESSAGE --}}
                    <div>

                        <span class="detail-label">
                            Message
                        </span>

                        <div class="query-message">

                            {!! nl2br(e($productQuery->message)) !!}

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- RIGHT SIDE --}}
        <div class="col-lg-4">

            {{-- PRODUCT INFORMATION --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white border-0 px-4 pt-4 pb-0">

                    <h5 class="fw-semibold mb-0">
                        <i class="bi bi-box-seam me-2 text-primary"></i>
                        Product
                    </h5>

                </div>


                <div class="card-body p-4">

                    @if($productQuery->product)

                        {{-- PRODUCT IMAGE --}}
                        @if($productQuery->product->image)

                            <img src="{{ asset('uploads/products/' . $productQuery->product->image) }}"
                                 alt="{{ $productQuery->product->name }}"
                                 class="product-image mb-3">

                        @else

                            <div class="product-placeholder mb-3">

                                <i class="bi bi-image"></i>

                            </div>

                        @endif


                        <h5 class="fw-bold mb-2">
                            {{ $productQuery->product->name }}
                        </h5>


                        <div class="text-muted small mb-3">
                            Product ID: #{{ $productQuery->product->id }}
                        </div>


                        @if(isset($productQuery->product->price))

                            <div class="product-price mb-4">
                                ₹{{ number_format($productQuery->product->price, 2) }}
                            </div>

                        @endif


                        {{-- VIEW PRODUCT --}}
                        @if($productQuery->product->slug)

                            <a href="{{ route('product.details', $productQuery->product->slug) }}"
                               target="_blank"
                               class="btn btn-outline-primary rounded-pill w-100">

                                <i class="bi bi-box-arrow-up-right me-1"></i>
                                View Product

                            </a>

                        @endif


                    @else

                        <div class="text-center py-4">

                            <div class="removed-product-icon mb-3">

                                <i class="bi bi-box-seam"></i>

                            </div>

                            <h6 class="fw-semibold">
                                Product Not Available
                            </h6>

                            <p class="text-muted small mb-0">
                                The related product may have been removed.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- QUICK CONTACT --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white border-0 px-4 pt-4 pb-0">

                    <h5 class="fw-semibold mb-0">
                        <i class="bi bi-headset me-2 text-primary"></i>
                        Quick Contact
                    </h5>

                </div>


                <div class="card-body p-4">

                    {{-- CALL --}}
                    <a href="tel:{{ $productQuery->phone }}"
                       class="btn btn-outline-primary rounded-pill w-100 mb-2">

                        <i class="bi bi-telephone-fill me-2"></i>
                        Call Customer

                    </a>


                    {{-- EMAIL --}}
                    @if($productQuery->email)

                        <a href="mailto:{{ $productQuery->email }}"
                           class="btn btn-outline-secondary rounded-pill w-100">

                            <i class="bi bi-envelope-fill me-2"></i>
                            Send Email

                        </a>

                    @endif

                </div>

            </div>


            {{-- DELETE --}}
            <div class="card border border-danger shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h6 class="fw-semibold text-danger">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        Delete Query
                    </h6>

                    <p class="text-muted small">
                        Permanently remove this product query from the system.
                    </p>


                    <form action="{{ route('admin.product-queries.destroy', $productQuery) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this product query?')">

                        @csrf
                        @method('DELETE')


                        <button type="submit"
                                class="btn btn-outline-danger rounded-pill w-100">

                            <i class="bi bi-trash3 me-1"></i>
                            Delete Query

                        </button>

                    </form>

                </div>

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


    /* DETAILS */

    .detail-item {
        height: 100%;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 12px;
        border: 1px solid #edf0f2;
    }

    .detail-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: #8a9097;
        margin-bottom: 6px;
    }

    .detail-value {
        color: #212529;
        font-weight: 500;
        word-break: break-word;
    }


    /* QUERY */

    .query-subject-box {
        padding: 14px 16px;
        background: #f8f9fa;
        border: 1px solid #edf0f2;
        border-radius: 12px;
        font-weight: 600;
    }

    .query-message {
        min-height: 150px;
        padding: 20px;
        background: #f8f9fa;
        border: 1px solid #edf0f2;
        border-radius: 12px;
        color: #495057;
        line-height: 1.8;
    }


    /* PRODUCT */

    .product-image {
        width: 100%;
        height: 230px;
        object-fit: cover;
        border-radius: 14px;
        border: 1px solid #edf0f2;
    }

    .product-placeholder {
        width: 100%;
        height: 230px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 14px;
        color: #adb5bd;
        font-size: 2.5rem;
    }

    .product-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #198754;
    }


    /* REMOVED PRODUCT */

    .removed-product-icon {
        width: 65px;
        height: 65px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        color: #adb5bd;
        border-radius: 50%;
        font-size: 1.6rem;
    }


    @media (max-width: 767px) {

        .container-fluid {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        .product-image,
        .product-placeholder {
            height: 200px;
        }

    }

</style>

@endpush