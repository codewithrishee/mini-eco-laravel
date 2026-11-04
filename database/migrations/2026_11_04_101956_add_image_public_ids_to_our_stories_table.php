
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('our_stories', function (Blueprint $table) {
            $table->string('main_image_public_id')->nullable();
            $table->string('floating_image_public_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('our_stories', function (Blueprint $table) {
            $table->dropColumn([
                'main_image_public_id',
                'floating_image_public_id',
            ]);
        });
    }
};
