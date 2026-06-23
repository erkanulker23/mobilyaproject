<?php

namespace App\Http\Middleware;

use App\Settings\AdministratorSettings;
use Closure;
use Illuminate\Http\Request;
use Spatie\LaravelSettings\Exceptions\MissingSettings;

class CheckIsSiteClosedDueToBillMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (file_exists(storage_path('installed')) && ! in_array($request->segment(1), ['admin', 'livewire'])) {
            try {
                $is_site_active = app(AdministratorSettings::class)->site_active;
                
                // TODO: add message and localize
                abort_if(! $is_site_active, 503);
            } catch (MissingSettings $e) {
                // Settings not configured yet, allow site to work
                // Site will be active by default when settings are missing
            }
        }

        return $next($request);
    }
}
