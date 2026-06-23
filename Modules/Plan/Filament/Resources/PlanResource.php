<?php

namespace Modules\Plan\Filament\Resources;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;

class PlanResource extends Resource
{
    protected static ?string $model = \Modules\Plan\Entities\Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function getModelLabel(): string
    {
        return 'Plan';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Planlar';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->label('Başlık')
                    ->maxLength(255),
                TextInput::make('subtitle')
                    ->maxLength(255)
                    ->label('Alt Başlık'),
                TextInput::make('description')
                    ->maxLength(255)
                    ->label('Açıklama'),
                TextInput::make('order_column')
                    ->numeric()
                    ->step(1)
                    ->default(\Modules\Plan\Entities\Plan::count() + 1)
                    ->label('Sıra'),
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
                TextInput::make('custom_icon')
                    ->label('Özel İkon'),
                FileUpload::make('image')
                    ->directory('plans')
                    ->placeholder('Plan görseli')
                    ->image()
                    ->imageEditor(),
                TextInput::make('monthly_price')
                    ->numeric()
                    ->step(0.01)
                    ->default(0)
                    ->label('Aylık Fiyat'),
                TextInput::make('yearly_price')
                    ->numeric()
                    ->step(0.01)
                    ->default(0)
                    ->label('Yıllık Fiyat'),
                TextInput::make('currency')
                    ->maxLength(255)
                    ->default('TL')
                    ->label('Para Birimi'),
                TextInput::make('button_text')
                    ->maxLength(255)
                    ->label('Buton Metni'),
                TextInput::make('button_variant')
                    ->maxLength(255)
                    ->label('Buton Renk'),
                TextInput::make('button_url')
                    ->maxLength(255)
                    ->url()
                    ->label('Button URL'),
                \Filament\Forms\Components\Repeater::make('features')
                    ->schema([
                        TextInput::make('name')
                            ->label('Adı')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('extra_class'),
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
                        TextInput::make('custom_icon')
                            ->label('Özel İkon'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Başlık'),
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
            ->reorderable('order_column')
            ->defaultSort('order_column');
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
            'index' => \Modules\Plan\Filament\Resources\PlanResource\Pages\ListPlans::route('/'),
            'create' => \Modules\Plan\Filament\Resources\PlanResource\Pages\CreatePlan::route('/create'),
            'edit' => \Modules\Plan\Filament\Resources\PlanResource\Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
