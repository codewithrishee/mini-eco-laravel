
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 blogs-page">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fas fa-blog me-2 text-primary"></i>Blogs
            </h4>
            <p class="text-muted small mb-0">Manage Rv-Store blog articles.</p>
        </div>

        <a href="{{ route('admin.blogs.create') }}"
           class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-1"></i> Add Blog
        </a>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Desktop Table -->
    <div class="card border-0 shadow-sm rounded-4 desktop-table">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="py-3 ps-4">#</th>
                            <th scope="col" class="py-3">Image</th>
                            <th scope="col" class="py-3">Title</th>
                            <th scope="col" class="py-3">Category</th>
                            <th scope="col" class="py-3">Author</th>
                            <th scope="col" class="py-3">Featured</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="py-3">Date</th>
                            <th scope="col" class="py-3 pe-4 text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($blogs as $blog)
                            <tr>
                                <td class="ps-4 fw-semibold">{{ $loop->iteration }}</td>

                                <td>
                                    @if($blog->image)
                                        <img
                                            src="{{ \Illuminate\Support\Str::startsWith($blog->image, ['http://', 'https://']) ? $blog->image : asset('uploads/blogs/' . $blog->image) }}"
                                            alt="{{ $blog->title }}"
                                            width="70"
                                            height="55"
                                            class="rounded-2 border object-fit-cover">
                                    @else
                                        <span class="text-muted small">No Image</span>
                                    @endif
                                </td>

                                <td class="fw-medium">{{ $blog->title }}</td>

                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                        {{ $blog->category }}
                                    </span>
                                </td>

                                <td>{{ $blog->author ?? '-' }}</td>

                                <td>
                                    @if($blog->is_featured)
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">
                                            <i class="fas fa-star me-1"></i> Featured
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                            <i class="fas fa-circle me-1"></i> No
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if($blog->status)
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">
                                            <i class="fas fa-times-circle me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $blog->created_at->format('d M Y') }}</td>

                                <td class="pe-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">

                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                           class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Delete this blog?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <i class="fas fa-blog display-3 text-muted opacity-25 d-block mb-3"></i>
                                    <h5 class="fw-light text-muted">No Blogs Found.</h5>
                                    <p class="text-muted small mb-0">Click "Add Blog" to write your first article.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Mobile Blog Cards -->
    <div class="mobile-cards">
        @forelse($blogs as $blog)
            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-3">

                    <div class="d-flex align-items-start gap-3 mb-3">

                        <!-- Blog Image -->
                        <div class="blog-image">
                            @if($blog->image)
                                <img
                                    src="{{ \Illuminate\Support\Str::startsWith($blog->image, ['http://', 'https://']) ? $blog->image : asset('uploads/blogs/' . $blog->image) }}"
                                    alt="{{ $blog->title }}"
                                    class="rounded-2 border object-fit-cover">
                            @else
                                <div class="no-image">
                                    <i class="fas fa-blog"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Blog Details -->
                        <div class="flex-grow-1 min-width-0">

                            <h6 class="fw-bold text-dark mb-2 blog-title">
                                {{ $blog->title }}
                            </h6>

                            <div class="d-flex flex-wrap gap-2 mb-2">
                                <span class="badge bg-light text-dark border rounded-pill">
                                    {{ $blog->category }}
                                </span>

                                @if($blog->is_featured)
                                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill">
                                        <i class="fas fa-star me-1"></i> Featured
                                    </span>
                                @endif
                            </div>

                            <p class="text-muted small mb-1">
                                <i class="fas fa-user me-1"></i>{{ $blog->author ?? '-' }}
                            </p>

                            <p class="text-muted small mb-2">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $blog->created_at->format('d M Y') }}
                            </p>

                            @if($blog->status)
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill">
                                    <i class="fas fa-check-circle me-1"></i> Active
                                </span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill">
                                    <i class="fas fa-times-circle me-1"></i> Inactive
                                </span>
                            @endif

                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2 mobile-actions">

                        <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                           class="btn btn-outline-primary rounded-pill flex-fill">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>

                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}"
                              method="POST"
                              class="flex-fill"
                              onsubmit="return confirm('Delete this blog?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-danger rounded-pill w-100">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        @empty
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center py-5">
                    <i class="fas fa-blog display-3 text-muted opacity-25 d-block mb-3"></i>
                    <h5 class="fw-light text-muted">No Blogs Found.</h5>
                    <p class="text-muted small mb-0">Click "Add Blog" to write your first article.</p>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection

@push('styles')
<style>
    .blogs-page .rounded-4 {
        border-radius: 1rem !important;
    }

    .blogs-page .bg-opacity-10 {
        --bs-bg-opacity: 0.1;
    }

    .blogs-page .table th {
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6c757d;
        border-bottom: 2px solid #e9ecef;
        white-space: nowrap;
    }

    .blogs-page .table td {
        vertical-align: middle;
        padding: 0.75rem 0.5rem;
    }

    .blogs-page .table tbody tr {
        transition: background 0.15s ease;
    }

    .blogs-page .table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .blogs-page .btn-outline-primary,
    .blogs-page .btn-outline-danger {
        border-width: 1.5px;
    }

    .blogs-page .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .blogs-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }

    .blogs-page .alert-success {
        background-color: #e8f5e9;
        border-left: 4px solid #28a745;
        color: #1e7e34;
    }

    .blogs-page .object-fit-cover {
        object-fit: cover;
    }

    .blogs-page .mobile-cards {
        display: none;
    }

    .blogs-page .min-width-0 {
        min-width: 0;
    }

    .blogs-page .blog-image {
        width: 105px;
        height: 78px;
        min-width: 105px;
    }

    .blogs-page .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .blogs-page .no-image {
        width: 100%;
        height: 100%;
        border-radius: 8px;
        background: #f1f3f9;
        color: #9ba3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .blogs-page .blog-title {
        overflow-wrap: anywhere;
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .blogs-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }

        .blogs-page h4 {
            font-size: 1.2rem;
        }

        .blogs-page > .d-flex > a {
            width: 100%;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blogs-page .desktop-table {
            display: none;
        }

        .blogs-page .mobile-cards {
            display: block;
        }

        .blogs-page .mobile-cards .card-body {
            padding: 1rem !important;
        }

        .blogs-page .mobile-actions {
            gap: 10px;
        }

        .blogs-page .mobile-actions .btn {
            min-height: 40px;
            font-size: 0.875rem;
        }
    }

    @media (max-width: 400px) {
        .blogs-page .blog-image {
            width: 88px;
            height: 72px;
            min-width: 88px;
        }

        .blogs-page .mobile-actions {
            gap: 8px;
        }
    }
</style>
@endpush
