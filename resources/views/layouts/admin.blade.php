
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rv-Store Admin</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- RV Store Favicon -->
<link rel="icon" type="image/png"
      href="{{ asset('assets/images/favicon.png') }}">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
            margin: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background: #f8fafc;
        }

        .main-content {
            min-width: 0;
            min-height: 100vh;
        }

        /* Common spacing for every admin page */
        .admin-page-content {
            width: 100%;
            min-width: 0;
            padding-top: 24px;
            padding-bottom: 40px;
        }

        @media (max-width: 767.98px) {
            .admin-page-content {
                padding-top: 20px;
                padding-bottom: 30px;
            }

            .main-content {
                width: 100%;
                min-width: 0;
            }
        }

        @media (max-width: 400px) {
            .admin-page-content {
                padding-top: 16px;
                padding-bottom: 24px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- Sidebar --}}
    @include('admin.layout.sidebar')

    <div class="main-content">

        {{-- Topbar --}}
        @include('admin.layout.top-head')

        {{-- Main Page Content --}}
        <main class="admin-page-content">
            @yield('content')
        </main>

    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('desktopToggle')?.addEventListener('click', function() {
            const sidebar = document.getElementById('desktopSidebar');
            const main = document.querySelector('.main-content');

            if (sidebar && main) {
                if (sidebar.style.transform === 'translateX(-100%)') {
                    sidebar.style.transform = 'translateX(0)';
                    main.style.marginLeft = '260px';
                } else {
                    sidebar.style.transform = 'translateX(-100%)';
                    main.style.marginLeft = '0';
                }
            }
        });
    </script>

    @stack('scripts')

</body>
</html>
