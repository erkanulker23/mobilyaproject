<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return 'Blog';
    }

    public static function getModelLabel(): string
    {
        return 'Sayfa';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Sayfalar';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Başlık')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('short_description')
                    ->label('Kısa Açıklama')
                    ->maxLength(65535),
                TinyEditor::make('content')
                    ->profile('full')
                    ->label('İçerik')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('SEO Başlık')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('seo_description')
                            ->label('SEO Açıklama')
                            ->maxLength(65535),
                    ]),

                Section::make('Görseller')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('details_image')
                            ->label('Detay Görseli')
                            ->collection('details_image'),
                        SpatieMediaLibraryFileUpload::make('details_image_mobile')
                            ->label('Detay Görseli (Mobil)')
                            ->collection('details_image_mobile'),
                        SpatieMediaLibraryFileUpload::make('details_hero')
                            ->label('Detay Hero')
                            ->collection('details_hero'),
                        SpatieMediaLibraryFileUpload::make('details_hero_mobile')
                            ->label('Detay Hero (Mobil)')
                            ->collection('details_hero_mobile'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Görüntüle')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Page $record) => $record->url),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
