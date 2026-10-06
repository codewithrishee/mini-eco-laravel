@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fas fa-tags me-2 text-primary"></i>
                {{ ucfirst($type) }}
            </h4>
            <p class="text-muted small mb-0">Manage {{ ucfirst($type) }}</p>
        </div>
        <a href="{{ route('admin.attributes.create', $type) }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-1"></i> Add {{ rtrim(ucfirst($type), 's') }}
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Items Table -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="py-3 ps-4" width="70">#</th>
                            @if($type == 'colors')
                                <th scope="col" class="py-3" width="90">Preview</th>
                            @endif
                            <th scope="col" class="py-3">Name</th>
                            @if($type == 'colors')
                                <th scope="col" class="py-3">Code</th>
                            @endif
                            <th scope="col" class="py-3">Display Order</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3 pe-4 text-end" width="170">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $loop->iteration }}</td>
                                @if($type == 'colors')
                                    <td>
                                        <div style="width:38px; height:38px; border-radius:8px; border:2px solid #e9ecef; background:{{ $item->code }};"></div>
                                    </td>
                                @endif
                                <td class="fw-medium">{{ $item->name }}</td>
                                @if($type == 'colors')
                                    <td>
                                        <code class="bg-light p-1 rounded">{{ $item->code }}</code>
                                    </td>
                                @endif
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                        {{ $item->display_order }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->status)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                            <i class="fas fa-times-circle me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.attributes.edit', [$type, $item->id]) }}"
                                           class="btn btn-outline-warning btn-sm rounded-pill px-3">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.attributes.destroy', [$type, $item->id]) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                <i class="fas fa-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $type == 'colors' ? 7 : 6 }}" class="text-center py-5">
                                    <i class="fas fa-tags display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No Data Found</h5>
                                    <p class="text-muted small mb-0">Click "Add {{ rtrim(ucfirst($type), 's') }}" to create the first item.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($items->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                <div class="d-flex justify-content-center">
                    {{ $items->links() }}
                </div>
            </div>
        @endif
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
    .btn-outline-warning, .btn-outline-danger {
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
    code {
        font-size: 0.85rem;
        background-color: #f8f9fa;
        padding: 0.2rem 0.5rem;
        border-radius: 0.25rem;
        color: #d63384;
    }
</style>
@endpush