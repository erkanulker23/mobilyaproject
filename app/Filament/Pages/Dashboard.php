<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\BlogPostsChart;
use App\Filament\Widgets\LatestBlogPosts;
use App\Filament\Widgets\LatestFormSubmissions;
use App\Filament\Widgets\PopularBlogCategories;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\SystemInfo;
use Filament\Actions\Action;
use Filament\Pages\Dashboard as BasePage;
use Illuminate\Support\Facades\Artisan;

class Dashboard extends BasePage
{
    protected function getHeaderActions(): array
    {
        return [
            Action::make('Clear Cache')
                ->label('Önbelleği Temizle')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function () {
                    Artisan::call('cache:clear');
                    Artisan::call('config:clear');
                    Artisan::call('route:clear');
                    Artisan::call('view:clear');

                    \Filament\Notifications\Notification::make()
                        ->title('Önbellek temizlendi')
                        ->success()
                        ->send();
                }),
            Action::make('Clean Unused Media')
                ->label('Kullanılmayan Medyaları Temizle')
                ->icon('heroicon-o-photo')
                ->color('warning')
                ->requiresConfirmation()
                ->action(function () {
                    Artisan::call('media-library:clean');

                    \Filament\Notifications\Notification::make()
                        ->title('Kullanılmayan medyalar temizlendi')
                        ->success()
                        ->send();
                }),
            Action::make('Generate Sitemap')
                ->label('Site Haritası Oluştur')
                ->icon('heroicon-o-map')
                ->color('success')
                ->requiresConfirmation()
                ->action(function () {
                    Artisan::call('sitemap:generate');

                    \Filament\Notifications\Notification::make()
                        ->title('Site haritası oluşturuldu')
                        ->body('Sitemap başarıyla oluşturuldu ve güncellendi.')
                        ->success()
                        ->send();
                }),
        ];
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            \App\Filament\Widgets\QuickLinks::class,
            LatestBlogPosts::class,
            \App\Filament\Widgets\PopularBlogPosts::class,
            LatestFormSubmissions::class,
            BlogPostsChart::class,
            PopularBlogCategories::class,
            \App\Filament\Widgets\LowSeoScorePosts::class,
            SystemInfo::class,
        ];
    }
}
