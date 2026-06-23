<?php

if (! function_exists('theme_asset')) {
    function theme_asset($path, $addVersion = false)
    {
        try {
            $theme = \Hexadog\ThemesManager\Facades\ThemesManager::current();
            $url = $theme->asset($path);
        } catch (\Exception $e) {
            // Fallback: config'den tema adını al
            $themePath = config('themes-manager.fallback_theme', 'awacms/default');
            $url = asset('themes/' . $themePath . '/public/' . $path);
        }

        // Versiyon ekle
        if ($addVersion) {
            $version = config('app.version', '1.0.0');
            $url .= '?v=' . $version;
        }

        return $url;
    }
}

if (! function_exists('theme_asset_minified')) {
    function theme_asset_minified($path, $addVersion = false)
    {
        $isProduction = config('app.env') === 'production';

        // Production ise .min uzantılı dosyayı kullan
        if ($isProduction) {
            // Dosya uzantısını bul
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $pathWithoutExt = substr($path, 0, -(strlen($extension) + 1));

            // .min uzantısı ekle
            $minifiedPath = $pathWithoutExt . '.min.' . $extension;

            // Tema için tam yolu oluştur
            try {
                $themePath = \Hexadog\ThemesManager\Facades\ThemesManager::current()->getName();
                $fullPath = public_path('themes/' . $themePath . '/public/' . $minifiedPath);

                // Minified dosya var mı kontrol et
                if (file_exists($fullPath)) {
                    $path = $minifiedPath;
                }
            } catch (\Exception $e) {
                // Fallback: config'den tema adını al
                $themePath = config('themes-manager.fallback_theme', 'awacms/default');
                $fullPath = public_path('themes/' . $themePath . '/public/' . $minifiedPath);

                if (file_exists($fullPath)) {
                    $path = $minifiedPath;
                }
            }
        }

        // Tema asset helper'ını kullan
        try {
            $url = theme_asset($path);
        } catch (\Exception $e) {
            // Fallback: normal asset kullan
            $url = asset($path);
        }

        // Versiyon ekle
        if ($addVersion) {
            $version = config('app.version', '1.0.0');
            $url .= '?v=' . $version;
        }

        return $url;
    }
}

if (! function_exists('safe_general_settings')) {
    /**
     * Güvenli şekilde GeneralSettings'e erişim sağlar
     * Eksik ayarlar için hata vermez, null döner
     */
    function safe_general_settings()
    {
        try {
            return app(\App\Settings\GeneralSettings::class);
        } catch (\Spatie\LaravelSettings\Exceptions\MissingSettings $e) {
            return null;
        }
    }
}
if (! function_exists('kalyon_settings')) {
    /**
     * GeneralSettings örneğini güvenli şekilde döndürür (yoksa null).
     */
    function kalyon_settings()
    {
        try {
            return app(\App\Settings\GeneralSettings::class);
        } catch (\Throwable $e) {
            return null;
        }
    }
}

if (! function_exists('kalyon_setting')) {
    /**
     * GeneralSettings'ten bir alanı, boşsa verilen varsayılanı döndürür.
     */
    function kalyon_setting($key, $default = null)
    {
        $s = kalyon_settings();
        if (! $s) {
            return $default;
        }
        try {
            $val = $s->{$key} ?? null;
        } catch (\Throwable $e) {
            return $default;
        }
        return ($val === null || $val === '') ? $default : $val;
    }
}
