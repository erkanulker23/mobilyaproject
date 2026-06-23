<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Modules\Gallery\Entities\GalleryCategory::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('description')->nullable();
            $table->string('youtube_embed_url')->nullable();
            $table->unsignedBigInteger('order_column')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_entries');
    }
};
