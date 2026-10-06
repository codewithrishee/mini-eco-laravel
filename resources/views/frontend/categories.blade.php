@extends('layouts.app')
@section('title', 'Category | RvStore')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/shop.css') }}">

<style>
    /* =========================================================
       CATEGORIES PAGE
    ========================================================= */

    .categories-section {
        background: #f8faf9;
        position: relative;
    }

    .categories-header {
        max-width: 650px;
        margin: 0 auto 3rem;
    }

    .categories-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 16px;
        border-radius: 50px;
        background: rgba(30, 74, 61, 0.08);
        color: #1e4a3d;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .categories-title {
        font-size: clamp(2rem, 4vw, 2.7rem);
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .categories-title span {
        color: #1e4a3d;
    }

    .categories-subtitle {
        color: #6b7280;
        font-size: 0.98rem;
        line-height: 1.7;
        margin: 0;
    }


    /* =========================================================
       CATEGORY CARD
    ========================================================= */

    .category-link {
        display: block;
        height: 100%;
        text-decoration: none;
        color: inherit;
    }

    .category-page-card {
        height: 100%;
        background: #fff;
        border: 1px solid #edf0ee;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease,
            border-color 0.3s ease;
    }

    .category-page-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 18px 45px rgba(22, 54, 44, 0.10);
        border-color: rgba(30, 74, 61, 0.15);
    }


    /* Image */

    .category-image-wrapper {
        position: relative;
        height: 270px;
        overflow: hidden;
        background: #eef3f1;
    }

    .category-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .category-page-card:hover .category-image-wrapper img {
        transform: scale(1.05);
    }

    .category-image-wrapper::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to bottom,
            transparent 55%,
            rgba(0, 0, 0, 0.12)
        );
        pointer-events: none;
    }


    /* Product Count Badge */

    .category-product-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        z-index: 2;
        padding: 7px 12px;
        background: rgba(255, 255, 255, 0.94);
        backdrop-filter: blur(8px);
        border-radius: 50px;
        color: #1e4a3d;
        font-size: 0.75rem;
        font-weight: 700;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }


    /* Card Content */

    .category-card-content {
        padding: 24px;
    }

    .category-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
        transition: color 0.25s ease;
    }

    .category-page-card:hover .category-card-title {
        color: #1e4a3d;
    }

    .category-card-text {
        color: #8a928e;
        font-size: 0.88rem;
        margin-bottom: 20px;
    }


    /* Explore */

    .category-explore {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid #eef1ef;
        color: #1e4a3d;
        font-size: 0.88rem;
        font-weight: 700;
    }

    .category-explore-icon {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f0f5f3;
        color: #1e4a3d;
        transition: all 0.25s ease;
    }

    .category-page-card:hover .category-explore-icon {
        background: #1e4a3d;
        color: #fff;
        transform: translateX(3px);
    }


    /* =========================================================
       NO IMAGE
    ========================================================= */

    .category-no-image {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef3f1;
        color: #a2ada8;
        font-size: 3rem;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .category-empty-state {
        background: #fff;
        border: 1px solid #edf0ee;
        border-radius: 20px;
        padding: 60px 20px;
        max-width: 650px;
        margin: auto;
    }

    .category-empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f0f5f3;
        color: #1e4a3d;
        font-size: 2rem;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {
        .category-image-wrapper {
            height: 240px;
        }
    }

    @media (max-width: 767px) {
        .categories-header {
            margin-bottom: 2rem;
        }

        .category-image-wrapper {
            height: 220px;
        }

        .category-card-content {
            padding: 20px;
        }
    }

    @media (max-width: 575px) {
        .category-image-wrapper {
            height: 200px;
        }

        .category-card-title {
            font-size: 1.1rem;
        }
    }
</style>


{{-- ================================================================
     BANNER
================================================================ --}}
<section class="shop-banner">

    <div class="banner-overlay">

        <div class="container text-center">

            <span class="shop-badge">
                Explore Rv-Store
            </span>

            <h1 class="banner-title">
                Shop By <span>Category</span>
            </h1>

            <p class="banner-subtitle">
                Explore our carefully curated collections and discover
                products made for your style.
            </p>

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb justify-content-center mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Categories
                    </li>

                </ol>

            </nav>

        </div>

    </div>

</section>


{{-- ================================================================
     ALL CATEGORIES
================================================================ --}}
<section class="categories-section py-5">

    <div class="container py-lg-3">


        {{-- SECTION HEADING --}}
        <div class="categories-header text-center">

            <span class="categories-eyebrow">
                <i class="bi bi-grid"></i>
                Rv-Store Collections
            </span>

            <h2 class="categories-title">
                Find Your Perfect
                <span>Collection</span>
            </h2>

            <p class="categories-subtitle">
                Browse thoughtfully selected categories and discover
                products designed to complement your everyday lifestyle.
            </p>

        </div>


        {{-- CATEGORY GRID --}}
        <div class="row g-4">

            @forelse($allCategories as $category)

                <div class="col-xl-4 col-md-6">

                    <a href="{{ route('category.show', $category->slug) }}"
                       class="category-link">

                        <article class="category-page-card">


                            {{-- IMAGE --}}
                            <div class="category-image-wrapper">

                                @if($category->image)

                                    <img
                                        src="{{ asset('uploads/categories/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="category-no-image">
                                        <i class="bi bi-image"></i>
                                    </div>

                                @endif


                                {{-- PRODUCT COUNT --}}
                                <span class="category-product-badge">

                                    {{ $category->products_count }}

                                    {{ $category->products_count == 1
                                        ? 'Product'
                                        : 'Products'
                                    }}

                                </span>

                            </div>


                            {{-- CONTENT --}}
                            <div class="category-card-content">

                                <h3 class="category-card-title">
                                    {{ $category->name }}
                                </h3>

                                <p class="category-card-text">
                                    Discover our handpicked
                                    {{ $category->name }} collection.
                                </p>


                                <div class="category-explore">

                                    <span>
                                        Explore Collection
                                    </span>

                                    <span class="category-explore-icon">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>

                                </div>

                            </div>

                        </article>

                    </a>

                </div>


            @empty

                {{-- EMPTY STATE --}}
                <div class="col-12">

                    <div class="category-empty-state text-center">

                        <div class="category-empty-icon">
                            <i class="bi bi-grid"></i>
                        </div>

                        <h4 class="fw-bold mb-2">
                            No Categories Available
                        </h4>

                        <p class="text-muted mb-0">
                            Our collections are being prepared.
                            Please check back soon.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</section>

@endsection