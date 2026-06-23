<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatalogResource\Pages;
use App\Models\Catalog;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CatalogResource extends Resource
{
    protected static ?string $model = Catalog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';

    protected static ?string $navigationGroup = 'İçerik Yönetimi';

    protected static ?int $navigationSort = 2;

    public static function getModelLabel(): string
    {
        return 'Katalog';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Kataloglar';
    }

    public static function getNavigationLabel(): string
    {
        return 'Kataloglar';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Katalog Adı')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                            $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('slug')->label('Slug')->unique(ignoreRecord: true),
                    Forms\Components\TextInput::make('year')->label('Yıl')->placeholder('2024'),
                    Forms\Components\TextInput::make('file_size')->label('Dosya Boyutu (etiket)')->placeholder('4.2 MB'),
                    Forms\Components\Toggle::make('published')->label('Yayında')->default(true),
                    Forms\Components\Textarea::make('description')->label('Açıklama')->rows(3)->columnSpanFull(),
                    SpatieMediaLibraryFileUpload::make('cover')
                        ->label('Kapak Görseli')->collection('cover')->image()->imageEditor(),
                    SpatieMediaLibraryFileUpload::make('file')
                        ->label('PDF Dosyası')->collection('file')
                        ->acceptedFileTypes(['application/pdf'])->downloadable()->openable(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')->collection('cover')->label('Kapak'),
                Tables\Columns\TextColumn::make('title')->label('Katalog')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('year')->label('Yıl'),
                Tables\Columns\TextColumn::make('file_size')->label('Boyut'),
                Tables\Columns\IconColumn::make('published')->label('Yayında')->boolean(),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCatalogs::route('/'),
            'create' => Pages\CreateCatalog::route('/create'),
            'edit' => Pages\EditCatalog::route('/{record}/edit'),
        ];
    }
}
