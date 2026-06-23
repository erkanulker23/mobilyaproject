<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('title');
            $table->json('description')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->json('submit_button_text')->nullable();
            $table->json('success_message')->nullable();
            $table->string('redirect_url')->nullable();
            $table->boolean('send_email_notification')->default(false);
            $table->string('notification_email')->nullable();
            $table->string('notification_subject')->nullable();
            $table->boolean('save_submissions')->default(true);
            $table->boolean('allow_multiple_submissions')->default(true);
            $table->boolean('require_login')->default(false);
            $table->text('custom_css')->nullable();
            $table->text('custom_js')->nullable();
            $table->json('settings')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
