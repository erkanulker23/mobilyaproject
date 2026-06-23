<?php

namespace Modules\References\Filament\Resources;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\References\Entities\Reference;
use Modules\References\Filament\Resources\ReferenceResource\Pages\CreateReference;
use Modules\References\Filament\Resources\ReferenceResource\Pages\EditReference;
use Modules\References\Filament\Resources\ReferenceResource\Pages\ListReferences;

class ReferenceResource extends Resource
{
    protected static ?string $model = \Modules\References\Entities\Reference::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    public static function getModelLabel(): string
    {
        return 'Referans';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Referanslar';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Başlık')
                    ->required()
                    ->placeholder('Title'),
                TextInput::make('order_column')
                    ->label('Sıra')
                    ->required()
                    ->numeric()
                    ->step(1)
                    ->default(Reference::query()->max('order_column') + 1)
                    ->placeholder('Order'),
                SpatieMediaLibraryFileUpload::make('logo')
                    ->label('Logolar')
                    ->collection('logo')
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('logo')
                    ->collection('logo')
                    ->label('Logo'),
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
            'index' => ListReferences::route('/'),
            'create' => CreateReference::route('/create'),
            'edit' => EditReference::route('/{record}/edit'),
        ];
    }
}
