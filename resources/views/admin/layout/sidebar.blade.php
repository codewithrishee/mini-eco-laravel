<!-- Sidebar (desktop) -->
<div class="sidebar d-none d-lg-block" id="desktopSidebar">

    <div class="logo">
        <h4>Rv-Store</h4>
        <small>Admin Panel</small>
    </div>

    <nav class="nav flex-column">

        <!-- Dashboard -->
        <a href="dashboard" class="nav-link active">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>


        <!-- ================= HOME PAGE ================= -->

        <div class="sidebar-section-title">
            HOME PAGE
        </div>

        <a href="hero-sliders" class="nav-link">
            <i class="bi bi-images"></i>
            Hero Slider
        </a>

        <a href="banners" class="nav-link">
            <i class="bi bi-megaphone-fill"></i>
            Banners
        </a>

        <a href="categories" class="nav-link">
            <i class="bi bi-grid-fill"></i>
            Categories
        </a>

        <a href="testimonials" class="nav-link">
            <i class="bi bi-chat-quote-fill"></i>
            Testimonials
        </a>

        <a href="brands" class="nav-link">
            <i class="bi bi-award-fill"></i>
            Brands Slider
        </a>

        <a href="instagram" class="nav-link">
            <i class="bi bi-instagram"></i>
            Instagram Gallery
        </a>


        <!-- ================= SHOP ================= -->

        <div class="sidebar-section-title">
            SHOP
        </div>

        <a href="products" class="nav-link">
            <i class="bi bi-box-seam-fill"></i>
            Products
        </a>

        <a href="attributes" class="nav-link">
            <i class="bi bi-box-seam-fill"></i>
            size,color
        </a>

        <!-- ================= ABOUT ================= -->

        <div class="sidebar-section-title">
            ABOUT
        </div>

        <a href="about" class="nav-link">
            <i class="bi bi-info-circle"></i>
            About
        </a>

        <a href="our-story" class="nav-link">
            <i class="bi bi-book"></i>
            Our Story
        </a>

        <a href="mission-vision" class="nav-link">
            <i class="bi bi-eye"></i>
            Mission & Vision
        </a>

        <a href="why-us" class="nav-link">
            <i class="bi bi-question-circle"></i>
            Why Us
        </a>

        <a href="core-values" class="nav-link">
            <i class="bi bi-star"></i>
            Core Values
        </a>

        <!-- <a href="timeline" class="nav-link">
    <i class="bi bi-clock-history"></i>
    Timeline
</a>

<a href="states" class="nav-link">
    <i class="bi bi-geo-alt"></i>
    States
</a> -->


        <!-- ================= BLOG ================= -->

        <div class="sidebar-section-title">
            BLOG
        </div>

        <a href="blogs" class="nav-link">
            <i class="bi bi-newspaper"></i>
            Blog
        </a>

        <!-- ================= CONTACT ================= -->

        <div class="sidebar-section-title">
            CONTACT
        </div>

        <!-- <a href="contact" class="nav-link">
            <i class="bi bi-envelope"></i>
            Contact
        </a> -->


        <a href="contact" class="nav-link">
            <i class="bi bi-telephone"></i>
            Contact Info
        </a>

        <a href="contact-messages" class="nav-link">
            <i class="bi bi-chat"></i>
            Contact Message
        </a>

        <a href="faqs" class="nav-link">
            <i class="bi bi-question-lg"></i>
            FAQ
        </a>

        <a href="store-information" class="nav-link">
            <i class="bi bi-gear"></i>
            CONTACT Settings
        </a>

        <!-- ================= ACCOUNT ================= -->

        <div class="sidebar-section-title">
            ACCOUNT
        </div>

        <a href="product-queries" class="nav-link">
            <i class="bi bi-chat-dots-fill"></i>
            Product Queries
        </a>



        <a href="{{ route('home') }}" class="nav-link" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i>
            View Website
        </a>

        <a href="" class="nav-link">
            <i class="bi bi-box-arrow-right"></i>
            Logout
        </a>

    </nav>
</div>


<!-- Offcanvas Sidebar (mobile) -->
<div class="offcanvas offcanvas-start offcanvas-sidebar d-lg-none" tabindex="-1" id="mobileSidebar">

    <div class="offcanvas-header">

        <div>
            <h5 class="text-white mb-0">Rv-Store</h5>
            <small class="text-secondary">Admin Panel</small>
        </div>

        <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close">
        </button>

    </div>

    <div class="offcanvas-body p-0">

        <nav class="nav flex-column">

            <!-- Dashboard -->

            <a href="dashboard" class="nav-link active">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>


            <!-- ================= HOME PAGE ================= -->

            <div class="sidebar-section-title">
                HOME PAGE
            </div>

            <a href="hero-sliders" class="nav-link">
                <i class="bi bi-images"></i>
                Hero Slider
            </a>

            <a href="banners" class="nav-link">
                <i class="bi bi-megaphone-fill"></i>
                Banners
            </a>

            <a href="categories" class="nav-link">
                <i class="bi bi-grid-fill"></i>
                Categories
            </a>

            <a href="testimonials" class="nav-link">
                <i class="bi bi-chat-quote-fill"></i>
                Testimonials
            </a>

            <a href="brands" class="nav-link">
                <i class="bi bi-award-fill"></i>
                Brands Slider
            </a>

            <a href="instagram" class="nav-link">
                <i class="bi bi-instagram"></i>
                Instagram Gallery
            </a>


            <!-- ================= SHOP ================= -->

            <div class="sidebar-section-title">
                SHOP
            </div>

            <a href="products" class="nav-link">
                <i class="bi bi-box-seam-fill"></i>
                Products
            </a>

            <a href="attributes" class="nav-link">
                <i class="bi bi-sliders"></i>
                Product Attributes
            </a>

            <a href="mission-vision" class="nav-link">
                <i class="bi bi-sliders"></i>
                mission-vision
            </a>


            <!-- ================= ACCOUNT ================= -->

            <div class="sidebar-section-title">
                ACCOUNT
            </div>

            <a href="{{ route('home') }}" class="nav-link" target="_blank">

                <i class="bi bi-box-arrow-up-right"></i>
                View Website
            </a>

            <a href="#" class="nav-link">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>

        </nav>

    </div>
</div>


<style>
    :root {
        --sidebar-width: 260px;
    }

    /* Sidebar Section Headings */
    .sidebar-section-title {
        color: #6b7280;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 1.4px;
        text-transform: uppercase;

        padding: 1.2rem 1.25rem 0.4rem;
        margin: 0 0.75rem;
    }

    /* Mobile Sidebar Links */
    .offcanvas-sidebar .nav-link {
        color: #9ca3af;
        padding: 0.75rem 1.25rem;
        border-radius: 0.5rem;
        margin: 0.2rem 0.75rem;
        font-weight: 500;

        display: flex;
        align-items: center;
        gap: 0.75rem;

        transition: all 0.2s;
    }

    .offcanvas-sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
    }

    .offcanvas-sidebar .nav-link.active {
        background: #198754;
        color: #fff;
    }

    .offcanvas-sidebar .nav-link i {
        font-size: 1.2rem;
        width: 1.5rem;
        text-align: center;
    }

    .sidebar {
        width: var(--sidebar-width);
        background: #1f2937;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1030;
        transition: transform 0.3s ease;
        overflow-y: auto;
        padding-top: 1rem;
    }

    .sidebar .nav-link {
        color: #9ca3af;
        padding: 0.75rem 1.25rem;
        border-radius: 0.5rem;
        margin: 0.2rem 0.75rem;
        transition: all 0.2s;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #fff;
    }

    .sidebar .nav-link.active {
        background: #198754;
        color: #fff;
        box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);
    }

    .sidebar .nav-link i {
        font-size: 1.2rem;
        width: 1.5rem;
        text-align: center;
    }

    .sidebar .logo {
        padding: 1rem 1.5rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        margin-bottom: 0.5rem;
    }

    .sidebar .logo h4 {
        color: #fff;
        font-weight: 700;
        letter-spacing: -0.5px;
        margin: 0;
    }

    .sidebar .logo small {
        color: #9ca3af;
        font-size: 0.75rem;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .main-content {
        margin-left: var(--sidebar-width);
        padding: 0;
        min-height: 100vh;
        background: #f8fafc;
        transition: margin 0.3s ease;
    }

    .topbar {
        background: #fff;
        padding: 0.75rem 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        position: sticky;
        top: 0;
        z-index: 1020;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .topbar .search-box {
        max-width: 300px;
        width: 100%;
    }

    .topbar .search-box .input-group {
        border-radius: 50px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background: #f1f5f9;
        transition: all 0.2s;
    }

    .topbar .search-box .input-group:focus-within {
        border-color: #198754;
        box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.15);
        background: #fff;
    }

    .topbar .search-box .form-control {
        border: none;
        background: transparent;
        padding: 0.4rem 1rem;
        font-size: 0.9rem;
    }

    .topbar .search-box .btn {
        border: none;
        background: transparent;
        color: #6b7280;
        padding: 0.4rem 1rem;
    }

    .topbar .profile-dropdown .dropdown-toggle::after {
        display: none;
    }

    .topbar .profile-dropdown .dropdown-menu {
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        padding: 0.5rem;
        min-width: 200px;
    }

    .topbar .profile-dropdown .dropdown-item {
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .topbar .profile-dropdown .dropdown-item:hover {
        background: #f1f5f9;
    }

    .topbar .profile-dropdown .dropdown-item i {
        font-size: 1.1rem;
        width: 1.5rem;
        text-align: center;
    }

    .topbar .notification-bell {
        position: relative;
        cursor: pointer;
        padding: 0.25rem 0.5rem;
        border-radius: 50%;
        transition: background 0.2s;
    }

    .topbar .notification-bell:hover {
        background: #f1f5f9;
    }

    .topbar .notification-bell .badge-dot {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 10px;
        height: 10px;
        background: #dc3545;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .stat-card {
        border: none;
        border-radius: 16px;
        padding: 1.5rem 1.25rem;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
        background: #fff;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    }

    .stat-card .stat-icon {
        font-size: 2.4rem;
        opacity: 0.2;
        position: absolute;
        right: 1rem;
        bottom: 1rem;
        line-height: 1;
    }

    .stat-card .stat-number {
        font-size: 2.2rem;
        font-weight: 700;
        line-height: 1.2;
        color: #1f2937;
    }

    .stat-card .stat-label {
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .stat-card.gradient-1 {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
    }

    .stat-card.gradient-2 {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    }

    .stat-card.gradient-3 {
        background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 100%);
    }

    .stat-card.gradient-4 {
        background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
    }

    .quick-action-btn {
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        border: 1px solid #e5e7eb;
        background: #fff;
        color: #1f2937;
        transition: all 0.2s;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quick-action-btn:hover {
        background: #198754;
        color: #fff;
        border-color: #198754;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(25, 135, 84, 0.15);
    }

    .quick-action-btn i {
        font-size: 1.2rem;
    }

    .table-action-btn {
        border: none;
        background: transparent;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        transition: all 0.15s;
        color: #6b7280;
    }

    .table-action-btn:hover {
        background: #f1f5f9;
        color: #1f2937;
    }

    .table-action-btn.edit:hover {
        color: #198754;
    }

    .table-action-btn.delete:hover {
        color: #dc3545;
    }

    .card-custom {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        transition: all 0.2s;
        background: #fff;
    }

    .card-custom:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    }

    .card-custom .card-header {
        background: transparent;
        border-bottom: 1px solid #f1f5f9;
        padding: 1.25rem 1.5rem;
        font-weight: 600;
    }

    .card-custom .card-body {
        padding: 1.5rem;
    }

    .footer-dashboard {
        padding: 1.5rem;
        background: #fff;
        border-top: 1px solid #f1f5f9;
        color: #6b7280;
        font-size: 0.9rem;
        margin-top: 2rem;
        border-radius: 16px 16px 0 0;
        text-align: center;
    }

    /* Sidebar toggle button (mobile) */
    .sidebar-toggle {
        background: transparent;
        border: none;
        font-size: 1.5rem;
        padding: 0.25rem 0.5rem;
        color: #1f2937;
        cursor: pointer;
        display: none;
    }

    /* Offcanvas sidebar for mobile */
    .offcanvas-sidebar {
        width: var(--sidebar-width);
        background: #1f2937;
    }

    .offcanvas-sidebar .offcanvas-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        padding: 1rem 1.25rem;
    }

    .offcanvas-sidebar .offcanvas-header .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar-toggle {
            display: inline-block;
        }

        .topbar .search-box {
            max-width: 200px;
        }
    }

    @media (max-width: 575.98px) {
        .topbar {
            padding: 0.5rem 1rem;
            flex-wrap: wrap;
        }

        .topbar .search-box {
            max-width: 100%;
            order: 3;
            flex: 0 0 100%;
            margin-top: 0.25rem;
        }

        .stat-card .stat-number {
            font-size: 1.8rem;
        }

        .quick-action-btn {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .card-custom .card-body {
            padding: 1rem;
        }
    }

    /* Scrollbar style for sidebar */
    .sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #4b5563;
        border-radius: 10px;
    }
</style>