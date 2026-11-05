@extends('layouts.admin')

@section('content')

    @php
        $imageUrl = function ($image, $folder) {

            if (empty($image)) {
                return '';
            }

            // Cloudinary / External image URL
            if (
                str_starts_with($image, 'http://') ||
                str_starts_with($image, 'https://') ||
                str_starts_with($image, '//')
            ) {
                return $image;
            }

            // Local uploaded image
            return asset('uploads/' . $folder . '/' . $image);
        };
    @endphp

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
        <div class="row g-3 g-md-4 mb-4">

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
                <a href="{{ route('admin.categories.create') }}" class="quick-action-btn">
                    <i class="bi bi-plus-circle"></i> Add Category
                </a>
                <a href="{{ route('admin.products.create') }}" class="quick-action-btn">
                    <i class="bi bi-plus-circle"></i> Add Product
                </a>
                <a href="{{ route('admin.hero-sliders.create') }}" class="quick-action-btn">
                    <i class="bi bi-plus-circle"></i> Add Slider
                </a>
                <a href="{{ route('admin.blogs.create') }}" class="quick-action-btn">
                    <i class="bi bi-pencil-square"></i> Write Blog
                </a>
            </div>
        </div>



        <!-- =====================================================
             RECENT PRODUCTS
        ====================================================== -->
        <div class="card card-custom mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Recent Products</span>
                <a href="{{ route('admin.products.index') }}" class="text-decoration-none text-success fw-semibold small">
                    View All
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProducts as $product)
                                <tr>
                                    <td>
                                        @php $productImage = $product->images->first(); @endphp
                                        @if($productImage)
                                            <img src="{{ $imageUrl($productImage->image, 'products') }}" alt="{{ $product->name }}"
                                                width="45" height="45" class="rounded table-img" style="object-fit: cover;">
                                        @else
                                            <div
                                                class="rounded bg-light d-flex align-items-center justify-content-center text-muted table-img">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $product->name }}</td>
                                    <td>{{ $product->category?->name ?? 'No Category' }}</td>
                                    <td>
                                        @if($product->sale_price)
                                            <span
                                                class="fw-semibold text-success">₹{{ number_format($product->sale_price, 2) }}</span>
                                            <small
                                                class="text-muted text-decoration-line-through ms-1">₹{{ number_format($product->price, 2) }}</small>
                                        @else
                                            <span class="fw-semibold">₹{{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->stock > 0)
                                            <span
                                                class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25"><i
                                                    class="bi bi-check-circle me-1"></i> In Stock</span>
                                        @else
                                            <span
                                                class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25"><i
                                                    class="bi bi-x-circle me-1"></i> Out of Stock</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="table-action-btn edit"
                                            title="Edit Product">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-box-seam fs-2 d-block mb-2"></i> No products found.
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
                <span>Recent Contact Messages</span>
                <a href="{{ route('admin.contact-messages.index') }}"
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
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th class="text-end">Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMessages as $message)
                                <tr class="{{ !$message->is_read ? 'fw-semibold' : '' }}">
                                    <td>{{ $message->first_name }} {{ $message->last_name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->subject ?: 'No Subject' }}</td>
                                    <td>{{ $message->created_at->format('d M Y') }}</td>
                                    <td class="text-end">
                                        @if($message->is_read)
                                            <span
                                                class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25"><i
                                                    class="bi bi-check-circle me-1"></i> Read</span>
                                        @else
                                            <span
                                                class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25"><i
                                                    class="bi bi-envelope-fill me-1"></i> New</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.contact-messages.show', $message->id) }}"
                                            class="table-action-btn edit" title="View Message">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i> No contact messages found.
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
                <span>Recent Product Queries</span>
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
                                    <td>{{ $query->name }}</td>
                                    <td>{{ $query->phone ?: 'Not Provided' }}</td>
                                    <td>{{ $query->product?->name ?? 'Product Not Available' }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($query->message, 50) }}</td>
                                    <td>{{ $query->created_at->format('d M Y') }}</td>
                                    <td class="text-end">
                                        @if($query->is_read)
                                            <span
                                                class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25"><i
                                                    class="bi bi-check-circle me-1"></i> Read</span>
                                        @else
                                            <span
                                                class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25"><i
                                                    class="bi bi-chat-left-text-fill me-1"></i> New</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.product-queries.show', $query->id) }}"
                                            class="table-action-btn edit" title="View Query">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-chat-left-text fs-2 d-block mb-2"></i> No product queries found.
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
                <span>Recent Categories</span>
                <a href="{{ route('admin.categories.index') }}" class="text-decoration-none text-success fw-semibold small">
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
                                            class="table-action-btn edit" title="Edit Category">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i> No categories found.
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
                <span>Recent Blogs</span>
                <a href="{{ route('admin.blogs.index') }}" class="text-decoration-none text-success fw-semibold small">
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
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="table-action-btn edit"
                                            title="Edit Blog">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i> No blogs found.
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
                <span>Recent Banners</span>
                <a href="{{ route('admin.banners.index') }}" class="text-decoration-none text-success fw-semibold small">
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
                                            <img src="{{ $imageUrl($banner->image, 'banners') }}" alt="{{ $banner->title }}"
                                                width="45" height="45" class="rounded table-img" style="object-fit: cover;">
                                        @else
                                            <div
                                                class="rounded bg-light d-flex align-items-center justify-content-center text-muted table-img">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $banner->title ?? 'N/A' }}</td>
                                    <td>{{ $banner->created_at->format('d M Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.banners.edit', $banner->id) }}" class="table-action-btn edit"
                                            title="Edit Banner">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i> No banners found.
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
                <span>Recent Hero Sliders</span>
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
                                            <img src="{{ $imageUrl($slider->image, 'hero-sliders') }}" alt="{{ $slider->heading }}"
                                                width="45" height="45" class="rounded table-img" style="object-fit: cover;">
                                        @else
                                            <div
                                                class="rounded bg-light d-flex align-items-center justify-content-center text-muted table-img">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $slider->heading ?? 'N/A' }}</td>
                                    <td>{{ $slider->created_at->format('d M Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.hero-sliders.edit', $slider->id) }}"
                                            class="table-action-btn edit" title="Edit Slider">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i> No hero sliders found.
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
                <span>Recent Brands</span>
                <a href="{{ route('admin.brands.index') }}" class="text-decoration-none text-success fw-semibold small">
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
                                            <img src="{{ $imageUrl($brand->logo, 'brands') }}" alt="{{ $brand->name }}" width="45"
                                                height="45" class="rounded table-img" style="object-fit: cover;">
                                        @else
                                            <div
                                                class="rounded bg-light d-flex align-items-center justify-content-center text-muted table-img">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $brand->name }}</td>
                                    <td>{{ $brand->created_at->format('d M Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="table-action-btn edit"
                                            title="Edit Brand">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i> No brands found.
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
                <span>Recent Testimonials</span>
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
                                            <img src="{{ $imageUrl($testimonial->image, 'testimonials') }}"
                                                alt="{{ $testimonial->name }}" width="45" height="45"
                                                class="rounded-circle table-img" style="object-fit: cover;">
                                        @else
                                            <div
                                                class="rounded-circle bg-light d-flex align-items-center justify-content-center text-muted table-img">
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
                                            class="table-action-btn edit" title="Edit Testimonial">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i> No testimonials found.
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

@push('styles')
    <style>
        /* =========================================
           PREMIUM DASHBOARD STYLES (CSS ONLY)
        ========================================= */

        /* Stat Cards */
        .stat-card {
            border-radius: 18px;
            padding: 1.5rem 1.25rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.02);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }

        .stat-card .stat-icon {
            font-size: 3.5rem;
            opacity: 0.15;
            position: absolute;
            right: 1rem;
            bottom: 0.5rem;
            line-height: 1;
        }

        .stat-card .stat-number {
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1.2;
            color: #1e293b;
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 5px;
        }

        /* Gradients for Stat Cards */
        .gradient-1 {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
        }

        .gradient-2 {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        }

        .gradient-3 {
            background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 100%);
        }

        .gradient-4 {
            background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
        }

        .gradient-5 {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
        }

        .gradient-6 {
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
        }

        .gradient-7 {
            background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%);
        }

        .gradient-10 {
            background: linear-gradient(135deg, #e8eaf6 0%, #c5cae9 100%);
        }

        /* Quick Actions */
        .quick-action-btn {
            border-radius: 12px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #334155;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .quick-action-btn:hover {
            background: #198754;
            color: #fff;
            border-color: #198754;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(25, 135, 84, 0.2);
        }

        .quick-action-btn i {
            font-size: 1.1rem;
        }

        /* Cards */
        .card-custom {
            border: none;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            background: #fff;
            overflow: hidden;
        }

        .card-custom:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        .card-custom .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.5rem;
            font-weight: 700;
            font-size: 1.05rem;
            color: #1e293b;
        }

        /* Tables Premium Styling */
        .table-responsive {
            border-radius: 0 0 16px 16px;
        }

        .table thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem;
            white-space: nowrap;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 0.9rem;
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Image Fix (Prevent Stretching) */
        .table-img {
            width: 45px !important;
            height: 45px !important;
            max-width: 45px !important;
            max-height: 45px !important;
            object-fit: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .rounded-circle.table-img {
            border-radius: 50% !important;
        }

        /* Action Buttons */
        .table-action-btn {
            border: none;
            background: transparent;
            padding: 0.35rem 0.5rem;
            border-radius: 8px;
            transition: all 0.2s;
            color: #94a3b8;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .table-action-btn:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .table-action-btn.edit:hover {
            color: #198754;
            background: #e8f5e9;
        }

        /* Badges */
        .badge {
            font-weight: 600;
            letter-spacing: 0.3px;
            padding: 0.45em 0.8em;
        }

        /* =========================================
           MOBILE RESPONSIVE FIX
        ========================================= */
        @media (max-width: 575.98px) {

            /* 2 Columns for Stat Cards on Mobile */
            .row.g-3>.col-sm-6 {
                flex: 0 0 auto;
                width: 50%;
            }

            .stat-card {
                padding: 1rem;
                border-radius: 14px;
            }

            .stat-card .stat-number {
                font-size: 1.6rem;
            }

            .stat-card .stat-label {
                font-size: 0.7rem;
            }

            .stat-card .stat-icon {
                font-size: 2.5rem;
                right: 0.5rem;
                bottom: 0.5rem;
            }

            .card-custom .card-header {
                padding: 1rem;
                font-size: 0.95rem;
            }

            .table thead th {
                padding: 0.75rem;
                font-size: 0.7rem;
            }

            .table tbody td {
                padding: 0.75rem;
                font-size: 0.85rem;
            }

            .quick-action-btn {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
            }
        }
    </style>
@endpush