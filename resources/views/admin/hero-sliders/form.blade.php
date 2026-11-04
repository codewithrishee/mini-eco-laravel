
@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">
                {{ isset($slider) ? 'Edit Hero Slider' : 'Add Hero Slider' }}
            </h3>
            <p class="text-muted mb-0">
                {{ isset($slider) ? 'Update slider details.' : 'Create a new hero slider.' }}
            </p>
        </div>

        <a href="{{ route('admin.hero-sliders.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Validation Errors:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ isset($slider)
                ? route('admin.hero-sliders.update', $slider->id)
                : route('admin.hero-sliders.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                @if(isset($slider))
                    @method('PUT')
                @endif

                <div class="row">

                    <!-- Badge -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Badge</label>
                        <input type="text"
                               name="badge"
                               class="form-control @error('badge') is-invalid @enderror"
                               value="{{ old('badge', $slider->badge ?? '') }}">

                        @error('badge')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number"
                               name="display_order"
                               class="form-control @error('display_order') is-invalid @enderror"
                               value="{{ old('display_order', $slider->display_order ?? 1) }}"
                               required>

                        @error('display_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $slider->title ?? '') }}"
                               required>

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $slider->description ?? '') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Button 1 -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 1 Text</label>
                        <input type="text"
                               name="button1_text"
                               class="form-control @error('button1_text') is-invalid @enderror"
                               value="{{ old('button1_text', $slider->button1_text ?? '') }}">

                        @error('button1_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 1 Link</label>
                        <input type="text"
                               name="button1_link"
                               class="form-control @error('button1_link') is-invalid @enderror"
                               value="{{ old('button1_link', $slider->button1_link ?? '') }}">

                        @error('button1_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Button 2 -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 2 Text</label>
                        <input type="text"
                               name="button2_text"
                               class="form-control @error('button2_text') is-invalid @enderror"
                               value="{{ old('button2_text', $slider->button2_text ?? '') }}">

                        @error('button2_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 2 Link</label>
                        <input type="text"
                               name="button2_link"
                               class="form-control @error('button2_link') is-invalid @enderror"
                               value="{{ old('button2_link', $slider->button2_link ?? '') }}">

                        @error('button2_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Slider Image
                            @if(!isset($slider))
                                <span class="text-danger">*</span>
                            @endif
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control @error('image') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp"
                               {{ !isset($slider) ? 'required' : '' }}>

                        <small class="text-muted">
                            JPG, JPEG, PNG or WebP. Maximum size: 2 MB.
                            @if(isset($slider))
                                Leave empty to keep the current image.
                            @endif
                        </small>

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>

                        <select name="status"
                                class="form-select @error('status') is-invalid @enderror">

                            <option value="1"
                                {{ old('status', $slider->status ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status', $slider->status ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Image Preview -->
                    @if(isset($slider) && $slider->image)

                        <div class="col-md-12 mb-3">

                            <label class="form-label d-block">
                                Current Image
                            </label>

                            <img
                                src="{{ \Illuminate\Support\Str::startsWith($slider->image, ['http://', 'https://']) ? $slider->image : asset('uploads/hero-sliders/'.$slider->image) }}"
                                width="180"
                                height="110"
                                style="object-fit: cover;"
                                class="rounded shadow border"
                                alt="{{ $slider->title }}"
                            >

                        </div>

                    @endif

                </div>

                <button type="submit" class="btn btn-success">
                    {{ isset($slider) ? 'Update Slider' : 'Save Slider' }}
                </button>

            </form>

        </div>
    </div>

</div>

@endsection
