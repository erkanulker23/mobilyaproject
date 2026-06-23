<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable();        // villa, rezidans, ticari ...
            $table->string('location')->nullable();         // Sarıyer, İstanbul
            $table->string('status')->default('devam');     // devam | tamam
            $table->boolean('is_sale')->default(false);     // Satışta etiketi
            $table->string('client')->nullable();
            $table->string('area')->nullable();             // 12.000 m²
            $table->string('year')->nullable();             // 2024
            $table->text('short_description')->nullable();
            $table->longText('content')->nullable();
            $table->json('specs')->nullable();              // [{label, value}] künye
            $table->boolean('is_featured')->default(false);
            $table->boolean('published')->default(true);
            $table->unsignedBigInteger('order_column')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
