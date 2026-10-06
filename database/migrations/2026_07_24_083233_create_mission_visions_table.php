<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mission_visions', function (Blueprint $table) {
            $table->id();
            $table->string('mission_title')->default('Our Mission');
            $table->text('mission_description');
            $table->string('vision_title')->default('Our Vision');
            $table->text('vision_description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mission_visions');
    }
};