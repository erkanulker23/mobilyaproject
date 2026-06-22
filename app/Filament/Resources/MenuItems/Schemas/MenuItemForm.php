<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MenuItemForm
{
    public const TYPES = [
        'home'       => 'Ana Sayfa',
        'corporate'  => 'Kurumsal (alt menülü)',
        'collection' => 'Koleksiyon (mega menü)',
        'news'       => 'Haberler',
        'dealers'    => 'Bayiler',
        'contact'    => 'İletişim',
        'faq'        => 'SSS',
        'page'       => 'Sayfa (anahtar)',
        'category'   => 'Kategori (slug)',
        'url'        => 'Özel bağlantı (URL)',
    ];

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Menü Öğesi')
                    ->columns(1)
                    ->schema([
                        Select::make('location')
                            ->label('Konum')
                            ->options(['header' => 'Üst menü (header)', 'footer' => 'Alt menü (footer)'])
                            ->default('header')
                            ->required(),
                        Select::make('type')
                            ->label('Bağlantı tipi')
                            ->options(self::TYPES)
                            ->default('url')
                            ->required()
                            ->live(),
                        TextInput::make('label_tr')->label('Etiket (TR)')->required(),
                        TextInput::make('label_en')->label('Etiket (EN)')->required(),
                        TextInput::make('value')
                            ->label('Hedef (sayfa anahtarı / kategori slug / URL)')
                            ->visible(fn ($get) => in_array($get('type'), ['page', 'category', 'url']))
                            ->columnSpanFull(),
                        TextInput::make('sort')->label('Sıra')->numeric()->default(0),
                        Toggle::make('is_active')->label('Aktif')->default(true),
                    ]),
            ]);
    }
}
