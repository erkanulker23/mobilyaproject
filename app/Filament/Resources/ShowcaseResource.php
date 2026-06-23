<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShowcaseResource\Pages;
use App\Models\Showcase;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ShowcaseResource extends Resource
{
    protected static ?string $model = Showcase::class;

    protected static ?string $slug = 'projeler';

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'İçerik Yönetimi';

    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return 'Proje';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Projeler';
    }

    public static function getNavigationLabel(): string
    {
        return 'Projeler';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Proje Bilgileri')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Proje Adı')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('location')->label('Konum')->placeholder('New York, ABD'),
                    Forms\Components\TextInput::make('year')->label('Yıl')->placeholder('2026'),
                    Forms\Components\TextInput::make('slug')->label('Slug (URL)')->unique(ignoreRecord: true)
                        ->helperText('Boş bırakılırsa proje adından üretilir.'),
                    Forms\Components\Toggle::make('is_featured')->label('Öne Çıkan (Anasayfada gösterilir)'),
                    Forms\Components\Toggle::make('published')->label('Yayında')->default(true),
                ]),

            Forms\Components\Section::make('İçerik')
                ->schema([
                    Forms\Components\Textarea::make('short_description')->label('Kısa Açıklama')->rows(2)->maxLength(500),
                    Forms\Components\RichEditor::make('content')->label('Detaylı Açıklama')->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Görseller')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('cover')->label('Kapak Görseli')->collection('cover')->image()->imageEditor(),
                    SpatieMediaLibraryFileUpload::make('gallery')->label('Galeri')->collection('gallery')->multiple()->reorderable()->maxFiles(40)->panelLayout('grid')->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')->collection('cover')->label('Görsel'),
                Tables\Columns\TextColumn::make('title')->label('Proje')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('location')->label('Konum')->toggleable(),
                Tables\Columns\IconColumn::make('is_featured')->label('Öne Çıkan')->boolean(),
                Tables\Columns\IconColumn::make('published')->label('Yayında')->boolean(),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])])
            ->reorderable('order_column')
            ->defaultSort('order_column');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShowcases::route('/'),
            'create' => Pages\CreateShowcase::route('/create'),
            'edit' => Pages\EditShowcase::route('/{record}/edit'),
        ];
    }
}
