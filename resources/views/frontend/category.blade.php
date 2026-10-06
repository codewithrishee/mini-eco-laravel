@extends('layouts.app')
@section('title', 'Category | RvStore')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

{{-- ================= CATEGORY BANNER ================= --}}
<section class="shop-banner">

    <div class="banner-overlay">

        <div class="container text-center">

            <span class="shop-badge">
                Rv-Store Collection
            </span>

            <h1 class="banner-title">
                {{ $category->name }}
            </h1>

            <p class="banner-subtitle">
                Explore our premium {{ $category->name }} collection,
                carefully selected for quality, style and value.
            </p>

            <nav>
                <ol class="breadcrumb justify-content-center">

                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('shop') }}">
                            Shop
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        {{ $category->name }}
                    </li>

                </ol>
            </nav>

        </div>

    </div>

</section>


{{-- ================= CATEGORY PRODUCTS ================= --}}
<section class="shop-content py-5">

    <div class="container">

        {{-- Heading --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <span class="text-muted small">
                    Rv-Store
                </span>

                <h2 class="fw-bold mb-1">
                    {{ $category->name }}
                </h2>

                <p class="text-muted mb-0">
                    {{ $products->total() }}
                    {{ $products->total() == 1 ? 'Product' : 'Products' }}
                </p>

            </div>

            <a href="{{ route('shop') }}"
               class="btn btn-outline-success">

                View All Products

            </a>

        </div>


        {{-- Products --}}
        <div class="row g-4">

            @forelse($products as $product)

                <div class="col-xl-3 col-lg-4 col-md-4 col-6">

                    <a href="{{ route('product.details', $product->slug) }}"
                       class="text-decoration-none text-dark d-block h-100">

                        <div class="product-card h-100">

                            {{-- IMAGE --}}
                            <div class="product-image">

                                @php
                                    $productImage = $product->images->first();
                                @endphp

                                @if($productImage)

                                    <img
                                        src="{{ asset('uploads/products/' . $productImage->image) }}"
                                        alt="{{ $product->name }}"
                                        class="img-fluid"
                                    >

                                @endif


                                {{-- DISCOUNT --}}
                                @if(
                                    $product->sale_price &&
                                    $product->price > $product->sale_price
                                )

                                    @php
                                        $discount = round(
                                            (($product->price - $product->sale_price)
                                            / $product->price) * 100
                                        );
                                    @endphp

                                    <span class="badge-discount">
                                        -{{ $discount }}%
                                    </span>

                                @endif


                                {{-- STOCK --}}
                                @if($product->stock > 0)

                                    <span class="badge-stock">
                                        In Stock
                                    </span>

                                @else

                                    <span class="badge-stock">
                                        Out of Stock
                                    </span>

                                @endif

                            </div>


                            {{-- PRODUCT CONTENT --}}
                            <div class="card-body">

                                <div class="product-category">
                                    {{ $product->category->name ?? '' }}
                                </div>

                                <h5 class="product-name">
                                    {{ $product->name }}
                                </h5>


                                {{-- PRICE --}}
                                <div class="product-price">

                                    @if($product->sale_price)

                                        ₹{{ number_format($product->sale_price, 2) }}

                                        <span class="product-old-price">
                                            ₹{{ number_format($product->price, 2) }}
                                        </span>

                                    @else

                                        ₹{{ number_format($product->price, 2) }}

                                    @endif

                                </div>


                                {{-- DESCRIPTION --}}
                                <p class="product-description">

                                    {{ Str::limit(
                                        $product->short_description
                                        ?? $product->description,
                                        70
                                    ) }}

                                </p>

                            </div>

                        </div>

                    </a>

                </div>

            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <i class="bi bi-box-seam fs-1 text-muted"></i>

                        <h4 class="mt-3">
                            No Products Found
                        </h4>

                        <p class="text-muted">
                            There are currently no products available
                            in {{ $category->name }}.
                        </p>

                        <a href="{{ route('shop') }}"
                           class="btn btn-primary mt-2">

                            Browse All Products

                        </a>

                    </div>

                </div>

            @endforelse

        </div>


        {{-- PAGINATION --}}
        @if($products->hasPages())

            <div class="mt-5 d-flex justify-content-center">

                {{ $products->links() }}

            </div>

        @endif

    </div>

</section>

@endsection