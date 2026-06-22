<?php

namespace App\Filament\Resources\Slides\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Slayt İçeriği')
                    ->columns(1)
                    ->schema([
                        TextInput::make('slug')->label('Kısa ad (slug)')->required()->unique(ignoreRecord: true),
                        TextInput::make('sub_tr')->label('Üst başlık (TR)')->placeholder('KÖŞE TAKIMLARI'),
                        TextInput::make('sub_en')->label('Üst başlık (EN)'),
                        TextInput::make('title_tr')->label('Başlık (TR)'),
                        TextInput::make('title_en')->label('Başlık (EN)'),
                        Textarea::make('desc_tr')->label('Açıklama (TR)')->rows(2),
                        Textarea::make('desc_en')->label('Açıklama (EN)')->rows(2),
                        Select::make('product_id')
                            ->label('Bağlı Ürün')
                            ->relationship('product', 'tr')
                            ->searchable()->preload()
                            ->helperText('Slayttaki "Keşfet" bağlantısı bu ürüne gider.'),
                        TextInput::make('sort')->label('Sıra')->numeric()->default(0),
                    ]),
                Section::make('Görsel & Video')
                    ->columns(1)
                    ->description('Masaüstünde büyük görsel, mobilde mobil görsel gösterilir. Video varsa görselin yerine oynatılır.')
                    ->schema([
                        FileUpload::make('img')->label('Masaüstü görseli')
                            ->image()->disk('site')->directory('uploads')->visibility('public')->imageEditor(),
                        FileUpload::make('img_mobile')->label('Mobil görseli')
                            ->image()->disk('site')->directory('uploads')->visibility('public')->imageEditor(),
                        FileUpload::make('video')->label('Video (mp4)')
                            ->disk('site')->directory('uploads')->visibility('public')
                            ->acceptedFileTypes(['video/mp4'])
                            ->helperText('Yüklenirse slaytta arka planda otomatik oynar.'),
                    ]),
            ]);
    }
}
