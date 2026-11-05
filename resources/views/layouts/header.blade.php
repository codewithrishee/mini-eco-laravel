
<link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">

<header class="navbar-custom sticky-top" id="mainHeader">
    <nav class="container d-flex align-items-center gap-3">

        {{-- Logo --}}
        <a class="navbar-brand" href="{{ route('home') }}">
    <img src="{{ asset('assets/images/logo.png') }}"
         alt="RV Store"
         class="navbar-logo">
</a>

        {{-- Desktop Navigation --}}
        <ul class="nav d-none d-lg-flex mx-auto">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                   href="{{ route('home') }}">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('shop') ? 'active' : '' }}"
                   href="{{ route('shop') }}">Shop</a>
            </li>

            <li class="nav-item category-dropdown">
                <a class="nav-link {{ request()->routeIs('categories.index', 'category.show') ? 'active' : '' }}"
                   href="{{ route('categories.index') }}">
                    Categories <i class="fas fa-chevron-down ms-1"></i>
                </a>

                <ul class="category-dropdown-menu">
                    @forelse($categories as $category)
                        <li>
                            <a href="{{ route('category.show', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @empty
                        <li><span>No Categories Found</span></li>
                    @endforelse
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                   href="{{ route('about') }}">About</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}"
                   href="{{ route('blog') }}">Blogs</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                   href="{{ route('contact') }}">Contact</a>
            </li>
        </ul>

        {{-- Search --}}
        <form action="{{ route('shop') }}" method="GET"
              class="search-form d-none d-md-block">
            <i class="fas fa-search"></i>
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   placeholder="Search products..."
                   autocomplete="off">
        </form>

        {{-- Mobile Menu --}}
        <button class="mobile-menu-btn d-lg-none ms-auto"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileOffcanvas"
                aria-controls="mobileOffcanvas"
                aria-label="Open menu">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
</header>

{{-- Mobile Offcanvas --}}
<div class="offcanvas offcanvas-end mobile-menu"
     tabindex="-1"
     id="mobileOffcanvas"
     aria-labelledby="mobileMenuLabel">

    <div class="offcanvas-header">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-store"></i> RV<span>Store</span>
        </a>

        <button type="button" class="mobile-close-btn"
                data-bs-dismiss="offcanvas"
                aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="offcanvas-body">

        {{-- Menu Heading --}}
        <p class="mobile-menu-label" id="mobileMenuLabel">
            MENU
        </p>

        {{-- Search --}}
        <form action="{{ route('shop') }}" method="GET"
              class="search-form mobile-search">
            <i class="fas fa-search"></i>
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   placeholder="Search products..."
                   autocomplete="off">
        </form>

        {{-- Main Links --}}
        <ul class="mobile-nav-list">
            <li>
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Home
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
            </li>

            <li>
                <a href="{{ route('shop') }}"
                   class="{{ request()->routeIs('shop') ? 'active' : '' }}">
                    <i class="fas fa-store"></i> Shop
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
            </li>

            <li>
                <a href="{{ route('categories.index') }}"
                   class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> Categories
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
            </li>

            {{-- Category Sub-links --}}
            @if($categories->isNotEmpty())
                <li class="mobile-category-heading">SHOP BY CATEGORY</li>

                @foreach($categories as $category)
                    <li class="mobile-category-link">
                        <a href="{{ route('category.show', $category->slug) }}">
                            <i class="fas fa-angle-right"></i>
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            @endif

            <li>
                <a href="{{ route('about') }}"
                   class="{{ request()->routeIs('about') ? 'active' : '' }}">
                    <i class="fas fa-info-circle"></i> About
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
            </li>

            <li>
                <a href="{{ route('blog') }}"
                   class="{{ request()->routeIs('blog*') ? 'active' : '' }}">
                    <i class="fas fa-blog"></i> Blogs
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
            </li>

            <li>
                <a href="{{ route('contact') }}"
                   class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> Contact
                    <i class="fas fa-chevron-right menu-arrow"></i>
                </a>
            </li>
        </ul>

        <div class="mobile-menu-footer">
            <i class="fas fa-store"></i>
            <span>RV Store</span>
            <small>Premium Shopping Experience · 2026</small>
        </div>

    </div>
</div>
