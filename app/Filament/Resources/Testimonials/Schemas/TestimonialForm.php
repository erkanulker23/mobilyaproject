<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Müşteri Yorumu')
                    ->columns(1)
                    ->schema([
                        TextInput::make('name')->label('Ad Soyad')->required(),
                        TextInput::make('company')->label('Şirket / Şehir'),
                        Textarea::make('comment_tr')->label('Yorum (TR)')->rows(3)->columnSpanFull(),
                        Textarea::make('comment_en')->label('Yorum (EN)')->rows(3)->columnSpanFull(),
                        Select::make('rating')
                            ->label('Puan')
                            ->options([1 => '1 ★', 2 => '2 ★', 3 => '3 ★', 4 => '4 ★', 5 => '5 ★'])
                            ->default(5)
                            ->required(),
                        TextInput::make('sort')->label('Sıra')->numeric()->default(0),
                        FileUpload::make('img')
                            ->label('Fotoğraf')
                            ->image()
                            ->disk('site')
                            ->directory('uploads')
                            ->visibility('public')
                            ->imageEditor()
                            ->avatar(),
                        Toggle::make('is_active')->label('Aktif')->default(true),
                    ]),
            ]);
    }
}
