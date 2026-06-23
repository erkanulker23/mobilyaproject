<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectCategoryResource\Pages;
use App\Models\ProjectCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectCategoryResource extends Resource
{
    protected static ?string $model = ProjectCategory::class;

    protected static ?string $slug = 'urun-kategorileri';

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'İçerik Yönetimi';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return 'Ürün Kategorisi';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Ürün Kategorileri';
    }

    public static function getNavigationLabel(): string
    {
        return 'Ürün Kategorileri';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Kategori Adı')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                    $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
            Forms\Components\TextInput::make('slug')
                ->label('Slug (URL)')
                ->helperText('Boş bırakılırsa addan otomatik üretilir.')
                ->unique(ignoreRecord: true),
            Forms\Components\Section::make('SEO')
                ->schema([
                    Forms\Components\TextInput::make('seo_title')
                        ->label('SEO Başlık')
                        ->maxLength(255)
                        ->helperText('Boş bırakılırsa kategori adı kullanılır.'),
                    Forms\Components\Textarea::make('seo_description')
                        ->label('SEO Açıklama')
                        ->rows(2)
                        ->maxLength(300),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Kategori')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('slug')->label('Slug')->color('gray'),
                Tables\Columns\TextColumn::make('projects_count')->counts('projects')->label('Ürün Sayısı')->badge(),
            ])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectCategories::route('/'),
            'create' => Pages\CreateProjectCategory::route('/create'),
            'edit' => Pages\EditProjectCategory::route('/{record}/edit'),
        ];
    }
}
