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


Route::get('/', function () {
    try {
        $content = app(HomepageSettings::class)->content;
    } catch (MissingSettings $e) {
        $content = null;
    }

    try {
        $generalSettings = app(\App\Settings\GeneralSettings::class);
    } catch (MissingSettings $e) {
        $generalSettings = null;
    }

    seo()
        ->title($generalSettings->seo_title ?? '')
        ->description($generalSettings->seo_description ?? '')
        ->site($generalSettings->site_name ?? '')
        ->image($generalSettings->header_logo ? url(Storage::url($generalSettings->header_logo)) : '')
        ->twitterImage($generalSettings->header_logo ? url(Storage::url($generalSettings->header_logo)) : '')
        ->url(route('home'));

    return view('frontend.home', [
        'content' => $content,
    ]);
})->name('home');

Route::localized(function () {
    Route::get(Lang::uri('gallery'), [\App\Http\Controllers\Frontend\GalleryController::class, 'index'])
        ->name('gallery.index');

    Route::get(Lang::uri('testimonials'), [\App\Http\Controllers\Frontend\TestimonialController::class, 'index'])
        ->name('testimonial.index');

    Route::get(Lang::uri('contact'), [\App\Http\Controllers\Frontend\ContactController::class, 'index'])
        ->name('contact.index');

    Route::post(Lang::uri('contact'), [\App\Http\Controllers\Frontend\ContactController::class, 'store'])
        ->middleware(['throttle:3,1', \Spatie\Honeypot\ProtectAgainstSpam::class])
        ->name('contact.store');

    Route::get(Lang::uri('page/{page:slug}'), [\App\Http\Controllers\Frontend\PageController::class, 'show'])
        ->name('page.show');

    require __DIR__.'/service.php';
    require __DIR__.'/blog.php';

    // Projeler
    Route::get('projeler', [\App\Http\Controllers\Frontend\ProjectController::class, 'index'])
        ->name('projects.index');
    Route::get('projeler/{project:slug}', [\App\Http\Controllers\Frontend\ProjectController::class, 'show'])
        ->name('projects.show');

    // Kataloglar
    Route::get('kataloglar', [\App\Http\Controllers\Frontend\CatalogController::class, 'index'])
        ->name('catalogs.index');
});

require __DIR__.'/auth.php';
