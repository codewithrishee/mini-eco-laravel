@extends('layouts.app')
@section('title', 'Blog-Details | RvStore')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/blog-details.css') }}">

<div class="blog-details-page">

    <!-- =====================================================
         BREADCRUMB
    ===================================================== -->
    <section class="blog-breadcrumb py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-transparent p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ url('/blog') }}" class="text-decoration-none">Blog</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $blog->title }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- =====================================================
         ARTICLE HEADER
    ===================================================== -->
    <section class="blog-header-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">

                    <!-- Category Badge -->
                    <div class="article-category-wrapper mb-3">
                        <span class="article-category-badge">
                            {{ $blog->category }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="article-title">
                        {{ $blog->title }}
                    </h1>

                    <!-- Meta -->
                    <div class="article-meta d-flex flex-wrap align-items-center gap-3 mt-4">
                        <span class="meta-item">
                            <i class="bi bi-calendar3"></i>
                            {{ $blog->created_at->format('d M Y') }}
                        </span>

                        @if($blog->author)
                            <span class="meta-item">
                                <i class="bi bi-person"></i>
                                {{ $blog->author }}
                            </span>
                        @endif

                        <span class="meta-item">
                            <i class="bi bi-clock"></i>
                            {{ $blog->read_time }} min read
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================
         FEATURED IMAGE
    ===================================================== -->
    @if($blog->image)
        <section class="blog-featured-image-section pb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-9">
                        <div class="featured-image-wrapper">
                            <img src="{{ asset('uploads/blogs/'.$blog->image) }}"
                                 alt="{{ $blog->title }}"
                                 class="featured-image img-fluid w-100">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- =====================================================
         ARTICLE CONTENT
    ===================================================== -->
    <section class="blog-content-section pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">

                    <!-- Short Description / Intro -->
                    @if($blog->short_description)
                        <div class="blog-intro mb-4">
                            <p class="intro-text">
                                {{ $blog->short_description }}
                            </p>
                        </div>
                    @endif

                    <!-- Full Content -->
                    <div class="blog-content">
                        {!! nl2br(e($blog->content)) !!}
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================
         ARTICLE FOOTER - Category & Share
    ===================================================== -->
    <section class="blog-footer-section py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <div class="article-footer d-flex flex-wrap align-items-center justify-content-between gap-3 pt-4 border-top">

                        <!-- Category -->
                        <div class="article-category-tag">
                            <span class="text-muted me-2">Category:</span>
                            <span class="category-label">{{ $blog->category }}</span>
                        </div>

                        <!-- Share -->
                        <div class="article-share d-flex align-items-center gap-2">
                            <span class="text-muted me-1">Share:</span>

                            <!-- WhatsApp -->
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' - ' . url()->current()) }}"
                               target="_blank"
                               class="share-link whatsapp"
                               aria-label="Share on WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>

                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="share-link facebook"
                               aria-label="Share on Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>

                            <!-- Copy Link -->
                            <button type="button"
                                    class="share-link copy-link"
                                    onclick="copyArticleLink()"
                                    aria-label="Copy link">
                                <i class="bi bi-link-45deg"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================
         RELATED ARTICLES
    ===================================================== -->
    @if($relatedBlogs->count())
        <section class="related-blogs-section py-5 bg-light">
            <div class="container">

                <div class="section-header text-center mb-5">
                    <span class="section-tag text-uppercase small fw-semibold text-muted">Keep Reading</span>
                    <h2 class="section-heading fs-2 fw-bold">Related <span class="text-primary">Articles</span></h2>
                </div>

                <div class="row g-4">

                    @foreach($relatedBlogs as $relatedBlog)

                        <div class="col-lg-4 col-md-6">

                            <article class="related-card h-100">

                                <div class="related-card-image">
                                    @if($relatedBlog->image)
                                        <img src="{{ asset('uploads/blogs/'.$relatedBlog->image) }}"
                                             alt="{{ $relatedBlog->title }}"
                                             class="card-img">
                                    @else
                                        <div class="card-image-placeholder">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                    <span class="related-category-badge">{{ $relatedBlog->category }}</span>
                                </div>

                                <div class="related-card-body">

                                    <div class="related-meta d-flex flex-wrap gap-3 small text-muted">
                                        <span>
                                            <i class="bi bi-calendar3"></i>
                                            {{ $relatedBlog->created_at->format('d M Y') }}
                                        </span>
                                        <span>
                                            <i class="bi bi-clock"></i>
                                            {{ $relatedBlog->read_time }} min read
                                        </span>
                                    </div>

                                    <h3 class="related-card-title">
                                        <a href="{{ route('blog.details', $relatedBlog->slug) }}" class="text-decoration-none text-dark">
                                            {{ $relatedBlog->title }}
                                        </a>
                                    </h3>

                                    <p class="related-card-excerpt">
                                        {{ \Illuminate\Support\Str::limit($relatedBlog->short_description, 120) }}
                                    </p>

                                    <a href="{{ route('blog.details', $relatedBlog->slug) }}"
                                       class="read-more-link">
                                        Read More
                                        <i class="bi bi-arrow-right"></i>
                                    </a>

                                </div>

                            </article>

                        </div>

                    @endforeach

                </div>
            </div>
        </section>
    @endif

</div> <!-- end blog-details-page -->


<!-- =====================================================
     PAGE-SPECIFIC STYLES
===================================================== -->
<style>
/* ============================================
   BLOG DETAILS PAGE - Premium Design
   Scoped under .blog-details-page
   ============================================ */

.blog-details-page {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* ----- Breadcrumb ----- */
.blog-details-page .breadcrumb {
    font-size: 0.95rem;
}
.blog-details-page .breadcrumb-item a {
    color: #6c757d;
    transition: color 0.2s;
}
.blog-details-page .breadcrumb-item a:hover {
    color: #198754;
}
.blog-details-page .breadcrumb-item.active {
    color: #212529;
    font-weight: 500;
}

/* ----- Article Header ----- */
.blog-details-page .article-category-badge {
    display: inline-block;
    background: #198754;
    color: #fff;
    padding: 0.3rem 1.2rem;
    border-radius: 30px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.blog-details-page .article-title {
    font-size: 2.8rem;
    font-weight: 700;
    color: #1f2937;
    line-height: 1.2;
    margin-bottom: 0;
}

.blog-details-page .article-meta .meta-item {
    color: #6c757d;
    font-size: 0.95rem;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
}
.blog-details-page .article-meta .meta-item i {
    font-size: 1rem;
}

/* ----- Featured Image ----- */
.blog-details-page .featured-image-wrapper {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    background: #f8f9fa;
}
.blog-details-page .featured-image {
    height: 520px;
    object-fit: cover;
    display: block;
}

/* ----- Article Content ----- */
.blog-details-page .blog-intro .intro-text {
    font-size: 1.2rem;
    font-weight: 500;
    color: #2c3e50;
    line-height: 1.8;
    padding-left: 1.2rem;
    border-left: 4px solid #198754;
    background: #f8f9fa;
    padding: 1.2rem 1.5rem;
    border-radius: 8px;
}

.blog-details-page .blog-content {
    color: #374151;
    font-size: 1.05rem;
    line-height: 1.9;
}

.blog-details-page .blog-content p {
    margin-bottom: 1.5rem;
}

.blog-details-page .blog-content h2,
.blog-details-page .blog-content h3,
.blog-details-page .blog-content h4 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
    color: #1f2937;
}

.blog-details-page .blog-content ul,
.blog-details-page .blog-content ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.blog-details-page .blog-content li {
    margin-bottom: 0.5rem;
}

.blog-details-page .blog-content blockquote {
    border-left: 4px solid #198754;
    padding: 1rem 1.5rem;
    margin: 1.5rem 0;
    background: #f8f9fa;
    border-radius: 0 8px 8px 0;
    font-style: italic;
    color: #4a5568;
}

.blog-details-page .blog-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 1.5rem 0;
}

/* ----- Article Footer / Share ----- */
.blog-details-page .article-footer {
    border-top-color: #e9ecef !important;
}

.blog-details-page .category-label {
    background: #f1f3f5;
    padding: 0.2rem 1rem;
    border-radius: 20px;
    font-weight: 500;
    color: #1f2937;
}

.blog-details-page .share-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    border: none;
    background: #f1f3f5;
    color: #495057;
    font-size: 1.1rem;
    transition: all 0.2s;
    text-decoration: none;
    cursor: pointer;
}

.blog-details-page .share-link:hover {
    transform: translateY(-2px);
    background: #198754;
    color: #fff;
}

.blog-details-page .share-link.whatsapp:hover {
    background: #25d366;
}

.blog-details-page .share-link.facebook:hover {
    background: #1877f2;
}

.blog-details-page .share-link.copy-link {
    background: #f1f3f5;
    color: #495057;
}
.blog-details-page .share-link.copy-link:hover {
    background: #198754;
    color: #fff;
}

/* ----- Related Articles ----- */
.blog-details-page .related-card {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    transition: transform 0.3s, box-shadow 0.3s;
    border: 1px solid #f0f0f0;
}

.blog-details-page .related-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

.blog-details-page .related-card-image {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: #f8f9fa;
}

.blog-details-page .related-card-image .card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.blog-details-page .related-card:hover .card-img {
    transform: scale(1.04);
}

.blog-details-page .related-card-image .card-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f3f5;
    font-size: 3rem;
}

.blog-details-page .related-category-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(25, 135, 84, 0.9);
    color: #fff;
    padding: 0.2rem 0.8rem;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.blog-details-page .related-card-body {
    padding: 1.5rem;
}

.blog-details-page .related-meta {
    font-size: 0.85rem;
    color: #6c757d;
}

.blog-details-page .related-meta i {
    margin-right: 0.2rem;
}

.blog-details-page .related-card-title {
    font-size: 1.15rem;
    font-weight: 600;
    margin: 0.6rem 0 0.5rem;
    line-height: 1.3;
}

.blog-details-page .related-card-title a {
    transition: color 0.2s;
}
.blog-details-page .related-card-title a:hover {
    color: #198754 !important;
}

.blog-details-page .related-card-excerpt {
    color: #6b7280;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.blog-details-page .read-more-link {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    color: #198754;
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    transition: gap 0.2s;
}

.blog-details-page .read-more-link:hover {
    gap: 0.7rem;
    color: #157347;
}

.blog-details-page .read-more-link i {
    font-size: 0.9rem;
}

/* ----- Section Helpers ----- */
.blog-details-page .section-tag {
    font-size: 0.85rem;
    letter-spacing: 1px;
    color: #6c757d;
    text-transform: uppercase;
}

.blog-details-page .section-heading {
    font-weight: 700;
    color: #1f2937;
}

.blog-details-page .section-heading .text-primary {
    color: #198754 !important;
}

/* ============================================
   RESPONSIVE DESIGN
   ============================================ */

@media (max-width: 992px) {
    .blog-details-page .article-title {
        font-size: 2.2rem;
    }
    .blog-details-page .featured-image {
        height: 420px;
    }
}

@media (max-width: 768px) {
    .blog-details-page .article-title {
        font-size: 1.8rem;
    }
    .blog-details-page .featured-image {
        height: 320px;
    }
    .blog-details-page .article-meta {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0.5rem 1rem;
    }
    .blog-details-page .article-meta .meta-item {
        font-size: 0.85rem;
    }
    .blog-details-page .blog-content {
        font-size: 1rem;
    }
    .blog-details-page .blog-intro .intro-text {
        font-size: 1.05rem;
        padding: 1rem;
    }
    .blog-details-page .article-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    .blog-details-page .related-card-image {
        height: 180px;
    }
}

@media (max-width: 576px) {
    .blog-details-page .article-title {
        font-size: 1.5rem;
    }
    .blog-details-page .featured-image {
        height: 240px;
    }
    .blog-details-page .blog-content {
        font-size: 0.95rem;
    }
    .blog-details-page .blog-intro .intro-text {
        font-size: 0.95rem;
        padding: 0.8rem 1rem;
    }
    .blog-details-page .related-card-image {
        height: 160px;
    }
    .blog-details-page .related-card-body {
        padding: 1.2rem;
    }
    .blog-details-page .related-card-title {
        font-size: 1rem;
    }
    .blog-details-page .blog-breadcrumb .breadcrumb {
        font-size: 0.85rem;
    }
}
</style>


<!-- =====================================================
     PAGE-SPECIFIC JAVASCRIPT
===================================================== -->
<script>
    function copyArticleLink() {
        const url = window.location.href;
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(url).then(() => {
                // Optional: show a temporary feedback
                const btn = document.querySelector('.copy-link');
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check-lg"></i>';
                btn.style.background = '#198754';
                btn.style.color = '#fff';
                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.style.background = '';
                    btn.style.color = '';
                }, 2000);
            }).catch(() => {
                fallbackCopyLink(url);
            });
        } else {
            fallbackCopyLink(url);
        }
    }

    function fallbackCopyLink(url) {
        const tempInput = document.createElement('input');
        tempInput.value = url;
        document.body.appendChild(tempInput);
        tempInput.select();
        try {
            document.execCommand('copy');
            // Optional feedback
            const btn = document.querySelector('.copy-link');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-check-lg"></i>';
            btn.style.background = '#198754';
            btn.style.color = '#fff';
            setTimeout(() => {
                btn.innerHTML = originalHtml;
                btn.style.background = '';
                btn.style.color = '';
            }, 2000);
        } catch (err) {
            // Silent fail
        }
        document.body.removeChild(tempInput);
    }
</script>

@endsection