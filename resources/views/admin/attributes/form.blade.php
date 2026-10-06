@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-tag me-2 text-primary"></i>
                {{ isset($item) ? 'Edit ' : 'Add ' }}
                {{ rtrim(ucfirst($type), 's') }}
            </h4>
            <p class="text-muted small mb-0">
                {{ isset($item) ? 'Update attribute details.' : 'Create a new attribute.' }}
            </p>
        </div>
        <a href="{{ route('admin.attributes.index', $type) }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
            <h5 class="fw-semibold text-dark mb-0">
                <i class="bi bi-pencil-square me-2 text-primary"></i>
                {{ isset($item) ? 'Edit ' : 'Add ' }}
                {{ rtrim(ucfirst($type), 's') }}
            </h5>
        </div>
        <div class="card-body p-4 p-lg-5">
            <form action="{{ isset($item)
                        ? route('admin.attributes.update', [$type, $item->id])
                        : route('admin.attributes.store', $type) }}"
                  method="POST">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="row g-4">
                    <!-- Name -->
                    <div class="col-12">
                        <label for="name" class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                               value="{{ old('name', $item->name ?? '') }}"
                               placeholder="Enter Name"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Color Code (only for colors) -->
                    @if($type == 'colors')
                        <div class="col-12">
                            <label for="code" class="form-label fw-semibold">Color Code</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="color"
                                       id="code"
                                       name="code"
                                       class="form-control form-control-color rounded-3"
                                       value="{{ old('code', $item->code ?? '#000000') }}"
                                       style="width: 80px; height: 48px; padding: 0; border: 2px solid #e9ecef;">
                                <span class="text-muted small">Click to pick a color</span>
                            </div>
                        </div>
                    @endif

                    <!-- Display Order -->
                    <div class="col-md-6">
                        <label for="display_order" class="form-label fw-semibold">Display Order</label>
                        <input type="number"
                               id="display_order"
                               name="display_order"
                               class="form-control rounded-3"
                               min="0"
                               value="{{ old('display_order', $item->display_order ?? 0) }}">
                        <div class="form-text">Lower number appears first.</div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select id="status" name="status" class="form-select rounded-3">
                            <option value="1" {{ old('status', $item->status ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0" {{ old('status', $item->status ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="mt-4 d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ isset($item) ? 'Update' : 'Save' }}
                    </button>
                    <a href="{{ route('admin.attributes.index', $type) }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .rounded-4 {
        border-radius: 1rem !important;
    }
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
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
    .btn-outline-secondary {
        border-width: 1.5px;
        transition: all 0.3s ease;
    }
    .btn-outline-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.2);
    }
    .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: #2c3e50;
    }
    .card-body {
        background: #ffffff;
    }
    .invalid-feedback {
        font-size: 0.85rem;
    }
    .form-control-color {
        cursor: pointer;
        padding: 0;
        border: 2px solid #dee2e6;
    }
    .form-control-color:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    }
</style>
@endpush