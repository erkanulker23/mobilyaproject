<?php

namespace App\Filament\Pages;

use App\Filament\Support\SettingsPage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ManageSeo extends SettingsPage
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedMagnifyingGlass;

    protected static ?int $navigationSort = 51;

    protected static ?string $title = 'SEO Ayarları';

    protected static ?string $navigationLabel = 'SEO Ayarları';

    protected function settingsGroup(): string
    {
        return 'seo';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Site Geneli SEO')
                    ->description('Sayfa bazlı SEO girilmediğinde bu varsayılanlar kullanılır.')
                    ->columns(1)
                    ->schema([
                        TextInput::make('seoTitleTr')->label('SEO Başlık (TR)')->maxLength(255),
                        TextInput::make('seoTitleEn')->label('SEO Başlık (EN)')->maxLength(255),
                        Textarea::make('seoDescTr')->label('SEO Açıklama (TR)')->rows(2),
                        Textarea::make('seoDescEn')->label('SEO Açıklama (EN)')->rows(2),
                        FileUpload::make('ogImage')->label('Paylaşım görseli (OG image)')->image()
                            ->disk('site')->directory('uploads')->visibility('public'),
                    ]),
            ])
            ->statePath('data');
    }
}
