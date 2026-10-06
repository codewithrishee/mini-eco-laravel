@extends('layouts.app')
@section('title', 'About US | RvStore')
@section('content')

    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">

<section class="about-hero">
    <div class="about-hero-overlay d-flex align-items-center justify-content-center">
        <div class="container text-center">
            <span class="hero-badge">Welcome to Rv-Store</span>
            <h1 class="hero-title">About <span class="highlight">Rv-Store</span></h1>
            <p class="hero-subtitle">Crafted with purpose, designed for a greener tomorrow</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

<!-- ================================================================ -->
<!-- SECTION 2: OUR STORY                                             -->
<!-- ================================================================ -->
{{-- ================= OUR STORY ================= --}}
<section class="our-story section-padding">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="story-image-wrapper">
                    <div class="story-image-main">
                        @if($ourStory && $ourStory->main_image)
                            <img src="{{ asset('uploads/about/' . $ourStory->main_image) }}" alt="{{ $ourStory->title }}" class="img-fluid rounded-4">
                        @else
                            <img src="{{ asset('assets/images/story-placeholder.jpg') }}" alt="Our Story" class="img-fluid rounded-4">
                        @endif
                    </div>

                    @if($ourStory && $ourStory->floating_image)
                        <div class="story-image-floating">
                            <img src="{{ asset('uploads/about/' . $ourStory->floating_image) }}" alt="Rv-Store" class="img-fluid rounded-circle">
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6">
                <div class="story-content">
                    <span class="section-tag">
                        {{ $ourStory->tag ?? 'About Us' }}
                    </span>

                    <h2 class="section-heading">
                        {{ $ourStory->title ?? 'Our' }}
                        <span class="highlight">
                            {{ $ourStory->highlight_text ?? 'Story' }}
                        </span>
                    </h2>

                    <div class="story-text">
                        @if($ourStory && $ourStory->description)
                            @foreach(preg_split('/\r\n|\r|\n/', $ourStory->description) as $paragraph)
                                @if(trim($paragraph) !== '')
                                    <p>{{ $paragraph }}</p>
                                @endif
                            @endforeach
                        @else
                            <p>Our story will be available soon.</p>
                        @endif
                    </div>

                    <a href="{{ route('shop') }}" class="btn btn-primary mt-3">
                        Discover Our Collection
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================================================ -->
<!-- SECTION 3: OUR MISSION                                           -->
<!-- ================================================================ -->
<section class="mission-vision section-padding bg-gray-soft">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>
                    <h3>{{ $missionVision->mission_title ?? 'Our Mission' }}</h3>
                    <p>
                        {{ $missionVision->mission_description ?? 'Our mission content will be available soon.' }}
                    </p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="vision-card">
                    <div class="vision-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3>{{ $missionVision->vision_title ?? 'Our Vision' }}</h3>
                    <p>
                        {{ $missionVision->vision_description ?? 'Our vision content will be available soon.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================================================================ -->
<!-- SECTION 4: WHY CHOOSE Rv-Store                                   -->
<!-- ================================================================ -->
<section class="why-choose section-padding">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-tag">Why Rv-Store</span>
            <h2 class="section-heading">Designed with <span class="highlight">Purpose</span></h2>
            <p class="section-subtitle">Every detail matters. Every choice counts.</p>
        </div>

        <div class="row g-4">
            @forelse($whyUsItems as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="{{ $item->icon }}"></i>
                        </div>
                        <h4>{{ $item->title }}</h4>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-4">
                        <p class="text-muted mb-0">No features available.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ================================================================ -->
<!-- SECTION 5: OUR VALUES                                            -->
<!-- ================================================================ -->
<section class="our-values section-padding bg-gray-soft">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-tag">Core Values</span>
            <h2 class="section-heading">What We <span class="highlight">Believe</span></h2>
            <p class="section-subtitle">The principles that guide everything we do.</p>
        </div>

        <div class="row g-4">
            @forelse($coreValues as $value)
                <div class="col-lg-3 col-md-6">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="{{ $value->icon }}"></i>
                        </div>
                        <h4>{{ $value->title }}</h4>
                        <p>{{ $value->description }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-4">
                        <p class="text-muted mb-0">No Core Values available.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ================================================================ -->
<!-- SECTION 6: OUR JOURNEY (TIMELINE)                                -->
<!-- ================================================================ -->
<!-- <section class="our-journey section-padding">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-tag">Our Journey</span>
            <h2 class="section-heading">The <span class="highlight">Timeline</span></h2>
            <p class="section-subtitle">From a dream to a destination — our story in milestones.</p>
        </div>
        <div class="timeline-wrapper">
            <div class="timeline-line"></div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <span class="timeline-year">2023</span>
                    <h4>Where It All Began</h4>
                    <p>Rv-Store was founded with a small curated collection of sustainable home goods and a big vision for a greener future.</p>
                </div>
            </div>

            <div class="timeline-item right">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <span class="timeline-year">2024</span>
                    <h4>Expansion & Recognition</h4>
                    <p>We grew our product range to 150+ premium items, partnered with artisans across the globe, and were featured in leading design publications.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <span class="timeline-year">2025</span>
                    <h4>Community & Impact</h4>
                    <p>Launched our eco-commitment program, planted 5,000+ trees, and built a thriving community of conscious consumers worldwide.</p>
                </div>
            </div>

            <div class="timeline-item right">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <span class="timeline-year">2026</span>
                    <h4>Innovating Tomorrow</h4>
                    <p>Introducing our circular economy initiative, new sustainable packaging, and exclusive collections crafted from ocean-recycled materials.</p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- ================================================================ -->
<!-- SECTION 7: STATISTICS                                            -->
<!-- ================================================================ -->
<!-- <section class="statistics section-padding bg-gray-soft">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-number">500<span>+</span></div>
                    <p class="stat-label">Products</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-number">10K<span>+</span></div>
                    <p class="stat-label">Happy Customers</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-number">150<span>+</span></div>
                    <p class="stat-label">Brands</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card">
                    <div class="stat-number">99<span>%</span></div>
                    <p class="stat-label">Customer Satisfaction</p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- ================================================================ -->
<!-- SECTION 8: MEET OUR TEAM                                         -->
<!-- ================================================================ -->
<!-- <section class="our-team section-padding">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-tag">Our Team</span>
            <h2 class="section-heading">Meet the <span class="highlight">Dreamers</span></h2>
            <p class="section-subtitle">Passionate individuals dedicated to making a difference.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="https://placehold.co/300x300/e8f0ee/1e4a3d?text=Sarah" alt="Sarah" class="img-fluid">
                    </div>
                    <h4>Sarah Mitchell</h4>
                    <span class="team-position">Founder & CEO</span>
                    <p class="team-bio">A sustainability advocate with a passion for design and a vision for a greener retail experience.</p>
                    <div class="team-social">
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="https://placehold.co/300x300/e8f0ee/1e4a3d?text=James" alt="James" class="img-fluid">
                    </div>
                    <h4>James Chen</h4>
                    <span class="team-position">Head of Product</span>
                    <p class="team-bio">Curates our collection with a keen eye for quality, craftsmanship, and sustainable materials.</p>
                    <div class="team-social">
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="https://placehold.co/300x300/e8f0ee/1e4a3d?text=Elena" alt="Elena" class="img-fluid">
                    </div>
                    <h4>Elena Rodriguez</h4>
                    <span class="team-position">Sustainability Lead</span>
                    <p class="team-bio">Drives our eco-initiatives, ensuring every choice aligns with our mission for a healthier planet.</p>
                    <div class="team-social">
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team-card">
                    <div class="team-image">
                        <img src="https://placehold.co/300x300/e8f0ee/1e4a3d?text=Marcus" alt="Marcus" class="img-fluid">
                    </div>
                    <h4>Marcus Wright</h4>
                    <span class="team-position">Customer Experience</span>
                    <p class="team-bio">Ensures every customer feels valued, heard, and delighted with their Rv-Store journey.</p>
                    <div class="team-social">
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- ================================================================ -->
<!-- SECTION 9: CUSTOMER PROMISE                                      -->
<!-- ================================================================ -->
<section class="customer-promise section-padding">
    <div class="container">
        <div class="promise-card">
            <div class="promise-content text-center">
                <span class="promise-tag">Our Promise</span>
                <h2 class="promise-heading">Quality You Can <span class="highlight">Trust</span></h2>
                <p class="promise-text">We stand behind every product we sell. From the moment you place your order to the moment it arrives at your door, we're committed to delivering an experience that exceeds your expectations. Your happiness is our success.</p>
                <a href="shop" class="btn btn-promise">Shop With Confidence <i class="bi bi-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section>

@endsection