<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('blogs', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('category');
        $table->string('author')->nullable();
        $table->string('image')->nullable();
        $table->text('short_description');
        $table->longText('content');
        $table->unsignedInteger('read_time')->default(5);
        $table->boolean('is_featured')->default(0);
        $table->boolean('status')->default(1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
