@extends('layouts.app')
@section('title', 'Product-Details | RvStore')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/product-details.css') }}">

<div class="product-details-page">

    <!-- =====================================================
         BREADCRUMB
    ===================================================== -->
    <section class="py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-transparent p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('shop') }}" class="text-decoration-none">Shop</a>
                    </li>
                    @if($product->category)
                        <li class="breadcrumb-item">
                            {{ $product->category->name }}
                        </li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $product->name }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>


    <!-- =====================================================
         PRODUCT DETAILS MAIN
    ===================================================== -->
    <section class="product-details-section py-5">
        <div class="container">

            <div class="row g-5">

                <!-- LEFT: PRODUCT IMAGES -->
                <div class="col-lg-6">
                    @php
                        $mainImage = $product->images->first();
                    @endphp

                    <div class="product-main-image mb-3">
                        @if($mainImage)
                            <img
                                id="mainProductImage"
                                src="{{ asset('uploads/products/' . $mainImage->image) }}"
                                alt="{{ $product->name }}"
                                class="img-fluid w-100"
                            >
                        @else
                            <div class="text-center py-5 bg-light">No Image Available</div>
                        @endif
                    </div>

                    @if($product->images->count() > 1)
                        <div class="thumbnail-gallery d-flex flex-wrap gap-2">
                            @foreach($product->images as $image)
                                <div class="thumbnail-item @if($loop->first) active @endif">
                                    <img
                                        src="{{ asset('uploads/products/' . $image->image) }}"
                                        alt="{{ $product->name }}"
                                        class="product-thumbnail"
                                        onclick="changeProductImage(this.src)"
                                    >
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- RIGHT: PRODUCT INFORMATION -->
                <div class="col-lg-6">

                    <!-- Category -->
                    @if($product->category)
                        <div class="product-category mb-2">
                            {{ $product->category->name }}
                        </div>
                    @endif

                    <!-- Title -->
                    <h1 class="product-title">{{ $product->name }}</h1>

                    <!-- SKU -->
                    @if($product->sku)
                        <div class="product-sku text-muted mb-3">
                            SKU: <strong>{{ $product->sku }}</strong>
                        </div>
                    @endif

                    <!-- Rating (static for now) -->
                    <div class="product-rating mb-3">
                        <span class="stars">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-half text-warning"></i>
                        </span>
                        <span class="rating-text">4.8 (24 Reviews)</span>
                        {{-- Note: Rating is static; can be made dynamic later --}}
                    </div>

                    <!-- Price -->
                    <div class="product-price mb-4">
                        @if($product->sale_price)
                            <span class="sale-price">₹{{ number_format($product->sale_price, 2) }}</span>
                            <span class="old-price">₹{{ number_format($product->price, 2) }}</span>
                            @php
                                $discount = $product->price > 0 ? round((($product->price - $product->sale_price) / $product->price) * 100) : 0;
                            @endphp
                            @if($discount > 0)
                                <span class="discount-badge">{{ $discount }}% OFF</span>
                            @endif
                        @else
                            <span class="sale-price">₹{{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>

                    <!-- Stock -->
                    <div class="product-stock mb-4">
                        @if($product->stock > 0)
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> In Stock</span>
                            <small class="text-muted ms-2">{{ $product->stock }} available</small>
                        @else
                            <span class="badge bg-danger">Out of Stock</span>
                        @endif
                    </div>

                    <!-- Short Description -->
                    @if($product->short_description)
                        <p class="product-short-description">{{ $product->short_description }}</p>
                    @endif

                    <!-- Colors -->
                    @if($product->colors->count())
                        <div class="product-option mb-4">
                            <h6 class="fw-bold">Available Colors</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($product->colors as $color)
                                    <span class="color-swatch" data-color="{{ $color->name }}" style="background-color: {{ strtolower($color->name) }}; color: #fff;">
                                        {{ $color->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Sizes -->
                    @if($product->sizes->count())
                        <div class="product-option mb-4">
                            <h6 class="fw-bold">Available Sizes</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($product->sizes as $size)
                                    <span class="size-option" data-size="{{ $size->name }}">{{ $size->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Material -->
                    @if($product->materials->count())
                        <div class="product-option mb-4">
                            <h6 class="fw-bold">Material</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($product->materials as $material)
                                    <span class="material-badge">{{ $material->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Tags -->
                    @if($product->tags->count())
                        <div class="product-tags mt-3 mb-4">
                            <strong>Tags:</strong>
                            @foreach($product->tags as $tag)
                                <span class="tag-badge">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif

                    <!-- ACTION BUTTONS -->
                    <div class="product-actions d-flex flex-wrap gap-3 mt-4">
                        <!-- Product Query Button -->
                        <button type="button" class="btn btn-primary flex-fill" data-bs-toggle="modal" data-bs-target="#productQueryModal">
                            <i class="bi bi-chat-dots me-2"></i> Product Query
                        </button>

                        <!-- WhatsApp Inquiry Button -->
                        @if($product->stock > 0)
                            @php
                                $whatsappMessage = 'Hello, I am interested in this product.' . "\n\n" .
                                    'Product: ' . $product->name . "\n" .
                                    'Price: ₹' . ($product->sale_price ?? $product->price) . "\n" .
                                    'SKU: ' . ($product->sku ?? 'N/A') . "\n" .
                                    'Product Link: ' . url()->current() . "\n\n" .
                                    'Please share more details.';
                            @endphp
                            <a href="https://wa.me/917827583414?text={{ urlencode($whatsappMessage) }}"
                               target="_blank"
                               class="btn btn-success flex-fill">
                                <i class="bi bi-whatsapp me-2"></i> Enquire on WhatsApp
                            </a>
                        @endif
                    </div>

                    <!-- Trust Section -->
                    <div class="trust-section mt-4 pt-3 border-top">
                        <div class="row g-2 text-center">
                            <div class="col-4">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span class="d-block small fw-semibold">Premium Quality</span>
                            </div>
                            <div class="col-4">
                                <i class="bi bi-clock-fill text-warning"></i>
                                <span class="d-block small fw-semibold">Quick Response</span>
                            </div>
                            <div class="col-4">
                                <i class="bi bi-headset"></i>
                                <span class="d-block small fw-semibold">Customer Support</span>
                            </div>
                        </div>
                    </div>

                </div> <!-- end right column -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>


    <!-- =====================================================
         PRODUCT DESCRIPTION (replacing tabs)
    ===================================================== -->
    <section class="product-description-block py-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-heading d-flex align-items-center gap-2">
                        <i class="bi bi-file-text text-primary" style="color: #198754 !important;"></i>
                        Product Description
                    </h3>
                    @if($product->description)
                        <div class="description-content mt-3">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    @else
                        <p class="text-muted mt-2">No description available.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================
         PRODUCT INFORMATION
    ===================================================== -->
    <section class="product-information-block py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-heading d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle text-primary" style="color: #198754 !important;"></i>
                        Product Information
                    </h3>
                    <div class="product-info-table mt-3">
                        <table class="table table-borderless">
                            <tbody>
                                <tr><th style="width:30%;">SKU</th><td>{{ $product->sku ?? 'N/A' }}</td></tr>
                                <tr><th>Category</th><td>{{ $product->category->name ?? 'N/A' }}</td></tr>
                                <tr><th>Stock</th><td>{{ $product->stock ?? 0 }} units</td></tr>
                                @if($product->colors->count())
                                    <tr><th>Colors</th><td>{{ $product->colors->pluck('name')->implode(', ') }}</td></tr>
                                @endif
                                @if($product->sizes->count())
                                    <tr><th>Sizes</th><td>{{ $product->sizes->pluck('name')->implode(', ') }}</td></tr>
                                @endif
                                @if($product->materials->count())
                                    <tr><th>Materials</th><td>{{ $product->materials->pluck('name')->implode(', ') }}</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================
         SHIPPING & SUPPORT
    ===================================================== -->
    <section class="shipping-support-block py-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-heading d-flex align-items-center gap-2">
                        <i class="bi bi-truck text-primary" style="color: #198754 !important;"></i>
                        Shipping &amp; Support
                    </h3>
                    <div class="shipping-features mt-3 row g-4">
                        <div class="col-md-4">
                            <div class="shipping-item d-flex align-items-start gap-3">
                                <i class="bi bi-clock-history fs-2 text-success"></i>
                                <div>
                                    <h6 class="fw-bold">Fast Dispatch</h6>
                                    <p class="small text-muted">Orders dispatched within 24 hours</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="shipping-item d-flex align-items-start gap-3">
                                <i class="bi bi-truck fs-2 text-success"></i>
                                <div>
                                    <h6 class="fw-bold">Delivery</h6>
                                    <p class="small text-muted">Estimated delivery 3–5 business days</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="shipping-item d-flex align-items-start gap-3">
                                <i class="bi bi-headset fs-2 text-success"></i>
                                <div>
                                    <h6 class="fw-bold">Customer Support</h6>
                                    <p class="small text-muted">Support available Monday–Friday</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Additional static shipping info (if any) -->
                    <div class="shipping-details mt-3 p-3 bg-light rounded-3">
                        <p class="mb-1">We offer free standard shipping on all orders. Express shipping available at checkout.</p>
                        <p class="mb-0">For international orders, delivery may take 7-14 business days. Customs duties may apply.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- =====================================================
         RELATED PRODUCTS (optional)
    ===================================================== -->
    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
    <section class="related-products-section py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-4">
                <span class="section-tag text-uppercase small fw-semibold text-muted">You May Also Like</span>
                <h2 class="section-heading fs-3 fw-bold">Related <span class="text-primary">Products</span></h2>
            </div>

            <div class="row g-4">
                @foreach($relatedProducts as $related)
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="related-product-card h-100 border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                            <div class="position-relative">
                                <img src="{{ asset('uploads/products/' . ($related->images->first()->image ?? '')) }}" alt="{{ $related->name }}" class="img-fluid w-100" style="height: 200px; object-fit: cover;">
                                @if($related->sale_price)
                                    <span class="badge bg-danger position-absolute top-0 end-0 m-2">Sale</span>
                                @endif
                            </div>
                            <div class="p-3">
                                <span class="small text-muted text-uppercase">{{ $related->category->name ?? '' }}</span>
                                <h5 class="card-title fw-bold mt-1 fs-6">{{ $related->name }}</h5>
                                <div class="d-flex align-items-center gap-2">
                                    @if($related->sale_price)
                                        <span class="fw-bold text-primary">₹{{ number_format($related->sale_price, 2) }}</span>
                                        <span class="text-muted text-decoration-line-through small">₹{{ number_format($related->price, 2) }}</span>
                                    @else
                                        <span class="fw-bold text-primary">₹{{ number_format($related->price, 2) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('product.details', $related->slug ?? $related->id) }}" class="btn btn-outline-primary btn-sm mt-2 w-100 rounded-pill">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif


    <!-- =====================================================
         PRODUCT QUERY MODAL
    ===================================================== -->
    <div class="modal fade" id="productQueryModal" tabindex="-1" aria-labelledby="productQueryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="productQueryModalLabel">
                        <i class="bi bi-envelope-paper me-2 text-primary"></i>Product Inquiry
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <p class="text-muted small">Have a question about this product? Send us your details and we'll get back to you.</p>

                    <!-- Product Preview -->
                    <div class="product-preview d-flex align-items-center gap-3 p-3 bg-light rounded-3 mb-4">
                        @php $previewImage = $product->images->first(); @endphp
                        @if($previewImage)
                            <img src="{{ asset('uploads/products/' . $previewImage->image) }}" alt="{{ $product->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                        @else
                            <div style="width: 60px; height: 60px; background: #e9ecef; border-radius: 8px;"></div>
                        @endif
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $product->name }}</h6>
                            <span class="text-primary fw-semibold">₹{{ number_format($product->sale_price ?? $product->price, 2) }}</span>
                        </div>
                    </div>

                    <!-- Inquiry Form (frontend only) -->
                    <form id="productInquiryForm"
      action="{{ route('product.query.store') }}"
      method="POST">

    @csrf
                        @csrf <!-- keep CSRF for future use -->
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="inquiry_name" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inquiry_name" name="name" required placeholder="Your full name">
                            </div>
                            <div class="col-md-6">
                                <label for="inquiry_phone" class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="inquiry_phone" name="phone" required placeholder="Your phone number">
                            </div>
                            <div class="col-12">
                                <label for="inquiry_email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control" id="inquiry_email" name="email" placeholder="your@email.com">
                            </div>
                            <div class="col-12">
                                <label for="inquiry_subject" class="form-label fw-semibold">Subject</label>
                                <input type="text" class="form-control" id="inquiry_subject" name="subject" value="Question about {{ $product->name }}">
                            </div>
                            <div class="col-12">
                                <label for="inquiry_message" class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="inquiry_message" name="message" rows="3" required placeholder="I would like to know more about this product..."></textarea>
                            </div>
                        </div>

                        <div class="modal-footer border-0 px-0 pt-4">
                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-5" id="sendInquiryBtn">
                                <i class="bi bi-send me-2"></i>Send Inquiry
                            </button>
                        </div>
                    </form>
                    {{-- Product inquiry backend will be connected later --}}
                </div>
            </div>
        </div>
    </div>

</div> <!-- end product-details-page -->


<!-- =====================================================
     PAGE-SPECIFIC STYLES
===================================================== -->
<style>
.product-details-page {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Breadcrumb */
.product-details-page .breadcrumb {
    font-size: 0.95rem;
}
.product-details-page .breadcrumb-item a {
    color: #6c757d;
    transition: color 0.2s;
}
.product-details-page .breadcrumb-item a:hover {
    color: #198754;
}
.product-details-page .breadcrumb-item.active {
    color: #212529;
    font-weight: 500;
}

/* Main Image */
.product-details-page .product-main-image {
    background: #f8f9fa;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid #e9ecef;
    transition: box-shadow 0.3s;
}
.product-details-page .product-main-image img {
    width: 100%;
    height: 520px;
    object-fit: contain;
    padding: 20px;
}

/* Thumbnail Gallery */
.product-details-page .thumbnail-gallery {
    gap: 12px;
}
.product-details-page .thumbnail-item {
    border: 2px solid transparent;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: border-color 0.2s, transform 0.2s;
}
.product-details-page .thumbnail-item.active {
    border-color: #198754;
    box-shadow: 0 0 0 2px rgba(25, 135, 84, 0.2);
}
.product-details-page .thumbnail-item:hover {
    transform: translateY(-2px);
}
.product-details-page .product-thumbnail {
    width: 80px;
    height: 80px;
    object-fit: cover;
    display: block;
}

/* Product Info */
.product-details-page .product-category {
    color: #198754;
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.product-details-page .product-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 0.25rem;
}
.product-details-page .product-sku {
    font-size: 0.9rem;
}
.product-details-page .product-rating .stars {
    font-size: 1.1rem;
    letter-spacing: 2px;
}
.product-details-page .product-rating .rating-text {
    font-size: 0.9rem;
    color: #6c757d;
    margin-left: 0.5rem;
}
.product-details-page .product-price {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}
.product-details-page .sale-price {
    font-size: 2rem;
    font-weight: 700;
    color: #198754;
}
.product-details-page .old-price {
    color: #adb5bd;
    font-size: 1.2rem;
    text-decoration: line-through;
}
.product-details-page .discount-badge {
    background: #fff3cd;
    color: #856404;
    padding: 4px 12px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 700;
}
.product-details-page .product-stock .badge {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}
.product-details-page .product-short-description {
    color: #6b7280;
    line-height: 1.8;
    font-size: 1rem;
}

/* Options */
.product-details-page .product-option h6 {
    font-size: 0.95rem;
    color: #2c3e50;
}
.product-details-page .color-swatch {
    display: inline-block;
    padding: 6px 16px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 600;
    border: 2px solid #dee2e6;
    cursor: pointer;
    transition: all 0.2s;
    background: #f8f9fa;
    color: #212529;
}
.product-details-page .color-swatch:hover {
    transform: translateY(-2px);
    border-color: #198754;
}
.product-details-page .color-swatch.active {
    border-color: #198754;
    background: #198754;
    color: #fff;
}
.product-details-page .size-option {
    display: inline-block;
    padding: 6px 18px;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 600;
    border: 2px solid #dee2e6;
    cursor: pointer;
    transition: all 0.2s;
    background: #fff;
    color: #212529;
}
.product-details-page .size-option:hover {
    border-color: #198754;
    transform: translateY(-2px);
}
.product-details-page .size-option.active {
    border-color: #198754;
    background: #198754;
    color: #fff;
}
.product-details-page .material-badge {
    display: inline-block;
    padding: 4px 14px;
    border-radius: 30px;
    background: #e9ecef;
    font-size: 0.85rem;
    font-weight: 500;
    color: #495057;
}
.product-details-page .tag-badge {
    display: inline-block;
    padding: 2px 12px;
    border-radius: 30px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    font-size: 0.8rem;
    margin-right: 4px;
    color: #495057;
}

/* Action Buttons */
.product-details-page .product-actions .btn {
    border-radius: 30px;
    padding: 0.7rem 1.5rem;
    font-weight: 600;
    transition: all 0.2s;
}
.product-details-page .product-actions .btn-primary {
    background: #198754;
    border-color: #198754;
}
.product-details-page .product-actions .btn-primary:hover {
    background: #157347;
    border-color: #157347;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(25, 135, 84, 0.3);
}
.product-details-page .product-actions .btn-success {
    background: #25d366;
    border-color: #25d366;
    color: #fff;
}
.product-details-page .product-actions .btn-success:hover {
    background: #1ebe5c;
    border-color: #1ebe5c;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(37, 211, 102, 0.3);
}

/* Trust Section */
.product-details-page .trust-section i {
    font-size: 1.8rem;
}
.product-details-page .trust-section .col-4 {
    transition: transform 0.2s;
}
.product-details-page .trust-section .col-4:hover {
    transform: translateY(-3px);
}

/* New sections replacing tabs */
.product-details-page .section-heading {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    border-bottom: 2px solid #198754;
    padding-bottom: 0.5rem;
}
.product-details-page .section-heading i {
    font-size: 1.6rem;
}

.product-details-page .product-description-block .description-content {
    color: #4a5568;
    line-height: 1.9;
    font-size: 1rem;
}

.product-details-page .product-info-table table {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.product-details-page .product-info-table table th {
    font-weight: 600;
    color: #2c3e50;
    padding: 0.75rem 0;
}
.product-details-page .product-info-table table td {
    padding: 0.75rem 0;
    color: #4a5568;
}

.product-details-page .shipping-support-block .shipping-item {
    background: #fff;
    padding: 1.2rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    height: 100%;
}
.product-details-page .shipping-support-block .shipping-item i {
    color: #198754;
}
.product-details-page .shipping-support-block .shipping-details {
    border-left: 4px solid #198754;
}

/* Related Products */
.product-details-page .related-product-card {
    transition: transform 0.25s, box-shadow 0.25s;
}
.product-details-page .related-product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.08) !important;
}
.product-details-page .related-product-card .btn-outline-primary {
    border-radius: 30px;
    transition: all 0.2s;
}
.product-details-page .related-product-card .btn-outline-primary:hover {
    background: #198754;
    border-color: #198754;
    color: #fff;
}

/* Modal Enhancements */
.product-details-page .modal-content {
    border: none;
}
.product-details-page .modal-header {
    border-bottom: none;
}
.product-details-page .modal-footer {
    border-top: none;
}
.product-details-page .modal-body .form-control:focus {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.15);
}
.product-details-page .modal-body .btn-primary {
    background: #198754;
    border-color: #198754;
}
.product-details-page .modal-body .btn-primary:hover {
    background: #157347;
    border-color: #157347;
}

/* Responsive */
@media (max-width: 768px) {
    .product-details-page .product-main-image img {
        height: 320px;
    }
    .product-details-page .product-title {
        font-size: 1.6rem;
    }
    .product-details-page .sale-price {
        font-size: 1.6rem;
    }
    .product-details-page .product-thumbnail {
        width: 60px;
        height: 60px;
    }
    .product-details-page .product-actions .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    .product-details-page .trust-section .col-4 {
        font-size: 0.85rem;
    }
    .product-details-page .trust-section i {
        font-size: 1.4rem;
    }
    .product-details-page .section-heading {
        font-size: 1.2rem;
    }
    .product-details-page .shipping-item {
        padding: 0.8rem;
    }
}
@media (max-width: 576px) {
    .product-details-page .product-main-image img {
        height: 260px;
    }
    .product-details-page .product-title {
        font-size: 1.3rem;
    }
    .product-details-page .sale-price {
        font-size: 1.3rem;
    }
    .product-details-page .product-thumbnail {
        width: 50px;
        height: 50px;
    }
    .product-details-page .product-info-table table th,
    .product-details-page .product-info-table table td {
        padding: 0.5rem 0;
        font-size: 0.9rem;
    }
}
</style>


<!-- =====================================================
     PAGE-SPECIFIC JAVASCRIPT
===================================================== -->
<script>
    // Thumbnail click: change main image
    function changeProductImage(src) {
        document.getElementById('mainProductImage').src = src;
        // Update active thumbnail
        document.querySelectorAll('.thumbnail-item').forEach(item => item.classList.remove('active'));
        // Find the clicked thumbnail parent and add active class
        let thumbnails = document.querySelectorAll('.product-thumbnail');
        for (let i = 0; i < thumbnails.length; i++) {
            if (thumbnails[i].src === src) {
                thumbnails[i].closest('.thumbnail-item').classList.add('active');
                break;
            }
        }
    }

    // Color swatch selection
    document.addEventListener('DOMContentLoaded', function() {
        const swatches = document.querySelectorAll('.color-swatch');
        swatches.forEach(sw => {
            sw.addEventListener('click', function() {
                swatches.forEach(s => s.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Size option selection
        const sizes = document.querySelectorAll('.size-option');
        sizes.forEach(sz => {
            sz.addEventListener('click', function() {
                sizes.forEach(s => s.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Product Inquiry Form - prevent actual submission (frontend demo)
        const inquiryForm = document.getElementById('productInquiryForm');
        if (inquiryForm) {
            inquiryForm.addEventListener('submit', function(e) {
                var modal = bootstrap.Modal.getInstance(document.getElementById('productQueryModal'));
                if (modal) modal.hide();
            });
        }
    });
</script>

@endsection