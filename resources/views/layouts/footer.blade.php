
<link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">

<footer class="footer-section">
    <div class="container">
        <div class="row g-4">

            {{-- Brand --}}
            <div class="col-lg-4">
                <a class="footer-brand" href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/admin-logo.png') }}"
                         alt="RV Store"
                         class="footer-logo">
                </a>

                <p class="footer-about">
                    Your premier destination for quality products,
                    unbeatable prices, and exceptional service.
                    Shop with confidence.
                </p>

                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h5>Quick Links</h5>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            {{-- Dynamic Categories --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h5>Categories</h5>
                <ul>
                    @forelse($categories->take(5) as $category)
                        <li>
                            <a href="{{ route('category.show', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @empty
                        <li><span>No Categories Found</span></li>
                    @endforelse
                </ul>
            </div>

            {{-- Support --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h5>Support</h5>
                <ul>
                    <li><a href="#">Shipping Info</a></li>
                    <li><a href="#">Returns & Refunds</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Track Order</a></li>
                </ul>
            </div>

            {{-- Contact - Dummy Details --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h5>Contact</h5>
                <ul class="contact-info">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        New Delhi, India
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        +91 98765 43210
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        support@rvstore.com
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        9 AM – 9 PM Daily
                    </li>
                </ul>
            </div>

        </div>

        {{-- Footer Bottom --}}
        <div class="footer-bottom">
            &copy; {{ date('Y') }}
            <strong>RVStore</strong>. All rights reserved.
            | Made with <i class="fas fa-heart text-danger"></i>
            for Shopping Lovers.
        </div>
    </div>
</footer>
