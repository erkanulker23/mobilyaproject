<?php

namespace App\Filament\Pages;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Models\Page;
use App\Settings\GeneralSettings;
use App\Settings\SeoSettings;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Guava\FilamentIconPicker\Forms\IconPicker;

class ManageSeo extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = SeoSettings::class;

    protected static ?string $navigationLabel = 'SEO Ayarları';

    public static function getNavigationGroup(): ?string
    {
        return 'Settings';
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('testimonial_section')
                ->heading('Müşteri Yorumları')
                ->columns(2)
                ->description('Müşteri yorumları sayfası için SEO ayarları')
                ->schema([
                    TextInput::make('testimonial_title')
                        ->label('Müşteri Yorumları Başlık'),
                    TextArea::make('testimonial_description')
                        ->label('Müşteri Yorumları Açıklama'),
                ]),
            Section::make('contact_section')
                ->heading('İletişim')
                ->columns(2)
                ->description('İletişim sayfası için SEO ayarları')
                ->schema([
                    TextInput::make('contact_title')
                        ->label('İletişim Başlık'),
                    TextArea::make('contact_description')
                        ->label('İletişim Açıklama'),
                ]),
            Section::make('gallery_section')
                ->heading('Galeri')
                ->columns(2)
                ->description('Galeri sayfası için SEO ayarları')
                ->schema([
                    TextInput::make('gallery_title')
                        ->label('Galeri Başlık'),
                    TextArea::make('gallery_description')
                        ->label('Galeri Açıklama'),
                ]),
            Section::make('blog_section')
                ->heading('Blog')
                ->columns(2)
                ->description('Blog sayfası için SEO ayarları')
                ->schema([
                    TextInput::make('blog_title')
                        ->label('Blog Başlık'),
                    TextArea::make('blog_description')
                        ->label('Blog Açıklama'),
                ]),
            Section::make('services_section')
                ->heading('Hizmetler')
                ->columns(2)
                ->description('Hizmetler sayfası için SEO ayarları')
                ->schema([
                    TextInput::make('services_title')
                        ->label('Hizmetler Başlık'),
                    TextArea::make('services_description')
                        ->label('Hizmetler Açıklama'),
                ]),
        ];
    }
}
