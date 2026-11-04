
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    @php
        $isEdit = isset($item);
    @endphp

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fas fa-tags text-primary me-2"></i>
                {{ $isEdit ? 'Edit Tag' : 'Add New Tag' }}
            </h4>

            <p class="text-muted small mb-0">
                {{ $isEdit ? 'Update tag information.' : 'Create a new product tag.' }}
            </p>
        </div>

        <a href="{{ route('admin.attributes.index', 'tags') }}"
           class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>

    <div class="row">
        <div class="col-lg-7 col-xl-6">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <form action="{{ $isEdit
                        ? route('admin.attributes.update', ['tags', $item->id])
                        : route('admin.attributes.store', 'tags') }}"
                          method="POST">

                        @csrf

                        @if($isEdit)
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Tag Name <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   placeholder="e.g. Trending, New Arrival, Best Seller"
                                   value="{{ old('name', $item->name ?? '') }}"
                                   required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="text-muted">
                                Enter a name for your product tag.
                            </small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Display Order
                            </label>

                            <input type="number"
                                   name="display_order"
                                   class="form-control @error('display_order') is-invalid @enderror"
                                   value="{{ old('display_order', $item->display_order ?? 0) }}"
                                   min="0"
                                   placeholder="0">

                            @error('display_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="text-muted">
                                Lower numbers will appear first.
                            </small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block">
                                Status
                            </label>

                            <input type="hidden" name="status" value="0">

                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       role="switch"
                                       id="status"
                                       name="status"
                                       value="1"
                                       {{ old('status', $item->status ?? 1) ? 'checked' : '' }}>

                                <label class="form-check-label" for="status">
                                    Active
                                </label>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.attributes.index', 'tags') }}"
                               class="btn btn-light rounded-pill px-4">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-2"></i>
                                {{ $isEdit ? 'Update Tag' : 'Save Tag' }}
                            </button>
                        </div>

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
        border-radius: 16px !important;
    }

    .form-label {
        color: #343a40;
        font-size: 14px;
    }

    .form-control {
        border-radius: 10px;
        padding: 11px 14px;
        border-color: #dee2e6;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 .2rem rgba(102, 126, 234, .12);
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
    }
</style>
@endpush
