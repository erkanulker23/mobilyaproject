<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];
        $add = function (string $path, ?Carbon $mod = null, string $freq = 'weekly', string $pri = '0.6') use (&$urls) {
            $urls[] = [
                'loc'     => url($path),
                'lastmod' => ($mod ?? now())->toAtomString(),
                'freq'    => $freq,
                'pri'     => $pri,
            ];
        };

        // Statik sayfalar
        $add('/', now(), 'daily', '1.0');
        $add('/kurumsal');
        $add('/koleksiyon', now(), 'weekly', '0.8');
        $add('/haberler');
        $add('/bayiler');
        $add('/iletisim');
        $add('/sss');

        foreach (Category::all() as $c) {
            $add('/koleksiyon/' . $c->slug, $c->updated_at, 'weekly', '0.8');
        }
        foreach (Product::all() as $p) {
            $add('/urun/' . $p->slug, $p->updated_at, 'weekly', '0.7');
        }
        foreach (News::all() as $n) {
            $add('/haber/' . $n->slug, $n->updated_at, 'monthly', '0.6');
        }
        foreach (Page::all() as $pg) {
            $add('/' . $pg->key, $pg->updated_at, 'yearly', '0.3');
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
