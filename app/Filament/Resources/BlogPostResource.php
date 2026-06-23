<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\BlogPostResource\Pages;
use App\Filament\Resources\BlogPostResource\Widgets\SeoScoreWidget;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPostResource extends Resource
{
    use Translatable;

    protected static ?string $model = BlogPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationGroup(): ?string
    {
        return 'Blog';
    }

    public static function getModelLabel(): string
    {
        return 'Blog Yazısı';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Blog Yazıları';
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
                Forms\Components\Select::make('gallery_category_id')
                    ->label('Galeri Kategorisi')
                    ->relationship('galleryCategory', 'name')
                    ->searchable()
                    ->preload()
                    ->optionsLimit(10),
                Select::make('tags')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->relationship('tags', 'name')
                    ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->name)
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label(__('tag::filament.name'))
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label(__('tag::filament.description')),
                    ]),
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
                Forms\Components\Textarea::make('short_description')
                    ->label('Kısa Açıklama')
                    ->maxLength(65535)
                    ->columnSpanFull(),
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
                        Forms\Components\TextInput::make('focus_keyword')
                            ->label('Odaklanan Anahtar Kelime')
                            ->maxLength(255)
                            ->helperText('Bu anahtar kelime üzerinden SEO analizi yapılacak. Örnek: "evden eve nakliyat", "uluslararası taşımacılık"')
                            ->placeholder('Anahtar kelime girin...'),
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
        // TODO: make this split or stack based on screen size
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
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
                Tables\Columns\TextColumn::make('comments_count')
                    ->label('Yorum Sayısı')
                    ->getStateUsing(function (BlogPost $record) {
                        return $record->comments()->where('is_approved', true)->count();
                    })
                    ->badge()
                    ->color(fn (int $state): string => $state > 0 ? 'success' : 'gray'),
                Tables\Columns\TextColumn::make('seo_score')
                    ->label('SEO Skoru')
                    ->formatStateUsing(function (BlogPost $record) {
                        $score = $record->seo_score ?? 0;
                        $grade = $record->getSeoGrade();
                        return "{$score}/100 ({$grade})";
                    })
                    ->badge()
                    ->color(function (BlogPost $record): string {
                        $score = $record->seo_score ?? 0;
                        if ($score >= 80) return 'success';
                        if ($score >= 60) return 'warning';
                        if ($score >= 40) return 'danger';
                        return 'gray';
                    })
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('show_blog_post')
                    ->label('Görüntüle')
                    ->icon('heroicon-o-arrow-right')
                    ->url(fn (BlogPost $record) => $record->url),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('publish_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            SeoScoreWidget::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
