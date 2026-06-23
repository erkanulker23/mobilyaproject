<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->string('title_color')->nullable()->after('title');
            $table->string('subtitle_color')->nullable()->after('subtitle');
            $table->string('content_color')->nullable()->after('content');
            $table->boolean('show_title_on_mobile')->default(true)->after('title_color');
            $table->boolean('show_subtitle_on_mobile')->default(true)->after('subtitle_color');
            $table->boolean('show_content_on_mobile')->default(true)->after('content_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn([
                'title_color',
                'subtitle_color',
                'content_color',
                'show_title_on_mobile',
                'show_subtitle_on_mobile',
                'show_content_on_mobile',
            ]);
        });
    }
};
