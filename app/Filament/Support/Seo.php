<?php

namespace App\Filament\Support;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class Seo
{
    /**
     * Kayıt başına SEO alanları (TR/EN). Tüm içerik formlarında yeniden kullanılır.
     */
    public static function section(): Section
    {
        return Section::make('SEO Ayarları')
            ->description('Arama motorları ve sosyal paylaşım için başlık/açıklama. Boş bırakılırsa site varsayılanları kullanılır.')
            ->collapsed()
            ->columns(2)
            ->schema([
                TextInput::make('seo_title_tr')->label('SEO Başlık (TR)')->maxLength(255),
                TextInput::make('seo_title_en')->label('SEO Başlık (EN)')->maxLength(255),
                Textarea::make('seo_desc_tr')->label('SEO Açıklama (TR)')->rows(2)->columnSpanFull(),
                Textarea::make('seo_desc_en')->label('SEO Açıklama (EN)')->rows(2)->columnSpanFull(),
            ]);
    }
}
