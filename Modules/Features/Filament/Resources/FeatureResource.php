<?php

namespace Modules\Features\Filament\Resources;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Database\Eloquent\Model;
use Modules\Features\Entities\Feature;
use Modules\Features\Entities\FeatureCategory;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-ripple';

    public static function getModelLabel(): string
    {
        return 'Hizmet';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Hizmetler';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Başlık')
                    ->required(),
                TextInput::make('description')
                    ->label('Açıklama')
                    ->required(),
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Kategori Adı')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->nullable(),
                IconPicker::make('icon')
                    ->columns([
                        'default' => 1,
                        'lg' => 3,
                        '2xl' => 5,
                    ])
                    ->sets([
                        'fontawesome-brands',
                        'fontawesome-regular',
                        'fontawesome-regular',
                    ])
                    ->label('İkon'),
                FileUpload::make('image')
                    ->label('Görsel')
                    ->directory('features')
                    ->placeholder('Image of the feature')
                    ->image()
                    ->imageEditor(),
                TextInput::make('order_column')
                    ->label('Sıra')
                    ->numeric()
                    ->step(1)
                    ->default(0)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order_column')
            ->reorderable(true);
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
            'index' => \Modules\Features\Filament\Resources\FeatureResource\Pages\ListFeatures::route('/'),
            'create' => \Modules\Features\Filament\Resources\FeatureResource\Pages\CreateFeature::route('/create'),
            'edit' => \Modules\Features\Filament\Resources\FeatureResource\Pages\EditFeature::route('/{record}/edit'),
        ];
    }
}
