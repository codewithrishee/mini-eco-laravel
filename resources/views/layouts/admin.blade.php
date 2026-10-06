<!DOCTYPE html>
<html>
<head>
    <title>Rv-Store Admin</title>
    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>
<body>


 {{-- Sidebar --}}
    @include('admin.layout.sidebar')

    <div class="main-content">

        {{-- Topbar --}}
        @include('admin.layout.top-head')

    @yield('content')

    
   <!-- jQuery (required for Owl Carousel) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl Carousel 2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Toggle desktop sidebar (optional, we keep it as a demonstration)
    document.getElementById('desktopToggle')?.addEventListener('click', function() {
        const sidebar = document.getElementById('desktopSidebar');
        const main = document.querySelector('.main-content');
        if (sidebar.style.transform === 'translateX(-100%)') {
            sidebar.style.transform = 'translateX(0)';
            main.style.marginLeft = '260px';
        } else {
            sidebar.style.transform = 'translateX(-100%)';
            main.style.marginLeft = '0';
        }
    });
</script>
</body>
</html>