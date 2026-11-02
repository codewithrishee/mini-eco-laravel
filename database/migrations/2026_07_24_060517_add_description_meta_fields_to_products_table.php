<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('products', 'short_description')) {
            Schema::table('products', function (Blueprint $table) {
                $table->text('short_description')->nullable();
            });
        }

        if (!Schema::hasColumn('products', 'meta_title')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('meta_title')->nullable();
            });
        }

        if (!Schema::hasColumn('products', 'meta_description')) {
            Schema::table('products', function (Blueprint $table) {
                $table->text('meta_description')->nullable();
            });
        }

        if (!Schema::hasColumn('products', 'meta_keywords')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('meta_keywords')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Existing columns/data ko accidentally delete hone se bachane ke liye
        // is migration mein automatic column deletion nahi karenge.
    }
};
