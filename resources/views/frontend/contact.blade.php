@extends('layouts.app')
@section('title', 'Contact Us | RvStore')
@section('content')


    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">

<!-- ================================================================ -->
<!-- SECTION 1: PREMIUM HERO BANNER                                   -->
<!-- ================================================================ -->
<section class="contact-hero">
    <div class="contact-hero-overlay d-flex align-items-center justify-content-center">
        <div class="container text-center">
            <span class="hero-badge">Get in Touch</span>
            <h1 class="hero-title">Contact <span class="highlight">Us</span></h1>
            <p class="hero-subtitle">We’d love to hear from you — reach out anytime</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- ================================================================ -->
<!-- SECTION 2: CONTACT INFORMATION                                   -->
<!-- ================================================================ -->
<section class="contact-info section-padding bg-gray-soft">
    <div class="container">
        <!-- Section Heading -->
<div class="text-center mb-5">
    <span class="section-tag">Get in Touch</span>

    <h2 class="section-heading mt-2">
        We're Here to <span class="highlight">Help</span>
    </h2>

    <br class="text-muted mx-auto mb-0" style="max-width: 650px;">
        Have a question about our products or need assistance?
    </p>
</div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h4>Service Area</h4>
                    <p>{!! nl2br(e($contact->address ?? 'Address not available')) !!}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h4>Phone Number</h4>
                    @if($contact?->phone)
                        <p>
                            <a href="tel:{{ $contact->phone }}" class="text-decoration-none text-reset">
                                {{ $contact->phone }}
                            </a>
                        </p>
                    @else
                        <p>Phone not available</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h4>Email Address</h4>
                    @if($contact?->email)
                        <p>
                            <a href="mailto:{{ $contact->email }}" class="text-decoration-none text-reset">
                                {{ $contact->email }}
                            </a>
                        </p>
                    @else
                        <p>Email not available</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="contact-info-card">
                    <div class="contact-info-icon">
                        <i class="bi bi-chat-dots"></i>
                    </div>
                    <h4>Quick Response</h4>
                    <p>We aim to respond to your product and support queries as quickly as possible.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================================================ -->
<!-- SECTION 3: CONTACT FORM + STORE INFORMATION                      -->
<!-- ================================================================ -->
<section class="contact-form-section section-padding">

    <div class="container">

        <div class="row g-4">


            <!-- ==================================================== -->
            <!-- LEFT SIDE: CONTACT MESSAGE FORM                      -->
            <!-- ==================================================== -->
            <div class="col-lg-7">

                <div class="contact-form-card">

                    <span class="section-tag">
                        Send a Message
                    </span>

                    <h2 class="section-heading" style="font-size:1.8rem;">
                        We’d Love to
                        <span class="highlight">Hear</span>
                        From You
                    </h2>

                    <p class="text-muted mb-4" style="font-size:0.95rem;">
                        Fill in the details below and we’ll get back to you within 24 hours.
                    </p>


                    {{-- SUCCESS MESSAGE --}}
                    @if(session('success'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">

                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close">
                            </button>

                        </div>

                    @endif


                    {{-- VALIDATION ERRORS --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- CONTACT MESSAGE FORM --}}
                    <form action="{{ route('contact.message.store') }}"
                          method="POST">

                        @csrf


                        <div class="row g-3">


                            {{-- FIRST NAME --}}
                            <div class="col-md-6">

                                <label for="firstName" class="form-label">
                                    First Name
                                </label>

                                <input type="text"
                                       name="first_name"
                                       class="form-control"
                                       id="firstName"
                                       value="{{ old('first_name') }}"
                                       placeholder="Jane"
                                       required>

                                @error('first_name')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- LAST NAME --}}
                            <div class="col-md-6">

                                <label for="lastName" class="form-label">
                                    Last Name
                                </label>

                                <input type="text"
                                       name="last_name"
                                       class="form-control"
                                       id="lastName"
                                       value="{{ old('last_name') }}"
                                       placeholder="Doe"
                                       required>

                                @error('last_name')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- EMAIL --}}
                            <div class="col-md-6">

                                <label for="email" class="form-label">
                                    Email Address
                                </label>

                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       id="email"
                                       value="{{ old('email') }}"
                                       placeholder="you@example.com"
                                       required>

                                @error('email')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- PHONE --}}
                            <div class="col-md-6">

                                <label for="phone" class="form-label">
                                    Phone Number
                                </label>

                                <input type="tel"
                                       name="phone"
                                       class="form-control"
                                       id="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="+91 98765 43210">

                                @error('phone')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- SUBJECT --}}
                            <div class="col-12">

                                <label for="subject" class="form-label">
                                    Subject
                                </label>

                                <input type="text"
                                       name="subject"
                                       class="form-control"
                                       id="subject"
                                       value="{{ old('subject') }}"
                                       placeholder="How can we help?"
                                       required>

                                @error('subject')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- MESSAGE --}}
                            <div class="col-12">

                                <label for="message" class="form-label">
                                    Message
                                </label>

                                <textarea name="message"
                                          class="form-control"
                                          id="message"
                                          rows="5"
                                          placeholder="Write your message here..."
                                          required>{{ old('message') }}</textarea>

                                @error('message')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- SEND BUTTON --}}
                            <div class="col-12">

                                <button type="submit"
                                        class="btn btn-primary w-100 w-md-auto">

                                    Send Message

                                    <i class="bi bi-arrow-right ms-2"></i>

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>



            <!-- ==================================================== -->
            <!-- RIGHT SIDE: DYNAMIC STORE INFORMATION                -->
            <!-- ==================================================== -->
            <div class="col-lg-5">

                <div class="store-info-card">


                    {{-- STORE IMAGE --}}
                    @if($storeInformation?->image)

                        <img src="{{ asset('uploads/store/' . $storeInformation->image) }}"
                             alt="{{ $storeInformation->heading ?? 'Customer Assistance' }}"
                             class="img-fluid">

                    @else

                        <div class="text-center py-5 bg-light rounded-3" style="font-size: 4rem;">
                            <i class="bi bi-headset"></i>
                        </div>

                    @endif



                    {{-- HEADING --}}
                    <h4>
                        {{ $storeInformation->heading ?? 'Customer Assistance' }}
                    </h4>



                    {{-- DESCRIPTION --}}
                    <p>
                        {{ $storeInformation->description ?? 'Not sure which product is right for you? Our team is here to help with product details, availability and general queries.' }}
                    </p>



                    {{-- SUPPORT OPTIONS (replaces store hours) --}}
                    <div class="support-options">
                        <div class="support-option d-flex align-items-start gap-3 mb-3">
                            <div class="support-option-icon">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Product Queries</h6>
                                <p class="small text-muted mb-0">{{ $storeInformation->product_query_text ?? 'Get help with product details and available options.' }}</p>
                            </div>
                        </div>
                        <div class="support-option d-flex align-items-start gap-3 mb-3">
                            <div class="support-option-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Product Availability</h6>
                                <p class="small text-muted mb-0">{{ $storeInformation->availability_text ?? 'Ask us about product availability and stock.' }}</p>
                            </div>
                        </div>
                        <div class="support-option d-flex align-items-start gap-3">
                            <div class="support-option-icon">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">WhatsApp Support</h6>
                                <p class="small text-muted mb-0">{{ $storeInformation->whatsapp_text ?? 'Connect with us directly for quick assistance.' }}</p>
                            </div>
                        </div>
                    </div>


                    <hr>


                    {{-- SUPPORT EMAIL + PHONE --}}
                    <p>

                        <strong>Support:</strong>

                        @if($storeInformation?->support_email)

                            <a href="mailto:{{ $storeInformation->support_email }}"
                               class="text-decoration-none text-reset">

                                {{ $storeInformation->support_email }}

                            </a>

                        @else

                            Not Available

                        @endif


                        <br>


                        <strong>Phone:</strong>

                        @if($storeInformation?->phone)

                            <a href="tel:{{ $storeInformation->phone }}"
                               class="text-decoration-none text-reset">

                                {{ $storeInformation->phone }}

                            </a>

                        @else

                            Not Available

                        @endif

                    </p>


                </div>

            </div>


        </div>

    </div>

</section>

<!-- ================================================================ -->
<!-- SECTION 4: FAQ (DYNAMIC ACCORDION)                               -->
<!-- ================================================================ -->

<section class="faq-section section-padding bg-gray-soft">

    <div class="container">

        <div class="section-header text-center mb-5">

            <span class="section-tag">
                FAQ
            </span>

            <h2 class="section-heading">
                Frequently Asked
                <span class="highlight">Questions</span>
            </h2>

            <p class="section-subtitle">
                Quick answers to the most common queries.
            </p>

        </div>


        @if($faqs->count() > 0)

            <div class="accordion" id="faqAccordion">

                @foreach($faqs as $faq)

                    <div class="accordion-item faq-card">

                        <h5 class="accordion-header"
                            id="faqHeading{{ $faq->id }}">

                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faqCollapse{{ $faq->id }}"
                                aria-expanded="false"
                                aria-controls="faqCollapse{{ $faq->id }}">

                                <i class="bi bi-question-circle"></i>

                                {{ $faq->question }}

                            </button>

                        </h5>


                        <div
                            id="faqCollapse{{ $faq->id }}"
                            class="accordion-collapse collapse"
                            aria-labelledby="faqHeading{{ $faq->id }}"
                            data-bs-parent="#faqAccordion">

                            <div class="accordion-body">

                                {!! nl2br(e($faq->answer)) !!}

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="text-center py-4">

                <p class="text-muted mb-0">
                    No FAQs available at the moment.
                </p>

            </div>

        @endif

    </div>

</section>


<!-- ================================================================ -->
<!-- SECTION 5: GOOGLE MAP - DYNAMIC                                  -->
<!-- ================================================================ -->
<section class="map-section section-padding">
    <div class="container">
        <div class="section-header text-center mb-4">
            <span class="section-tag">
                Find Us
            </span>
            <h2 class="section-heading">
                Our <span class="highlight">Location</span>
            </h2>
            <p class="section-subtitle">
                Come visit our store and experience Rv-Store.
            </p>
        </div>
        <div class="map-container">
            @if($storeInformation?->map_url)
                <iframe
                    src="{{ $storeInformation->map_url }}"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-geo-alt fs-1 text-muted"></i>
                    <p class="text-muted mt-2 mb-0">
                        Location map is currently unavailable.
                    </p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- ================================================================ -->
<!-- SECTION 6: CUSTOMER SUPPORT BANNER                               -->
<!-- ================================================================ -->
<section class="support-section section-padding bg-gray-soft">
    <div class="container">
        <div class="support-banner">
            <h2>We're Always <span class="highlight">Here to Help</span></h2>
            <p>Whether you have a question, need assistance, or just want to say hello — our team is ready to support you with warmth and expertise.</p>
            <a href="#" class="btn-support">Contact Support <i class="bi bi-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>



@endsection