<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('hero_sliders', function (Blueprint $table) {
        $table->id();

        $table->string('badge')->nullable();
        $table->string('title');
        $table->text('description')->nullable();

        $table->string('button1_text')->nullable();
        $table->string('button1_link')->nullable();

        $table->string('button2_text')->nullable();
        $table->string('button2_link')->nullable();

        $table->string('image');

        $table->integer('display_order')->default(1);

        $table->boolean('status')->default(true);

        $table->timestamps();
    });
} 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sliders');
    }
};
