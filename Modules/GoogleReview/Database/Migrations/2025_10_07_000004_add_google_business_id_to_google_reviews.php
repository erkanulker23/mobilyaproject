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
        Schema::table('google_reviews', function (Blueprint $table) {
            $table->foreignId('google_business_id')->nullable()->after('id')->constrained('google_businesses')->onDelete('cascade');
            $table->index('google_business_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('google_reviews', function (Blueprint $table) {
            $table->dropForeign(['google_business_id']);
            $table->dropIndex(['google_business_id']);
            $table->dropColumn('google_business_id');
        });
    }
};

