@extends('layouts.app')
@section('title', 'Home | RvStore')
@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


    <section class="hero-slider owl-carousel owl-theme">
        @foreach($heroSliders as $slider)
            <div class="hero-slide" style="background-image: url('{{ asset('uploads/hero-sliders/' . $slider->image) }}');">
                <div class="container">
                    <div class="hero-content col-lg-7">
                        <span class="badge">
                            {{ $slider->badge }}
                        </span>
                        <h1>
                            {!! nl2br(e($slider->title)) !!}
                        </h1>
                        <p>
                            {{ $slider->description }}
                        </p>
                        <div>
                            <a href="{{ $slider->button1_link }}" class="btn btn-gold">
                                {{ $slider->button1_text }}
                            </a>
                            <a href="{{ $slider->button2_link }}" class="btn btn-outline-light">
                                {{ $slider->button2_text }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <!-- ============================================================
         SHOP BY CATEGORY
    ============================================================ -->
    <section class="section-padding bg-white">
        <div class="container">

            <div class="text-center mb-5">
                <h2>
                    Shop by <span class="text-primary">Category</span>
                </h2>

                <p class="text-muted">
                    Explore our premium collections
                </p>
            </div>

            <div class="row g-4">

                @forelse($categories as $category)

                    <div class="col-6 col-md-3">

                        {{-- CLICKABLE CATEGORY --}}
                        <a href="{{ route('category.show', $category->slug) }}"
                            class="text-decoration-none text-dark d-block h-100">

                            <div class="category-card h-100">

                                <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="{{ $category->name }}">

                                <div class="category-name">
                                    {{ $category->name }}
                                </div>

                                <div class="category-count">
                                    Category
                                </div>

                            </div>

                        </a>

                    </div>

                @empty

                    <div class="col-12 text-center">
                        <h5>No Categories Found</h5>
                    </div>

                @endforelse

            </div>

        </div>
    </section>

    <!-- ============================================================
         FEATURED PRODUCTS
    ============================================================ -->
    <section class="section-padding bg-gray-soft">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>
                    Featured <span class="text-primary">Products</span>
                </h2>

                <a href="{{ route('shop') }}" class="text-primary text-decoration-none">
                    View All
                    <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="featured-slider owl-carousel owl-theme">

                @forelse($featuredProducts as $product)

                    <div class="item">

                        <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none text-dark d-block">

                            <div class="product-card">

                                <div class="product-image">

                                    @php
                                        $productImage = $product->images->first();
                                    @endphp

                                    @if($productImage)

                                        <img src="{{ asset('uploads/products/' . $productImage->image) }}"
                                            alt="{{ $product->name }}">

                                    @else

                                        <p>No Image</p>

                                    @endif

                                    {{-- Discount Badge --}}
                                    @if($product->sale_price && $product->price > $product->sale_price)

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


                                    {{-- Stock Badge --}}
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


                                <div class="card-body">

                                    {{-- Category --}}
                                    <div class="product-category">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </div>


                                    {{-- Product Name --}}
                                    <h5 class="product-name">
                                        {{ $product->name }}
                                    </h5>


                                    {{-- Price --}}
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
                                    {{-- Description --}}
                                    <p class="product-description">
                                        {{ Str::limit($product->description, 70) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <p class="text-muted mb-0">
                            No featured products available.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @if($offerBanner)

        <section class="section-padding">
            <div class="container">

                <div class="offer-banner" style="background-image:url('{{ asset('uploads/banners/' . $offerBanner->image) }}');
                           background-size:cover;
                           background-position:center;">

                    <div class="offer-bg">
                        {{ $offerBanner->display_order }}
                    </div>

                    <div class="row align-items-center">

                        <div class="col-lg-8">

                            <span class="offer-tag">
                                {{ $offerBanner->subtitle }}
                            </span>

                            <h2>
                                {{ $offerBanner->title }}
                            </h2>

                            <p class="lead">
                                {{ $offerBanner->button_text }}
                            </p>

                            <a href="{{ $offerBanner->button_link }}" class="btn btn-gold btn-lg">

                                Shop Now
                                <i class="fas fa-arrow-right ms-2"></i>

                            </a>

                        </div>

                    </div>

                </div>

            </div>
        </section>

    @endif

    <!-- ============================================================
         BEST SELLING PRODUCTS
    ============================================================ -->
    <section class="section-padding bg-gray-soft">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h2>
                    Best <span class="text-primary">Sellers</span>
                </h2>

                <a href="{{ route('shop') }}" class="text-primary text-decoration-none">
                    View All
                    <i class="fas fa-arrow-right ms-1"></i>
                </a>

            </div>

            <div class="row g-4">

                @forelse($bestSellerProducts as $product)

                    <div class="col-6 col-md-3">

                        <a href="{{ route('product.details', $product->slug) }}"
                            class="text-decoration-none text-dark d-block h-100">

                            <div class="product-card h-100">

                                <div class="product-image">

                                    {{-- Product First Image --}}
                                    @php
                                        $productImage = $product->images->first();
                                    @endphp

                                    @if($productImage)

                                        <img src="{{ asset('uploads/products/' . $productImage->image) }}"
                                            alt="{{ $product->name }}">

                                    @endif


                                    {{-- Discount --}}
                                    @if($product->sale_price && $product->price > $product->sale_price)

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


                                    {{-- Stock --}}
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


                                <div class="card-body">

                                    {{-- Category --}}
                                    <div class="product-category">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </div>


                                    {{-- Product Name --}}
                                    <h5 class="product-name">
                                        {{ $product->name }}
                                    </h5>


                                    {{-- Price --}}
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


                                    {{-- Description --}}
                                    <p class="product-description">
                                        {{ Str::limit($product->short_description ?? $product->description, 70) }}
                                    </p>

                                </div>

                            </div>

                        </a>

                    </div>

                @empty

                    <div class="col-12 text-center py-4">
                        <p class="text-muted mb-0">
                            No best seller products available.
                        </p>
                    </div>

                @endforelse

            </div>

        </div>
    </section>

    <!-- ============================================================
            WHY SHOP WITH US
            ============================================================ -->
    <section class="section-padding bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Why <span class="text-primary">Shop With Us</span></h2>
                <p class="text-muted">We deliver excellence at every step</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="text-center p-3">
                        <div class="bg-primary-soft rounded-circle d-inline-flex p-3 mb-3">
                            <i class="fas fa-truck fa-2x text-primary"></i>
                        </div>
                        <h6 class="fw-bold">Fast Delivery</h6>
                        <p class="small text-muted">Quick shipping across the globe</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-center p-3">
                        <div class="bg-primary-soft rounded-circle d-inline-flex p-3 mb-3">
                            <i class="fas fa-lock fa-2x text-primary"></i>
                        </div>
                        <h6 class="fw-bold">Secure Payment</h6>
                        <p class="small text-muted">100% safe transactions</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-center p-3">
                        <div class="bg-primary-soft rounded-circle d-inline-flex p-3 mb-3">
                            <i class="fas fa-undo fa-2x text-primary"></i>
                        </div>
                        <h6 class="fw-bold">Easy Returns</h6>
                        <p class="small text-muted">30-day hassle-free returns</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="text-center p-3">
                        <div class="bg-primary-soft rounded-circle d-inline-flex p-3 mb-3">
                            <i class="fas fa-headset fa-2x text-primary"></i>
                        </div>
                        <h6 class="fw-bold">24/7 Support</h6>
                        <p class="small text-muted">Dedicated customer care</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         NEW ARRIVALS
    ============================================================ -->
    <section class="section-padding bg-gray-soft">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h2>
                    New <span class="text-primary">Arrivals</span>
                </h2>

                <a href="{{ route('shop') }}" class="text-primary text-decoration-none">
                    View All
                    <i class="fas fa-arrow-right ms-1"></i>
                </a>

            </div>

            <div class="new-arrivals-slider owl-carousel owl-theme">

                @forelse($newArrivalProducts as $product)

                    <div class="item">

                        <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none text-dark d-block">

                            <div class="product-card">

                                <div class="product-image">

                                    {{-- First Product Image --}}
                                    @php
                                        $productImage = $product->images->first();
                                    @endphp

                                    @if($productImage)

                                        <img src="{{ asset('uploads/products/' . $productImage->image) }}"
                                            alt="{{ $product->name }}">

                                    @endif


                                    {{-- New Badge --}}
                                    <span class="badge-discount">
                                        New
                                    </span>


                                    {{-- Stock --}}
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


                                <div class="card-body">

                                    {{-- Category --}}
                                    <div class="product-category">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </div>


                                    {{-- Product Name --}}
                                    <h5 class="product-name">
                                        {{ $product->name }}
                                    </h5>


                                    {{-- Price --}}
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


                                    {{-- Description --}}
                                    <p class="product-description">
                                        {{ Str::limit($product->short_description ?? $product->description, 70) }}
                                    </p>

                                </div>

                            </div>

                        </a>

                    </div>

                @empty

                    <div class="item">
                        <div class="text-center py-4">
                            <p class="text-muted mb-0">
                                No new arrivals available.
                            </p>
                        </div>
                    </div>

                @endforelse

            </div>

        </div>
    </section>

    <!-- ============================================================
         FLASH SALE
    ============================================================ -->
    <section class="section-padding bg-white">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

                <h2>
                    Flash <span class="text-primary">Sale</span>
                </h2>

                <div class="countdown-box">
                    <span id="hours">24</span>h
                    <span id="minutes">00</span>m
                    <span id="seconds">00</span>s
                </div>

            </div>


            <div class="row g-4">

                @forelse($flashSaleProducts as $product)

                    <div class="col-6 col-md-3">

                        <a href="{{ route('product.details', $product->slug) }}"
                            class="text-decoration-none text-dark d-block h-100">

                            <div class="product-card h-100">

                                <div class="product-image">

                                    {{-- Product Image --}}
                                    @php
                                        $productImage = $product->images->first();
                                    @endphp

                                    @if($productImage)

                                        <img src="{{ asset('uploads/products/' . $productImage->image) }}"
                                            alt="{{ $product->name }}">

                                    @endif


                                    {{-- Discount --}}
                                    @if($product->sale_price && $product->price > $product->sale_price)

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


                                    {{-- Stock --}}
                                    @if($product->stock > 0)

                                        <span class="badge-stock">
                                            Hurry!
                                        </span>

                                    @else

                                        <span class="badge-stock">
                                            Out of Stock
                                        </span>

                                    @endif

                                </div>


                                <div class="card-body">

                                    <div class="product-category">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </div>


                                    <h5 class="product-name">
                                        {{ $product->name }}
                                    </h5>


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


                                    <p class="product-description">
                                        {{ Str::limit($product->short_description ?? $product->description, 70) }}
                                    </p>

                                </div>

                            </div>

                        </a>

                    </div>

                @empty

                    <div class="col-12 text-center py-4">
                        <p class="text-muted mb-0">
                            No flash sale products available.
                        </p>
                    </div>

                @endforelse

            </div>

        </div>
    </section>

    <!-- ============================================================
            CUSTOMER REVIEWS (Slider)
            ============================================================ -->
    <section class="section-padding bg-gray-soft">
        <div class="container">

            <div class="text-center mb-5">
                <h2>Customer <span class="text-primary">Reviews</span></h2>
                <p class="text-muted">What our customers say about us</p>
            </div>

            <div class="reviews-slider owl-carousel owl-theme">

                @forelse($testimonials as $testimonial)

                    <div class="item">

                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center h-100">

                            @if($testimonial->image)

                                <img src="{{ asset('uploads/testimonials/' . $testimonial->image) }}" alt="{{ $testimonial->name }}"
                                    class="rounded-circle mx-auto mb-3" width="80" height="80" style="object-fit:cover;">

                            @else

                                <img src="https://picsum.photos/80" alt="Customer" class="rounded-circle mx-auto mb-3" width="80"
                                    height="80">

                            @endif

                            <h6 class="fw-bold mb-1">
                                {{ $testimonial->name }}
                            </h6>

                            <span class="text-muted small d-block mb-2">
                                {{ $testimonial->designation }}
                            </span>

                            <div class="text-warning mb-3">

                                @for($i = 1; $i <= $testimonial->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor

                                @for($i = $testimonial->rating + 1; $i <= 5; $i++)
                                    <i class="far fa-star"></i>
                                @endfor

                            </div>

                            <p class="text-muted mb-0">
                                "{{ $testimonial->review }}"
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="item">
                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center">
                            <p class="mb-0">No testimonials available.</p>
                        </div>
                    </div>

                @endforelse

            </div>

        </div>
    </section>
    <!-- ============================================================
         BRAND LOGOS (Dynamic Slider)
    ============================================================ -->
    <section class="section-padding bg-white">
        <div class="container">

            <div class="text-center mb-5">
                <h2>Trusted <span class="text-primary">Brands</span></h2>
                <p class="text-muted">We partner with the best in the industry</p>
            </div>

            <div class="brand-slider owl-carousel owl-theme">

                @foreach($brands as $brand)

                    <div class="item text-center" style="border-radius: 10px; overflow: hidden;">

                        <img src="{{ asset('uploads/brands/' . $brand->logo) }}" alt="{{ $brand->name }}" class="img-fluid"
                            style="
                                    filter: grayscale(100%);
                                    opacity: 0.6;
                                    transition: 0.3s;
                                " onmouseover="
                                    this.style.filter='grayscale(0)';
                                    this.style.opacity='1';
                                " onmouseout="
                                    this.style.filter='grayscale(100%)';
                                    this.style.opacity='0.6';
                                ">

                    </div>

                @endforeach

            </div>

        </div>
    </section>

    <!-- ============================================================
         INSTAGRAM GALLERY (Dynamic)
    ============================================================ -->
    <section class="section-padding bg-gray-soft">
        <div class="container">

            <div class="text-center mb-5">
                <h2>
                    Follow us on <span class="text-primary">Instagram</span>
                </h2>

                <p class="text-muted">
                    @mini_eco
                </p>
            </div>


            <div class="row g-3">

                @foreach($instagramGalleries as $gallery)

                    <div class="col-4 col-md-2">

                        @if($gallery->link)
                            <a href="{{ $gallery->link }}" target="_blank" class="text-decoration-none">
                        @endif


                            <div class="insta-item">

                                <img src="{{ asset('uploads/instagram/' . $gallery->image) }}" alt="Instagram">

                                <div class="insta-overlay">
                                    <i class="fab fa-instagram"></i>
                                </div>

                            </div>


                            @if($gallery->link)
                                </a>
                            @endif

                    </div>

                @endforeach

            </div>

        </div>
    </section>

@endsection