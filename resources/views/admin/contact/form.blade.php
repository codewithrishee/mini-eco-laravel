@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-4">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-info-circle me-2 text-primary"></i>
                Contact Information
            </h4>

            <p class="text-muted small mb-0">
                Manage contact information displayed on the Contact page.
            </p>
        </div>

        @if($contact)

            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                <i class="bi bi-check-circle-fill me-1"></i>
                Active
            </span>

        @else

            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                <i class="bi bi-circle me-1"></i>
                Not Added
            </span>

        @endif

    </div>


    <!-- Success Alert -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm"
             role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>

        </div>

    @endif


    <!-- Error Alert -->
    @if($errors->any())

        <div class="alert alert-danger alert-dismissible fade show border-0 rounded-3 shadow-sm"
             role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close">
            </button>

        </div>

    @endif


    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 pt-4 pb-0 px-4">

            <h5 class="fw-semibold text-dark mb-0">
                <i class="bi bi-pencil-square me-2 text-primary"></i>
                Contact Details
            </h5>

            <p class="text-muted small mb-0 mt-1">
                Update the contact information shown on your website.
            </p>

        </div>


        <div class="card-body p-4 p-lg-5">

            <form action="{{ route('admin.contact.update') }}"
                  method="POST">

                @csrf
                @method('PUT')


                <div class="row g-4">


                    <!-- SERVICE AREA / ADDRESS -->
                    <div class="col-md-6">

                        <div class="border rounded-3 p-4 h-100 bg-light bg-opacity-25">

                            <div class="d-flex align-items-center mb-3">

                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">

                                    <i class="bi bi-geo-alt text-primary fs-5"></i>

                                </div>

                                <div>

                                    <h6 class="fw-semibold mb-0">
                                        Service Area
                                    </h6>

                                    <small class="text-muted">
                                        Area or location you serve
                                    </small>

                                </div>

                            </div>


                            <label for="address"
                                   class="form-label fw-semibold">

                                Service Area / Address

                            </label>


                            <textarea id="address"
                                      name="address"
                                      class="form-control rounded-3 @error('address') is-invalid @enderror"
                                      rows="4"
                                      placeholder="e.g. Serving customers across India">{{ old('address', $contact->address ?? '') }}</textarea>


                            @error('address')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    <!-- PHONE -->
                    <div class="col-md-6">

                        <div class="border rounded-3 p-4 h-100 bg-light bg-opacity-25">

                            <div class="d-flex align-items-center mb-3">

                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">

                                    <i class="bi bi-telephone text-primary fs-5"></i>

                                </div>

                                <div>

                                    <h6 class="fw-semibold mb-0">
                                        Phone Number
                                    </h6>

                                    <small class="text-muted">
                                        Customer contact number
                                    </small>

                                </div>

                            </div>


                            <label for="phone"
                                   class="form-label fw-semibold">

                                Phone Number

                            </label>


                            <input type="text"
                                   id="phone"
                                   name="phone"
                                   class="form-control rounded-3 @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $contact->phone ?? '') }}"
                                   placeholder="+91 98765 43210">


                            @error('phone')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    <!-- EMAIL -->
                    <div class="col-md-6">

                        <div class="border rounded-3 p-4 h-100 bg-light bg-opacity-25">

                            <div class="d-flex align-items-center mb-3">

                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">

                                    <i class="bi bi-envelope text-primary fs-5"></i>

                                </div>

                                <div>

                                    <h6 class="fw-semibold mb-0">
                                        Email Address
                                    </h6>

                                    <small class="text-muted">
                                        Customer support email
                                    </small>

                                </div>

                            </div>


                            <label for="email"
                                   class="form-label fw-semibold">

                                Email Address

                            </label>


                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control rounded-3 @error('email') is-invalid @enderror"
                                   value="{{ old('email', $contact->email ?? '') }}"
                                   placeholder="hello@minieco.com">


                            @error('email')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>


                    <!-- QUICK RESPONSE INFO -->
                    <div class="col-md-6">

                        <div class="border rounded-3 p-4 h-100 bg-light bg-opacity-25">

                            <div class="d-flex align-items-center mb-3">

                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">

                                    <i class="bi bi-chat-dots text-primary fs-5"></i>

                                </div>

                                <div>

                                    <h6 class="fw-semibold mb-0">
                                        Quick Response
                                    </h6>

                                    <small class="text-muted">
                                        Customer assistance information
                                    </small>

                                </div>

                            </div>


                            <div class="quick-response-info">

                                <div class="d-flex align-items-start gap-2">

                                    <i class="bi bi-check-circle-fill text-success mt-1"></i>

                                    <p class="mb-0 text-muted">
                                        We aim to respond to product and support queries as quickly as possible.
                                    </p>

                                </div>

                            </div>


                            <div class="form-text mt-3">
                                This information is displayed automatically on the Contact page and does not require editing.
                            </div>

                        </div>

                    </div>


                </div>


                <!-- Update Button -->
                <div class="mt-4">

                    <button type="submit"
                            class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">

                        <i class="bi bi-pencil-square me-1"></i>

                        {{ $contact ? 'Update Contact Information' : 'Add Contact Information' }}

                    </button>

                </div>

            </form>


            <!-- Delete Section -->
            @if($contact)

                <hr class="my-5">


                <div class="row g-3 align-items-center">

                    <div class="col-md-8">

                        <h6 class="fw-semibold text-danger mb-1">

                            <i class="bi bi-exclamation-triangle-fill me-1"></i>

                            Delete Contact Information

                        </h6>

                        <p class="text-muted small mb-0">
                            This action will permanently remove all contact details from the system.
                        </p>

                    </div>


                    <div class="col-md-4 text-md-end">

                        <form action="{{ route('admin.contact.destroy') }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete contact information?')"
                              class="d-inline">

                            @csrf
                            @method('DELETE')


                            <button type="submit"
                                    class="btn btn-outline-danger rounded-pill px-4">

                                <i class="bi bi-trash3 me-1"></i>
                                Delete

                            </button>

                        </form>

                    </div>

                </div>

            @endif

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

    .bg-opacity-25 {
        --bs-bg-opacity: 0.25;
    }


    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }


    .btn-primary {
        background: linear-gradient(
            135deg,
            #667eea 0%,
            #764ba2 100%
        );

        border: none;

        transition: all 0.3s ease;
    }


    .btn-primary:hover {
        transform: translateY(-2px);

        box-shadow:
            0 6px 20px
            rgba(102, 126, 234, 0.4);

        color: #fff;
    }


    .btn-outline-danger {
        border-width: 1.5px;

        transition: all 0.3s ease;
    }


    .btn-outline-danger:hover {
        transform: translateY(-2px);

        box-shadow:
            0 4px 12px
            rgba(220, 53, 69, 0.3);
    }


    .alert-success {
        background-color: #e8f5e9;

        border-left:
            4px solid #28a745;

        color: #1e7e34;
    }


    .alert-danger {
        background-color: #fde8e8;

        border-left:
            4px solid #dc3545;

        color: #842029;
    }


    .form-label {
        font-size: 0.9rem;

        margin-bottom: 0.4rem;

        color: #2c3e50;
    }


    .card-body {
        background: #ffffff;
    }


    .border {
        border-color: #e9ecef !important;
    }


    /* Quick Response Static Card */

    .quick-response-info {
        min-height: 88px;

        display: flex;

        align-items: center;

        padding: 15px;

        background: #ffffff;

        border: 1px solid #e9ecef;

        border-radius: 0.75rem;

        line-height: 1.6;
    }


    @media (max-width: 767px) {

        .container-fluid {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

    }

</style>

@endpush