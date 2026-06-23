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
                'label' => 'Yeni Blog Yazısı',
                'icon' => 'heroicon-o-document-text',
                'url' => route('filament.admin.resources.blog-posts.create'),
                'color' => 'primary',
                'description' => 'Blog yazısı ekle',
            ],
            [
                'label' => 'Yeni Sayfa',
                'icon' => 'heroicon-o-document-duplicate',
                'url' => route('filament.admin.resources.pages.create'),
                'color' => 'success',
                'description' => 'Yeni sayfa oluştur',
            ],
            [
                'label' => 'Yeni Servis',
                'icon' => 'heroicon-o-wrench-screwdriver',
                'url' => route('filament.admin.resources.service-posts.create'),
                'color' => 'warning',
                'description' => 'Servis ekle',
            ],
            [
                'label' => 'Medya Kütüphanesi',
                'icon' => 'heroicon-o-photo',
                'url' => '#',
                'color' => 'info',
                'description' => 'Görselleri yönet',
            ],
            [
                'label' => 'Site Ayarları',
                'icon' => 'heroicon-o-cog-6-tooth',
                'url' => route('filament.admin.pages.manage-settings'),
                'color' => 'gray',
                'description' => 'Genel ayarlar',
            ],
            [
                'label' => 'Menü Yönetimi',
                'icon' => 'heroicon-o-bars-3',
                'url' => '#',
                'color' => 'purple',
                'description' => 'Menüleri düzenle',
            ],
        ];
    }
}

