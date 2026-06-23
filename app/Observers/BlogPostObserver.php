<?php

namespace App\Observers;

use App\Models\BlogPost;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "created" event.
     */
    public function created(BlogPost $blogPost): void
    {
        // SEO analizini otomatik olarak yap (sadece focus keyword varsa)
        if ($blogPost->focus_keyword) {
            $blogPost->updateSeoAnalysis();
        }
    }

    /**
     * Handle the BlogPost "updated" event.
     */
    public function updated(BlogPost $blogPost): void
    {
        // Sadece SEO ile ilgili alanlar değiştiyse ve focus keyword varsa analiz yap
        $seoFields = ['title', 'seo_title', 'seo_description', 'focus_keyword', 'content', 'slug'];

        if ($blogPost->wasChanged($seoFields) && $blogPost->focus_keyword) {
            // SEO skorları değişikliklerini hariç tut (sonsuz döngüyü önle)
            if (!$blogPost->wasChanged(['seo_score', 'seo_analysis', 'seo_suggestions'])) {
                $blogPost->updateSeoAnalysis();
            }
        }
    }

    /**
     * Handle the BlogPost "deleted" event.
     */
    public function deleted(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle the BlogPost "restored" event.
     */
    public function restored(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     */
    public function forceDeleted(BlogPost $blogPost): void
    {
        //
    }
}
