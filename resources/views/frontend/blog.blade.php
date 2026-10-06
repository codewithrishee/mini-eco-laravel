@extends('layouts.app')
@section('title', 'Blogs | RvStore')
@section('content')

 <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">

<section class="blog-hero mb-5">
    <div class="blog-hero-overlay d-flex align-items-center justify-content-center">
        <div class="container text-center">
            <span class="hero-badge">BLOG & INSIGHTS</span>
            <h1 class="hero-title">
                Our <span class="highlight">Blog</span>
            </h1>
            <p class="hero-subtitle">
                Discover shopping tips, eco-friendly ideas, product guides and inspiring lifestyle stories from Rv-Store.
            </p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Blog
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- ===== SECTION 2: FEATURED BLOG ===== -->
@if($featuredBlog)
<section class="container mb-5">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('blog.details', $featuredBlog->slug) }}" class="text-decoration-none text-dark d-block">
                <div class="featured-card card">
                    @if($featuredBlog->image)
                        <img src="{{ asset('uploads/blogs/' . $featuredBlog->image) }}" class="card-img-top" alt="{{ $featuredBlog->title }}">
                    @endif

                    <div class="card-body">
                       

                        <div class="card-meta">
                            <span>
                                <i class="fas fa-calendar-alt"></i>
                                {{ $featuredBlog->created_at->format('F d, Y') }}
                            </span>

                            @if($featuredBlog->author)
                                <span>
                                    <i class="fas fa-user"></i>
                                    By {{ $featuredBlog->author }}
                                </span>
                            @endif

                            <span>
                                <i class="fas fa-clock"></i>
                                {{ $featuredBlog->read_time }} min read
                            </span>
                        </div>

                        <h5 class="card-title">
                            {{ $featuredBlog->title }}
                        </h5>

                        <p class="card-text">
                            {{ $featuredBlog->short_description }}
                        </p>

                        <span class="btn-read">
                            Read Full Article
                            <i class="fas fa-arrow-right ms-2"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
@endif


<!-- ===== SECTION 3: LATEST ARTICLES ===== -->
<section class="container mb-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="section-title">Latest <span>Articles</span></h2>
            <p class="section-subtitle">Fresh reads to inspire your shopping and lifestyle choices.</p>
        </div>
    </div>

    <div class="row g-4">
        @forelse($blogs as $blog)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('blog.details', $blog->slug) }}" class="text-decoration-none text-dark d-block h-100">
                    <div class="blog-card card h-100">
                        @if($blog->image)
                            <img src="{{ asset('uploads/blogs/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                        @endif

                        <div class="card-body">
                          

                            <div class="card-meta">
                                <span>
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $blog->created_at->format('M d') }}
                                </span>

                                @if($blog->author)
                                    <span>
                                        <i class="fas fa-user"></i>
                                        {{ $blog->author }}
                                    </span>
                                @endif

                                <span>
                                    <i class="fas fa-clock"></i>
                                    {{ $blog->read_time }} min
                                </span>
                            </div>

                            <h6 class="card-title">
                                {{ $blog->title }}
                            </h6>

                            <p class="card-text">
                                {{ \Illuminate\Support\Str::limit($blog->short_description, 120) }}
                            </p>

                            <span class="btn-read-sm">
                                Read More
                                <i class="fas fa-arrow-right ms-1"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <h4>No Articles Found</h4>
                    <p class="text-muted mb-0">New articles will be available soon.</p>
                </div>
            </div>
        @endforelse
    </div>

    @if($blogs->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $blogs->links() }}
        </div>
    @endif
</section>

<!-- ===== SECTION 4: BLOG CATEGORIES ===== -->
<!-- <section class="container mb-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="section-title">Blog <span>Categories</span></h2>
            <p class="section-subtitle">Explore topics that matter to you.</p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-6 col-md-4 col-lg-2">
            <a href="#" class="category-card">
                <i class="fas fa-shopping-bag"></i>
                <h6>Shopping Tips</h6>
                <small>12 articles</small>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="#" class="category-card">
                <i class="fas fa-tshirt"></i>
                <h6>Fashion</h6>
                <small>8 articles</small>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="#" class="category-card">
                <i class="fas fa-microchip"></i>
                <h6>Technology</h6>
                <small>6 articles</small>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="#" class="category-card">
                <i class="fas fa-heart"></i>
                <h6>Lifestyle</h6>
                <small>11 articles</small>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="#" class="category-card">
                <i class="fas fa-leaf"></i>
                <h6>Eco Living</h6>
                <small>14 articles</small>
            </a>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <a href="#" class="category-card">
                <i class="fas fa-couch"></i>
                <h6>Home Decor</h6>
                <small>9 articles</small>
            </a>
        </div>
    </div>
</section> -->

<!-- ===== SECTION 5: POPULAR TAGS ===== -->
<!-- <section class="container mb-5">
    <div class="row mb-3">
        <div class="col-12">
            <h5 class="fw-bold" style="color:#1a1a2e;">Popular Tags</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="#" class="tag-item">#Fashion</a>
            <a href="#" class="tag-item">#Shopping</a>
            <a href="#" class="tag-item">#Lifestyle</a>
            <a href="#" class="tag-item">#Eco</a>
            <a href="#" class="tag-item">#Organic</a>
            <a href="#" class="tag-item">#Technology</a>
            <a href="#" class="tag-item">#Home</a>
            <a href="#" class="tag-item">#Accessories</a>
            <a href="#" class="tag-item">#Decor</a>
        </div>
    </div>
</section> -->

<!-- ===== SECTION 6: WHY READ OUR BLOG ===== -->
<!-- <section class="container mb-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="section-title">Why Read <span>Our Blog</span></h2>
            <p class="section-subtitle">We deliver content that enriches your shopping journey and daily life.</p>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-3 col-6">
            <div class="why-card">
                <i class="fas fa-user-tie"></i>
                <h6>Expert Advice</h6>
                <p>Curated by industry professionals.</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="why-card">
                <i class="fas fa-shopping-cart"></i>
                <h6>Buying Guides</h6>
                <p>Make informed purchase decisions.</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="why-card">
                <i class="fas fa-chart-line"></i>
                <h6>Latest Trends</h6>
                <p>Stay ahead with fresh insights.</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="why-card">
                <i class="fas fa-shield-alt"></i>
                <h6>Trusted Information</h6>
                <p>Reliable, transparent content.</p>
            </div>
        </div>
    </div>
</section> -->

<!-- ===== SECTION 7: LATEST UPDATES BANNER ===== -->
<section class="container mb-5">
    <div class="updates-banner">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2>Stay <span>Updated</span> with Our Latest Posts</h2>
                <p>Get the newest articles, product launches, and eco-friendly tips delivered straight to your feed.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="#" class="btn-gold">Explore Now <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section>



<!-- ===== SECTION 9: PAGINATION ===== -->
<section class="container mb-5">
    <nav aria-label="Blog pagination">
        <ul class="pagination pagination-custom justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</section>

@endsection