<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_queries', function (Blueprint $table) {

            $table->id();

            // Product jiski query hai
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();

            // Customer details
            $table->string('name');
            $table->string('phone', 50);
            $table->string('email')->nullable();

            // Query details
            $table->string('subject')->nullable();
            $table->text('message');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_queries');
    }
};