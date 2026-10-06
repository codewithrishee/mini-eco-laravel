<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('store_information', function (Blueprint $table) {

            // Online Rv-Store support fields
            $table->string('product_query_text')->nullable();
            $table->string('availability_text')->nullable();
            $table->string('whatsapp_text')->nullable();

            // Physical store fields no longer required
            $table->dropColumn([
                'monday_friday',
                'saturday',
                'sunday',
                'holidays',
            ]);
        });

        Schema::table('contact_settings', function (Blueprint $table) {
            $table->dropColumn([
                'working_hours',
                'map_embed',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('store_information', function (Blueprint $table) {
            $table->string('monday_friday')->nullable();
            $table->string('saturday')->nullable();
            $table->string('sunday')->nullable();
            $table->string('holidays')->nullable();

            $table->dropColumn([
                'product_query_text',
                'availability_text',
                'whatsapp_text',
            ]);
        });

        Schema::table('contact_settings', function (Blueprint $table) {
            $table->string('working_hours')->nullable();
            $table->text('map_embed')->nullable();
        });
    }
};