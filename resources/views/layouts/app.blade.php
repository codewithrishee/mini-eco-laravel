<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title', 'Rv-Store – Premium E-Commerce')</title>

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

    {{-- Header --}}
    @include('layouts.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <!-- jQuery (required for Owl Carousel) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl Carousel 2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
document.addEventListener("DOMContentLoaded", function () {

    const hoursElement = document.getElementById("hours");
    const minutesElement = document.getElementById("minutes");
    const secondsElement = document.getElementById("seconds");

    if (!hoursElement || !minutesElement || !secondsElement) {
        return;
    }

    const TIMER_DURATION = 24 * 60 * 60 * 1000;

    let endTime = localStorage.getItem("flashSaleEndTime");

    if (!endTime || Date.now() >= Number(endTime)) {

        endTime = Date.now() + TIMER_DURATION;

        localStorage.setItem(
            "flashSaleEndTime",
            endTime
        );
    }


    function updateTimer() {

        let now = Date.now();
        let remaining = Number(endTime) - now;


        // Timer complete → automatically restart 24 hours
        if (remaining <= 0) {

            endTime = Date.now() + TIMER_DURATION;

            localStorage.setItem(
                "flashSaleEndTime",
                endTime
            );

            remaining = TIMER_DURATION;
        }


        const hours = Math.floor(
            remaining / (1000 * 60 * 60)
        );

        const minutes = Math.floor(
            (remaining % (1000 * 60 * 60)) /
            (1000 * 60)
        );

        const seconds = Math.floor(
            (remaining % (1000 * 60)) /
            1000
        );


        hoursElement.textContent =
            String(hours).padStart(2, "0");

        minutesElement.textContent =
            String(minutes).padStart(2, "0");

        secondsElement.textContent =
            String(seconds).padStart(2, "0");
    }


    updateTimer();

    setInterval(updateTimer, 1000);

});

        
        $(document).ready(function () {

            //  Hero Slider 
            $('.hero-slider').owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 5000,
                smartSpeed: 800,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>']
            });

            //  Featured Products Slider 
            $('.featured-slider').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 4000,
                smartSpeed: 600,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                responsive: {
                    0: { items: 2 },
                    576: { items: 2 },
                    768: { items: 3 },
                    992: { items: 4 },
                    1200: { items: 4 }
                }
            });

            //  New Arrivals Slider 
            $('.new-arrivals-slider').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 4000,
                smartSpeed: 600,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                responsive: {
                    0: { items: 2 },
                    576: { items: 2 },
                    768: { items: 3 },
                    992: { items: 4 },
                    1200: { items: 4 }
                }
            });

            //  Reviews Slider 
            $('.reviews-slider').owlCarousel({
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                smartSpeed: 600,
                navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
                responsive: {
                    0: { items: 1 },
                    768: { items: 2 },
                    992: { items: 3 }
                }
            });

            //  Brand Logos Slider 
            $('.brand-slider').owlCarousel({
                loop: true,
                margin: 40,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 2500,
                smartSpeed: 800,
                responsive: {
                    0: { items: 2 },
                    576: { items: 3 },
                    768: { items: 4 },
                    992: { items: 5 },
                    1200: { items: 6 }
                }
            });


        });
    </script>
</body>

</html>