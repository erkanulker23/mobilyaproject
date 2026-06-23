<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Support\Facades\Cache;

class StatsOverview extends BaseWidget
{
    public function getTwoNumberPercentage($number1, $number2)
    {
        if ($number1 == 0) {
            return 100;
        }

        $percentage = ($number2 - $number1) / $number1 * 100;

        return round($percentage, 2);
    }

    public function getPercentageDescription($percentage)
    {
        $description = 'Geçen aya göre ';
        if ($percentage >= 0) {
            $description .= "%$percentage artış";
        } else {
            $description .= '-%'.abs($percentage).' azalış';
        }

        return $description;
    }

    public function getIconByPercentage($percentage)
    {
        if ($percentage >= 0) {
            return 'heroicon-m-arrow-trending-up';
        } else {
            return 'heroicon-m-arrow-trending-down';
        }
    }

    public function getColorByPercentage($percentage)
    {
        if ($percentage >= 0) {
            return 'success';
        } else {
            return 'danger';
        }
    }

    protected function getCards(): array
    {
        $cacheTTL = 60 * 2;

        return Cache::remember('panel_stats', $cacheTTL, function () {
            $lastMonth = now()->subMonth();
            
            // Blog istatistikleri
            $totalBlogs = \App\Models\BlogPost::count();
            $lastMonthBlogs = \App\Models\BlogPost::where('created_at', '>=', $lastMonth)->count();
            $previousMonthBlogs = \App\Models\BlogPost::where('created_at', '<', $lastMonth)
                ->where('created_at', '>=', $lastMonth->copy()->subMonth())->count();
            $blogPercentage = $this->getTwoNumberPercentage($previousMonthBlogs, $lastMonthBlogs);
            
            // Servis istatistikleri
            $totalServices = \App\Models\ServicePost::count();
            $lastMonthServices = \App\Models\ServicePost::where('created_at', '>=', $lastMonth)->count();
            $previousMonthServices = \App\Models\ServicePost::where('created_at', '<', $lastMonth)
                ->where('created_at', '>=', $lastMonth->copy()->subMonth())->count();
            $servicePercentage = $this->getTwoNumberPercentage($previousMonthServices, $lastMonthServices);
            
            // Form başvuruları
            $totalForms = \App\Models\ContactFormSubmission::count();
            $lastMonthForms = \App\Models\ContactFormSubmission::where('created_at', '>=', $lastMonth)->count();
            $previousMonthForms = \App\Models\ContactFormSubmission::where('created_at', '<', $lastMonth)
                ->where('created_at', '>=', $lastMonth->copy()->subMonth())->count();
            $formPercentage = $this->getTwoNumberPercentage($previousMonthForms, $lastMonthForms);
            
            // Sayfa istatistikleri
            $totalPages = \App\Models\Page::count();
            
            // Testimonials
            $totalTestimonials = \App\Models\Testimonial::count();
            
            // Şubeler
            $totalBranches = \App\Models\Branch::count();
            
            return [
                \Filament\Widgets\StatsOverviewWidget\Stat::make('Toplam Blog Yazısı', $totalBlogs)
                    ->description($this->getPercentageDescription($blogPercentage))
                    ->descriptionIcon($this->getIconByPercentage($blogPercentage))
                    ->color($this->getColorByPercentage($blogPercentage))
                    ->chart([$previousMonthBlogs, $lastMonthBlogs]),
                    
                \Filament\Widgets\StatsOverviewWidget\Stat::make('Toplam Servis', $totalServices)
                    ->description($this->getPercentageDescription($servicePercentage))
                    ->descriptionIcon($this->getIconByPercentage($servicePercentage))
                    ->color($this->getColorByPercentage($servicePercentage))
                    ->chart([$previousMonthServices, $lastMonthServices]),
                    
                \Filament\Widgets\StatsOverviewWidget\Stat::make('Form Başvuruları', $totalForms)
                    ->description($this->getPercentageDescription($formPercentage))
                    ->descriptionIcon($this->getIconByPercentage($formPercentage))
                    ->color($this->getColorByPercentage($formPercentage))
                    ->chart([$previousMonthForms, $lastMonthForms]),
                    
                \Filament\Widgets\StatsOverviewWidget\Stat::make('Toplam Sayfa', $totalPages)
                    ->description('Aktif sayfalar')
                    ->descriptionIcon('heroicon-m-document-text')
                    ->color('info'),
                    
                \Filament\Widgets\StatsOverviewWidget\Stat::make('Referanslar', $totalTestimonials)
                    ->description('Müşteri yorumları')
                    ->descriptionIcon('heroicon-m-star')
                    ->color('warning'),
                    
                \Filament\Widgets\StatsOverviewWidget\Stat::make('Şubeler', $totalBranches)
                    ->description('Aktif şubeler')
                    ->descriptionIcon('heroicon-m-map-pin')
                    ->color('success'),
            ];
        });
    }
}
