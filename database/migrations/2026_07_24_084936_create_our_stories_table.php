<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('our_stories', function (Blueprint $table) {
        $table->id();
        $table->string('tag')->nullable();
        $table->string('title');
        $table->string('highlight_text')->nullable();
        $table->longText('description');
        $table->string('main_image')->nullable();
        $table->string('floating_image')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_stories');
    }
};
