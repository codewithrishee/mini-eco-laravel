<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_information', function (Blueprint $table) {
            $table->id();

            $table->string('image')->nullable();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();

            $table->string('monday_friday')->nullable();
            $table->string('saturday')->nullable();
            $table->string('sunday')->nullable();
            $table->string('holidays')->nullable();

            $table->string('support_email')->nullable();
            $table->string('phone')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_information');
    }
};