<?php

namespace Modules\Gallery\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Gallery\Filament\Resources\GalleryEntryResource\Pages\CreateGalleryEntry;
use Modules\Gallery\Filament\Resources\GalleryEntryResource\Pages\EditGalleryEntry;
use Modules\Gallery\Filament\Resources\GalleryEntryResource\Pages\ListGalleryEntries;

class GalleryEntryResource extends Resource
{
    protected static ?string $model = \Modules\Gallery\Entities\GalleryEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function getModelLabel(): string
    {
        return 'Galeri İçeriği';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Galeri İçerikleri';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->label('Başlık')
                    ->maxLength(255),
                Select::make('gallery_category_id')
                    ->relationship('galleryCategory', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Galeri Kategorisi')
                    ->createOptionForm(function () {
                        return [
                            TextInput::make('name')
                                ->required()
                                ->label('İsim')
                                ->maxLength(255),
                        ];
                    }),
                TextInput::make('subtitle')
                    ->maxLength(255)
                    ->label('Alt Başlık'),
                TextInput::make('description')
                    ->maxLength(255)
                    ->label('Açıklama'),
                TextInput::make('youtube_embed_url')
                    ->maxLength(255)
                    ->label('YouTube URL'),

                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Görseller')
                    ->collection('image')
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(50)
                    ->panelLayout('grid')
                    ->imagePreviewHeight('150')
                    ->columns(5)
                    ->columnSpanFull()
                    ->downloadable()
                    ->openable()
                    ->deletable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->label('Görsel'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Başlık'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column');
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
            'index' => ListGalleryEntries::route('/'),
            'create' => CreateGalleryEntry::route('/create'),
            'edit' => EditGalleryEntry::route('/{record}/edit'),
        ];
    }
}
