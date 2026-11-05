<!-- Topbar -->
<div class="topbar d-flex flex-nowrap justify-content-between align-items-center">

    <div class="d-flex align-items-center gap-2 topbar-left flex-shrink-0">

        <!-- Mobile Sidebar Toggle -->
        <button class="sidebar-toggle d-lg-none"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar"
                aria-controls="mobileSidebar">
            <i class="bi bi-list fs-4"></i>
        </button>

        <!-- Desktop Sidebar Toggle -->
        <button class="sidebar-toggle d-none d-lg-block"
                type="button"
                id="desktopToggle">
            <i class="bi bi-chevron-left"></i>
        </button>

        <!-- Search (Yahan d-none d-sm-block lagaya hai) -->
        <div class="search-box d-none d-sm-block">
            <div class="input-group">

                <span class="input-group-text bg-transparent border-0">
                    <i class="bi bi-search"></i>
                </span>

                <input type="text"
                       class="form-control"
                       placeholder="Search..."
                       aria-label="Search">

            </div>
        </div>

    </div>

    <div class="d-flex align-items-center gap-3 topbar-right flex-shrink-0">

        <!-- Notification -->
        <div class="notification-bell">
            <i class="bi bi-bell-fill fs-5 text-secondary"></i>
            <span class="badge-dot"></span>
        </div>

        <!-- Profile Dropdown -->
        @auth
            <div class="profile-dropdown dropdown">

                <a href="#"
                   class="d-flex align-items-center gap-2 text-decoration-none text-dark dropdown-toggle"
                   data-bs-toggle="dropdown"
                   aria-expanded="false">

                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=198754&color=fff&size=32"
                        alt="{{ Auth::user()->name }}"
                        class="rounded-circle"
                        width="36"
                        height="36"
                    >

                    <span class="d-none d-md-inline fw-semibold">
                        {{ Auth::user()->name }}
                    </span>

                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person me-2"></i> Profile
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}#password-settings">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        @endauth

    </div>

</div>

@push('styles')
<style>
    /* Topbar Base */
    .topbar {
        width: 100%;
        min-width: 0;
        margin-bottom: 18px;
    }

    .search-box {
        width: 280px;
        max-width: 100%;
    }

    .search-box .input-group {
        border-radius: 10px;
        overflow: hidden;
    }

    .notification-bell {
        position: relative;
        cursor: pointer;
    }

    /* Tablet */
    @media (max-width: 991.98px) {
        .topbar {
            margin-bottom: 16px;
        }
        .search-box {
            width: 220px;
        }
    }

    /* Mobile Fix */
    @media (max-width: 575.98px) {
        .topbar {
            gap: 8px !important;
            margin-bottom: 20px;
        }
        
        .topbar-right {
            gap: 12px !important;
        }

        .notification-bell i {
            font-size: 18px !important;
        }

        .profile-dropdown img {
            width: 32px !important;
            height: 32px !important;
        }
    }
</style>
@endpush