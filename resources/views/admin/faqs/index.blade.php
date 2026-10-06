@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-question-circle me-2 text-primary"></i>FAQs
            </h4>
            <p class="text-muted small mb-0">Manage frequently asked questions for the Contact page.</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Add FAQ
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- FAQ Table -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
            <h5 class="fw-semibold text-dark mb-0">
                <i class="bi bi-list-ul me-2 text-primary"></i>FAQ List
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="py-3 ps-4" style="width:70px;">#</th>
                            <th scope="col" class="py-3">Question</th>
                            <th scope="col" class="py-3">Answer</th>
                            <th scope="col" class="py-3" style="width:120px;">Status</th>
                            <th scope="col" class="py-3 pe-4 text-end" style="width:160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $faq)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $faq->id }}</td>
                                <td class="fw-medium">{{ $faq->question }}</td>
                                <td class="text-muted">
                                    <span title="{{ $faq->answer }}">
                                        {{ \Illuminate\Support\Str::limit($faq->answer, 80) }}
                                    </span>
                                </td>
                                <td>
                                    @if($faq->status)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="bi bi-check-circle-fill me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                            <i class="bi bi-circle me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.faqs.edit', $faq->id) }}"
                                           class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                           data-bs-toggle="tooltip" title="Edit FAQ">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>
                                        <!-- Delete -->
                                        <form action="{{ route('admin.faqs.destroy', $faq->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this FAQ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                                    data-bs-toggle="tooltip" title="Delete FAQ">
                                                <i class="bi bi-trash3 me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-question-circle display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No FAQs Found</h5>
                                    <p class="text-muted small mb-3">Add your first FAQ for the Contact page.</p>
                                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary rounded-pill px-4">
                                        <i class="bi bi-plus-lg me-1"></i> Add FAQ
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
    .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
    }
    .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }
    .table tbody tr {
        transition: background 0.15s ease;
    }
    .table tbody tr:hover {
        background-color: #f8f9fc;
    }
    .btn-outline-primary, .btn-outline-danger {
        border-width: 1.5px;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }
    .alert-success {
        background-color: #e8f5e9;
        border-left: 4px solid #28a745;
        color: #1e7e34;
    }
    .card-header {
        background: #ffffff;
    }
    .card-body {
        background: #ffffff;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (el) {
            return new bootstrap.Tooltip(el);
        });
    });
</script>
@endpush