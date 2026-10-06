<!-- Topbar -->
<div class="topbar">

    <div class="d-flex align-items-center gap-2">

        <!-- Mobile Sidebar Toggle -->
        <button class="sidebar-toggle d-lg-none"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar"
                aria-controls="mobileSidebar">
            <i class="bi bi-list"></i>
        </button>

        <!-- Desktop Sidebar Toggle -->
        <button class="sidebar-toggle d-none d-lg-block"
                type="button"
                id="desktopToggle">
            <i class="bi bi-chevron-left"></i>
        </button>

        <!-- Search -->
        <div class="search-box">
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


    <div class="d-flex align-items-center gap-3">

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

                    <span class="d-none d-sm-inline fw-semibold">
                        {{ Auth::user()->name }}
                    </span>

                </a>


                <ul class="dropdown-menu dropdown-menu-end">

                    <!-- Profile -->
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('profile.edit') }}">

                            <i class="bi bi-person"></i>
                            Profile

                        </a>
                    </li>


                    <!-- Settings -->
                    <li>
                        <a class="dropdown-item"
                           href="{{ route('profile.edit') }}#password-settings">

                            <i class="bi bi-gear"></i>
                            Settings

                        </a>
                    </li>


                    <li>
                        <hr class="dropdown-divider">
                    </li>


                    <!-- Logout -->
                    <li>

                        <form method="POST"
                              action="{{ route('logout') }}"
                              class="m-0">

                            @csrf

                            <button type="submit"
                                    class="dropdown-item text-danger">

                                <i class="bi bi-box-arrow-right"></i>
                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </div>
        @endauth

    </div>

</div>