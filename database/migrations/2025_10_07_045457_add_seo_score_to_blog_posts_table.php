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
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->integer('seo_score')->nullable()->after('share_count');
            $table->json('seo_analysis')->nullable()->after('seo_score');
            $table->json('seo_suggestions')->nullable()->after('seo_analysis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn(['seo_score', 'seo_analysis', 'seo_suggestions']);
        });
    }
};
