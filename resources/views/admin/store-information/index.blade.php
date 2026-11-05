
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4 store-information-page">

    <!-- PAGE HEADER -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-headset me-2 text-primary"></i>
                Customer Assistance Settings
            </h4>
            <p class="text-muted small mb-0">
                Manage product assistance, customer support information and Google Map displayed on the Contact page.
            </p>
        </div>

        @if($store)
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                <i class="bi bi-check-circle-fill me-1"></i> Active
            </span>
        @else
            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                <i class="bi bi-circle me-1"></i> Not Added
            </span>
        @endif
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- VALIDATION ERRORS -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- MAIN FORM -->
    <form action="{{ route('admin.store-information.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <!-- CUSTOMER ASSISTANCE CARD -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                <h5 class="fw-semibold text-dark mb-0">
                    <i class="bi bi-chat-heart me-2 text-primary"></i>
                    Customer Assistance
                </h5>
                <p class="text-muted small mb-0 mt-1">
                    Manage the information customers see when they need help choosing or enquiring about a product.
                </p>
            </div>

            <div class="card-body p-4 p-lg-5">
                <div class="row g-4">

                    <!-- SUPPORT IMAGE -->
                    <div class="col-12">
                        <label for="image" class="form-label fw-semibold">
                            Support Image
                        </label>

                        @if($store?->image)
                            <div class="mb-3">
                                <img
                                    src="{{ \Illuminate\Support\Str::startsWith($store->image, ['http://', 'https://']) ? $store->image : asset('uploads/store/' . $store->image) }}"
                                    alt="Customer Support"
                                    class="img-thumbnail rounded-3 border shadow-sm support-preview"
                                >
                            </div>
                        @endif

                        <input
                            type="file"
                            id="image"
                            name="image"
                            class="form-control rounded-3 @error('image') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <div class="form-text">
                            JPG, JPEG, PNG or WEBP. Maximum size 2MB.
                        </div>

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- HEADING -->
                    <div class="col-12">
                        <label for="heading" class="form-label fw-semibold">
                            Heading
                        </label>

                        <input
                            type="text"
                            id="heading"
                            name="heading"
                            class="form-control form-control-lg rounded-3 @error('heading') is-invalid @enderror"
                            value="{{ old('heading', $store->heading ?? '') }}"
                            placeholder="Need Help Choosing?"
                        >

                        @error('heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            class="form-control rounded-3 @error('description') is-invalid @enderror"
                            rows="4"
                            placeholder="Not sure which product is right for you? Our team is here to help with product details, availability and general queries."
                        >{{ old('description', $store->description ?? '') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- PRODUCT QUERY -->
                    <div class="col-12">
                        <div class="support-field-card">
                            <div class="support-field-icon">
                                <i class="bi bi-chat-dots"></i>
                            </div>

                            <div class="flex-grow-1 min-w-0">
                                <label for="product_query_text" class="form-label fw-semibold">
                                    Product Query Text
                                </label>

                                <input
                                    type="text"
                                    id="product_query_text"
                                    name="product_query_text"
                                    class="form-control rounded-3 @error('product_query_text') is-invalid @enderror"
                                    value="{{ old('product_query_text', $store->product_query_text ?? '') }}"
                                    placeholder="Get help with product details and available options."
                                >

                                <div class="form-text">
                                    This text will appear under Product Queries on the Contact page.
                                </div>

                                @error('product_query_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- PRODUCT AVAILABILITY -->
                    <div class="col-12">
                        <div class="support-field-card">
                            <div class="support-field-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div class="flex-grow-1 min-w-0">
                                <label for="availability_text" class="form-label fw-semibold">
                                    Product Availability Text
                                </label>

                                <input
                                    type="text"
                                    id="availability_text"
                                    name="availability_text"
                                    class="form-control rounded-3 @error('availability_text') is-invalid @enderror"
                                    value="{{ old('availability_text', $store->availability_text ?? '') }}"
                                    placeholder="Ask us about product availability and stock."
                                >

                                <div class="form-text">
                                    Tell customers how they can enquire about product availability.
                                </div>

                                @error('availability_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- WHATSAPP SUPPORT -->
                    <div class="col-12">
                        <div class="support-field-card">
                            <div class="support-field-icon">
                                <i class="bi bi-whatsapp"></i>
                            </div>

                            <div class="flex-grow-1 min-w-0">
                                <label for="whatsapp_text" class="form-label fw-semibold">
                                    WhatsApp Support Text
                                </label>

                                <input
                                    type="text"
                                    id="whatsapp_text"
                                    name="whatsapp_text"
                                    class="form-control rounded-3 @error('whatsapp_text') is-invalid @enderror"
                                    value="{{ old('whatsapp_text', $store->whatsapp_text ?? '') }}"
                                    placeholder="Connect with us directly for quick assistance."
                                >

                                <div class="form-text">
                                    This message will describe your WhatsApp assistance.
                                </div>

                                @error('whatsapp_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SUPPORT CONTACT DETAILS -->
                    <div class="col-12 mt-5">
                        <div class="border-top pt-4">
                            <h6 class="fw-bold text-dark mb-1">
                                <i class="bi bi-headset me-2 text-primary"></i>
                                Support Contact Details
                            </h6>
                            <p class="text-muted small mb-4">
                                Contact details customers can use when they need direct assistance.
                            </p>
                        </div>
                    </div>

                    <!-- SUPPORT EMAIL -->
                    <div class="col-md-6">
                        <label for="support_email" class="form-label fw-semibold">
                            Support Email
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-envelope"></i>
                            </span>

                            <input
                                type="email"
                                id="support_email"
                                name="support_email"
                                class="form-control border-start-0 rounded-end-3 @error('support_email') is-invalid @enderror"
                                value="{{ old('support_email', $store->support_email ?? '') }}"
                                placeholder="support@minieco.com"
                            >

                            @error('support_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- PHONE -->
                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-semibold">
                            Phone Number
                        </label>

                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-telephone"></i>
                            </span>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                class="form-control border-start-0 rounded-end-3 @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $store->phone ?? '') }}"
                                placeholder="+91 98765 43210"
                            >

                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- GOOGLE MAP CARD -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                <h5 class="fw-semibold text-dark mb-0">
                    <i class="bi bi-geo-alt me-2 text-primary"></i>
                    Google Map
                </h5>
                <p class="text-muted small mb-0 mt-1">
                    Add a Google Map location to display on the Contact page.
                </p>
            </div>

            <div class="card-body p-4 p-lg-5">
                <div class="row g-4">

                    <!-- MAP URL -->
                    <div class="col-12">
                        <label for="map_url" class="form-label fw-semibold">
                            Google Map Embed URL
                        </label>

                        <textarea
                            id="map_url"
                            name="map_url"
                            class="form-control rounded-3 @error('map_url') is-invalid @enderror"
                            rows="4"
                            placeholder="Paste Google Maps embed URL here..."
                        >{{ old('map_url', $store->map_url ?? '') }}</textarea>

                        <div class="form-text">
                            Google Maps → Share → Embed a map → copy the
                            <code>src</code> URL from the iframe.
                        </div>

                        @error('map_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- MAP PREVIEW -->
                    @if($store?->map_url)
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                Current Map Preview
                            </label>

                            <div class="ratio ratio-21x9 map-preview rounded-3 overflow-hidden border shadow-sm">
                                <iframe
                                    src="{{ $store->map_url }}"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- SAVE BUTTON -->
        <div class="store-form-actions mt-4">
            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                <i class="bi bi-check-lg me-1"></i>
                {{ $store ? 'Update Settings' : 'Add Settings' }}
            </button>
        </div>

    </form>

    <!-- DELETE SECTION -->
    @if($store)
        <div class="card border border-danger shadow-sm rounded-4 mt-5">
            <div class="card-body p-4 p-lg-5">
                <div class="row g-3 align-items-center">

                    <div class="col-md-8">
                        <h6 class="fw-semibold text-danger mb-1">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                            Delete Customer Assistance Settings
                        </h6>

                        <p class="text-muted small mb-0">
                            This action will permanently delete the customer assistance and Google Map information.
                        </p>
                    </div>

                    <div class="col-md-4 text-md-end">
                        <form
                            action="{{ route('admin.store-information.destroy') }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete these settings?')"
                            class="store-delete-form">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                                <i class="bi bi-trash3 me-1"></i>
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endif

</div>
@endsection

@push('styles')
<style>
    .store-information-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .store-information-page .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .store-information-page .card {
        border-radius: 1rem !important;
        overflow: hidden;
    }

    .store-information-page .card-header,
    .store-information-page .card-body {
        background: #fff;
    }

    /* SUPPORT FIELDS */
    .store-information-page .support-field-card {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 18px;
        border: 1px solid #e9ecef;
        border-radius: 14px;
        background: #fafbfc;
        transition: all 0.25s ease;
    }

    .store-information-page .support-field-card:hover {
        border-color: #d7dce2;
        background: #fff;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.05);
    }

    .store-information-page .support-field-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 12px;
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
    }

    /* FORM */
    .store-information-page .form-control {
        border-radius: 0.6rem;
    }

    .store-information-page .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }

    .store-information-page .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: #2c3e50;
    }

    .store-information-page .form-text {
        font-size: 0.8rem;
    }

    .store-information-page .input-group-text {
        border-color: #dee2e6;
    }

    /* BUTTONS */
    .store-information-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .store-information-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .store-information-page .btn-outline-danger {
        border-width: 1.5px;
        transition: all 0.3s ease;
    }

    .store-information-page .btn-outline-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    /* ALERTS */
    .store-information-page .alert-success {
        background-color: #e8f5e9;
        border-left: 4px solid #28a745;
        color: #1e7e34;
    }

    .store-information-page .alert-danger {
        background-color: #fde8e8;
        border-left: 4px solid #dc3545;
        color: #842029;
    }

    /* IMAGE */
    .store-information-page .support-preview {
        width: 220px;
        height: 140px;
        object-fit: cover;
        border-radius: 0.75rem;
        border-color: #e9ecef;
    }

    /* MAP */
    .store-information-page .map-preview {
        --bs-aspect-ratio: 42.857%;
    }

    /* RESPONSIVE */
    @media (max-width: 767px) {
        .store-information-page {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        .store-information-page h4 {
            font-size: 1.2rem;
        }

        .store-information-page .card-header {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .store-information-page .card-body {
            padding: 1rem !important;
        }

        .store-information-page .support-field-card {
            padding: 15px;
            gap: 12px;
        }

        .store-information-page .support-field-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
        }

        .store-information-page .support-preview {
            width: 100%;
            max-width: 220px;
            height: 140px;
        }

        .store-information-page .map-preview {
            --bs-aspect-ratio: 70%;
        }

        .store-information-page .store-form-actions button,
        .store-information-page .store-delete-form,
        .store-information-page .store-delete-form button {
            width: 100%;
        }

        .store-information-page .store-form-actions button,
        .store-information-page .store-delete-form button {
            min-height: 40px;
        }

        .store-information-page .store-delete-form {
            display: flex;
        }
    }

    @media (max-width: 400px) {
        .store-information-page {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        .store-information-page .support-field-card {
            padding: 12px;
            gap: 10px;
        }

        .store-information-page .support-field-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            font-size: 1rem;
        }
    }
</style>
@endpush
