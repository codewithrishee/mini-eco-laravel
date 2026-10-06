<link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">

{{-- ================= HEADER ================= --}}
<header class="navbar-custom sticky-top" id="mainHeader">
    <nav class="container d-flex align-items-center justify-content-between flex-wrap gap-2">

        {{-- Logo --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-store"></i>RV<span>Store</span>
        </a>

        {{-- ================= DESKTOP NAVIGATION ================= --}}
        <ul class="nav d-none d-lg-flex">

            {{-- Home --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    Home
                </a>
            </li>

            {{-- Shop --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">
                    Shop
                </a>
            </li>

            {{-- Categories --}}
            <li class="nav-item category-dropdown">
                <a class="nav-link {{ request()->routeIs('categories.index', 'category.show') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                    Categories
                    <i class="fas fa-chevron-down ms-1"></i>
                </a>

                {{-- Hover Dropdown --}}
                <ul class="category-dropdown-menu">
                    @forelse($categories as $category)
                        <li>
                            <a href="{{ route('category.show', $category->slug) }}"
                               class="{{ request()->is('category/' . $category->slug) ? 'active' : '' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @empty
                        <li>
                            <span>No Categories Found</span>
                        </li>
                    @endforelse
                </ul>
            </li>

            {{-- About --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                    About
                </a>
            </li>

            {{-- Blogs --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}" href="{{ route('blog') }}">
                    Blogs
                </a>
            </li>

            {{-- Contact --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                    Contact
                </a>
            </li>
        </ul>

        {{-- Search --}}
        <form action="{{ route('shop') }}"
      method="GET"
      class="search-form d-none d-md-block">

    <i class="fas fa-search"></i>

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Search products..."
           autocomplete="off">

</form>

        {{-- Mobile Menu Button --}}
        <div class="header-icons">
            <button class="btn btn-link d-lg-none p-0 border-0 text-dark"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#mobileOffcanvas"
                    aria-controls="mobileOffcanvas">
                <i class="fas fa-bars fs-4"></i>
            </button>
        </div>
    </nav>
</header>

{{-- ================= MOBILE OFFCANVAS ================= --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileOffcanvas">
    <div class="offcanvas-header border-bottom">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-store"></i>RV<span>Store</span>
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column">

        {{-- Mobile Search --}}
    <form action="{{ route('shop') }}"
      method="GET"
      class="search-form w-100 mb-4">

    <i class="fas fa-search"></i>

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Search products..."
           class="w-100"
           autocomplete="off">

</form>

        {{-- Mobile Navigation --}}
        <ul class="nav flex-column gap-2 mb-4">

            {{-- Home --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="fas fa-home me-2"></i>Home
                </a>
            </li>

            {{-- Shop --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">
                    <i class="fas fa-store-alt me-2"></i>Shop
                </a>
            </li>

            {{-- All Categories Page --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                    <i class="fas fa-th-large me-2"></i>Categories
                </a>
            </li>

            {{-- Mobile Individual Categories --}}
            @foreach($categories as $category)
                <li class="nav-item ps-4">
                    <a class="nav-link {{ request()->is('category/' . $category->slug) ? 'active' : '' }}"
                       href="{{ route('category.show', $category->slug) }}">
                        <i class="fas fa-angle-right me-2"></i>{{ $category->name }}
                    </a>
                </li>
            @endforeach

            {{-- About --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                    <i class="fas fa-info-circle me-2"></i>About
                </a>
            </li>

            {{-- Blogs --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}" href="{{ route('blog') }}">
                    <i class="fas fa-blog me-2"></i>Blogs
                </a>
            </li>

            {{-- Contact --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                    <i class="fas fa-envelope me-2"></i>Contact
                </a>
            </li>
        </ul>

        <hr class="my-2">

        {{-- Mobile Footer --}}
        <div class="mt-auto pt-4 text-center text-muted small">
            <i class="fas fa-store me-1"></i>RV Store &bull; 2026
        </div>
    </div>
</div>