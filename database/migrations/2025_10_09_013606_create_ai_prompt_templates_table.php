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
        Schema::create('ai_prompt_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('system_prompt');
            $table->text('user_prompt_template');

            // Advanced Settings
            $table->string('language')->default('tr'); // tr, en, etc.
            $table->string('tone')->default('professional'); // professional, casual, friendly, formal
            $table->string('writing_style')->default('informative'); // informative, persuasive, narrative, descriptive
            $table->integer('default_word_count')->default(700);

            // Content Structure Options
            $table->boolean('include_introduction')->default(true);
            $table->boolean('include_conclusion')->default(true);
            $table->boolean('include_faq')->default(false);
            $table->integer('faq_count')->nullable();
            $table->boolean('include_bullet_points')->default(true);
            $table->boolean('include_statistics')->default(false);
            $table->boolean('include_examples')->default(false);
            $table->boolean('include_call_to_action')->default(false);

            // SEO Settings
            $table->boolean('seo_optimized')->default(true);
            $table->boolean('include_keywords')->default(true);
            $table->text('target_keywords')->nullable();

            // Format Settings
            $table->string('heading_structure')->default('h2_h3'); // h2_only, h2_h3, h2_h3_h4
            $table->integer('paragraph_length')->default(3); // sentences per paragraph

            // AI Model Settings
            $table->string('preferred_model')->default('gpt-3.5-turbo-0125');
            $table->decimal('temperature', 3, 2)->default(0.70);
            $table->integer('max_tokens')->default(3000);

            // Status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_prompt_templates');
    }
};
