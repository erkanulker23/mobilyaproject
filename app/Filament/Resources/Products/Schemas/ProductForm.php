<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Filament\Support\Seo;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ürün Bilgileri')
                    ->columns(1)
                    ->schema([
                        TextInput::make('tr')
                            ->label('Ad (TR)')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set, callable $get) => filled($get('slug')) ? null : $set('slug', Str::slug((string) $state))),
                        TextInput::make('en')->label('Ad (EN)')->required(),
                        Select::make('category_id')->label('Kategori')->relationship('category', 'tr')->searchable()->preload()->required(),
                        TextInput::make('slug')->label('Kısa ad (slug)')->required()->unique(ignoreRecord: true),
                        TextInput::make('sort')->label('Sıra')->numeric()->default(0),
                    ]),
                Section::make('Açıklama')
                    ->columns(1)
                    ->schema([
                        Textarea::make('desc_tr')->label('Açıklama (TR)')->rows(3),
                        Textarea::make('desc_en')->label('Açıklama (EN)')->rows(3),
                    ]),
                Section::make('Özellikler')
                    ->description('Her satır bir özellik maddesi olarak gösterilir.')
                    ->columns(1)
                    ->schema([
                        Textarea::make('features_tr')->label('Özellikler (TR)')->rows(5)
                            ->placeholder("El işçiliğiyle üretilen sağlam ahşap karkas\n2 yıl üretici garantisi"),
                        Textarea::make('features_en')->label('Özellikler (EN)')->rows(5),
                    ]),
                Section::make('Görseller')
                    ->description('İlk görsel ana görsel olarak kullanılır. Galeri ürün detay sayfasında gösterilir.')
                    ->columns(1)
                    ->schema([
                        FileUpload::make('img')->label('Ana görsel')
                            ->image()->disk('site')->directory('uploads')->visibility('public')->imageEditor(),
                        FileUpload::make('gallery')->label('Galeri (çoklu görsel)')
                            ->image()->multiple()->reorderable()
                            ->disk('site')->directory('uploads')->visibility('public'),
                    ]),
                Seo::section(),
            ]);
    }
}
