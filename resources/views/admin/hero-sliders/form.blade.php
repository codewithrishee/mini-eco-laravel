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
                               class="form-control"
                               value="{{ old('badge', $slider->badge ?? '') }}">
                    </div>

                    <!-- Display Order -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number"
                               name="display_order"
                               class="form-control"
                               value="{{ old('display_order', $slider->display_order ?? 1) }}">
                    </div>

                    <!-- Title -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               value="{{ old('title', $slider->title ?? '') }}"
                               required>
                    </div>

                    <!-- Description -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control">{{ old('description', $slider->description ?? '') }}</textarea>
                    </div>

                    <!-- Button 1 -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 1 Text</label>
                        <input type="text"
                               name="button1_text"
                               class="form-control"
                               value="{{ old('button1_text', $slider->button1_text ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 1 Link</label>
                        <input type="text"
                               name="button1_link"
                               class="form-control"
                               value="{{ old('button1_link', $slider->button1_link ?? '') }}">
                    </div>

                    <!-- Button 2 -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 2 Text</label>
                        <input type="text"
                               name="button2_text"
                               class="form-control"
                               value="{{ old('button2_text', $slider->button2_text ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Button 2 Link</label>
                        <input type="text"
                               name="button2_link"
                               class="form-control"
                               value="{{ old('button2_link', $slider->button2_link ?? '') }}">
                    </div>

                    <!-- Image -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slider Image</label>
                        <input type="file"
                               name="image"
                               class="form-control">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">

                            <option value="1"
                                {{ old('status', $slider->status ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('status', $slider->status ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>
                    </div>

                    <!-- Preview -->
                    @if(isset($slider) && $slider->image)

                    <div class="col-md-12 mb-3">

                        <label class="form-label d-block">
                            Current Image
                        </label>

                        <img src="{{ asset('uploads/hero-sliders/'.$slider->image) }}"
                             width="180"
                             class="rounded shadow">

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