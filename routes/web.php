<?php

use App\Settings\HomepageSettings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\JS;
use Spatie\LaravelSettings\Exceptions\MissingSettings;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('minify/{any}', function ($any) {
    $path = public_path($any);
    if (!file_exists($path)) {
        abort(404);
    }

    // Cache the checksum of the file
    $checksum = Cache::rememberForever("file_checksum:{$path}", function () use ($path) {
        return md5_file($path);
    });

    // Cache the file content based on the checksum
    $content = Cache::remember("file_content:{$checksum}", 60 * 24 * 365, function () use ($path, $any) {
        $extension = pathinfo($any, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'css':
                $minifier = new CSS($path);
                $minifiedContent = $minifier->minify();
                return ['content' => $minifiedContent, 'headers' => ['Content-Type' => 'text/css']];
            case 'js':
                $minifier = new JS($path);
                $minifiedContent = $minifier->minify();
                return ['content' => $minifiedContent, 'headers' => ['Content-Type' => 'application/javascript']];
            default:
                return ['content' => file_get_contents($path), 'headers' => ['Content-Type' => 'text/plain']];
        }
    });

    // Set content and headers
    $response = response($content['content'], 200, $content['headers']);

    // Set Cache-Control, Expires and ETag headers for browser caching
    $cacheDuration = 60 * 24 * 365; // 1 year in minutes
    return $response->header('Cache-Control', "public, max-age=" . ($cacheDuration * 60))
        ->header('Expires', now()->addMinutes($cacheDuration)->toRfc7231String())
        ->header('ETag', $checksum); // ETag for validation
})->where('any', '.*')->name('themes_file');

Route::get('sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

Route::get('robots.txt', function (\App\Settings\GeneralSettings $settings) {
    $robotsTxtContent = $settings->robots_txt;

    $content = [
        'content' => $robotsTxtContent,
        'headers' => ['Content-Type' => 'text/plain']
    ];

    $response = response($content['content'], 200, $content['headers']);

    $cacheDuration = 60 * 24 * 365; // 1 year in minutes
    return $response->header('Cache-Control', "public, max-age=" . ($cacheDuration * 60))
        ->header('Expires', now()->addMinutes($cacheDuration)->toRfc7231String());
})->name('robots_txt');


/*
 * Frontend = AWA Mobilya DC tasarımı. Her sayfanın kendi URL'si vardır (derin link,
 * SEO, paylaşılabilir). Tüm rotalar aynı DC view'ını döndürür ama farklı başlangıç
 * durumu (initialState) ile; istemci tarafı pushState ile URL'i senkron tutar.
 * İçeriğin tamamı DB'den (DcSiteData) gelir.
 */
$dc = function (array $state = []) {
    $data = app(\App\Services\DcSiteData::class)->build();
    $s = $data['settings'];
    $brand = app(\App\Settings\GeneralSettings::class)->site_name ?: 'AWA Mobilya';
    $suffix = ' — '.$brand;

    $title = $s['seoTitleTr'] ?? $brand;
    $desc = $s['seoDescTr'] ?? '';
    $page = $state['page'] ?? 'home';
    $find = fn ($list, $id) => collect($data[$list] ?? [])->firstWhere('id', $id);

    if ($page === 'corporate') { $title = 'Kurumsal'.$suffix; }
    elseif ($page === 'dealers') { $title = 'Bayiler'.$suffix; }
    elseif ($page === 'contact') { $title = 'İletişim'.$suffix; }
    elseif ($page === 'faq') { $title = 'Sıkça Sorulan Sorular'.$suffix; }
    elseif ($page === 'news') { $title = 'Haberler'.$suffix; }
    elseif ($page === 'legal') { $title = ['mesafeli' => 'Mesafeli Satış Sözleşmesi', 'kvkk' => 'KVKK Aydınlatma Metni', 'gizlilik' => 'Gizlilik Politikası'][$state['legal'] ?? 'mesafeli'].$suffix; }
    elseif ($page === 'collection') {
        $title = 'Koleksiyon'.$suffix;
        if (! empty($state['cat']) && ($c = $find('categories', $state['cat']))) { $title = $c['tr'].$suffix; }
    } elseif ($page === 'product' && ($p = $find('products', $state['product'] ?? ''))) {
        $title = $p['tr'].$suffix;
        $desc = $p['tr'].' — '.$brand.' koleksiyonu.';
    } elseif ($page === 'article' && ($n = $find('news', $state['article'] ?? ''))) {
        $title = $n['tr'].$suffix;
        $desc = $n['exTr'] ?? $desc;
    }

    return view('frontend.dc', [
        'serverData' => json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        'initialState' => json_encode($state ?: ['page' => 'home'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        'seoTitle' => $title,
        'seoDescription' => $desc,
        'ogImage' => $s['ogImage'] ?? '',
        'v' => @filemtime(public_path('dc/support.js')) ?: '1',
    ]);
};

Route::get('/', fn () => $dc(['page' => 'home']))->name('home');

Route::localized(function () use ($dc) {
    Route::get('kurumsal', fn () => $dc(['page' => 'corporate']))->name('corporate.index');
    Route::get('bayiler', fn () => $dc(['page' => 'dealers']))->name('dealers.index');
    Route::get('sss', fn () => $dc(['page' => 'faq']))->name('faq.index');

    Route::get(Lang::uri('contact'), fn () => $dc(['page' => 'contact']))->name('contact.index');
    Route::post(Lang::uri('contact'), [\App\Http\Controllers\Frontend\ContactController::class, 'store'])
        ->middleware(['throttle:3,1', \Spatie\Honeypot\ProtectAgainstSpam::class])
        ->name('contact.store');

    // Hukuki / statik sayfalar (DC legal görünümü): mesafeli-satis, kvkk, gizlilik...
    Route::get(Lang::uri('page/{page:slug}'), function ($page) use ($dc) {
        $map = ['mesafeli-satis' => 'mesafeli', 'kvkk' => 'kvkk', 'gizlilik' => 'gizlilik'];
        $slug = is_object($page) ? $page->getTranslation('slug', 'tr') : $page;
        if ($slug === 'hakkimizda') {
            return $dc(['page' => 'corporate']);
        }
        return $dc(['page' => 'legal', 'legal' => $map[$slug] ?? 'mesafeli']);
    })->name('page.show');

    // Hukuki sayfalar (DC legal görünümü)
    Route::get('mesafeli', fn () => $dc(['page' => 'legal', 'legal' => 'mesafeli']))->name('legal.mesafeli');
    Route::get('kvkk', fn () => $dc(['page' => 'legal', 'legal' => 'kvkk']))->name('legal.kvkk');
    Route::get('gizlilik', fn () => $dc(['page' => 'legal', 'legal' => 'gizlilik']))->name('legal.gizlilik');

    // Haberler
    Route::get('haberler', fn () => $dc(['page' => 'news']))->name('blog.index');
    Route::get('haberler/{post:slug}', fn ($post) => $dc([
        'page' => 'article',
        'article' => is_object($post) ? $post->getTranslation('slug', 'tr') : $post,
    ]))->name('blog.post.show');

    // Ürünler / Koleksiyon
    Route::get('projeler', fn () => $dc(['page' => 'collection']))->name('projects.index');
    Route::get('projeler/{slug}', function ($slug) use ($dc) {
        $p = \App\Models\Project::where('slug', $slug)->with('projectCategory')->first();
        $catSlug = optional(optional($p)->projectCategory)->slug ?: (optional($p)->category);
        if ($p) {
            return $dc(['page' => 'product', 'product' => $slug, 'cat' => $catSlug]);
        }
        // Kategori slug'ı olabilir → koleksiyon
        return $dc(['page' => 'collection', 'cat' => $slug]);
    })->name('projects.show');
});

require __DIR__.'/auth.php';
