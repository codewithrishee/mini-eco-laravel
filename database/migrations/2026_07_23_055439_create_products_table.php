<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up(): void
{
    Schema::create('products', function (Blueprint $table) {

$table->id();

$table->foreignId('category_id')->constrained()->cascadeOnDelete();

$table->string('name');
$table->string('slug')->unique();

$table->text('short_description')->nullable();
$table->longText('description')->nullable();

$table->decimal('price',10,2);
$table->decimal('sale_price',10,2)->nullable();

$table->integer('stock')->default(0);

$table->string('sku')->nullable();

$table->string('meta_title')->nullable();
$table->text('meta_description')->nullable();
$table->text('meta_keywords')->nullable();

$table->boolean('status')->default(true);

$table->boolean('is_featured')->default(false);
$table->boolean('is_best_seller')->default(false);
$table->boolean('is_new_arrival')->default(false);
$table->boolean('is_flash_sale')->default(false);

$table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
