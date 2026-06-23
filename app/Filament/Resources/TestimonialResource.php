<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    /**
     * @return string|null
     */
    public static function getModelLabel(): string
    {
        return 'Müşteri Yorumu';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Müşteri Yorumları';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('İsim ve Soyisim')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('company')
                    ->label('Şirket Adı')
                    ->maxLength(100),
                Forms\Components\TextInput::make('title')
                    ->label('Ünvan')
                    ->maxLength(100),
                Forms\Components\Textarea::make('description')
                    ->label('Açıklama')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('order_column')
                    ->label('Sıralama')
                    ->default(0)
                    ->required(),
                Forms\Components\TextInput::make('rating')
                    ->label('Puan')
                    ->default(0)
                    ->required(),
                Forms\Components\DatePicker::make('date_at')
                    ->label('Tarih')
                    ->default(now())
                    ->required(),
                Forms\Components\TextInput::make('link')
                    ->label('Link')
                    ->url()
                    ->maxLength(255),
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
                    ->directory('testimonials')
                    ->placeholder('Resim Yükle')
                    ->image()
                    ->imageEditor(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif mi?')
                    ->default('true')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif mi?')
                    ->boolean(),
                Tables\Columns\TextColumn::make('name')
                    ->label('İsim ve Soyisim')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company')
                    ->label('Şirket Adı')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Ünvan'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Açıklama')
                    ->limit(20)
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_column')
                    ->label('Sıralama'),
                Tables\Columns\TextColumn::make('date_at')
                    ->label('Tarih')
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function () {
                        \Illuminate\Support\Facades\Cache::forget('testimonials_list');
                    }),
                Tables\Actions\DeleteAction::make()
                    ->after(function () {
                        \Illuminate\Support\Facades\Cache::forget('testimonials_list');
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->after(function () {
                        \Illuminate\Support\Facades\Cache::forget('testimonials_list');
                    }),
            ])
            ->reorderable('order_column');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTestimonials::route('/'),
        ];
    }
}
