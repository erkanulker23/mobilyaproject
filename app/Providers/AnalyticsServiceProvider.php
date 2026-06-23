<?php

namespace App\Providers;

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\LaravelSettings\Exceptions\MissingSettings;

class AnalyticsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (file_exists(storage_path('installed')) && Schema::hasTable('settings')) {
            try {
                $settings = app(GeneralSettings::class);
                $config = [
                    'analytics.property_id' => $settings->analytics_property_id,
                    'analytics.service_account_credentials_json' => storage_path('app/'.$settings->analytics_json_file_path),
                ];

                config($config);
            } catch (MissingSettings $e) {
                // do nothing
            }
        }
    }
}
