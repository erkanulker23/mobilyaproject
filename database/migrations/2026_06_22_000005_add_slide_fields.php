<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('slides', function (Blueprint $t) {
            $t->string('title_tr')->nullable();   // slayt başlığı
            $t->string('title_en')->nullable();
            $t->text('desc_tr')->nullable();       // slayt açıklaması
            $t->text('desc_en')->nullable();
            $t->string('img_mobile')->nullable();  // mobil görsel
            $t->string('video')->nullable();       // video (mp4 url/path)
        });
    }

    public function down(): void
    {
        Schema::table('slides', function (Blueprint $t) {
            $t->dropColumn(['title_tr', 'title_en', 'desc_tr', 'desc_en', 'img_mobile', 'video']);
        });
    }
};
