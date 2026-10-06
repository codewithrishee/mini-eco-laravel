@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Heading -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                {{ isset($banner) ? 'Edit Banner' : 'Add Banner' }}
            </h4>
            <p class="text-muted small mb-0">
                {{ isset($banner) ? 'Update banner details.' : 'Create a new homepage banner.' }}
            </p>
        </div>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ isset($banner) ? route('admin.banners.update',$banner->id) : route('admin.banners.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($banner))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <!-- Title -->
                    <div class="col-md-6">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input type="text"
                               id="title"
                               name="title"
                               class="form-control form-control-lg rounded-3"
                               value="{{ old('title',$banner->title ?? '') }}"
                               placeholder="Banner title">
                    </div>

                    <!-- Subtitle -->
                    <div class="col-md-6">
                        <label for="subtitle" class="form-label fw-semibold">Subtitle</label>
                        <input type="text"
                               id="subtitle"
                               name="subtitle"
                               class="form-control form-control-lg rounded-3"
                               value="{{ old('subtitle',$banner->subtitle ?? '') }}"
                               placeholder="Banner subtitle">
                    </div>

                    <!-- Button Text -->
                    <div class="col-md-6">
                        <label for="button_text" class="form-label fw-semibold">Button Text</label>
                        <input type="text"
                               id="button_text"
                               name="button_text"
                               class="form-control rounded-3"
                               value="{{ old('button_text',$banner->button_text ?? '') }}"
                               placeholder="e.g. Shop Now">
                    </div>

                    <!-- Button Link -->
                    <div class="col-md-6">
                        <label for="button_link" class="form-label fw-semibold">Button Link</label>
                        <input type="text"
                               id="button_link"
                               name="button_link"
                               class="form-control rounded-3"
                               value="{{ old('button_link',$banner->button_link ?? '') }}"
                               placeholder="e.g. /products">
                    </div>

                    <!-- Image -->
                    <div class="col-md-6">
                        <label for="image" class="form-label fw-semibold">Image</label>
                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control rounded-3"
                               accept="image/*">
                        <div class="form-text">Recommended size: 1920 x 800 pixels.</div>
                        @if(isset($banner))
                            <div class="mt-2">
                                <img src="{{ asset('uploads/banners/'.$banner->image) }}"
                                     width="120"
                                     class="rounded-2 border shadow-sm"
                                     alt="Current banner image">
                            </div>
                        @endif
                    </div>

                    <!-- Position -->
                    <div class="col-md-6">
                        <label for="position" class="form-label fw-semibold">Position</label>
                        <select id="position" name="position" class="form-select rounded-3">
                            <option value="top" {{ old('position',$banner->position ?? '')=='top'?'selected':'' }}>Top</option>
                            <option value="middle" {{ old('position',$banner->position ?? '')=='middle'?'selected':'' }}>Middle</option>
                            <option value="bottom" {{ old('position',$banner->position ?? '')=='bottom'?'selected':'' }}>Bottom</option>
                            <option value="offer" {{ old('position',$banner->position ?? '')=='offer'?'selected':'' }}>Offer</option>
                        </select>
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-6">
                        <label for="display_order" class="form-label fw-semibold">Display Order</label>
                        <input type="number"
                               id="display_order"
                               name="display_order"
                               class="form-control rounded-3"
                               value="{{ old('display_order',$banner->display_order ?? 0) }}"
                               min="0">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <select id="status" name="status" class="form-select rounded-3">
                            <option value="1" {{ old('status',$banner->status ?? '')==1?'selected':'' }}>Active</option>
                            <option value="0" {{ old('status',$banner->status ?? '')==0?'selected':'' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> Save Banner
                        </button>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 ms-2">
                            Cancel
                        </a>
                    </div>
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
    .form-control-lg, .form-select-lg {
        font-size: 0.95rem;
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
    }
    .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.4rem;
        color: #2c3e50;
    }
    .card-body {
        background: #ffffff;
    }
</style>
@endpush