<?php

namespace Modules\Group\Filament\Resources\GroupResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;

class CategoryRelationManager extends RelationManager
{
    protected static string $relationship = 'categories';

    protected static string $inverseRelationshipName = 'groups';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return 'Kategoriler';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('order_column')->numeric()->required()->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('groupables.order_column')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('category_pivot.order_column')
                    ->label('Sıra'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    // TODO: check if this is needed
                    // ->inverseRelationshipName('groups')
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        Select::make('recordId')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->options(fn (RelationManager $livewire): array => Category::orderBy('id', 'desc')
                                ->limit(10)
                                ->pluck('name', 'id')
                                ->toArray()
                            )
                            ->getSearchResultsUsing(
                                fn (string $search, RelationManager $livewire) => Category::filamentSearch($search)
                                    ->orderBy('id', 'desc')
                                    ->limit(10)
                                    ->pluck('name', 'id')
                            )
                            ->getOptionLabelUsing(fn ($value): ?string => Product::find($value)?->name)
                            ->disableLabel(),
                        TextInput::make('order_column')->numeric()->required()->default(0),
                    ]),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
