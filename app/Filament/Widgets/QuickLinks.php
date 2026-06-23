<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickLinks extends Widget
{
    protected static string $view = 'filament.widgets.quick-links';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    public function getLinks(): array
    {
        return [
            [
                'label' => 'Yeni Ürün',
                'icon' => 'heroicon-o-cube',
                'url' => \App\Filament\Resources\ProjectResource::getUrl('create'),
                'color' => 'primary',
                'description' => 'Ürün ekle',
            ],
            [
                'label' => 'Yeni Haber',
                'icon' => 'heroicon-o-document-text',
                'url' => \App\Filament\Resources\BlogPostResource::getUrl('create'),
                'color' => 'success',
                'description' => 'Haber / blog yazısı ekle',
            ],
            [
                'label' => 'Bayiler',
                'icon' => 'heroicon-o-map-pin',
                'url' => \App\Filament\Resources\BranchResource::getUrl(),
                'color' => 'warning',
                'description' => 'Bayileri yönet',
            ],
            [
                'label' => 'Yeni Sayfa',
                'icon' => 'heroicon-o-document-duplicate',
                'url' => \App\Filament\Resources\PageResource::getUrl('create'),
                'color' => 'info',
                'description' => 'Yeni sayfa oluştur',
            ],
            [
                'label' => 'Genel Ayarlar',
                'icon' => 'heroicon-o-cog-6-tooth',
                'url' => route('filament.admin.pages.manage-settings'),
                'color' => 'gray',
                'description' => 'İletişim, sosyal medya, marka',
            ],
            [
                'label' => 'SSS',
                'icon' => 'heroicon-o-question-mark-circle',
                'url' => \Modules\Faq\Filament\Resources\FaqResource::getUrl(),
                'color' => 'gray',
                'description' => 'Sıkça sorulan sorular',
            ],
        ];
    }
}

