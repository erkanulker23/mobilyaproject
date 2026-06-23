<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AiPromptTemplateResource\Pages;
use App\Filament\Resources\AiPromptTemplateResource\RelationManagers;
use App\Models\AiPromptTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AiPromptTemplateResource extends Resource
{
    protected static ?string $model = AiPromptTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'AI Prompt Şablonları';

    protected static ?string $modelLabel = 'AI Prompt Şablonu';

    protected static ?string $pluralModelLabel = 'AI Prompt Şablonları';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Genel Bilgiler')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Şablon Adı')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('Örn: SEO Optimizasyonlu Blog Şablonu'),

                                Forms\Components\Textarea::make('description')
                                    ->label('Açıklama')
                                    ->rows(3)
                                    ->placeholder('Bu şablonun ne için kullanılacağını açıklayın...'),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Aktif')
                                            ->default(true)
                                            ->inline(false),

                                        Forms\Components\Toggle::make('is_default')
                                            ->label('Varsayılan Şablon')
                                            ->default(false)
                                            ->inline(false)
                                            ->helperText('Bu şablon varsayılan olarak seçili gelir'),
                                    ]),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Sıralama')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Düşük değerler üstte görünür'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Prompt Ayarları')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->schema([
                                Forms\Components\Textarea::make('system_prompt')
                                    ->label('Sistem Promptu')
                                    ->required()
                                    ->rows(8)
                                    ->placeholder('AI\'ye rolünü ve görevini tanımlayan ana prompt...')
                                    ->helperText('Kullanılabilir değişkenler: {site_name}, {language}, {tone}, {writing_style}')
                                    ->default('You are a professional content writer tasked with creating detailed, engaging, and SEO-optimized articles for {site_name}. Write in {language} with a {tone} tone using a {writing_style} writing style. Ensure the content is well-structured, informative, and properly formatted in HTML (use <h2>, <h3>, <strong>, <p>, etc.).'),

                                Forms\Components\Textarea::make('user_prompt_template')
                                    ->label('Kullanıcı Prompt Şablonu')
                                    ->required()
                                    ->rows(6)
                                    ->placeholder('Kullanıcının girdiği konuya göre oluşturulacak prompt...')
                                    ->helperText('Kullanılabilir değişkenler: {topic}, {word_count}')
                                    ->default('Write a comprehensive article about: {topic}\n\nThe article should be approximately {word_count} words long. Make sure to follow the content structure guidelines provided.'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Yazı Ayarları')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Select::make('language')
                                            ->label('Dil')
                                            ->required()
                                            ->options([
                                                'tr' => 'Türkçe',
                                                'en' => 'İngilizce',
                                                'de' => 'Almanca',
                                                'fr' => 'Fransızca',
                                                'es' => 'İspanyolca',
                                            ])
                                            ->default('tr'),

                                        Forms\Components\Select::make('tone')
                                            ->label('Yazım Dili')
                                            ->required()
                                            ->options([
                                                'formal' => 'Resmi',
                                                'intimate' => 'Samimi',
                                                'standard' => 'Standart',
                                                'professional' => 'Profesyonel',
                                                'diplomatic' => 'Diplomatik',
                                                'confident' => 'Kendinden Emin',
                                            ])
                                            ->default('professional'),

                                        Forms\Components\Select::make('writing_style')
                                            ->label('Yazım Stili')
                                            ->required()
                                            ->options([
                                                'middle_school' => 'Ortaokul',
                                                'high_school' => 'Lise',
                                                'academic' => 'Akademik',
                                                'simplified' => 'Basitleştirilmiş',
                                                'lively' => 'Canlı',
                                                'understanding' => 'Anlayışlı',
                                                'luxury' => 'Lüks',
                                                'engaging' => 'İlgi Çekici',
                                                'direct' => 'Direk',
                                                'persuasive' => 'İkna Edici',
                                            ])
                                            ->default('engaging'),

                                        Forms\Components\TextInput::make('default_word_count')
                                            ->label('Varsayılan Kelime Sayısı')
                                            ->numeric()
                                            ->default(700)
                                            ->required()
                                            ->minValue(100)
                                            ->maxValue(5000),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('İçerik Yapısı')
                            ->icon('heroicon-o-squares-2x2')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Toggle::make('include_introduction')
                                            ->label('Giriş Bölümü Ekle')
                                            ->default(true)
                                            ->inline(false),

                                        Forms\Components\Toggle::make('include_conclusion')
                                            ->label('Sonuç Bölümü Ekle')
                                            ->default(true)
                                            ->inline(false),

                                        Forms\Components\Toggle::make('include_bullet_points')
                                            ->label('Madde İmleri Kullan')
                                            ->default(true)
                                            ->inline(false),

                                        Forms\Components\Toggle::make('include_statistics')
                                            ->label('İstatistikler Ekle')
                                            ->default(false)
                                            ->inline(false),

                                        Forms\Components\Toggle::make('include_examples')
                                            ->label('Örnekler Ekle')
                                            ->default(false)
                                            ->inline(false),

                                        Forms\Components\Toggle::make('include_call_to_action')
                                            ->label('Harekete Geçirici Mesaj Ekle')
                                            ->default(false)
                                            ->inline(false),
                                    ]),

                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\Toggle::make('include_faq')
                                            ->label('SSS (Sıkça Sorulan Sorular) Ekle')
                                            ->default(false)
                                            ->reactive()
                                            ->inline(false),

                                        Forms\Components\TextInput::make('faq_count')
                                            ->label('SSS Sayısı')
                                            ->numeric()
                                            ->minValue(1)
                                            ->maxValue(20)
                                            ->default(5)
                                            ->visible(fn (callable $get) => $get('include_faq')),
                                    ]),

                                Forms\Components\Select::make('heading_structure')
                                    ->label('Başlık Yapısı')
                                    ->options([
                                        'h2_only' => 'Sadece H2',
                                        'h2_h3' => 'H2 ve H3',
                                        'h2_h3_h4' => 'H2, H3 ve H4',
                                    ])
                                    ->default('h2_h3')
                                    ->required(),

                                Forms\Components\TextInput::make('paragraph_length')
                                    ->label('Paragraf Uzunluğu (cümle)')
                                    ->numeric()
                                    ->default(3)
                                    ->minValue(1)
                                    ->maxValue(10)
                                    ->required(),
                            ]),

                        Forms\Components\Tabs\Tab::make('SEO Ayarları')
                            ->icon('heroicon-o-magnifying-glass')
                            ->schema([
                                Forms\Components\Toggle::make('seo_optimized')
                                    ->label('SEO Optimizasyonu Yap')
                                    ->default(true)
                                    ->inline(false)
                                    ->reactive(),

                                Forms\Components\Toggle::make('include_keywords')
                                    ->label('Anahtar Kelimeler Kullan')
                                    ->default(true)
                                    ->inline(false)
                                    ->reactive()
                                    ->visible(fn (callable $get) => $get('seo_optimized')),

                                Forms\Components\Textarea::make('target_keywords')
                                    ->label('Hedef Anahtar Kelimeler')
                                    ->rows(3)
                                    ->placeholder('Anahtar kelimeleri virgülle ayırarak girin...')
                                    ->helperText('Örn: dijital pazarlama, SEO, içerik yönetimi')
                                    ->visible(fn (callable $get) => $get('seo_optimized') && $get('include_keywords')),
                            ]),

                        Forms\Components\Tabs\Tab::make('AI Model Ayarları')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Forms\Components\Select::make('preferred_model')
                                    ->label('Tercih Edilen Model')
                                    ->options([
                                        'gpt-3.5-turbo-0125' => 'GPT-3.5 Turbo (Hızlı ve Ekonomik)',
                                        'gpt-4-turbo' => 'GPT-4 Turbo (Güçlü ve Detaylı)',
                                        'gpt-4o' => 'GPT-4o (En Yeni)',
                                    ])
                                    ->default('gpt-3.5-turbo-0125')
                                    ->required()
                                    ->helperText('GPT-4 daha kaliteli ancak daha yavaş ve pahalıdır'),

                                Forms\Components\TextInput::make('temperature')
                                    ->label('Temperature (Yaratıcılık)')
                                    ->numeric()
                                    ->step(0.1)
                                    ->minValue(0)
                                    ->maxValue(2)
                                    ->default(0.7)
                                    ->required()
                                    ->helperText('0 = Tutarlı, 2 = Yaratıcı. Önerilen: 0.7'),

                                Forms\Components\TextInput::make('max_tokens')
                                    ->label('Maksimum Token')
                                    ->numeric()
                                    ->default(3000)
                                    ->required()
                                    ->minValue(500)
                                    ->maxValue(4000)
                                    ->helperText('Daha uzun içerikler için yüksek değer kullanın'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Şablon Adı')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('language')
                    ->label('Dil')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'tr' => 'success',
                        'en' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'tr' => 'Türkçe',
                        'en' => 'İngilizce',
                        'de' => 'Almanca',
                        'fr' => 'Fransızca',
                        'es' => 'İspanyolca',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('tone')
                    ->label('Ton')
                    ->sortable(),

                Tables\Columns\TextColumn::make('writing_style')
                    ->label('Yazım Stili')
                    ->sortable(),

                Tables\Columns\TextColumn::make('default_word_count')
                    ->label('Kelime Sayısı')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_default')
                    ->label('Varsayılan')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Sıra')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('language')
                    ->label('Dil')
                    ->options([
                        'tr' => 'Türkçe',
                        'en' => 'İngilizce',
                        'de' => 'Almanca',
                        'fr' => 'Fransızca',
                        'es' => 'İspanyolca',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Aktif'),

                Tables\Filters\TernaryFilter::make('is_default')
                    ->label('Varsayılan'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('duplicate')
                    ->label('Kopyala')
                    ->icon('heroicon-o-document-duplicate')
                    ->color('gray')
                    ->action(function (AiPromptTemplate $record) {
                        $newTemplate = $record->replicate();
                        $newTemplate->name = $record->name . ' (Kopya)';
                        $newTemplate->is_default = false;
                        $newTemplate->save();
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListAiPromptTemplates::route('/'),
            'create' => Pages\CreateAiPromptTemplate::route('/create'),
            'edit' => Pages\EditAiPromptTemplate::route('/{record}/edit'),
        ];
    }
}
