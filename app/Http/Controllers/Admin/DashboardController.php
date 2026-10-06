<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\ProductQuery;
use App\Models\Banner;
use App\Models\HeroSlider;
use App\Models\Brand;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        // =====================================================
        // TOTAL COUNTS
        // =====================================================

        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalBlogs = Blog::count();
        $totalMessages = ContactMessage::count();
        $totalProductQueries = ProductQuery::count();

        $totalBanners = Banner::count();
        $totalHeroSliders = HeroSlider::count();
        $totalBrands = Brand::count();
        $totalTestimonials = Testimonial::count();


        // =====================================================
        // TEMPORARY COUNTS
        // Models milne ke baad dynamic karenge
        // =====================================================

        $totalBrandSliders = 0;
        $totalInstagram = 0;


        // =====================================================
        // RECENT CATEGORIES
        // =====================================================

        $recentCategories = Category::latest()
            ->take(5)
            ->get();


        // =====================================================
        // RECENT PRODUCTS
        // =====================================================

        $recentProducts = Product::with([
            'category',
            'images'
        ])
        ->latest()
        ->take(5)
        ->get();


        // =====================================================
        // RECENT BLOGS
        // =====================================================

        $recentBlogs = Blog::latest()
            ->take(5)
            ->get();


        // =====================================================
        // RECENT CONTACT MESSAGES
        // =====================================================

        $recentMessages = ContactMessage::latest()
            ->take(5)
            ->get();


        // =====================================================
        // RECENT PRODUCT QUERIES
        // =====================================================

        $recentProductQueries = ProductQuery::with('product')
            ->latest()
            ->take(5)
            ->get();


        // =====================================================
        // RECENT BANNERS
        // =====================================================

        $recentBanners = Banner::latest()
            ->take(5)
            ->get();


        // =====================================================
        // RECENT HERO SLIDERS
        // =====================================================

        $recentHeroSliders = HeroSlider::latest()
            ->take(5)
            ->get();


        // =====================================================
        // RECENT BRANDS
        // =====================================================

        $recentBrands = Brand::latest()
            ->take(5)
            ->get();


        // =====================================================
        // RECENT TESTIMONIALS
        // =====================================================

        $recentTestimonials = Testimonial::latest()
            ->take(5)
            ->get();


        // =====================================================
        // SEND ALL DATA TO DASHBOARD
        // =====================================================

        return view('admin.dashboard', compact(

            // Counts
            'totalCategories',
            'totalProducts',
            'totalBlogs',
            'totalMessages',
            'totalProductQueries',
            'totalBanners',
            'totalHeroSliders',
            'totalBrands',
            'totalBrandSliders',
            'totalInstagram',
            'totalTestimonials',

            // Recent Data
            'recentCategories',
            'recentProducts',
            'recentBlogs',
            'recentMessages',
            'recentProductQueries',
            'recentBanners',
            'recentHeroSliders',
            'recentBrands',
            'recentTestimonials'
        ));
    }
}