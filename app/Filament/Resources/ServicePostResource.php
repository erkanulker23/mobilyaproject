<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\ServicePostResource\Pages\CreateServicePost;
use App\Filament\Resources\ServicePostResource\Pages\EditServicePost;
use App\Filament\Resources\ServicePostResource\Pages\ListServicePosts;
use App\Models\ServicePost;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ServicePostResource extends Resource
{
    use Translatable;

    protected static ?string $model = ServicePost::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return 'Servis';
    }

    public static function getModelLabel(): string
    {
        return 'Servis';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Servisler';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Başlık')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->hidden(fn ($context) => $context === 'create')
                    ->live(onBlur: true)
                    ->dehydrateStateUsing(function(?string $state) {
                        if(! $state) return;
                        return Str::slug($state);
                    })
                    ->afterStateUpdated(function(?string $state, $set) {
                        if(! $state) return;

                        $slug = Str::slug($state);
                        if($slug !== $state){
                            $set('slug', $slug);
                        }
                    })
                    ->helperText("Bu değer kayıt ettiğinizde otomatik olarak biçimlendirilecektir."),
                Forms\Components\Select::make('categories')
                    ->label('Kategoriler')
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(10)
                    ->multiple(),
                Forms\Components\Textarea::make('short_description')
                    ->label('Kısa Açıklama')
                    ->maxLength(65535),
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
                Forms\Components\TextInput::make('jotform_id')
                    ->label('Jotform ID')
                    ->afterStateUpdated(function ($state, $set) {
                        $pattern = '/(?:src|id)="(?:https:\/\/form\.jotform\.com\/jsform\/|JotFormIFrame-)(\d+)"/';
                        if (preg_match($pattern, $state, $matches)) {
                            $set('jotform_id', $matches[1]);
                        }
                    })
                    ->helperText('Script veya Iframe kodu girerseniz ID değeri olarak bulunacaktır.')
                    ->reactive()
                    ->maxLength(255),
                TinyEditor::make('content')
                    ->profile('full')
                    ->label('İçerik')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('publish_at')
                    ->label('Yayın Tarihi')
                    ->default(now())
                    ->required(),
                Forms\Components\DateTimePicker::make('unpublish_at')
                    ->label('Kaldırma Tarihi'),
                Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('SEO Başlık')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('seo_description')
                            ->label('SEO Açıklama')
                            ->maxLength(65535),
                    ]),

                Section::make('Görseller')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('details_image')
                            ->label('Detay Görseli')
                            ->collection('details_image'),
                        SpatieMediaLibraryFileUpload::make('details_image_mobile')
                            ->label('Detay Görseli (Mobil)')
                            ->collection('details_image_mobile'),
                        SpatieMediaLibraryFileUpload::make('details_hero')
                            ->label('Detay Hero')
                            ->collection('details_hero'),
                        SpatieMediaLibraryFileUpload::make('details_hero_mobile')
                            ->label('Detay Hero (Mobil)')
                            ->collection('details_hero_mobile'),
                        SpatieMediaLibraryFileUpload::make('listing_image')
                            ->label('Liste Görseli')
                            ->collection('listing_image'),
                        SpatieMediaLibraryFileUpload::make('listing_image_mobile')
                            ->label('Liste Görseli (Mobil)')
                            ->collection('listing_image_mobile'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->limit(50)
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->filamentSearch($search);
                    }),
                Tables\Columns\TextColumn::make('publish_at')
                    ->label('Yayın Tarihi')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('unpublish_at')
                    ->label('Kaldırma Tarihi')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma Tarihi')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('show_blog_post')
                    ->label('Görüntüle')
                    ->icon('heroicon-o-arrow-right')
                    ->url(fn (ServicePost $record) => $record->url),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => ListServicePosts::route('/'),
            'create' => CreateServicePost::route('/create'),
            'edit' => EditServicePost::route('/{record}/edit'),
        ];
    }
}
