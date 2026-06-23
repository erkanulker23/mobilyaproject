<?php

namespace Modules\Group\Filament\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Modules\Group\Entities\Group;
use Modules\Group\Filament\Resources\GroupResource\Pages;
use Modules\Group\Filament\Resources\GroupResource\RelationManagers\CategoryRelationManager;
use Modules\Group\Filament\Resources\GroupResource\RelationManagers\ProductRelationManager;

class GroupResource extends Resource
{
    use Translatable;

    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('group::filament.model_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('group::filament.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        //                        \Camya\Filament\Forms\Components\TitleWithSlugInput::make(
                        //                            fieldTitle: 'title',
                        //                            fieldSlug: 'slug',
                        //                            urlHostVisible: false,
                        //                            titleLabel: __('group::filament.title'),
                        //                            titleRules: [
                        //                                'required',
                        //                                'string',
                        //                                'max:255',
                        //                            ],
                        //                        ),
                        TextInput::make('title')
                            ->label(__('group::filament.title'))
                            ->required()
                            ->maxLength(255),
                    ]),
                TextInput::make('subtitle')
                    ->label(__('group::filament.subtitle'))
                    ->maxLength(255),
                Textarea::make('description')
                    ->label(__('group::filament.description'))
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('group::filament.id')),
                TextColumn::make('title')
                    ->label(__('group::filament.title'))
                    ->searchable()
                    ->sortable(),
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
            ProductRelationManager::class,
            CategoryRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
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
