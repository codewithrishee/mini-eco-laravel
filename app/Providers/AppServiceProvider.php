<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            if (Schema::hasTable('categories')) {
                View::share(
                    'categories',
                    Category::where('status', 1)
                        ->orderBy('display_order')
                        ->get()
                );
            } else {
                View::share('categories', collect());
            }
        } catch (\Throwable $e) {
            Log::error('Category loading failed: ' . $e->getMessage());

            View::share('categories', collect());
        }
    }
}
