<?php

namespace Modules\Faq\Filament\Resources\FaqResource\RelationManagers;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class FaqItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'title';

    protected static function getModelLabel(): string
    {
        return __('faq::filament.faq_item');
    }

    protected static function getPluralModelLabel(): string
    {
        return __('faq::filament.faq_items');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('faq::filament.faq_items');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label(__('faq::filament.title'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('order_column')
                    ->label(__('faq::filament.order_column'))
                    ->required()
                    ->numeric()
                    ->default(0),
                RichEditor::make('description')
                    ->label(__('faq::filament.description'))
                    ->nullable()
                    ->columnSpanFull(),
                RichEditor::make('short_description')
                    ->label(__('faq::filament.short_description'))
                    ->nullable()
                    ->columnSpanFull(),
                KeyValue::make('properties'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('order_column')
            ->columns([
                Tables\Columns\TextColumn::make('order_column')
                    ->label(__('faq::filament.order_column')),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('faq::filament.title')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        TextInput::make('order_column')
                            ->label(__('faq::filament.order_column'))
                            ->required()
                            ->numeric()
                            ->default(0),
                    ]),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
