@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                <i class="fas fa-blog me-2 text-primary"></i>Blogs
            </h4>
            <p class="text-muted small mb-0">Manage Rv-Store blog articles.</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
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

    <!-- Blogs Table -->
    <div class="card border-0 shadow-sm rounded-4">
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
                                        <img src="{{ asset('uploads/blogs/'.$blog->image) }}"
                                             alt="{{ $blog->title }}"
                                             width="70"
                                             height="55"
                                             class="rounded-2 border object-fit-cover"
                                             style="object-fit:cover;">
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
    .btn-outline-primary {
        border-width: 1.5px;
    }
    .btn-outline-danger {
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
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush