<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('google_maps_url');
            $table->string('place_id')->unique()->nullable();
            $table->text('formatted_address')->nullable();
            $table->decimal('rating', 2, 1)->default(0)->nullable();
            $table->integer('user_ratings_total')->default(0);
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_sync_at')->nullable();
            $table->json('api_data')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('is_active');
            $table->index('place_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('google_businesses');
    }
};

