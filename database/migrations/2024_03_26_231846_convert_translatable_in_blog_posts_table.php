<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $raw_posts = DB::select('select * from blog_posts');

        foreach ($raw_posts as $raw_post) {
            $post = \App\Models\BlogPost::find($raw_post->id);
            $post->setTranslation('title', 'tr', $raw_post->title)
                ->setTranslation('title', 'en', $raw_post->title)
                ->setTranslation('short_description', 'tr', $raw_post->short_description)
                ->setTranslation('seo_title', 'tr', $raw_post->seo_title)
                ->setTranslation('seo_description', 'tr', $raw_post->seo_description)
                ->setTranslation('content', 'tr', $raw_post->content)
                ->setTranslation('slug', 'tr', $raw_post->slug);
            $post->save();
        }

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->json('title')->nullable()->change();
            $table->json('short_description')->nullable()->change();
            $table->json('seo_title')->nullable()->change();
            $table->json('seo_description')->nullable()->change();
            $table->json('content')->nullable()->change();
            $table->json('slug')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('short_description')->nullable()->change();
            $table->string('seo_title')->nullable()->change();
            $table->string('seo_description')->nullable()->change();
            $table->text('content')->nullable()->change();
            $table->string('slug')->nullable()->change();
        });
    }
};
