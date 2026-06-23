<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $slug = 'urunler';

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'İçerik Yönetimi';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return 'Ürün';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Ürünler';
    }

    public static function getNavigationLabel(): string
    {
        return 'Ürünler';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Ürün Bilgileri')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Ürün Adı')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                            $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null)
                        ->columnSpanFull(),
                    Forms\Components\Select::make('project_category_id')
                        ->label('Kategori')
                        ->relationship('projectCategory', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->label('Kategori Adı')->required(),
                        ])
                        ->helperText('Yeni kategori eklemek için listeden "Create" seçeneğini kullanın veya Ürün Kategorileri sayfasından yönetin.'),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->helperText('Boş bırakılırsa ürün adından otomatik üretilir.')
                        ->unique(ignoreRecord: true),
                    Forms\Components\Toggle::make('is_featured')->label('Öne Çıkan (Ana sayfada gösterilir)'),
                    Forms\Components\Toggle::make('published')->label('Yayında')->default(true),
                ]),

            Forms\Components\Section::make('Ürün Açıklaması')
                ->schema([
                    Forms\Components\Textarea::make('short_description')
                        ->label('Kısa Açıklama')
                        ->rows(2)
                        ->maxLength(500),
                    Forms\Components\RichEditor::make('content')
                        ->label('Detaylı Açıklama')
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Ürünü Oluşturan Parçalar')
                ->description('Ürünü oluşturan parçalar (ör. Üçlü Kanepe, Berjer, Komodin) ve ölçüleri.')
                ->schema([
                    Forms\Components\Repeater::make('specs')
                        ->hiddenLabel()
                        ->schema([
                            Forms\Components\TextInput::make('label')->label('Parça Adı')->placeholder('Üçlü Kanepe')->required(),
                            Forms\Components\TextInput::make('value')->label('Ölçü / Detay')->placeholder('G 240 · D 95 · Y 85 cm'),
                            Forms\Components\FileUpload::make('image')
                                ->label('Parça Görseli')
                                ->image()
                                ->imageEditor()
                                ->disk('public')
                                ->directory('product-pieces')
                                ->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                        ->addActionLabel('Parça ekle'),
                ]),

            Forms\Components\Section::make('Ürün Görselleri')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('cover')
                        ->label('Kapak Görseli')
                        ->collection('cover')
                        ->image()
                        ->imageEditor(),
                    SpatieMediaLibraryFileUpload::make('gallery')
                        ->label('Ürün Görselleri (birden fazla)')
                        ->collection('gallery')
                        ->multiple()
                        ->reorderable()
                        ->maxFiles(40)
                        ->panelLayout('grid')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')
                    ->collection('cover')->label('Görsel'),
                Tables\Columns\TextColumn::make('title')->label('Ürün')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('projectCategory.name')->label('Kategori')->badge(),
                Tables\Columns\IconColumn::make('is_featured')->label('Öne Çıkan')->boolean(),
                Tables\Columns\IconColumn::make('published')->label('Yayında')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('project_category_id')->label('Kategori')
                    ->relationship('projectCategory', 'name'),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
