@extends('layouts.admin')

@section('content')

<!-- Dashboard Content -->
<div class="container-fluid p-3 p-lg-4">

    <!-- Welcome -->
    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            Welcome Back, {{ auth()->user()->name ?? 'Admin' }}
        </h4>

        <p class="text-secondary mb-0">
            Manage your Rv-Store Store efficiently.
        </p>
    </div>


    <!-- =====================================================
     STAT CARDS
====================================================== -->
<div class="row g-4 mb-4">

    <!-- Categories -->
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="stat-card gradient-1">
            <div class="stat-icon">
                <i class="bi bi-grid"></i>
            </div>

            <div class="stat-number">
                {{ $totalCategories }}
            </div>

            <div class="stat-label">
                Total Categories
            </div>
        </div>
    </div>


    <!-- Products -->
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="stat-card gradient-2">
            <div class="stat-icon">
                <i class="bi bi-box-seam"></i>
            </div>

            <div class="stat-number">
                {{ $totalProducts }}
            </div>

            <div class="stat-label">
                Total Products
            </div>
        </div>
    </div>


    <!-- Blogs -->
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="stat-card gradient-3">
            <div class="stat-icon">
                <i class="bi bi-newspaper"></i>
            </div>

            <div class="stat-number">
                {{ $totalBlogs }}
            </div>

            <div class="stat-label">
                Total Blogs
            </div>
        </div>
    </div>


    <!-- Messages -->
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="stat-card gradient-4">
            <div class="stat-icon">
                <i class="bi bi-envelope"></i>
            </div>

            <div class="stat-number">
                {{ $totalMessages }}
            </div>

            <div class="stat-label">
                Contact Messages
            </div>
        </div>
    </div>


    <!-- Banners -->
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="stat-card gradient-5">
            <div class="stat-icon">
                <i class="bi bi-image"></i>
            </div>

            <div class="stat-number">
                {{ $totalBanners }}
            </div>

            <div class="stat-label">
                Total Banners
            </div>
        </div>
    </div>


    <!-- Hero Sliders -->
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="stat-card gradient-6">
            <div class="stat-icon">
                <i class="bi bi-images"></i>
            </div>

            <div class="stat-number">
                {{ $totalHeroSliders }}
            </div>

            <div class="stat-label">
                Hero Sliders
            </div>
        </div>
    </div>


    <!-- Brands -->
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="stat-card gradient-7">
            <div class="stat-icon">
                <i class="bi bi-tags"></i>
            </div>

            <div class="stat-number">
                {{ $totalBrands }}
            </div>

            <div class="stat-label">
                Total Brands
            </div>
        </div>
    </div>


    <!-- Brand Sliders -->
    <!-- <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="stat-card gradient-8">
            <div class="stat-icon">
                <i class="bi bi-badge-ad"></i>
            </div>

            <div class="stat-number">
                {{ $totalBrandSliders }}
            </div>

            <div class="stat-label">
                Brand Sliders
            </div>
        </div>
    </div> -->


    <!-- Instagram -->
    <!-- <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="stat-card gradient-9">
            <div class="stat-icon">
                <i class="bi bi-instagram"></i>
            </div>

            <div class="stat-number">
                {{ $totalInstagram }}
            </div>

            <div class="stat-label">
                Instagram Posts
            </div>
        </div>
    </div> -->


    <!-- Testimonials -->
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="stat-card gradient-10">
            <div class="stat-icon">
                <i class="bi bi-chat-quote"></i>
            </div>

            <div class="stat-number">
                {{ $totalTestimonials }}
            </div>

            <div class="stat-label">
                Testimonials
            </div>
        </div>
    </div>

</div>


    <!-- =====================================================
         QUICK ACTIONS
    ====================================================== -->
    <div class="mb-4">

        <h6 class="fw-semibold mb-3">
            Quick Actions
        </h6>

        <div class="d-flex flex-wrap gap-2">

            <a href="{{ route('admin.categories.create') }}"
               class="quick-action-btn">

                <i class="bi bi-plus-circle"></i>
                Add Category

            </a>


            <a href="{{ route('admin.products.create') }}"
               class="quick-action-btn">

                <i class="bi bi-plus-circle"></i>
                Add Product

            </a>


            <a href="{{ route('admin.hero-sliders.create') }}"
               class="quick-action-btn">

                <i class="bi bi-plus-circle"></i>
                Add Slider

            </a>


            <a href="{{ route('admin.blogs.create') }}"
               class="quick-action-btn">

                <i class="bi bi-pencil-square"></i>
                Write Blog

            </a>

        </div>

    </div>



    <!-- =====================================================
         RECENT PRODUCTS
    ====================================================== -->
    <div class="card card-custom mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <span>
                Recent Products
            </span>

            <a href="{{ route('admin.products.index') }}"
               class="text-decoration-none text-success fw-semibold small">

                View All

            </a>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Image</th>

                            <th>
                                Product Name
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Price
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-end">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($recentProducts as $product)

                        <tr>

                            <!-- PRODUCT IMAGE -->
                            <td>

                                @php
                                    $productImage = $product->images->first();
                                @endphp

                                @if($productImage)

                                    <img
                                        src="{{ asset('uploads/products/' . $productImage->image) }}"
                                        alt="{{ $product->name }}"
                                        width="45"
                                        height="45"
                                        class="rounded"
                                        style="object-fit: cover;"
                                    >

                                @else

                                    <div
                                        class="rounded bg-light d-flex align-items-center justify-content-center text-muted"
                                        style="width:45px;height:45px;"
                                    >

                                        <i class="bi bi-image"></i>

                                    </div>

                                @endif

                            </td>


                            <!-- PRODUCT NAME -->
                            <td class="fw-semibold">

                                {{ $product->name }}

                            </td>


                            <!-- CATEGORY -->
                            <td>

                                {{ $product->category?->name ?? 'No Category' }}

                            </td>


                            <!-- PRICE -->
                            <td>

                                @if($product->sale_price)

                                    <span class="fw-semibold text-success">
                                        ₹{{ number_format($product->sale_price, 2) }}
                                    </span>

                                    <small class="text-muted text-decoration-line-through ms-1">
                                        ₹{{ number_format($product->price, 2) }}
                                    </small>

                                @else

                                    <span class="fw-semibold">
                                        ₹{{ number_format($product->price, 2) }}
                                    </span>

                                @endif

                            </td>


                            <!-- STOCK STATUS -->
                            <td>

                                @if($product->stock > 0)

                                    <span class="badge bg-success">

                                        <i class="bi bi-check-circle me-1"></i>
                                        In Stock

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        <i class="bi bi-x-circle me-1"></i>
                                        Out of Stock

                                    </span>

                                @endif

                            </td>


                            <!-- ACTIONS -->
                            <td class="text-end">

                                <a
                                    href="{{ route('admin.products.edit', $product->id) }}"
                                    class="table-action-btn edit"
                                    title="Edit Product"
                                >

                                    <i class="bi bi-pencil"></i>

                                </a>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-5 text-muted">

                                <i class="bi bi-box-seam fs-2 d-block mb-2"></i>

                                No products found.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =====================================================
         RECENT CONTACT MESSAGES
    ====================================================== -->
    <div class="card card-custom mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <span>
                Recent Contact Messages
            </span>

            <a
                href="{{ route('admin.contact-messages.index') }}"
                class="text-decoration-none text-success fw-semibold small"
            >

                View All

            </a>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Subject
                            </th>

                            <th>
                                Date
                            </th>

                            <th class="text-end">
                                Status
                            </th>

                            <th class="text-end">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($recentMessages as $message)

                        <tr class="{{ !$message->is_read ? 'fw-semibold' : '' }}">

                            <!-- NAME -->
                            <td>

                                {{ $message->first_name }}
                                {{ $message->last_name }}

                            </td>


                            <!-- EMAIL -->
                            <td>

                                {{ $message->email }}

                            </td>


                            <!-- SUBJECT -->
                            <td>

                                {{ $message->subject ?: 'No Subject' }}

                            </td>


                            <!-- DATE -->
                            <td>

                                {{ $message->created_at->format('d M Y') }}

                            </td>


                            <!-- STATUS -->
                            <td class="text-end">

                                @if($message->is_read)

                                    <span class="badge bg-secondary">

                                        <i class="bi bi-check-circle me-1"></i>
                                        Read

                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">

                                        <i class="bi bi-envelope-fill me-1"></i>
                                        New

                                    </span>

                                @endif

                            </td>


                            <!-- VIEW -->
                            <td class="text-end">

                                <a
                                    href="{{ route('admin.contact-messages.show', $message->id) }}"
                                    class="table-action-btn edit"
                                    title="View Message"
                                >

                                    <i class="bi bi-eye"></i>

                                </a>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-5 text-muted">

                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>

                                No contact messages found.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =====================================================
         RECENT PRODUCT QUERIES
    ====================================================== -->
    <div class="card card-custom mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <span>
                Recent Product Queries
            </span>

            <a href="{{ route('admin.product-queries.index') }}"
               class="text-decoration-none text-success fw-semibold small">
                View All
            </a>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Product</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th class="text-end">Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($recentProductQueries as $query)

                            <tr class="{{ !$query->is_read ? 'fw-semibold' : '' }}">

                                <!-- NAME -->
                                <td>
                                    {{ $query->name }}
                                </td>


                                <!-- PHONE -->
                                <td>
                                    {{ $query->phone ?: 'Not Provided' }}
                                </td>


                                <!-- PRODUCT -->
                                <td>
                                    {{ $query->product?->name ?? 'Product Not Available' }}
                                </td>


                                <!-- MESSAGE -->
                                <td>
                                    {{ \Illuminate\Support\Str::limit($query->message, 50) }}
                                </td>


                                <!-- DATE -->
                                <td>
                                    {{ $query->created_at->format('d M Y') }}
                                </td>


                                <!-- STATUS -->
                                <td class="text-end">

                                    @if($query->is_read)

                                        <span class="badge bg-secondary">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Read
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-chat-left-text-fill me-1"></i>
                                            New
                                        </span>

                                    @endif

                                </td>


                                <!-- ACTION -->
                                <td class="text-end">

                                    <a href="{{ route('admin.product-queries.show', $query->id) }}"
                                       class="table-action-btn edit"
                                       title="View Query">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7"
                                    class="text-center py-5 text-muted">

                                    <i class="bi bi-chat-left-text fs-2 d-block mb-2"></i>

                                    No product queries found.

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =====================================================
         RECENT CATEGORIES
    ====================================================== -->
    <div class="card card-custom mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <span>
                Recent Categories
            </span>

            <a href="{{ route('admin.categories.index') }}"
               class="text-decoration-none text-success fw-semibold small">
                View All
            </a>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Created Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($recentCategories as $category)

                            <tr>
                                <td>{{ $category->id }}</td>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td>{{ $category->created_at->format('d M Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="table-action-btn edit"
                                       title="Edit Category">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4"
                                    class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No categories found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =====================================================
         RECENT BLOGS
    ====================================================== -->
    <div class="card card-custom mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <span>
                Recent Blogs
            </span>

            <a href="{{ route('admin.blogs.index') }}"
               class="text-decoration-none text-success fw-semibold small">
                View All
            </a>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Created Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($recentBlogs as $blog)

                            <tr>
                                <td class="fw-semibold">{{ $blog->title }}</td>
                                <td>{{ $blog->category?->name ?? 'No Category' }}</td>
                                <td>{{ $blog->created_at->format('d M Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                       class="table-action-btn edit"
                                       title="Edit Blog">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4"
                                    class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No blogs found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =====================================================
         RECENT BANNERS
    ====================================================== -->
    <div class="card card-custom mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <span>
                Recent Banners
            </span>

            <a href="{{ route('admin.banners.index') }}"
               class="text-decoration-none text-success fw-semibold small">
                View All
            </a>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Created Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($recentBanners as $banner)

                            <tr>
                                <td>
                                    @if($banner->image)
                                        <img src="{{ asset('uploads/banners/' . $banner->image) }}"
                                             alt="{{ $banner->title }}"
                                             width="45" height="45" class="rounded"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted"
                                             style="width:45px;height:45px;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $banner->title ?? 'N/A' }}</td>
                                <td>{{ $banner->created_at->format('d M Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                       class="table-action-btn edit"
                                       title="Edit Banner">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4"
                                    class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No banners found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =====================================================
         RECENT HERO SLIDERS
    ====================================================== -->
    <div class="card card-custom mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <span>
                Recent Hero Sliders
            </span>

            <a href="{{ route('admin.hero-sliders.index') }}"
               class="text-decoration-none text-success fw-semibold small">
                View All
            </a>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Heading</th>
                            <th>Created Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($recentHeroSliders as $slider)

                            <tr>
                                <td>
                                    @if($slider->image)
                                        <img src="{{ asset('uploads/hero-sliders/' . $slider->image) }}"
                                             alt="{{ $slider->heading }}"
                                             width="45" height="45" class="rounded"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted"
                                             style="width:45px;height:45px;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $slider->heading ?? 'N/A' }}</td>
                                <td>{{ $slider->created_at->format('d M Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.hero-sliders.edit', $slider->id) }}"
                                       class="table-action-btn edit"
                                       title="Edit Slider">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4"
                                    class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No hero sliders found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =====================================================
         RECENT BRANDS
    ====================================================== -->
    <div class="card card-custom mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <span>
                Recent Brands
            </span>

            <a href="{{ route('admin.brands.index') }}"
               class="text-decoration-none text-success fw-semibold small">
                View All
            </a>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Logo</th>
                            <th>Brand Name</th>
                            <th>Created Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($recentBrands as $brand)

                            <tr>
                                <td>
                                    @if($brand->logo)
                                        <img src="{{ asset('uploads/brands/' . $brand->logo) }}"
                                             alt="{{ $brand->name }}"
                                             width="45" height="45" class="rounded"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted"
                                             style="width:45px;height:45px;">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $brand->name }}</td>
                                <td>{{ $brand->created_at->format('d M Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                       class="table-action-btn edit"
                                       title="Edit Brand">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4"
                                    class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No brands found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <!-- =====================================================
         RECENT TESTIMONIALS
    ====================================================== -->
    <div class="card card-custom mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <span>
                Recent Testimonials
            </span>

            <a href="{{ route('admin.testimonials.index') }}"
               class="text-decoration-none text-success fw-semibold small">
                View All
            </a>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Created Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($recentTestimonials as $testimonial)

                            <tr>
                                <td>
                                    @if($testimonial->image)
                                        <img src="{{ asset('uploads/testimonials/' . $testimonial->image) }}"
                                             alt="{{ $testimonial->name }}"
                                             width="45" height="45" class="rounded-circle"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-muted"
                                             style="width:45px;height:45px;">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $testimonial->name }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($testimonial->review, 50) }}</td>
                                <td>
                                    @if(isset($testimonial->rating))
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $testimonial->rating)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @else
                                                <i class="bi bi-star text-secondary"></i>
                                            @endif
                                        @endfor
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $testimonial->created_at->format('d M Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                       class="table-action-btn edit"
                                       title="Edit Testimonial">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No testimonials found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
<!-- /container-fluid -->

@endsection