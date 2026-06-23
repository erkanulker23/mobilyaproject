<?php

namespace Modules\Menu\Filament\Resources;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Menu\Entities\MenuItem;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

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
        return 'Menü Öğesi';
    }

    /**
     * @return string|null
     */
    public static function getPluralModelLabel(): string
    {
        return 'Menü Öğeleri';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('url'),
                Tables\Columns\TextColumn::make('menu.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getFormSchema()
    {
        return [
            TextInput::make('name')
                ->autofocus()
                ->required()
                ->maxLength(255),
            TextInput::make('icon')
                ->maxLength(255),
            Select::make('target')
                ->required()
                ->default('_self')
                ->options([
                    '_self' => 'Same window',
                    '_blank' => 'New window',
                ]),
            TextInput::make('link_class')
                ->maxLength(255),
            TextInput::make('wrapper_class')
                ->maxLength(255),
            Select::make('menuable_type')
                ->options(
                    array_flip(config('menu.menuables'))
                )
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('menuable_id', null)),
            Select::make('menuable_id')
                ->searchable()
                ->getSearchResultsUsing(function (string $search, callable $get) {
                    $className = $get('menuable_type');

                    return $className::filamentSearch($search)->pluck($className::getFilamentSearchLabel(), 'id');
                })
                ->getOptionLabelUsing(fn ($value, $get): ?string => $get('menuable_type')::find($value)?->getFilamentSearchOptionName())
                ->hidden(fn ($get) => $get('menuable_type') == null),
            TextInput::make('url')
                ->hidden(fn ($get) => $get('menuable_type') != null)
                ->maxLength(255),
            KeyValue::make('parameters')
                ->helperText('mega_menu, mega_menu_columns'),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Modules\Menu\Filament\Resources\MenuItemResource\Pages\ListMenuItems::route('/'),
            'create' => \Modules\Menu\Filament\Resources\MenuItemResource\Pages\CreateMenuItem::route('/create'),
            'edit' => \Modules\Menu\Filament\Resources\MenuItemResource\Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
