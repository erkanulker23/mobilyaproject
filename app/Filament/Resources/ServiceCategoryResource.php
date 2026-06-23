<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceCategoryResource\Pages\CreateServiceCategory;
use App\Filament\Resources\ServiceCategoryResource\Pages\EditServiceCategory;
use App\Filament\Resources\ServiceCategoryResource\Pages\ListServiceCategories;
use App\Models\ServiceCategory;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceCategoryResource extends Resource
{
    protected static ?string $model = ServiceCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return 'Servis';
    }

    public static function getModelLabel(): string
    {
        return 'Servis Kategorisi';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Servis Kategorileri';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.blog_category.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('parent_id')
                    ->label(__('filament.blog_category.parent_id'))
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(10)
                    ->placeholder('Üst Kategori Seçiniz'),
                Forms\Components\Textarea::make('short_description')
                    ->label(__('Kısa Açıklama'))
                    ->maxLength(65535),
                Grid::make()
                    ->columns(1)
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label(__('İçerik'))
                            ->maxLength(65535),
                    ]),
                Forms\Components\TextInput::make('order_column')
                    ->label(__('filament.blog_category.order_column'))
                    ->default(0)
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('filament.is_active'))
                    ->required(),
                Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label(__('SEO Başlık'))
                            ->maxLength(255),
                        Forms\Components\Textarea::make('seo_description')
                            ->label(__('SEO Açıklama'))
                            ->maxLength(65535),
                    ]),
                Section::make('Görseller')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('category_details_image')
                            ->label(__('filament.blog_category.category_details_image'))
                            ->collection('category_details_image'),
                        SpatieMediaLibraryFileUpload::make('category_details_hero')
                            ->label(__('filament.blog_category.category_details_hero'))
                            ->collection('category_details_hero'),
                        SpatieMediaLibraryFileUpload::make('category_icon')
                            ->label(__('filament.blog_category.category_icon'))
                            ->collection('category_icon'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.blog_category.name')),
                Tables\Columns\TextColumn::make('short_description')
                    ->label(__('Kısa Açıklama'))
                    ->limit(50),
                Tables\Columns\TextColumn::make('order_column'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => ListServiceCategories::route('/'),
            'create' => CreateServiceCategory::route('/create'),
            'edit' => EditServiceCategory::route('/{record}/edit'),
        ];
    }
}
