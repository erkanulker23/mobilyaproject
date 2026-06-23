<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix home.blade.php
        $homeBladePath = base_path('themes/awacms/default/resources/views/frontend/home.blade.php');

        if (File::exists($homeBladePath)) {
            $content = File::get($homeBladePath);

            // Replace theme_asset_minified with asset() calls
            $content = str_replace(
                "{{ theme_asset_minified('css/newstyle.css') }}",
                "{{ asset('themes/awacms/default/public/css/newstyle.min.css') }}",
                $content
            );

            $content = str_replace(
                "{{ theme_asset_minified('css/icon.css') }}",
                "{{ asset('themes/awacms/default/public/css/icon.min.css') }}",
                $content
            );

            File::put($homeBladePath, $content);
        }

        // Fix app.blade.php
        $appBladePath = base_path('themes/awacms/default/resources/views/frontend/layouts/app.blade.php');

        if (File::exists($appBladePath)) {
            $content = File::get($appBladePath);

            // Replace all theme_asset_minified calls with conditional asset() calls
            $content = preg_replace(
                '/\{\{\s*theme_asset_minified\(([^)]+)\)\s*\}\}/',
                '{{ asset($1) }}',
                $content
            );

            File::put($appBladePath, $content);
        }

        // Clear view cache
        \Artisan::call('view:clear');
        \Artisan::call('config:clear');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is not reversible
        // We don't want to restore the broken theme_asset_minified calls
    }
};
