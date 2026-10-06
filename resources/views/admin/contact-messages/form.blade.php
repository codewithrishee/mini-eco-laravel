@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4 py-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>

            <a href="{{ route('admin.contact-messages.index') }}"
               class="text-decoration-none text-muted small">

                <i class="bi bi-arrow-left me-1"></i>
                Back to Contact Messages

            </a>

            <h4 class="fw-bold text-dark mt-2 mb-1">

                <i class="bi bi-envelope-paper-fill me-2 text-primary"></i>
                Contact Message

            </h4>

            <p class="text-muted small mb-0">
                View customer contact details and message information.
            </p>

        </div>


        {{-- STATUS --}}
        <div>

            <span class="badge
                {{ $contactMessage->is_read
                    ? 'bg-secondary bg-opacity-10 text-secondary'
                    : 'bg-success bg-opacity-10 text-success' }}
                px-3 py-2 rounded-pill">

                <i class="bi
                    {{ $contactMessage->is_read
                        ? 'bi-check-circle'
                        : 'bi-envelope-fill' }}
                    me-1">
                </i>

                {{ $contactMessage->is_read ? 'Read' : 'New Message' }}

            </span>

        </div>

    </div>


    <div class="row g-4">

        {{-- ===================================================== --}}
        {{-- LEFT SIDE --}}
        {{-- ===================================================== --}}

        <div class="col-lg-8">


            {{-- CUSTOMER INFORMATION --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">

                    <h5 class="fw-semibold text-dark mb-1">

                        <i class="bi bi-person-circle me-2 text-primary"></i>
                        Customer Information

                    </h5>

                    <p class="text-muted small mb-0">
                        Contact details submitted by the customer.
                    </p>

                </div>


                <div class="card-body p-4">

                    <div class="row g-4">


                        {{-- NAME --}}
                        <div class="col-md-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Name
                                </span>

                                <div class="detail-value">

                                    <i class="bi bi-person me-1 text-muted"></i>

                                    {{ $contactMessage->first_name }}
                                    {{ $contactMessage->last_name }}

                                </div>

                            </div>

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Email Address
                                </span>

                                <div class="detail-value">

                                    <a href="mailto:{{ $contactMessage->email }}"
                                       class="text-decoration-none">

                                        <i class="bi bi-envelope me-1"></i>

                                        {{ $contactMessage->email }}

                                    </a>

                                </div>

                            </div>

                        </div>


                        {{-- PHONE --}}
                        <div class="col-md-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Phone Number
                                </span>

                                <div class="detail-value">

                                    @if($contactMessage->phone)

                                        <a href="tel:{{ $contactMessage->phone }}"
                                           class="text-decoration-none">

                                            <i class="bi bi-telephone me-1"></i>

                                            {{ $contactMessage->phone }}

                                        </a>

                                    @else

                                        <span class="text-muted">
                                            Not provided
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>


                        {{-- RECEIVED --}}
                        <div class="col-md-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Received
                                </span>

                                <div class="detail-value">

                                    <i class="bi bi-calendar3 me-1 text-muted"></i>

                                    {{ $contactMessage->created_at->format('d M Y, h:i A') }}

                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>



            {{-- MESSAGE DETAILS --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">

                    <h5 class="fw-semibold text-dark mb-1">

                        <i class="bi bi-chat-left-text me-2 text-primary"></i>
                        Message Details

                    </h5>

                    <p class="text-muted small mb-0">
                        Message received through the Contact page.
                    </p>

                </div>


                <div class="card-body p-4">


                    {{-- SUBJECT --}}
                    <div class="mb-4">

                        <span class="detail-label">
                            Subject
                        </span>

                        <div class="subject-box">

                            {{ $contactMessage->subject ?: 'No subject provided' }}

                        </div>

                    </div>


                    {{-- MESSAGE --}}
                    <div>

                        <span class="detail-label">
                            Message
                        </span>

                        <div class="message-box">

                            {!! nl2br(e($contactMessage->message)) !!}

                        </div>

                    </div>


                </div>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- RIGHT SIDE --}}
        {{-- ===================================================== --}}

        <div class="col-lg-4">


            {{-- QUICK CONTACT --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">

                    <h5 class="fw-semibold text-dark mb-1">

                        <i class="bi bi-headset me-2 text-primary"></i>
                        Quick Contact

                    </h5>

                    <p class="text-muted small mb-0">
                        Respond directly to this customer.
                    </p>

                </div>


                <div class="card-body p-4">


                    {{-- EMAIL --}}
                    <a href="mailto:{{ $contactMessage->email }}"
                       class="btn btn-outline-primary rounded-pill w-100 mb-3">

                        <i class="bi bi-envelope-fill me-2"></i>

                        Send Email

                    </a>


                    {{-- CALL --}}
                    @if($contactMessage->phone)

                        <a href="tel:{{ $contactMessage->phone }}"
                           class="btn btn-outline-secondary rounded-pill w-100">

                            <i class="bi bi-telephone-fill me-2"></i>

                            Call Customer

                        </a>

                    @endif


                </div>

            </div>



            {{-- MESSAGE INFO --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white border-0 pt-4 pb-0 px-4">

                    <h5 class="fw-semibold text-dark mb-0">

                        <i class="bi bi-info-circle me-2 text-primary"></i>
                        Message Information

                    </h5>

                </div>


                <div class="card-body p-4">


                    <div class="info-row">

                        <span>
                            Message ID
                        </span>

                        <strong>
                            #{{ $contactMessage->id }}
                        </strong>

                    </div>


                    <div class="info-row">

                        <span>
                            Status
                        </span>

                        @if($contactMessage->is_read)

                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                Read
                            </span>

                        @else

                            <span class="badge bg-success bg-opacity-10 text-success">
                                New
                            </span>

                        @endif

                    </div>


                    <div class="info-row">

                        <span>
                            Date
                        </span>

                        <strong>
                            {{ $contactMessage->created_at->format('d M Y') }}
                        </strong>

                    </div>


                    <div class="info-row border-0 pb-0">

                        <span>
                            Time
                        </span>

                        <strong>
                            {{ $contactMessage->created_at->format('h:i A') }}
                        </strong>

                    </div>


                </div>

            </div>



            {{-- DELETE MESSAGE --}}
            <div class="card border border-danger shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h6 class="fw-semibold text-danger mb-2">

                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        Delete Message

                    </h6>

                    <p class="text-muted small">
                        Permanently remove this contact message from the system.
                    </p>


                    <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this contact message?')">

                        @csrf
                        @method('DELETE')


                        <button type="submit"
                                class="btn btn-outline-danger rounded-pill w-100">

                            <i class="bi bi-trash3 me-1"></i>

                            Delete Message

                        </button>

                    </form>

                </div>

            </div>


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


    /* ==========================================================
       DETAIL ITEMS
    ========================================================== */

    .detail-item {
        height: 100%;
        padding: 16px;

        background: #f8f9fa;

        border: 1px solid #edf0f2;
        border-radius: 12px;
    }


    .detail-label {
        display: block;

        margin-bottom: 7px;

        color: #8a9097;

        font-size: 0.75rem;
        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: 0.5px;
    }


    .detail-value {
        color: #212529;

        font-weight: 500;

        word-break: break-word;
    }


    /* ==========================================================
       SUBJECT
    ========================================================== */

    .subject-box {
        padding: 15px 17px;

        background: #f8f9fa;

        border: 1px solid #edf0f2;
        border-radius: 12px;

        color: #212529;

        font-weight: 600;
    }


    /* ==========================================================
       MESSAGE
    ========================================================== */

    .message-box {
        min-height: 180px;

        padding: 20px;

        background: #f8f9fa;

        border: 1px solid #edf0f2;
        border-radius: 12px;

        color: #495057;

        line-height: 1.8;

        word-break: break-word;
    }


    /* ==========================================================
       MESSAGE INFORMATION
    ========================================================== */

    .info-row {
        display: flex;

        justify-content: space-between;
        align-items: center;

        gap: 15px;

        padding: 13px 0;

        border-bottom: 1px solid #edf0f2;

        font-size: 0.88rem;
    }


    .info-row > span:first-child {
        color: #6c757d;
    }


    /* ==========================================================
       LINKS
    ========================================================== */

    a {
        color: #667eea;
    }


    a:hover {
        color: #4a5fcf;
    }


    /* ==========================================================
       BUTTONS
    ========================================================== */

    .btn-outline-primary,
    .btn-outline-secondary,
    .btn-outline-danger {
        border-width: 1.5px;

        transition: all 0.25s ease;
    }


    .btn-outline-primary:hover,
    .btn-outline-secondary:hover,
    .btn-outline-danger:hover {
        transform: translateY(-2px);
    }


    /* ==========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 767px) {

        .container-fluid {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }


        .message-box {
            min-height: 130px;
        }

    }

</style>

@endpush