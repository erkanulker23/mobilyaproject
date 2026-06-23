<?php

namespace Modules\Faq\Filament\Resources;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Faq\Entities\Faq;
use Modules\Faq\Entities\FaqItem;
use Modules\Faq\Filament\Resources\FaqItemResource\Pages;

class FaqItemResource extends Resource
{
    use Translatable;

    protected static ?string $model = FaqItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('faq::filament.faqs');
    }

    public static function getModelLabel(): string
    {
        return __('faq::filament.faq_item');
    }

    public static function getPluralModelLabel(): string
    {
        return __('faq::filament.faq_items');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        TextInput::make('title')
                            ->label(__('faq::filament.title'))
                            ->required()
                            ->maxLength(255),
                        Select::make('faqs')
                            ->label(__('faq::filament.faqs'))
                            ->multiple()
                            ->relationship('faqs', 'name')
                            ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->name)
                            ->getSearchResultsUsing(
                                fn (string $search) => Faq::filamentSearch($search)
                                    ->limit(10)
                                    ->pluck('name', 'id')
                            )
                            ->getOptionLabelUsing(fn ($value): ?string => Faq::find($value)?->name),
                        RichEditor::make('description')
                            ->label(__('faq::filament.description'))
                            ->nullable(),
                        RichEditor::make('short_description')
                            ->label(__('faq::filament.short_description'))
                            ->nullable(),
                        KeyValue::make('properties'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->label(__('faq::filament.title')),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqItems::route('/'),
            'create' => Pages\CreateFaqItem::route('/create'),
            'edit' => Pages\EditFaqItem::route('/{record}/edit'),
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
