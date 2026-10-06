@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="bi bi-sliders2 me-2 text-primary"></i>Attributes Management
            </h4>
            <p class="text-muted small mb-0">Manage Colors, Sizes, Materials &amp; Tags</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4">
        <!-- Colors -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-card">
                <div class="card-body text-center p-4">
                    <div class="icon-circle bg-primary bg-opacity-10 mx-auto mb-3">
                        <i class="bi bi-palette fs-1 text-primary"></i>
                    </div>
                    <h4 class="fw-semibold text-dark">Colors</h4>
                    <h2 class="fw-bold text-primary mb-1">{{ $colors }}</h2>
                    <p class="text-muted small">Total Colors</p>
                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('admin.attributes.create','colors') }}" class="btn btn-primary rounded-pill">
                            <i class="bi bi-plus-circle me-1"></i> Add Color
                        </a>
                        <a href="{{ route('admin.attributes.index','colors') }}" class="btn btn-outline-primary rounded-pill">
                            <i class="bi bi-eye me-1"></i> View Colors
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sizes -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-card">
                <div class="card-body text-center p-4">
                    <div class="icon-circle bg-success bg-opacity-10 mx-auto mb-3">
                        <i class="bi bi-rulers fs-1 text-success"></i>
                    </div>
                    <h4 class="fw-semibold text-dark">Sizes</h4>
                    <h2 class="fw-bold text-success mb-1">{{ $sizes }}</h2>
                    <p class="text-muted small">Total Sizes</p>
                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('admin.attributes.create','sizes') }}" class="btn btn-success rounded-pill">
                            <i class="bi bi-plus-circle me-1"></i> Add Size
                        </a>
                        <a href="{{ route('admin.attributes.index','sizes') }}" class="btn btn-outline-success rounded-pill">
                            <i class="bi bi-eye me-1"></i> View Sizes
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Materials -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-card">
                <div class="card-body text-center p-4">
                    <div class="icon-circle bg-warning bg-opacity-10 mx-auto mb-3">
                        <i class="bi bi-box-seam fs-1 text-warning"></i>
                    </div>
                    <h4 class="fw-semibold text-dark">Materials</h4>
                    <h2 class="fw-bold text-warning mb-1">{{ $materials }}</h2>
                    <p class="text-muted small">Total Materials</p>
                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('admin.attributes.create','materials') }}" class="btn btn-warning rounded-pill text-dark">
                            <i class="bi bi-plus-circle me-1"></i> Add Material
                        </a>
                        <a href="{{ route('admin.attributes.index','materials') }}" class="btn btn-outline-warning rounded-pill">
                            <i class="bi bi-eye me-1"></i> View Materials
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tags -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-card">
                <div class="card-body text-center p-4">
                    <div class="icon-circle bg-danger bg-opacity-10 mx-auto mb-3">
                        <i class="bi bi-tags fs-1 text-danger"></i>
                    </div>
                    <h4 class="fw-semibold text-dark">Tags</h4>
                    <h2 class="fw-bold text-danger mb-1">{{ $tags }}</h2>
                    <p class="text-muted small">Total Tags</p>
                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('admin.attributes.create','tags') }}" class="btn btn-danger rounded-pill">
                            <i class="bi bi-plus-circle me-1"></i> Add Tag
                        </a>
                        <a href="{{ route('admin.attributes.index','tags') }}" class="btn btn-outline-danger rounded-pill">
                            <i class="bi bi-eye me-1"></i> View Tags
                        </a>
                    </div>
                </div>
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
    .hover-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .hover-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08) !important;
    }
    .icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .icon-circle i {
        line-height: 1;
    }
    .btn {
        font-weight: 500;
        border-width: 1.5px;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102,126,234,0.4);
        color: #fff;
    }
    .btn-success {
        background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(74,222,128,0.4);
    }
    .btn-warning {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(251,191,36,0.4);
    }
    .btn-danger {
        background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
        border: none;
        transition: all 0.3s ease;
    }
    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(248,113,113,0.4);
    }
    .btn-outline-primary, .btn-outline-success, .btn-outline-warning, .btn-outline-danger {
        transition: all 0.3s ease;
    }
    .btn-outline-primary:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102,126,234,0.3);
    }
    .btn-outline-success:hover {
        background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(74,222,128,0.3);
    }
    .btn-outline-warning:hover {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: #212529;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(251,191,36,0.3);
    }
    .btn-outline-danger:hover {
        background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(248,113,113,0.3);
    }
    .card-body {
        background: #ffffff;
    }
    .text-warning {
        color: #d97706 !important;
    }
</style>
@endpush