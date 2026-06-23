<?php

namespace Modules\Gallery\Filament\Resources;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Gallery\Filament\Resources\GalleryCategoryResource\Pages\ListGalleryCategories;

class GalleryCategoryResource extends Resource
{
    protected static ?string $model = \Modules\Gallery\Entities\GalleryCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function getModelLabel(): string
    {
        return 'Galeri Kategorisi';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Galeri Kategorileri';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('İsim')
                    ->maxLength(255),
                Checkbox::make('is_listable')
                    ->label('Listelenebilir mi?')
                    ->default(true)
                    ->helperText('Eğer bu seçeneği işaretlerseniz, bu kategori galeri sayfasında listelenecektir.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('İsim'),
                Tables\Columns\CheckboxColumn::make('is_listable')
                    ->label('Listelenebilir mi?'),
                Tables\Columns\TextColumn::make('gallery_entries_count')
                    ->label('İçerik Sayısı')
                    ->counts('galleryEntries'),
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
            'index' => ListGalleryCategories::route('/'),
        ];
    }
}
