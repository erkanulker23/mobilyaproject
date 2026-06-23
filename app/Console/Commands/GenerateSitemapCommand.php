<?php

namespace App\Console\Commands;

use App\Models\BlogPost;
use App\Models\Page;
use App\Models\ServiceCategory;
use App\Models\ServicePost;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generates sitemap.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Sitemap::create()
            ->add(Url::create('/')->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_ALWAYS))
//            ->add(Url::create(route('gallery.index',[], true, 'en'))->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create(route('gallery.index',[], true, 'tr'))->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
//            ->add(Url::create(route('testimonial.index',[], true, 'en'))->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create(route('testimonial.index',[], true, 'tr'))->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
//            ->add(Url::create(route('contact.index',[], true, 'en'))->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create(route('contact.index',[], true, 'tr'))->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
//            ->add(Url::create(route('blog.index',[], true, 'en'))->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create(route('blog.index',[], true, 'tr'))->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add($this->build_index(BlogPost::published()->get(), 'sitemap_blog_posts.xml'))
            ->add($this->build_index(ServicePost::published()->get(), 'sitemap_service_posts.xml'))
            ->add($this->build_index(ServiceCategory::get(), 'sitemap_service_categories.xml'))
            ->add($this->build_index(Page::get(), 'sitemap_pages.xml'))
            ->writeToFile(public_path('sitemap.xml'));
    }

    private function build_index($models, $filename)
    {
        $sitemap = Sitemap::create();

        foreach ($models as $model) {
            $sitemap->add($model);
        }

        $sitemap->writeToFile(public_path($filename));

        return $filename;
    }
}
