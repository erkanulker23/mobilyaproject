<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Slide\Entities\Slider;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Slider::class);
            $table->json('title');
            $table->json('subtitle')->nullable();
            $table->json('content')->nullable();
            $table->json('cta_text')->nullable();
            $table->nullableMorphs('target');
            $table->json('link_url')->nullable();
            $table->bigInteger('order_column')->default(0);
            $table->timestamp('publish_at')->useCurrent()->before('created_at')->index();
            $table->timestamp('unpublish_at')->nullable()->before('created_at')->index();

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
        Schema::dropIfExists('slides');
    }
};
