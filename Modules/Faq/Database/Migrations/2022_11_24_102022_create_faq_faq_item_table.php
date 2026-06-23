<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Faq\Entities\Faq;
use Modules\Faq\Entities\FaqItem;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_faq_item', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Faq::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(FaqItem::class)->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('order_column')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_faq_item');
    }
};
