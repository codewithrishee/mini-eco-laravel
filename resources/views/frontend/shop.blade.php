@extends('layouts.app')
@section('title', 'Shop | RvStore')
@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

    <section class="shop-banner">
        <div class="banner-overlay">
            <div class="container text-center">
                <span class="shop-badge">
                    Premium Collection
                </span>
                <h1 class="banner-title">
                    Our <span>Shop</span>
                </h1>
                <p class="banner-subtitle">
                    Discover premium products carefully selected to deliver quality,
                    style and value in every purchase.
                </p>
                <nav>
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Shop
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- ================================================================ -->
    <!-- 2. SHOP CONTENT -->
    <!-- ================================================================ -->
    <section class="shop-content py-5">
        <div class="container">
            <div class="row g-4">

                <!-- ======================== -->
                <!-- LEFT SIDEBAR -->
                <!-- ======================== -->
                <div class="col-lg-3">
                    <div class="sidebar-sticky">

                        <form action="{{ route('shop') }}" method="GET">

                            <!-- ================= SEARCH ================= -->
                            <div class="filter-card">

                                <h5 class="filter-title">
                                    <i class="bi bi-search me-2"></i>
                                    Search Products
                                </h5>

                                <div class="input-group search-group">

                                    <input type="text" name="search" class="form-control" placeholder="Search..."
                                        value="{{ request('search') }}">

                                    <button class="btn btn-search" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>

                                </div>

                            </div>


                            <!-- ================= CATEGORIES ================= -->
                            <div class="filter-card">

                                <h5 class="filter-title">
                                    <i class="bi bi-grid me-2"></i>
                                    Categories
                                </h5>

                                @foreach($shopCategories as $category)

                                                            <div class="form-check">

                                                                <input class="form-check-input" type="checkbox" name="categories[]"
                                                                    value="{{ $category->id }}" id="category{{ $category->id }}" {{ in_array(
                                        $category->id,
                                        (array) request('categories', [])
                                    ) ? 'checked' : '' }}>

                                                                <label class="form-check-label" for="category{{ $category->id }}">

                                                                    {{ $category->name }}

                                                                    <span>
                                                                        ({{ $category->products_count }})
                                                                    </span>

                                                                </label>

                                                            </div>

                                @endforeach

                            </div>


                            <!-- ================= PRICE RANGE ================= -->
                            <div class="filter-card">

                                <h5 class="filter-title">
                                    <i class="bi bi-currency-rupee me-2"></i>
                                    Price Range
                                </h5>

                                <div class="row g-2">

                                    <!-- Minimum Price -->
                                    <div class="col-6">

                                        <label class="form-label small text-muted">
                                            Min Price
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                ₹
                                            </span>

                                            <input type="number" name="min_price" class="form-control" min="0"
                                                placeholder="0" value="{{ request('min_price') }}">

                                        </div>

                                    </div>


                                    <!-- Maximum Price -->
                                    <div class="col-6">

                                        <label class="form-label small text-muted">
                                            Max Price
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                ₹
                                            </span>

                                            <input type="number" name="max_price" class="form-control" min="0"
                                                placeholder="5000" value="{{ request('max_price') }}">

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- ================= AVAILABILITY ================= -->
                            <div class="filter-card">

                                <h5 class="filter-title">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Availability
                                </h5>


                                <!-- In Stock -->
                                <div class="form-check">

                                    <input class="form-check-input" type="checkbox" name="availability[]" value="in_stock"
                                        id="instock" {{ in_array(
        'in_stock',
        (array) request('availability', [])
    ) ? 'checked' : '' }}>

                                    <label class="form-check-label" for="instock">

                                        In Stock

                                        <span>
                                            ({{ $inStockCount }})
                                        </span>

                                    </label>

                                </div>


                                <!-- Out Of Stock -->
                                <div class="form-check">

                                    <input class="form-check-input" type="checkbox" name="availability[]"
                                        value="out_of_stock" id="outofstock" {{ in_array(
        'out_of_stock',
        (array) request('availability', [])
    ) ? 'checked' : '' }}>

                                    <label class="form-check-label" for="outofstock">

                                        Out of Stock

                                        <span>
                                            ({{ $outOfStockCount }})
                                        </span>

                                    </label>

                                </div>

                            </div>


                            <!-- ================= APPLY FILTER ================= -->
                            <button type="submit" class="btn btn-primary w-100 mb-2">

                                <i class="bi bi-funnel me-2"></i>
                                Apply Filters

                            </button>


                            <!-- ================= RESET FILTER ================= -->
                            <a href="{{ route('shop') }}" class="btn btn-reset w-100">

                                <i class="bi bi-arrow-counterclockwise me-2"></i>
                                Reset Filters

                            </a>

                        </form>

                    </div>
                </div>

                <!-- ======================== -->
                <!-- RIGHT PRODUCT GRID -->
                <!-- ======================== -->
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- <h2>Best <span class="text-primary">Sellers</span></h2> -->
                        <!-- <a href="#" class="text-primary text-decoration-none">View All <i class="fas fa-arrow-right ms-1"></i></a> -->
                    </div>

                    <div class="row g-4">

                        @forelse($products as $product)

                                            <div class="col-6 col-md-4">

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
                                                                    alt="{{ $product->name }}" class="img-fluid">

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

                                    <h5 class="mt-3">
                                        No products found
                                    </h5>

                                    <p class="text-muted">
                                        No products are currently available.
                                    </p>

                                </div>

                            </div>

                        @endforelse

                    </div>

                    <div class="mt-5">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
    </section>

    <!-- ================================================================ -->
    <!-- 5. OFFER BANNER -->
    <!-- ================================================================ -->
    <section class="offer-section py-5">
        <div class="container">
            <div class="offer-card">
                <div class="offer-content">
                    <span class="offer-tag">Limited Offer</span>
                    <h2 class="offer-title">Big Discount <span class="highlight">Up to 50%</span></h2>
                    <p class="offer-desc">Get the best deals on premium eco-friendly products. Hurry, offer ends soon!</p>
                    <button class="btn btn-offer">Shop Now <i class="bi bi-arrow-right ms-2"></i></button>
                </div>
            </div>
        </div>
    </section>

    <!-- ================================================================
     RECENTLY VIEWED
================================================================ -->
@if($recentProducts->count())

<section class="recently-viewed py-5">

    <div class="container">

        <div class="section-header text-center mb-4">

            <h2 class="section-title">
                Recently Viewed
            </h2>

            <p class="section-subtitle">
                Products you've been checking out
            </p>

        </div>


        <div class="recent-slider owl-carousel">

            @foreach($recentProducts as $product)

                @php
                    $recentImage = $product->images->first();
                @endphp

                <div class="recent-item">

                    <a href="{{ route('product.details', $product->slug) }}"
                       class="text-decoration-none text-dark">

                        <div class="recent-card">

                            @if($recentImage)

                                <img
                                    src="{{ asset('uploads/products/' . $recentImage->image) }}"
                                    alt="{{ $product->name }}"
                                    class="img-fluid"
                                >

                            @endif


                            <h6>
                                {{ $product->name }}
                            </h6>


                            <span class="recent-price">

                                @if($product->sale_price)

                                    ₹{{ number_format($product->sale_price, 2) }}

                                @else

                                    ₹{{ number_format($product->price, 2) }}

                                @endif

                            </span>

                        </div>

                    </a>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endif

  <!-- ================================================================
     POPULAR CATEGORIES
================================================================ -->
<section class="popular-categories py-5">

    <div class="container">

        <div class="section-header text-center mb-4">

            <h2 class="section-title">
                Popular Categories
            </h2>

            <p class="section-subtitle">
                Shop by category
            </p>

        </div>


        <div class="row g-4">

            @forelse($popularCategories as $category)

                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">

                    <a href="{{ route('shop', ['categories' => [$category->id]]) }}"
                       class="category-card">

                        <div class="category-icon">
                            <i class="bi bi-grid"></i>
                        </div>

                        <h5 class="category-name">
                            {{ $category->name }}
                        </h5>

                        <span class="category-count">

                            {{ $category->products_count }}

                            {{ $category->products_count == 1
                                ? 'Product'
                                : 'Products' }}
                        </span>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">
                        No categories available.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</section>

    <script src="{{ asset('assets/js/script.js') }}"></script>
@endsection