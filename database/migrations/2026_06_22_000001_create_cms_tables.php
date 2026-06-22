<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('tr');
            $table->string('en');
            $table->string('img')->nullable();
            $table->text('d_tr')->nullable();
            $table->text('d_en')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('tr');
            $table->string('en');
            $table->string('img')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('img')->nullable();
            $table->string('sub_tr')->nullable();
            $table->string('sub_en')->nullable();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('date')->nullable();
            $table->string('cat_tr')->nullable();
            $table->string('cat_en')->nullable();
            $table->string('tr');
            $table->string('en');
            $table->text('ex_tr')->nullable();
            $table->text('ex_en')->nullable();
            $table->longText('body_tr')->nullable();
            $table->longText('body_en')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('city');
            $table->string('addr')->nullable();
            $table->string('tel')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('t_tr')->nullable();
            $table->string('t_en')->nullable();
            $table->longText('b_tr')->nullable();
            $table->longText('b_en')->nullable();
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->default('general');
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->timestamps();
        });

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('message')->nullable();
            $table->string('product')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscribers');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('dealers');
        Schema::dropIfExists('news');
        Schema::dropIfExists('slides');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
