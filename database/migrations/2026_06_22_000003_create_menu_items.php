<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $t) {
            $t->id();
            $t->string('location')->default('header'); // header | footer
            $t->string('label_tr');
            $t->string('label_en');
            $t->string('type')->default('url');         // home|corporate|collection|news|dealers|contact|page|category|url
            $t->string('value')->nullable();            // page key / category slug / custom url
            $t->boolean('is_active')->default(true);
            $t->integer('sort')->default(0);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
