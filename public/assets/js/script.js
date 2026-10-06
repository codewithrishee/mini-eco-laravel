
        $(document).ready(function () {

            // ---- Recently Viewed Slider ----
            $('.recent-slider').owlCarousel({
                loop: false,
                margin: 16,
                autoplay: true,
                autoplayTimeout: 3500,
                autoplayHoverPause: true,
                nav: true,
                navText: [
                    '<i class="bi bi-chevron-left"></i>',
                    '<i class="bi bi-chevron-right"></i>'
                ],
                dots: true,
                responsive: {
                    0: { items: 1, margin: 10 },
                    480: { items: 2, margin: 12 },
                    768: { items: 3, margin: 14 },
                    992: { items: 4, margin: 16 },
                    1200: { items: 5, margin: 18 }
                }
            });

            // ---- Grid / List Toggle ----
            $('.btn-view').on('click', function () {
                $('.btn-view').removeClass('active');
                $(this).addClass('active');
                var view = $(this).data('view');
                var $grid = $('#productGrid');
                if (view === 'list') {
                    $grid.find('.col-xl-4, .col-lg-6, .col-md-6, .col-sm-6')
                        .removeClass('col-xl-4 col-lg-6 col-md-6 col-sm-6')
                        .addClass('col-12');
                    $grid.find('.product-card').addClass('product-card-list');
                } else {
                    $grid.find('.col-12')
                        .removeClass('col-12')
                        .addClass('col-xl-4 col-lg-6 col-md-6 col-sm-6');
                    $grid.find('.product-card').removeClass('product-card-list');
                }
            });

            // ---- Price Slider Live Update ----
            $('.price-range').on('input', function () {
                var val = $(this).val();
                $(this).closest('.price-slider-wrapper').find('.price-val:last').text('$' + val);
            });

            // ---- Wishlist Toggle ----
            $('.btn-action .bi-heart').on('click', function (e) {
                e.stopPropagation();
                $(this).toggleClass('bi-heart-fill');
                $(this).toggleClass('bi-heart');
                if ($(this).hasClass('bi-heart-fill')) {
                    $(this).css('color', '#ef4444');
                } else {
                    $(this).css('color', '#2d3748');
                }
            });

            // ---- Quick View Alert ----
            $('.btn-quickview, .btn-action .bi-eye').on('click', function (e) {
                e.stopPropagation();
                alert('Quick View — product details would open in a modal.');
            });

            // ---- Add to Cart Alert ----
            $('.btn-add-cart').on('click', function (e) {
                e.stopPropagation();
                var name = $(this).closest('.product-body').find('.product-name').text().trim();
                alert('🛒 "' + name + '" added to cart!');
            });

            // ---- Buy Now Alert ----
            $('.btn-buy').on('click', function (e) {
                e.stopPropagation();
                var name = $(this).closest('.product-body').find('.product-name').text().trim();
                alert('⚡ Proceeding to checkout for "' + name + '"');
            });

            // ---- Reset Filters ----
            $('.btn-reset').on('click', function () {
                $('.filter-card input[type="checkbox"], .filter-card input[type="radio"]')
                    .prop('checked', false);
                $('.filter-card .form-control').val('');
                $('.price-range').val(250);
                $('.price-range').trigger('input');
                alert('All filters have been reset.');
            });

            // ---- Subscribe ----
            $('.btn-subscribe').on('click', function () {
                var email = $(this).siblings('.form-control').val().trim();
                if (email) {
                    alert('✅ Subscribed with: ' + email);
                    $(this).siblings('.form-control').val('');
                } else {
                    alert('⚠️ Please enter a valid email address.');
                }
            });

            // ---- Offer Shop Now ----
            $('.btn-offer').on('click', function () {
                alert('🛍️ Explore our exclusive deals!');
            });

            // ---- Sort Dropdown ----
            $('.sort-select').on('change', function () {
                alert('Sorted by: ' + $(this).find('option:selected').text());
            });

        });
 
$(document).ready(function () {

    // ==============================
    // GRID / LIST VIEW
    // ==============================
    $('.btn-view').on('click', function () {

        $('.btn-view').removeClass('active');
        $(this).addClass('active');

        var view = $(this).data('view');
        var $grid = $('#productGrid');

        if (view === 'list') {

            $grid.find('.col-xl-4, .col-lg-6, .col-md-6, .col-sm-6')
                .removeClass('col-xl-4 col-lg-6 col-md-6 col-sm-6')
                .addClass('col-12');

            $grid.find('.product-card')
                .addClass('product-card-list');

        } else {

            $grid.find('.col-12')
                .removeClass('col-12')
                .addClass('col-xl-4 col-lg-6 col-md-6 col-sm-6');

            $grid.find('.product-card')
                .removeClass('product-card-list');
        }

    });


    // ==============================
    // NEWSLETTER
    // ==============================
    $('.btn-subscribe').on('click', function () {

        var email = $(this)
            .siblings('.form-control')
            .val()
            .trim();

        if (email) {

            alert('Subscribed with: ' + email);

            $(this)
                .siblings('.form-control')
                .val('');

        } else {

            alert('Please enter a valid email address.');

        }

    });

});