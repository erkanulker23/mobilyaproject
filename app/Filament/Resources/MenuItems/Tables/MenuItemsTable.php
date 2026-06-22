<?php

namespace App\Filament\Resources\MenuItems\Tables;

use App\Filament\Resources\MenuItems\Schemas\MenuItemForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MenuItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultGroup('location')
            ->defaultSort('sort')
            ->reorderable('sort')
            ->columns([
                TextColumn::make('label_tr')->label('Etiket (TR)')->searchable(),
                TextColumn::make('label_en')->label('Etiket (EN)')->searchable(),
                TextColumn::make('type')
                    ->label('Tip')
                    ->badge()
                    ->formatStateUsing(fn ($state) => MenuItemForm::TYPES[$state] ?? $state),
                TextColumn::make('location')
                    ->label('Konum')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'header' ? 'Üst menü' : 'Alt menü'),
                IconColumn::make('is_active')->label('Aktif')->boolean(),
                TextColumn::make('sort')->label('Sıra')->numeric()->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
