<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Catalog;
use App\Models\Page;
use App\Models\Project;
use App\Models\ServicePost;
use Illuminate\Support\Facades\Cache;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $xml = Cache::remember('sitemap.xml', 3600, function () {
            $sitemap = Sitemap::create();

            // Statik / ana rotalar
            $sitemap->add(Url::create(route('home'))->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
            foreach (['projects.index', 'catalogs.index', 'services.index', 'blog.index', 'contact.index'] as $name) {
                try { $sitemap->add(Url::create(route($name))->setPriority(0.8)); } catch (\Throwable $e) {}
            }

            // Projeler
            foreach (Project::published()->get() as $p) {
                $sitemap->add(Url::create(route('projects.show', $p->slug))
                    ->setLastModificationDate($p->updated_at)->setPriority(0.7));
            }
            // Hizmetler
            foreach (ServicePost::query()->published()->get() as $s) {
                try { $sitemap->add(Url::create(route('services.show', $s->slug))->setPriority(0.6)); } catch (\Throwable $e) {}
            }
            // Haberler
            foreach (BlogPost::query()->published()->get() as $b) {
                try { $sitemap->add(Url::create(route('blog.post.show', $b->slug))
                    ->setLastModificationDate($b->updated_at)->setPriority(0.6)); } catch (\Throwable $e) {}
            }
            // Sayfalar
            foreach (Page::all() as $page) {
                try { $sitemap->add(Url::create(route('page.show', $page->slug))->setPriority(0.5)); } catch (\Throwable $e) {}
            }

            return $sitemap->render();
        });

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
