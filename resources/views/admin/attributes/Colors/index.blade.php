
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="fas fa-palette text-primary me-2"></i> Manage Colors
            </h4>
            <p class="text-muted small mb-0">Manage product colors and their color codes.</p>
        </div>

        <a href="{{ route('admin.attributes.create', 'colors') }}"
           class="btn btn-primary rounded-pill px-4">
            <i class="fas fa-plus me-2"></i> Add New Color
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 px-4 py-3">
            <h6 class="fw-bold mb-0">All Colors</h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Preview</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Display Order</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td class="ps-4 fw-semibold">
                                    {{ $items->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="color-preview"
                                         style="background-color: {{ $item->code }};">
                                    </div>
                                </td>

                                <td class="fw-semibold">{{ $item->name }}</td>

                                <td>
                                    <code class="color-code">{{ $item->code }}</code>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                        {{ $item->display_order }}
                                    </span>
                                </td>

                                <td>
                                    @if($item->status)
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.attributes.edit', ['colors', $item->id]) }}"
                                           class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.attributes.destroy', ['colors', $item->id]) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this color?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                <i class="fas fa-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-palette fa-3x text-muted opacity-25 mb-3"></i>
                                    <h6 class="text-muted">No Colors Found</h6>
                                    <p class="small text-muted mb-3">Add your first product color.</p>
                                    <a href="{{ route('admin.attributes.create', 'colors') }}"
                                       class="btn btn-primary btn-sm rounded-pill px-3">
                                        <i class="fas fa-plus me-1"></i> Add Color
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($items->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $items->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .rounded-4 { border-radius: 16px !important; }

    .table th {
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #6c757d;
        padding: 16px 12px;
        white-space: nowrap;
    }

    .table td { padding: 14px 12px; }

    .table tbody tr:hover { background: #f8f9fc; }

    .color-preview {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        border: 2px solid #e9ecef;
        box-shadow: 0 2px 5px rgba(0,0,0,.08);
    }

    .color-code {
        background: #f8f9fa;
        padding: 5px 9px;
        border-radius: 6px;
        color: #d63384;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
    }
</style>
@endpush
