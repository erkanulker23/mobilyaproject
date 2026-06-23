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
        Schema::create('service_post_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\ServicePost::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\ServiceCategory::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_post_categories');
    }
};
