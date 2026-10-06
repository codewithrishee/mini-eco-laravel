<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('contact_settings', 'map_url')) {
            Schema::table('contact_settings', function (Blueprint $table) {
                $table->text('map_url')->nullable();
            });
        }

        if (!Schema::hasColumn('contact_settings', 'working_hours')) {
            Schema::table('contact_settings', function (Blueprint $table) {
                $table->text('working_hours')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('contact_settings', 'map_url')) {
            Schema::table('contact_settings', function (Blueprint $table) {
                $table->dropColumn('map_url');
            });
        }

        if (Schema::hasColumn('contact_settings', 'working_hours')) {
            Schema::table('contact_settings', function (Blueprint $table) {
                $table->dropColumn('working_hours');
            });
        }
    }
};