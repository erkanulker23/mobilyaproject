<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kayıt başına SEO alanları (TR/EN)
        foreach (['categories', 'products', 'news', 'pages'] as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->string('seo_title_tr')->nullable();
                $t->string('seo_title_en')->nullable();
                $t->text('seo_desc_tr')->nullable();
                $t->text('seo_desc_en')->nullable();
            });
        }

        // Müşteri yorumları
        Schema::create('testimonials', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('company')->nullable();
            $t->text('comment_tr')->nullable();
            $t->text('comment_en')->nullable();
            $t->unsignedTinyInteger('rating')->default(5);
            $t->string('img')->nullable();
            $t->boolean('is_active')->default(true);
            $t->integer('sort')->default(0);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');

        foreach (['categories', 'products', 'news', 'pages'] as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->dropColumn(['seo_title_tr', 'seo_title_en', 'seo_desc_tr', 'seo_desc_en']);
            });
        }
    }
};
