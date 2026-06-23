<?php

namespace App\Http\Middleware;

use App\Settings\AdministratorSettings;
use Closure;
use Hexadog\ThemesManager\Http\Middleware\ThemeLoader as HexadogThemeLoader;
use Illuminate\Contracts\Encryption\DecryptException;
use Spatie\LaravelSettings\Exceptions\MissingSettings;

class ThemeLoader extends HexadogThemeLoader
{
    public function handle($request, Closure $next, $theme = null)
    {
        if(file_exists(storage_path('installed'))) {
            try {
                $theme = app(AdministratorSettings::class)->theme;
            } catch (DecryptException $e) {
                // If decryption fails, use the fallback theme from config
                $theme = config('themes-manager.fallback_theme', 'awacms/default');

                // Log the error for debugging
                \Log::warning('Failed to decrypt AdministratorSettings, using fallback theme', [
                    'error' => $e->getMessage()
                ]);
            } catch (MissingSettings $e) {
                // If settings are missing, use the fallback theme from config
                $theme = config('themes-manager.fallback_theme', 'awacms/default');
            }
        }

        // Call parent Middleware handle method
        return parent::handle($request, $next, $theme);
    }
}
