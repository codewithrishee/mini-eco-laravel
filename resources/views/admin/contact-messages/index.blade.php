@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4 contact-messages-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-envelope-paper me-2 text-primary"></i>Contact Messages
            </h4>
            <p class="text-muted small mb-0">Messages received from customers.</p>
        </div>

        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
            <i class="bi bi-inbox me-1"></i> Total: {{ $messages->total() }}
        </span>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Messages Card -->
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 pt-4 pb-3 px-4">
            <h5 class="fw-semibold text-dark mb-0">
                <i class="bi bi-list-ul me-2 text-primary"></i>Customer Messages
            </h5>
        </div>

        <div class="card-body p-0">

            <!-- Desktop Table -->
            <div class="table-responsive desktop-messages-table">
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="py-3 ps-4">#</th>
                            <th scope="col" class="py-3">Name</th>
                            <th scope="col" class="py-3">Email</th>
                            <th scope="col" class="py-3">Subject</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3">Date</th>
                            <th scope="col" class="py-3 pe-4 text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($messages as $message)
                            <tr class="{{ !$message->is_read ? 'fw-bold' : '' }}">
                                <td class="ps-4">{{ $message->id }}</td>

                                <td>
                                    {{ $message->first_name }} {{ $message->last_name }}
                                </td>

                                <td>{{ $message->email }}</td>

                                <td>{{ $message->subject }}</td>

                                <td>
                                    @if($message->is_read)
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i> Read
                                        </span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="bi bi-envelope-fill me-1"></i> New
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $message->created_at->format('d M Y') }}</td>

                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">

                                        <a href="{{ route('admin.contact-messages.show', $message->id) }}"
                                           class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                           data-bs-toggle="tooltip"
                                           title="View message">
                                            <i class="bi bi-eye me-1"></i> View
                                        </a>

                                        <form action="{{ route('admin.contact-messages.destroy', $message->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Delete this message?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                                    data-bs-toggle="tooltip"
                                                    title="Delete message">
                                                <i class="bi bi-trash3 me-1"></i> Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-inbox display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No contact messages found.</h5>
                                    <p class="text-muted small mb-0">Customer inquiries will appear here.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="mobile-messages-list">
                @forelse($messages as $message)
                    <div class="message-mobile-card {{ !$message->is_read ? 'unread-message' : '' }}">

                        <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                            <div class="message-person">
                                <div class="message-avatar">
                                    <i class="bi bi-person-fill"></i>
                                </div>

                                <div class="min-w-0">
                                    <h6 class="fw-bold text-dark mb-1">
                                        {{ $message->first_name }} {{ $message->last_name }}
                                    </h6>
                                    <small class="text-muted">#{{ $message->id }}</small>
                                </div>
                            </div>

                            @if($message->is_read)
                                <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-2">
                                    Read
                                </span>
                            @else
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                    New
                                </span>
                            @endif
                        </div>

                        <div class="message-meta">
                            <div class="meta-item">
                                <i class="bi bi-envelope text-muted"></i>
                                <span>{{ $message->email }}</span>
                            </div>

                            <div class="meta-item">
                                <i class="bi bi-chat-left-text text-muted"></i>
                                <span>{{ $message->subject }}</span>
                            </div>

                            <div class="meta-item">
                                <i class="bi bi-calendar3 text-muted"></i>
                                <span>{{ $message->created_at->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="message-actions mt-3">
                            <a href="{{ route('admin.contact-messages.show', $message->id) }}"
                               class="btn btn-outline-primary rounded-pill">
                                <i class="bi bi-eye me-1"></i> View
                            </a>

                            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this message?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger rounded-pill">
                                    <i class="bi bi-trash3 me-1"></i> Delete
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="text-center py-5 px-3">
                        <i class="bi bi-inbox display-3 text-muted opacity-25 d-block mb-3"></i>
                        <h5 class="fw-light text-muted">No contact messages found.</h5>
                        <p class="text-muted small mb-0">Customer inquiries will appear here.</p>
                    </div>
                @endforelse
            </div>

        </div>

        @if($messages->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                <div class="d-flex justify-content-center">
                    {{ $messages->links() }}
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

@push('styles')
<style>
    .contact-messages-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .contact-messages-page .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .contact-messages-page .card {
        border-radius: 1rem !important;
        overflow: hidden;
    }

    .contact-messages-page .card-header,
    .contact-messages-page .card-body,
    .contact-messages-page .card-footer {
        background: #fff;
    }

    .contact-messages-page .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
        white-space: nowrap;
    }

    .contact-messages-page .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }

    .contact-messages-page .table tbody tr {
        transition: background 0.15s ease;
    }

    .contact-messages-page .table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .contact-messages-page .btn-outline-primary,
    .contact-messages-page .btn-outline-danger {
        border-width: 1.5px;
    }

    .contact-messages-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .contact-messages-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .contact-messages-page .alert-success {
        background-color: #e8f5e9;
        border-left: 4px solid #28a745;
        color: #1e7e34;
    }

    .contact-messages-page .mobile-messages-list {
        display: none;
    }

    .contact-messages-page .message-mobile-card {
        padding: 16px;
        border-bottom: 1px solid #edf0f2;
        background: #fff;
    }

    .contact-messages-page .message-mobile-card.unread-message {
        background: #fbfcff;
    }

    .contact-messages-page .message-person {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .contact-messages-page .message-avatar {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        font-size: 1.2rem;
    }

    .contact-messages-page .message-meta {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .contact-messages-page .meta-item {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        font-size: 0.85rem;
        color: #495057;
        min-width: 0;
    }

    .contact-messages-page .meta-item i {
        flex-shrink: 0;
        margin-top: 2px;
    }

    .contact-messages-page .meta-item span {
        overflow-wrap: anywhere;
    }

    .contact-messages-page .message-actions {
        display: flex;
        gap: 10px;
    }

    .contact-messages-page .message-actions > a,
    .contact-messages-page .message-actions > form {
        flex: 1;
        min-width: 0;
    }

    .contact-messages-page .message-actions button {
        width: 100%;
    }

    @media (max-width: 767px) {
        .contact-messages-page {
            padding-left: 15px !important;
            padding-right: 15px !important;
        }

        .contact-messages-page h4 {
            font-size: 1.2rem;
        }

        .contact-messages-page .card-header {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .contact-messages-page .desktop-messages-table {
            display: none;
        }

        .contact-messages-page .mobile-messages-list {
            display: block;
        }

        .contact-messages-page .message-actions .btn {
            min-height: 40px;
            width: 100%;
        }
    }

    @media (max-width: 400px) {
        .contact-messages-page {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        .contact-messages-page .message-mobile-card {
            padding: 14px 12px;
        }

        .contact-messages-page .message-actions {
            gap: 8px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );

        tooltipTriggerList.map(function (el) {
            return new bootstrap.Tooltip(el);
        });
    });
</script>
@endpush