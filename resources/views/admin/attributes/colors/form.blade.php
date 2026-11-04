
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-3">

    @php
        $isEdit = isset($item);
        $currentCode = old('code', $item->code ?? '#000000');
    @endphp

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                <i class="fas fa-palette text-primary me-2"></i>
                {{ $isEdit ? 'Edit Color' : 'Add New Color' }}
            </h4>
            <p class="text-muted small mb-0">
                {{ $isEdit ? 'Update product color details.' : 'Create a new product color.' }}
            </p>
        </div>

        <a href="{{ route('admin.attributes.index', 'colors') }}"
           class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>

    <div class="row">
        <div class="col-lg-7 col-xl-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <form action="{{ $isEdit
                        ? route('admin.attributes.update', ['colors', $item->id])
                        : route('admin.attributes.store', 'colors') }}"
                          method="POST">

                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Color Name <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="e.g. Black, White, Navy Blue"
                                   value="{{ old('name', $item->name ?? '') }}"
                                   required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Color Code <span class="text-danger">*</span>
                            </label>

                            <div class="color-picker-wrapper">
                                <input type="color"
                                       id="colorPicker"
                                       value="{{ preg_match('/^#[0-9A-Fa-f]{6}$/', $currentCode) ? $currentCode : '#000000' }}">

                                <input type="text"
                                       name="code"
                                       id="colorCode"
                                       class="form-control @error('code') is-invalid @enderror"
                                       placeholder="#000000"
                                       value="{{ $currentCode }}"
                                       pattern="^#[0-9A-Fa-f]{6}$"
                                       required>

                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <small class="text-muted">
                                Choose a color or enter its HEX code.
                            </small>
                        </div>

                        <div class="color-preview-box mb-4">
                            <span class="text-muted small fw-semibold">LIVE PREVIEW</span>
                            <div class="d-flex align-items-center gap-3 mt-2">
                                <div id="colorPreview" class="preview-circle"
                                     style="background: {{ $currentCode }};"></div>
                                <div>
                                    <div class="fw-semibold" id="previewName">
                                        {{ old('name', $item->name ?? 'Color Preview') }}
                                    </div>
                                    <small class="text-muted" id="previewCode">
                                        {{ $currentCode }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Display Order</label>
                            <input type="number"
                                   name="display_order"
                                   class="form-control @error('display_order') is-invalid @enderror"
                                   value="{{ old('display_order', $item->display_order ?? 0) }}"
                                   min="0">

                            @error('display_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block">Status</label>

                            <input type="hidden" name="status" value="0">

                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       role="switch"
                                       id="status"
                                       name="status"
                                       value="1"
                                       {{ old('status', $item->status ?? 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Active</label>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.attributes.index', 'colors') }}"
                               class="btn btn-light rounded-pill px-4">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-2"></i>
                                {{ $isEdit ? 'Update Color' : 'Save Color' }}
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
    .rounded-4 { border-radius: 16px !important; }

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
        box-shadow: 0 0 0 .2rem rgba(102,126,234,.12);
    }

    .color-picker-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    #colorPicker {
        width: 55px;
        height: 48px;
        padding: 4px;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        cursor: pointer;
        background: white;
        flex-shrink: 0;
    }

    .color-picker-wrapper .form-control { flex: 1; }

    .color-preview-box {
        padding: 18px;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        background: #f8f9fc;
    }

    .preview-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 1px #dee2e6;
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const picker = document.getElementById('colorPicker');
    const codeInput = document.getElementById('colorCode');
    const preview = document.getElementById('colorPreview');
    const previewCode = document.getElementById('previewCode');
    const nameInput = document.querySelector('input[name="name"]');
    const previewName = document.getElementById('previewName');

    function updatePreview(value) {
        if (/^#[0-9A-Fa-f]{6}$/.test(value)) {
            preview.style.backgroundColor = value;
            previewCode.textContent = value;
            picker.value = value;
        }
    }

    picker.addEventListener('input', function () {
        codeInput.value = this.value.toUpperCase();
        updatePreview(this.value);
    });

    codeInput.addEventListener('input', function () {
        updatePreview(this.value);
    });

    nameInput.addEventListener('input', function () {
        previewName.textContent = this.value || 'Color Preview';
    });
});
</script>
@endpush
