<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Setting;
use Illuminate\Support\Facades\View;

/**
 * Tüm frontend sayfaları için ortak taban: aktif dil çözümü ve
 * layout'un (header/footer/menü/ayarlar) ihtiyaç duyduğu paylaşılan veriyi sağlar.
 */
abstract class FrontendController extends Controller
{
    protected string $locale = 'tr';

    /** Frontend'de aktif olan diller (genel ayarlardan). */
    protected array $locales = ['tr', 'en'];

    protected function boot(): void
    {
        $settings = Setting::pluck('value', 'key');

        // Aktif diller — genel ayarlardan, virgülle ayrılmış (örn. "tr,en").
        $configured = array_filter(array_map('trim', explode(',', (string) ($settings['locales'] ?? 'tr,en'))));
        $this->locales = $configured ?: ['tr', 'en'];

        // Geçerli dil: session > varsayılan; aktif diller içinde olmalı.
        $req = request()->get('lang');
        if ($req && in_array($req, $this->locales, true)) {
            session(['locale' => $req]);
        }
        $this->locale = session('locale', $this->locales[0]);
        if (! in_array($this->locale, $this->locales, true)) {
            $this->locale = $this->locales[0];
        }
        app()->setLocale($this->locale);

        $L = $this->locale;
        $pick = fn ($tr, $en) => $L === 'tr' ? $tr : ($en ?: $tr);

        // Kök adres. (Önizleme önekiydi; artık site doğrudan '/' üzerinde.)
        $base = '';
        $route = function (string $name, ?string $slug = null) use ($base) {
            $paths = [
                'home' => $base ?: '/', 'corporate' => "$base/kurumsal", 'collection' => "$base/koleksiyon",
                'news' => "$base/haberler", 'dealers' => "$base/bayiler", 'contact' => "$base/iletisim", 'faq' => "$base/sss",
                'product' => "$base/urun/$slug", 'category' => "$base/koleksiyon/$slug",
                'article' => "$base/haber/$slug", 'page' => "$base/$slug",
            ];
            return url($paths[$name] ?? ($base ?: '/'));
        };
        $menuUrl = function ($mi) use ($route) {
            return match ($mi->type) {
                'url'      => $mi->value ?: '#',
                'category' => $route('category', $mi->value),
                'page'     => $route('page', $mi->value),
                default    => $route($mi->type),
            };
        };

        View::share('L', $L);
        View::share('locales', $this->locales);
        View::share('pick', $pick);
        View::share('route2', $route);
        View::share('menuUrl', $menuUrl);
        View::share('settings', $settings);
        View::share('headerMenu', $this->menu('header'));
        View::share('footerMenu', $this->menu('footer'));
        View::share('megaCategories', Category::orderBy('sort')->withCount('products')->get());
    }

    protected function menu(string $location)
    {
        return MenuItem::where('location', $location)
            ->where('is_active', true)
            ->orderBy('sort')
            ->get();
    }
}
