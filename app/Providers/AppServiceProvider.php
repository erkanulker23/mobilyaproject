<?php

namespace App\Providers;

use App\Models\BlogPost;
use App\Observers\BlogPostObserver;
use App\Settings\GeneralSettings;
use Exception;
use Illuminate\Support\ServiceProvider;
use Spatie\LaravelSettings\Exceptions\MissingSettings;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Health::checks([
            UsedDiskSpaceCheck::new(),
            DatabaseCheck::new(),
        ]);
    }

    /**
     * bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register observers
        BlogPost::observe(BlogPostObserver::class);
        
        // Set timezone
        date_default_timezone_set('Europe/Istanbul');
        \Carbon\Carbon::setLocale('tr_TR');
        setlocale(LC_TIME, $this->app->getLocale());
        if (! app()->runningInConsole()) {
            try {
                $generalSettings = app(GeneralSettings::class);
                $config = [
                    'cookie-consent.enabled' => $generalSettings->show_cookie_consent_banner,
                ];

                config($config);
            } catch (MissingSettings $e) {
                // Settings not configured yet, use defaults
                config(['cookie-consent.enabled' => false]);
            } catch (Exception $e) {
                // Other exceptions, use defaults
                config(['cookie-consent.enabled' => false]);
            }
        }
    }
}
