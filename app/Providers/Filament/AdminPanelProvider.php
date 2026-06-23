<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Pages\Dashboard;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Modules\Comment\Providers\CommentPlugin;
use Modules\Faq\Providers\FaqPlugin;
use Modules\Features\Providers\FeaturesPlugin;
use Modules\Gallery\Providers\GalleryPlugin;
use Modules\GoogleReview\Providers\GoogleReviewPlugin;
use Modules\Group\Providers\GroupPlugin;
use Modules\Members\Providers\MemberPlugin;
use Modules\Menu\Providers\MenuPlugin;
use Modules\Newsletter\Providers\NewsletterPlugin;
use Modules\Plan\Providers\PlanPlugin;
use Modules\References\Providers\ReferencePlugin;
use Modules\Slide\Providers\SlidePlugin;
use Modules\Tag\Providers\TagPlugin;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Spatie\LaravelSettings\Exceptions\MissingSettings;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::hex('#D97757'),
                'gray' => Color::hex('#5A5349'),
            ])
            ->font('Manrope')
            ->renderHook(
                'panels::head.end',
                fn (): string => <<<'HTML'
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
                    <style>
                        .fi-topbar, .fi-sidebar-header { font-family: 'Manrope', sans-serif; }
                        .fi-sidebar-item-label, .fi-btn, h1, h2, h3, .fi-header-heading { font-family: 'Plus Jakarta Sans', 'Manrope', sans-serif !important; }
                        .fi-sidebar-nav .fi-sidebar-group-label { letter-spacing: .04em; text-transform: uppercase; font-size: 10.5px; }
                        :root { --kal-accent: #D97757; }
                        .fi-sidebar-item.fi-active > a, .fi-sidebar-item-active > a { border-left: 3px solid #D97757; }
                    </style>
                HTML
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            // Sadeleştirilmiş menü: yalnızca AWA Mobilya (DC frontend) için kullanılan
            // kaynaklar gösterilir. Diğer AWA-CMS modülleri/sayfaları gizli kalır.
            ->navigation(function (\Filament\Navigation\NavigationBuilder $builder): \Filament\Navigation\NavigationBuilder {
                return $builder
                    ->items([
                        ...\App\Filament\Pages\Dashboard::getNavigationItems(),
                        ...\App\Filament\Pages\HomepageBuilderPage::getNavigationItems(),
                    ])
                    ->groups([
                        \Filament\Navigation\NavigationGroup::make('İçerik Yönetimi')->items([
                            ...\App\Filament\Resources\ProjectResource::getNavigationItems(),
                            ...\App\Filament\Resources\ProjectCategoryResource::getNavigationItems(),
                            ...\Modules\Slide\Filament\Resources\SliderResource::getNavigationItems(),
                            ...\Modules\Slide\Filament\Resources\SlideResource::getNavigationItems(),
                            ...\App\Filament\Resources\BlogPostResource::getNavigationItems(),
                            ...\App\Filament\Resources\BlogCategoryResource::getNavigationItems(),
                            ...\App\Filament\Resources\BranchResource::getNavigationItems(),
                            ...\Modules\Faq\Filament\Resources\FaqResource::getNavigationItems(),
                            ...\Modules\Faq\Filament\Resources\FaqItemResource::getNavigationItems(),
                            ...\App\Filament\Resources\PageResource::getNavigationItems(),
                        ]),
                        \Filament\Navigation\NavigationGroup::make('Talepler')->items([
                            ...\App\Filament\Resources\ContactFormSubmissionResource::getNavigationItems(),
                            ...\Modules\Newsletter\Filament\Resources\NewsletterSubscriberResource::getNavigationItems(),
                        ]),
                        \Filament\Navigation\NavigationGroup::make('Ayarlar')->items([
                            ...\App\Filament\Pages\ManageSettings::getNavigationItems(),
                            ...\App\Filament\Pages\ManageImage::getNavigationItems(),
                            ...\App\Filament\Pages\ManageSeo::getNavigationItems(),
                            ...\App\Filament\Pages\ManageEmail::getNavigationItems(),
                            ...\App\Filament\Pages\ManageCookieConsent::getNavigationItems(),
                            ...\App\Filament\Pages\StyleScriptSettings::getNavigationItems(),
                            ...\App\Filament\Pages\ManageTopbar::getNavigationItems(),
                            ...\App\Filament\Pages\PopupSettings::getNavigationItems(),
                            ...\App\Filament\Pages\ManageThirdParty::getNavigationItems(),
                            ...\App\Filament\Pages\ManageAdministrator::getNavigationItems(),
                        ]),
                        \Filament\Navigation\NavigationGroup::make('Sistem')->items([
                            ...\App\Filament\Resources\UserResource::getNavigationItems(),
                        ]),
                    ]);
            })
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('300s')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(config('filament-spatie-laravel-translatable-plugin.default_locales')),
                FilamentSpatieRolesPermissionsPlugin::make(),
                SlidePlugin::make(),
                // GroupPlugin kaldırıldı (kullanılmıyor)
                // TagPlugin kaldırıldı (kullanılmıyor)
                CommentPlugin::make(),
                MenuPlugin::make(),
                NewsletterPlugin::make(),
                ReferencePlugin::make(),
                FaqPlugin::make(),
                MemberPlugin::make(),
                FeaturesPlugin::make(),
                // PlanPlugin kaldırıldı (inşaat projesinde kullanılmıyor)
                GalleryPlugin::make(),
                GoogleReviewPlugin::make(),
                SpotlightPlugin::make(),
            ])
            // ->middleware([
            //     \Shipu\WebInstaller\Middleware\RedirectIfNotInstalled::class,
            // ])
            ->authMiddleware([
                Authenticate::class,
            ])->userMenuItems([
                MenuItem::make()
                    ->label('Siteye Git')
                    ->url(fn (): string => url('/'))
                    ->icon('heroicon-o-globe-alt'),
                // ...
            ])
            ->defaultThemeMode(ThemeMode::Light);

        if (file_exists(storage_path('installed')) && Schema::hasTable('settings')) {
            try {
                $panel->brandName(app(\App\Settings\GeneralSettings::class)->site_name);
            } catch (MissingSettings $e) {
                // do nothing
            }

        }

        return $panel;
    }
}
