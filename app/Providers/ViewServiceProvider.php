<?php

namespace App\Providers;

use App\DTOs\Member\SocialMediaLinkData;
use App\DTOs\Menu\MenuData;
use App\Models\Page;
use App\Settings\GeneralSettings;
use App\Settings\StyleScriptSettings;
use App\Settings\TopbarSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('cookie-consent::index', function ($view) {
            $cookieConsentText = app(GeneralSettings::class)->cookie_consent_banner_text;
            $cookieConsentPageId = app(GeneralSettings::class)->cookie_consent_page;
            $cookieConsentPage = Page::find($cookieConsentPageId);

            $view->with('cookieConsentText', $cookieConsentText);
            $view->with('cookieConsentPageUrl', $cookieConsentPage?->url);
        });

        View::composer('frontend.partials.header', function ($view) {
            $settings = app(GeneralSettings::class);
            $view->with('blocks', $settings->header);
        });

        View::composer('frontend.partials.footer', function ($view) {
            $settings = app(GeneralSettings::class);
            $view->with('blocks', $settings->footer);
        });

        View::composer('frontend.*', function ($view) {
            View::share('generalSettings', app(GeneralSettings::class));
            View::share('topbarSettings', app(TopbarSettings::class));

            View::share('header_codes', app(StyleScriptSettings::class)->header_codes);
            View::share('scripts', app(StyleScriptSettings::class)->scripts);
            View::share('styles', app(StyleScriptSettings::class)->styles);
        });
    }
}
