<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\BannerController;
use App\Models\HeroSlider;
use App\Models\Banner;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Models\Category;
use App\Models\Testimonial;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ProductController;
// use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\AttributeController;
use App\Models\Product;
use App\Http\Controllers\Admin\BrandController;
use App\Models\Brand;
use App\Http\Controllers\Admin\InstagramGalleryController;
use App\Models\InstagramGallery;
use App\Http\Controllers\Admin\MissionVisionController;
use App\Models\MissionVision;
use App\Http\Controllers\Admin\OurStoryController;
use App\Models\OurStory;
use App\Http\Controllers\Admin\WhyUsController;
use App\Models\WhyUs;
use App\Http\Controllers\Admin\CoreValueController;
use App\Models\CoreValue;
use App\Http\Controllers\Admin\BlogController;
use App\Models\Blog;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Models\ContactSetting;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\StoreInformationController;
use App\Models\StoreInformation;
use App\Http\Controllers\Admin\FaqController;
use App\Models\Faq;
use App\Http\Controllers\ProductQueryController;
use App\Http\Controllers\Admin\ProductQueryController as AdminProductQueryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;


//===============HOME PAGE//
Route::get('/', function () {

    $heroSliders = HeroSlider::where('status', 1)
        ->orderBy('display_order')
        ->get();

    $offerBanner = Banner::first();

    $categories = Category::where('status', 1)
        ->orderBy('display_order')
        ->get();

    $testimonials = Testimonial::where('status', 1)
        ->orderBy('display_order')
        ->get();

    $featuredProducts = Product::with(['category', 'images'])
        ->where('is_featured', 1)
        ->latest()
        ->take(10)
        ->get();

    $bestSellerProducts = Product::with(['category', 'images'])
        ->where('is_best_seller', 1)
        ->where('status', 1)
        ->latest()
        ->take(8)
        ->get();

    $newArrivalProducts = Product::with(['category', 'images'])
        ->where('is_new_arrival', 1)
        ->where('status', 1)
        ->latest()
        ->take(10)
        ->get();

    $flashSaleProducts = Product::with(['category', 'images'])
        ->where('is_flash_sale', 1)
        ->where('status', 1)
        ->latest()
        ->take(4)
        ->get();

    $brands = Brand::where('status', 1)
        ->orderBy('display_order')
        ->get();

    $instagramGalleries = InstagramGallery::where('status', 1)
        ->orderBy('display_order')
        ->take(6)
        ->get();

    return view('frontend.home', compact(
        'heroSliders',
        'offerBanner',
        'categories',
        'testimonials',
        'featuredProducts',
        'bestSellerProducts',
        'newArrivalProducts',
        'flashSaleProducts',
        'brands',
        'instagramGalleries'
    ));
})->name('home');



// ================= SHOP PAGE//
Route::get('/shop', function (\Illuminate\Http\Request $request) {

    $products = Product::with(['category', 'images'])
        ->where('status', 1)

        //   SEARCH 
        ->when($request->filled('search'), function ($query) use ($request) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('short_description', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        );
                    });
            });
        })

        //  CATEGORY FILTER
        ->when($request->filled('categories'), function ($query) use ($request) {
            $query->whereIn(
                'category_id',
                (array) $request->categories
            );
        })

        //  MINIMUM PRICE 
        ->when($request->filled('min_price'), function ($query) use ($request) {
            $query->whereRaw(
                'COALESCE(sale_price, price) >= ?',
                [(float) $request->min_price]
            );
        })

        //  MAXIMUM PRICE 
        ->when($request->filled('max_price'), function ($query) use ($request) {
            $query->whereRaw(
                'COALESCE(sale_price, price) <= ?',
                [(float) $request->max_price]
            );
        })

        // ================= AVAILABILITY =================
        ->when($request->filled('availability'), function ($query) use ($request) {

            $availability = (array) $request->availability;

            // Only In Stock selected
            if (
                in_array('in_stock', $availability) &&
                !in_array('out_of_stock', $availability)
            ) {
                $query->where('stock', '>', 0);
            }

            // Only Out of Stock selected
            if (
                in_array('out_of_stock', $availability) &&
                !in_array('in_stock', $availability)
            ) {
                $query->where('stock', '<=', 0);
            }

        })

        ->latest()
        ->paginate(9)
        ->withQueryString();


    // Categories for sidebar
    $shopCategories = Category::where('status', 1)
        ->withCount([
            'products' => function ($query) {
                $query->where('status', 1);
            }
        ])

        ->orderBy('display_order')
        ->get();

    $inStockCount = Product::where('status', 1)
        ->where('stock', '>', 0)
        ->count();

    $outOfStockCount = Product::where('status', 1)
        ->where('stock', '<=', 0)
        ->count();

    $recentIds = session()->get('recently_viewed', []);

    $recentProducts = collect();

    if (!empty($recentIds)) {

        $recentProducts = Product::with('images')
            ->whereIn('id', $recentIds)
            ->where('status', 1)
            ->get()
            ->sortBy(function ($product) use ($recentIds) {
                return array_search($product->id, $recentIds);
            });

    }

    $popularCategories = Category::where('status', 1)
        ->withCount([
            'products' => function ($query) {
                $query->where('status', 1);
            }
        ])
        ->orderByDesc('products_count')
        ->take(4)
        ->get();

    return view('frontend.shop', compact(
        'products',
        'shopCategories',
        'inStockCount',
        'outOfStockCount',
        'recentProducts',
        'popularCategories'
    ));

})->name('shop');


// PRODUCT DETAIL PAGE //
Route::get('/product/{slug}', function ($slug) {

    $product = Product::with([
        'category',
        'images',
        'colors',
        'sizes',
        'materials',
        'tags'
    ])
        ->where('slug', $slug)
        ->where('status', 1)
        ->firstOrFail();


    // Recently Viewed
    $recentlyViewed = session()->get('recently_viewed', []);

    $recentlyViewed = array_diff(
        $recentlyViewed,
        [$product->id]
    );

    array_unshift($recentlyViewed, $product->id);

    $recentlyViewed = array_slice($recentlyViewed, 0, 6);

    session()->put('recently_viewed', $recentlyViewed);


    return view('frontend.product-details', compact('product'));

})->name('product.details');


// CATEGORIES// 
Route::get('/categories', [FrontendCategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/category/{slug}', [FrontendCategoryController::class, 'show'])
    ->name('category.show');

//ABOUT PAGE //
Route::get('/about', function () {
    $missionVision = MissionVision::first();
    $ourStory = OurStory::first();

    $whyUsItems = WhyUs::where('status', 1)
        ->orderBy('display_order')
        ->get();

    $coreValues = CoreValue::where('status', 1)
        ->orderBy('display_order')
        ->get();

    return view('frontend.about', compact(
        'missionVision',
        'ourStory',
        'whyUsItems',
        'coreValues'
    ));
})->name('about');

// CONTACT PAGE //

Route::get('/contact', function () {

    $contact = ContactSetting::first();
    $storeInformation = StoreInformation::first();

    $faqs = Faq::where('status', true)
        ->latest()
        ->get();

    return view('frontend.contact', compact(
        'contact',
        'storeInformation',
        'faqs'
    ));

})->name('contact');


// CONTACT MESSAGE SUBMIT
Route::post('/contact/message', [ContactMessageController::class, 'store'])
    ->name('contact.message.store');

// BLOG PAGE //
Route::get('/blog', function () {
    $featuredBlog = Blog::where('status', 1)
        ->where('is_featured', 1)
        ->latest()
        ->first();

    $blogs = Blog::where('status', 1)
        ->when($featuredBlog, function ($query) use ($featuredBlog) {
            $query->where('id', '!=', $featuredBlog->id);
        })
        ->latest()
        ->paginate(6);

    return view('frontend.blog', compact(
        'featuredBlog',
        'blogs'
    ));
})->name('blog');


// BLOG DETAIL PAGE
Route::get('/blog/{slug}', function ($slug) {
    $blog = Blog::where('slug', $slug)
        ->where('status', 1)
        ->firstOrFail();

    $relatedBlogs = Blog::where('status', 1)
        ->where('id', '!=', $blog->id)
        ->latest()
        ->take(3)
        ->get();

    return view('frontend.blog-details', compact(
        'blog',
        'relatedBlogs'
    ));
})->name('blog.details');

Route::post('/product-query', [ProductQueryController::class, 'store'])
    ->name('product.query.store');




// ADMIN AUTH //
Route::middleware(['auth'])->group(function () {

    //DASHBOARD//
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::resource('hero-sliders', HeroSliderController::class);
            Route::resource('banners', BannerController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('testimonials', TestimonialController::class);
            Route::resource('products', ProductController::class);
            Route::resource('brands', BrandController::class);
            Route::resource('instagram', InstagramGalleryController::class);
            Route::get('/mission-vision', [MissionVisionController::class, 'index'])
                ->name('mission-vision.index');

            Route::get('/mission-vision/edit', [MissionVisionController::class, 'edit'])
                ->name('mission-vision.edit');

            Route::put('/mission-vision', [MissionVisionController::class, 'update'])
                ->name('mission-vision.update');

            Route::get('/our-story', [OurStoryController::class, 'index'])
                ->name('our-story.index');

            Route::get('/our-story/edit', [OurStoryController::class, 'edit'])
                ->name('our-story.edit');

            Route::put('/our-story', [OurStoryController::class, 'update'])
                ->name('our-story.update');

            Route::resource('why-us', WhyUsController::class)->except('show');

            Route::resource('core-values', CoreValueController::class)->except('show');

            Route::resource('blogs', BlogController::class)->except('show');

            Route::get('/contact', [ContactSettingController::class, 'index'])
                ->name('contact.index');

            Route::put('/contact', [ContactSettingController::class, 'update'])
                ->name('contact.update');

            Route::delete('/contact', [ContactSettingController::class, 'destroy'])
                ->name('contact.destroy');

            Route::get(
                '/contact-messages',
                [AdminContactMessageController::class, 'index']
            )
                ->name('contact-messages.index');

            Route::get(
                '/contact-messages/{contactMessage}',
                [AdminContactMessageController::class, 'show']
            )
                ->name('contact-messages.show');

            Route::delete(
                '/contact-messages/{contactMessage}',
                [AdminContactMessageController::class, 'destroy']
            )
                ->name('contact-messages.destroy');

            Route::get('/store-information', [StoreInformationController::class, 'index'])
                ->name('store-information.index');

            Route::put('/store-information', [StoreInformationController::class, 'update'])
                ->name('store-information.update');

            Route::delete('/store-information', [StoreInformationController::class, 'destroy'])
                ->name('store-information.destroy');

            // ================= FAQs =================
    
            Route::get('/faqs', [FaqController::class, 'index'])
                ->name('faqs.index');

            Route::get('/faqs/create', [FaqController::class, 'create'])
                ->name('faqs.create');

            Route::post('/faqs', [FaqController::class, 'store'])
                ->name('faqs.store');

            Route::get('/faqs/{faq}/edit', [FaqController::class, 'edit'])
                ->name('faqs.edit');

            Route::put('/faqs/{faq}', [FaqController::class, 'update'])
                ->name('faqs.update');

            Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])
                ->name('faqs.destroy');

            Route::resource('product-queries', AdminProductQueryController::class)
                ->only(['index', 'show', 'destroy']);



            Route::get('/attributes', [AttributeController::class, 'dashboard'])
                ->name('attributes.dashboard');

            Route::prefix('attributes')->name('attributes.')->group(function () {

                Route::get('/{type}', [AttributeController::class, 'index'])->name('index');

                Route::get('/{type}/create', [AttributeController::class, 'create'])->name('create');

                Route::post('/{type}', [AttributeController::class, 'store'])->name('store');

                Route::get('/{type}/{id}/edit', [AttributeController::class, 'edit'])->name('edit');

                Route::put('/{type}/{id}', [AttributeController::class, 'update'])->name('update');

                Route::delete('/{type}/{id}', [AttributeController::class, 'destroy'])->name('destroy');

            });
        });
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

Route::get('/test-mail/{id}', function ($id) {

    $user = User::findOrFail($id);

    Mail::to($user->email)
        ->send(new WelcomeMail($user));

    return "Welcome email sent successfully!";
});

require __DIR__ . '/auth.php';

