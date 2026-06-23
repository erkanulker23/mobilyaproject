<?php

namespace Modules\Menu\Filament\Resources;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Menu\Entities\Menu;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    public static function getNavigationGroup(): ?string
    {
        return 'Menu';
    }

    /**
     * @return string|null
     */
    public static function getModelLabel(): string
    {
        return 'Menü';
    }

    /**
     * @return string|null
     */
    public static function getPluralModelLabel(): string
    {
        return 'Menüler';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->autofocus()
                    ->placeholder('Name')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Builder')
                    ->url(fn (Menu $record): string => route('filament.admin.resources.menus.build', $record))
                    ->icon('heroicon-o-bars-3'),
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
            'index' => \Modules\Menu\Filament\Resources\MenuResource\Pages\ListMenus::route('/'),
            'create' => \Modules\Menu\Filament\Resources\MenuResource\Pages\CreateMenu::route('/create'),
            'edit' => \Modules\Menu\Filament\Resources\MenuResource\Pages\EditMenu::route('/{record}/edit'),
            'build' => \Modules\Menu\Filament\Resources\MenuResource\Pages\MenuBuilder::route('/{record}/build'),
        ];
    }

    public static function getSlug(): string
    {
        if (filled(static::$slug)) {
            return static::$slug;
        }

        return Str::of(static::getModel())
            ->afterLast('\\Entities\\')
            ->plural()
            ->explode('\\')
            ->map(fn (string $string) => Str::of($string)->kebab()->slug())
            ->implode('/');
    }
}
