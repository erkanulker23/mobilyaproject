<?php

namespace App\Http\Middleware;

use App\Settings\AdministratorSettings;
use Closure;
use Illuminate\Http\Request;
use Spatie\LaravelSettings\Exceptions\MissingSettings;

/**
 * "Frontend Aktif" kapalıyken (admin → Yönetici Ayarları), site yalnızca giriş
 * yapmış yöneticiye açıktır; ziyaretçilere kapalı sayfası gösterilir.
 */
class EnsureFrontendActive
{
    public function handle(Request $request, Closure $next)
    {
        // Admin paneli, livewire, giriş ve form uçları her zaman açık
        if (in_array($request->segment(1), ['admin', 'livewire'], true)
            || $request->is('login', 'lead', 'abone', 'sitemap.xml', 'robots.txt')) {
            return $next($request);
        }

        try {
            $active = app(AdministratorSettings::class)->frontend_active;
        } catch (MissingSettings $e) {
            $active = true;
        }

        if (! $active && ! auth()->check()) {
            return response()->view('errors.frontend-closed', [], 503);
        }

        return $next($request);
    }
}
