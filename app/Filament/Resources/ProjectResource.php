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

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'İçerik Yönetimi';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return 'Proje';
    }

    public static function getPluralLabel(): ?string
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
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                            $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug (URL)')
                        ->helperText('Boş bırakılırsa proje adından otomatik üretilir.')
                        ->unique(ignoreRecord: true),
                    Forms\Components\Select::make('project_category_id')
                        ->label('Kategori')
                        ->relationship('projectCategory', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->label('Kategori Adı')->required(),
                        ])
                        ->helperText('Yeni kategori eklemek için listeden "Create" seçeneğini kullanın veya Proje Kategorileri sayfasından yönetin.'),
                    Forms\Components\TextInput::make('location')
                        ->label('Konum')
                        ->placeholder('Sarıyer, İstanbul'),
                    Forms\Components\Select::make('status')
                        ->label('Durum')
                        ->options(['devam' => 'Devam Ediyor', 'tamam' => 'Tamamlandı'])
                        ->default('devam')
                        ->required(),
                    Forms\Components\TextInput::make('year')->label('Yıl')->placeholder('2024'),
                    Forms\Components\TextInput::make('client')->label('İşveren / Müşteri'),
                    Forms\Components\TextInput::make('area')->label('Alan')->placeholder('12.000 m²'),
                    Forms\Components\Toggle::make('is_sale')->label('Satışta'),
                    Forms\Components\Toggle::make('is_featured')->label('Öne Çıkan (Ana sayfada gösterilir)'),
                    Forms\Components\Toggle::make('published')->label('Yayında')->default(true),
                ]),

            Forms\Components\Section::make('İçerik')
                ->schema([
                    Forms\Components\Textarea::make('short_description')
                        ->label('Kısa Açıklama')
                        ->rows(2)
                        ->maxLength(500),
                    Forms\Components\RichEditor::make('content')
                        ->label('Detaylı Açıklama')
                        ->columnSpanFull(),
                    Forms\Components\Repeater::make('specs')
                        ->label('Künye (Özellikler)')
                        ->schema([
                            Forms\Components\TextInput::make('label')->label('Etiket')->placeholder('Toplam Alan'),
                            Forms\Components\TextInput::make('value')->label('Değer')->placeholder('45.000 m²'),
                        ])
                        ->columns(2)
                        ->defaultItems(0)
                        ->collapsible()
                        ->addActionLabel('Özellik ekle'),
                ]),

            Forms\Components\Section::make('Görseller')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('cover')
                        ->label('Kapak Görseli')
                        ->collection('cover')
                        ->image()
                        ->imageEditor(),
                    SpatieMediaLibraryFileUpload::make('gallery')
                        ->label('Galeri')
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
                    ->collection('cover')->label('Kapak'),
                Tables\Columns\TextColumn::make('title')->label('Proje')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('projectCategory.name')->label('Kategori')->badge(),
                Tables\Columns\TextColumn::make('location')->label('Konum')->toggleable(),
                Tables\Columns\TextColumn::make('status')->label('Durum')->badge()
                    ->formatStateUsing(fn ($state) => $state === 'tamam' ? 'Tamamlandı' : 'Devam Ediyor')
                    ->color(fn ($state) => $state === 'tamam' ? 'success' : 'warning'),
                Tables\Columns\IconColumn::make('is_featured')->label('Öne Çıkan')->boolean(),
                Tables\Columns\IconColumn::make('published')->label('Yayında')->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('project_category_id')->label('Kategori')
                    ->relationship('projectCategory', 'name'),
                Tables\Filters\SelectFilter::make('status')->label('Durum')
                    ->options(['devam' => 'Devam Ediyor', 'tamam' => 'Tamamlandı']),
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
