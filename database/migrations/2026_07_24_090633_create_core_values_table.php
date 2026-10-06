<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
{
    Schema::create('core_values', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('icon')->nullable();
        $table->text('description');
        $table->integer('display_order')->default(0);
        $table->boolean('status')->default(1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('core_values');
    }
};
