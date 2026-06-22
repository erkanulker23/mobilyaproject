<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kurumsal', [PageController::class, 'corporate'])->name('corporate');
Route::get('/koleksiyon/{slug?}', [PageController::class, 'collection'])->name('collection');
Route::get('/urun/{slug}', [PageController::class, 'product'])->name('product');
Route::get('/haberler', [PageController::class, 'news'])->name('news');
Route::get('/haber/{slug}', [PageController::class, 'article'])->name('article');
Route::get('/bayiler', [PageController::class, 'dealers'])->name('dealers');
Route::get('/iletisim', [PageController::class, 'contact'])->name('contact');
Route::post('/iletisim', [PageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/sss', [PageController::class, 'faq'])->name('faq');
Route::get('/arama', [PageController::class, 'search'])->name('search');

// E-bülten aboneliği (footer formu)
Route::post('/subscribe', [SiteController::class, 'subscribe'])->name('subscribe');

// Hukuki sayfalar — yalnızca bilinen anahtarlar (catch-all değil).
Route::get('/{slug}', [PageController::class, 'legal'])
    ->where('slug', 'mesafeli|kvkk|gizlilik')
    ->name('legal');
