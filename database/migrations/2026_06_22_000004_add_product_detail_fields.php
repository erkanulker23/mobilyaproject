<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $t) {
            $t->json('gallery')->nullable();        // çoklu görsel
            $t->text('desc_tr')->nullable();        // açıklama
            $t->text('desc_en')->nullable();
            $t->text('features_tr')->nullable();     // özellikler (satır başına bir madde)
            $t->text('features_en')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $t) {
            $t->dropColumn(['gallery', 'desc_tr', 'desc_en', 'features_tr', 'features_en']);
        });
    }
};
