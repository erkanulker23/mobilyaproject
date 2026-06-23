<?php

namespace App\Filament\Pages;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Models\BlogCategory;
use App\Settings\AdministratorSettings;
use App\Settings\GeneralSettings;
use App\Settings\HomepageSettings;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Hexadog\ThemesManager\Facades\ThemesManager;
use Modules\Faq\Entities\Faq;
use Modules\Features\Entities\FeatureCategory;
use Modules\Menu\Entities\Menu;
use Modules\Slide\Entities\Slider;
use Riodwanto\FilamentAceEditor\AceEditor;

class HomepageBuilderPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static string $view = 'filament.pages.homepage-builder-page';

    protected static ?string $navigationLabel = 'Anasayfa Düzenleyici';

    public ?array $data = [];

    public function mount(): void
    {
        // TODO: add here a validation for stable form
        // For example if we change something in here settings keys must be same with default settings etc.
        $content = app(HomepageSettings::class)->content;
        $header = app(GeneralSettings::class)->header;
        $footer = app(GeneralSettings::class)->footer;

        $this->form->fill([
            'content' => $content,
            'header' => $header,
            'footer' => $footer,
        ]);
    }

    public function form(Form $form): Form
    {

        $testimonialViewList = $this->getViewList('frontend/components/testimonials_section');
        $headerViewList = $this->getViewList('frontend/components/header_section');
        $footerViewList = $this->getViewList('frontend/components/footer_section');
        $sliderViewList = $this->getViewList('frontend/components/slider');
        $featuresViewList = $this->getViewList('frontend/components/features_section');
        $ourTeamViewList = $this->getViewList('frontend/components/our_team_section');
        $plansViewList = $this->getViewList('frontend/components/plans_section');
        $servicesViewList = $this->getViewList('frontend/components/service_post_slider_section');
        $serviceCategorySliderViewList = $this->getViewList('frontend/components/service_category_slider_section');
        $blogPostSliderViewList = $this->getViewList('frontend/components/blog_post_slider_section');
        $latestBlogPostSliderViewList = $this->getViewList('frontend/components/blog_post_slider_section');
        $faqViewList = $this->getViewList('frontend/components/faq_section');
        $referencesViewList = $this->getViewList('frontend/components/references_section');
        $countersViewList = $this->getViewList('frontend/components/counters_section');
        $operationsViewList = $this->getViewList('frontend/components/operations_section');
        $newsletterFormViewList = $this->getViewList('frontend/components/newsletter_form_section');
        $requestFormViewList = $this->getViewList('frontend/components/request_form_section');
        $aboutUsViewList = $this->getViewList('frontend/components/about_us_section');
        $projectsViewList = $this->getViewList('frontend/components/projects_section');
        $topbarViewList = $this->getViewList('frontend/components/topbar');
        $googleReviewsViewList = $this->getViewList('frontend/components/google_reviews_section');

        return $form
            ->schema([
                Section::make('header')
                    ->collapsible()
                    ->collapsed()
                    ->heading('Header içeriği')
                    ->schema([
                        Builder::make('header')
                            ->label('Header içeriği')
                            ->hiddenLabel()
                            ->blocks([
                                Block::make('header_section')
                                    ->label('Header')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('menu_id')
                                            ->options(Menu::limit(10)->pluck('name', 'id')->toArray())
                                            ->getSearchResultsUsing(fn (string $searchTerm) => Menu::where('name', 'like', "%{$searchTerm}%")->limit(10)->get())
                                            ->searchable()
                                            ->preload()
                                            ->label('Menü')
                                            ->required(),
                                        Checkbox::make('is_transparent')
                                            ->label('Saydam Header')
                                            ->default(false),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($headerViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('phone')
                                            ->label('Telefon Numarası'),
                                        TextInput::make('button_text')
                                            ->label('Buton Yazısı'),
                                        TextInput::make('button_link')
                                            ->label('Buton Linki'),
                                        IconPicker::make('button_icon')
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
                                            ->label('Buton İkon'),
                                        TextInput::make('button_custom_icon')
                                            ->label('Buton Özel İkon'),
                                        Select::make('width')
                                            ->label('Genişlik')
                                            ->options([
                                                'container' => 'Container',
                                                'container-fluid' => 'Container Fluid',
                                                'container-lg' => 'Container Large',
                                            ])
                                            ->required()
                                            ->default('container'),
                                        TextInput::make('wrapper_class')
                                            ->label('Kapsayıcı Sınıfı'),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),

                                        Fieldset::make('topbar_settings')
                                            ->label('Topbar')
                                            ->schema([
                                                Checkbox::make('is_topbar_active')
                                                    ->default('true')
                                                    ->label('Topbar aktif mi?'),
                                                Select::make('topbar_view_variant')
                                                    ->label('Görünüm')
                                                    ->options($topbarViewList)
                                                    ->required()
                                                    ->default('variant_1'),
                                                Checkbox::make('show_address')
                                                    ->default('true')
                                                    ->label('Adresi göster'),
                                                Checkbox::make('show_phone')
                                                    ->default('true')
                                                    ->label('Telefonu göster'),
                                                Checkbox::make('show_social')
                                                    ->default('true')
                                                    ->label('Sosyal medya göster'),
                                                TinyEditor::make('topbar_text')
                                                    ->columnSpanFull()
                                                    ->helperText('Tek satırdan oluşan bir değer giriniz.')
                                                    ->maxHeight(300)
                                                    ->label('Yazı'),
                                            ]),
                                    ]),
                            ])
                            ->collapsible()
                            ->collapsed(),
                    ]),
                Section::make('content')
                    ->collapsible()
                    ->collapsed()
                    ->heading('Anasayfa İçeriği')
                    ->schema([
                        Builder::make('content')
                            ->hiddenLabel()
                            ->label('Anasayfa içeriği')
                            ->blocks([
                                Block::make('hero_slider')
                                    ->label('Slider')
                                    ->schema([
                                        Select::make('slider_id')
                                            ->options(Slider::limit(10)->pluck('title', 'id')->toArray())
                                            ->getSearchResultsUsing(fn (string $searchTerm) => Slider::where('title', 'like', "%{$searchTerm}%")->limit(10)->get())
                                            ->searchable()
                                            ->preload()
                                            ->label('Slider')
                                            ->required(),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($sliderViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('wrapper_class')
                                            ->label('Kapsayıcı Sınıfı'),
                                    ]),
                                Block::make('request_form_section')
                                    ->label('Talep Formu')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($requestFormViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('phone')
                                            ->label('Telefon Numarası')
                                            ->required(),
                                        TextInput::make('email')
                                            ->label('E-Posta Adresi'),
                                        TextInput::make('button_text')
                                            ->label('Buton Yazısı')
                                            ->required(),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                        Repeater::make('topic_options')
                                            ->collapsible()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                            ->label('Konu Seçenekleri')
                                        ->schema([
                                            TextInput::make('title')
                                                ->label('Başlık')
                                                ->required(),
                                        ]),

                                    ]),
                                Block::make('custom_html')
                                    ->label('Custom HTML')
                                    ->schema([
                                        AceEditor::make('html')
                                            ->mode('html')
                                            ->theme('github')
                                            ->darkTheme('dracula'),
                                    ]),
                                Block::make('plans_section')
                                    ->label('Planlar')
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($plansViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('service_post_slider')
                                    ->label('Service Post Slider')
                                    ->schema([
                                        Select::make('service_category_id')
                                            ->options(\App\Models\ServiceCategory::all()->pluck('name', 'id')->toArray())
                                            ->label('Service Category')
                                            ->nullable(),
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        TextInput::make('limit')
                                            ->label('Limit')
                                            ->numeric(),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($servicesViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('button_text')
                                            ->label('Buton Yazısı'),
                                        TextInput::make('button_url')
                                            ->label('Buton URL')
                                            ->url(),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('service_category_slider')
                                    ->label('Service Category Slider')
                                    ->schema([
                                        Select::make('service_category_ids')
                                            ->options(\App\Models\ServiceCategory::all()->pluck('name', 'id')->toArray())
                                            ->label('Service Category')
                                            ->multiple()
                                            ->nullable(),
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        TextInput::make('limit')
                                            ->label('Limit')
                                            ->numeric(),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($serviceCategorySliderViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('button_text')
                                            ->label('Buton Yazısı'),
                                        TextInput::make('button_url')
                                            ->label('Buton URL')
                                            ->url(),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('blog_post_slider_section')
                                    ->label('Blog Post Slider')
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($blogPostSliderViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        Select::make('category_id')
                                            ->options(BlogCategory::all()->pluck('name', 'id')->toArray())
                                            ->label('Kategori')
                                            ->multiple()
                                            ->nullable(),
                                        TextInput::make('limit')
                                            ->label('Limit')
                                            ->numeric(),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('latest_blog_post_section')
                                    ->label('Latest Blog Post')
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($latestBlogPostSliderViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        Select::make('category_id')
                                            ->options(BlogCategory::all()->pluck('name', 'id')->toArray())
                                            ->label('Kategori')
                                            ->multiple()
                                            ->nullable(),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('testimonials_list')
                                    ->label('Müşteri Yorumları')
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($testimonialViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('limit')
                                            ->label('Limit')
                                            ->numeric(),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('google_reviews_section')
                                    ->label('Google Yorumları')
                                    ->schema([
                                        Select::make('business_id')
                                            ->label('İşletme Seç')
                                            ->options(\Modules\GoogleReview\Entities\GoogleBusiness::active()->pluck('name', 'id'))
                                            ->searchable()
                                            ->helperText('Boş bırakırsanız tüm işletmelerin yorumları gösterilir'),
                                        TextInput::make('section_title')
                                            ->label('Başlık')
                                            ->default('Müşteri Yorumları'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık')
                                            ->default('Değerli müşterilerimizin görüşleri'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($googleReviewsViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('limit')
                                            ->label('Gösterilecek Yorum Sayısı')
                                            ->numeric()
                                            ->default(10)
                                            ->minValue(1)
                                            ->maxValue(50),
                                        Select::make('min_rating')
                                            ->label('Minimum Puan')
                                            ->options([
                                                1 => '1 Yıldız ve Üzeri',
                                                2 => '2 Yıldız ve Üzeri',
                                                3 => '3 Yıldız ve Üzeri',
                                                4 => '4 Yıldız ve Üzeri',
                                                5 => 'Sadece 5 Yıldız',
                                            ])
                                            ->default(1),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('faq_section')
                                    ->label('Sıkça Sorulan Sorular')
                                    ->schema([
                                        Select::make('faq_id')
                                            ->options(Faq::all()->pluck('name', 'id')->toArray())
                                            ->label('SSS')
                                            ->required(),
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($faqViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('limit')
                                            ->label('Limit')
                                            ->numeric(),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('faqs_section')
                                    ->label('Sıkça Sorulan Sorular Listesi')
                                    ->schema([
                                        Select::make('faq_ids')
                                            ->options(Faq::all()->pluck('name', 'id')->toArray())
                                            ->multiple()
                                            ->label('SSS')
                                            ->required(),
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($faqViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('faq_limit')
                                            ->label('SSS Limit')
                                            ->numeric(),
                                        TextInput::make('faq_item_limit')
                                            ->label('SSS Soru Limit')
                                            ->numeric(),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('references_section')
                                    ->label('Referanslar')
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($referencesViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('limit')
                                            ->label('Limit')
                                            ->numeric(),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('features_section')
                                    ->label('Features')
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('category_ids')
                                            ->label('Kategoriler')
                                            ->options(FeatureCategory::limit(10)->pluck('name', 'id')->toArray())
                                            ->getSearchResultsUsing(fn (string $searchTerm) => FeatureCategory::where('name', 'like', "%{$searchTerm}%")->limit(10)->get())
                                            ->searchable()
                                            ->preload()
                                            ->multiple()
                                            ->nullable(),
                                        TextInput::make('limit')
                                            ->label('Limit')
                                            ->numeric(),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($featuresViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('our_team_section')
                                    ->label('Our Team')
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        TextInput::make('limit')
                                            ->label('Limit')
                                            ->numeric(),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($ourTeamViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('newsletter_form_section')
                                    ->label('Newsletter Form')
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($newsletterFormViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('counters_section')
                                    ->label('Sayaçlar')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık')
                                            ->default('Rakamlarla Biz'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık')
                                            ->default('Başarılarımızı ve büyümemizi sizlerle paylaşmaktan mutluluk duyuyoruz'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($countersViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                        Repeater::make('counters')
                                            ->collapsed()
                                            ->collapsible()
                                            ->columnSpanFull()
                                            ->addActionLabel('Sayaç Ekle')
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                            ->default([
                                                [
                                                    'title' => 'Mutlu Müşteri',
                                                    'description' => 'Memnun müşterilerimiz',
                                                    'icon' => 'fas fa-users',
                                                    'value' => '1250',
                                                ],
                                                [
                                                    'title' => 'Tamamlanan Proje',
                                                    'description' => 'Başarıyla teslim edildi',
                                                    'icon' => 'fas fa-briefcase',
                                                    'value' => '850',
                                                ],
                                                [
                                                    'title' => 'İş Ortağı',
                                                    'description' => 'Güvenilir partnerler',
                                                    'icon' => 'fas fa-handshake',
                                                    'value' => '340',
                                                ],
                                                [
                                                    'title' => 'Yıllık Deneyim',
                                                    'description' => 'Sektördeki tecrübemiz',
                                                    'icon' => 'fas fa-calendar-check',
                                                    'value' => '15',
                                                ],
                                            ])
                                            ->schema([
                                                Grid::make()
                                                    ->columns(2)
                                                    ->schema([
                                                        TextInput::make('title')
                                                            ->label('Başlık')
                                                            ->required(),
                                                        TextInput::make('description')
                                                            ->label('Açıklama'),
                                                        TextInput::make('icon')
                                                            ->label('İkon (FontAwesome)')
                                                            ->placeholder('Örn: fas fa-users')
                                                            ->helperText('FontAwesome icon class girin (örn: fas fa-users, fas fa-chart-line)'),
                                                        TextInput::make('value')
                                                            ->numeric()
                                                            ->required()
                                                            ->label('Sayı'),
                                                        FileUpload::make('image')
                                                            ->directory('counter_images')
                                                            ->placeholder('Resim Yükle')
                                                            ->image()
                                                            ->imageEditor(),
                                                    ]),
                                            ]),
                                    ]),
                                Block::make('about_us_section')
                                    ->label('Hakkımızda')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık')
                                            ->default('Hakkımızda'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık')
                                            ->default('Yılların deneyimi ve güvenilir hizmet'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($aboutUsViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TinyEditor::make('section_description')
                                            ->columnSpanFull()
                                            ->label('Detaylar')
                                            ->default('<p>Biz, müşterilerimize en kaliteli hizmeti sunmayı amaçlayan, deneyimli ve profesyonel bir ekibiz. Sektörde uzun yıllara dayanan tecrübemizle, her projede mükemmelliği hedefliyoruz.</p>'),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        FileUpload::make('image')
                                            ->label('Görsel')
                                            ->directory('images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                        TextInput::make('button_text')
                                            ->label('Buton Yazısı')
                                            ->default('Daha Fazla Bilgi'),
                                        TextInput::make('button_link')
                                            ->label('Buton Linki')
                                            ->default('#'),
                                        IconPicker::make('button_icon')
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
                                            ->label('Buton İkon'),
                                        TextInput::make('button_custom_icon')
                                            ->label('Buton Özel İkon'),
                                        Repeater::make('list')
                                            ->collapsed()
                                            ->collapsible()
                                            ->columnSpanFull()
                                            ->addActionLabel('Listeye Ekle')
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                            ->default([
                                                ['title' => 'Profesyonel Ekip'],
                                                ['title' => 'Kaliteli Hizmet'],
                                                ['title' => '7/24 Destek'],
                                                ['title' => 'Müşteri Memnuniyeti'],
                                            ])
                                            ->schema([
                                                TextInput::make('title')
                                                    ->label('Başlık')
                                                    ->required(),
                                            ]),
                                    ]),
                                Block::make('projects_section')
                                    ->label('Projeler')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('eyebrow')
                                            ->label('Üst Etiket')
                                            ->default('Projelerimiz'),
                                        TextInput::make('section_title')
                                            ->label('Başlık')
                                            ->default('Hayata geçirdiğimiz eserler'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($projectsViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('limit')
                                            ->label('Gösterilecek Proje Sayısı')
                                            ->numeric()
                                            ->default(6),
                                        Checkbox::make('only_featured')
                                            ->label('Sadece Öne Çıkanlar'),
                                        Checkbox::make('show_filter')
                                            ->label('Kategori Filtresini Göster')
                                            ->default(true),
                                        TextInput::make('button_text')
                                            ->label('Buton Yazısı')
                                            ->default('Tüm Projeler'),
                                        TextInput::make('button_url')
                                            ->label('Buton Linki')
                                            ->placeholder('Boş bırakılırsa /projeler'),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                    ]),
                                Block::make('operations_section')
                                    ->label('Operasyon Aşamaları')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('Başlık')
                                            ->default('Nasıl Çalışır?'),
                                        TextInput::make('section_subtitle')
                                            ->label('Alt Başlık')
                                            ->default('Adım adım sürecimizi keşfedin ve işinizi kolaylaştırın'),
                                        TextInput::make('section_description')
                                            ->label('Detaylar'),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($operationsViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                        Repeater::make('operations')
                                            ->collapsed()
                                            ->collapsible()
                                            ->columnSpanFull()
                                            ->addActionLabel('Operasyon Ekle')
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                            ->default([
                                                [
                                                    'title' => 'İletişime Geçin',
                                                    'description' => 'Bizimle iletişime geçin ve ihtiyaçlarınızı paylaşın',
                                                    'icon' => 'fas fa-phone',
                                                ],
                                                [
                                                    'title' => 'Analiz & Planlama',
                                                    'description' => 'Uzman ekibimiz projenizi detaylı analiz eder',
                                                    'icon' => 'fas fa-chart-line',
                                                ],
                                                [
                                                    'title' => 'Geliştirme',
                                                    'description' => 'En son teknolojilerle çözümünüzü geliştiririz',
                                                    'icon' => 'fas fa-code',
                                                ],
                                                [
                                                    'title' => 'Teslimat',
                                                    'description' => 'Projenizi zamanında ve eksiksiz teslim ederiz',
                                                    'icon' => 'fas fa-check-circle',
                                                ],
                                            ])
                                            ->schema([
                                                Grid::make()
                                                    ->columns(2)
                                                    ->schema([
                                                        TextInput::make('title')
                                                            ->label('Başlık')
                                                            ->required(),
                                                        TextInput::make('description')
                                                            ->label('Açıklama'),
                                                        TextInput::make('icon')
                                                            ->label('İkon (FontAwesome)')
                                                            ->placeholder('Örn: fas fa-phone')
                                                            ->helperText('FontAwesome icon class girin (örn: fas fa-phone, fas fa-code)'),
                                                        FileUpload::make('image')
                                                            ->directory('operation_images')
                                                            ->placeholder('Resim Yükle')
                                                            ->image()
                                                            ->imageEditor(),
                                                    ]),
                                            ]),
                                    ]),
                            ])
                            ->collapsible()
                            ->collapsed(),
                        ]),
                Section::make('footer')
                    ->collapsible()
                    ->collapsed()
                    ->heading('Footer içeriği')
                    ->schema([
                        Builder::make('footer')
                            ->label('Footer içeriği')
                            ->hiddenLabel()
                            ->blocks([
                                Block::make('footer_section')
                                    ->label('Footer')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('menu_id')
                                            ->options(Menu::limit(10)->pluck('name', 'id')->toArray())
                                            ->getSearchResultsUsing(fn (string $searchTerm) => Menu::where('name', 'like', "%{$searchTerm}%")->limit(10)->get())
                                            ->searchable()
                                            ->preload()
                                            ->label('Menü')
                                            ->required(),
                                        Select::make('view_variant')
                                            ->label('Görünüm')
                                            ->options($footerViewList)
                                            ->required()
                                            ->default('variant_1'),
                                        TextInput::make('phone')
                                            ->label('Telefon Numarası'),
                                        TextInput::make('address')
                                            ->label('Adres'),
                                        TextInput::make('wrapper_class')
                                            ->label('Kapsayıcı Sınıfı'),
                                        ColorPicker::make('bg_color')
                                            ->label('Arkaplan Rengi'),
                                        TextInput::make('bg_gradient')
                                            ->label('Arkaplan Gradient')
                                            ->helperText('CSS gradient değeri (örn: linear-gradient(135deg, #667eea 0%, #764ba2 100%))')
                                            ->placeholder('linear-gradient(135deg, #667eea 0%, #764ba2 100%)')
                                            ->columnSpanFull(),
                                        // NEW: link color and widget color
                                        ColorPicker::make('link_color')
                                            ->label('Link Rengi')
                                            ->helperText('Footer bağlantılarının rengi'),
                                        ColorPicker::make('title_color')
                                            ->label('Başlık Rengi')
                                            ->helperText('Menü başlıklarının rengi'),
                                        ColorPicker::make('widget_color')
                                            ->label('Widget Rengi')
                                            ->helperText('Varyantların widget arkaplan rengi (destekleyenlerde)'),
                                        // NEW: description under logo
                                        TextInput::make('logo_description')
                                            ->label('Logo Altı Kısa Açıklama')
                                            ->columnSpanFull(),
                                        FileUpload::make('bg_image')
                                            ->label('Arkaplan Görseli')
                                            ->directory('bg_images')
                                            ->placeholder('Resim Yükle')
                                            ->image()
                                            ->imageEditor(),
                                    ]),
                            ])
                            ->collapsible()
                            ->collapsed(),
                    ]),
                ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $homepage_settings = new HomepageSettings();
        $homepage_settings->content = $this->form->getState()['content'];
        $homepage_settings->save();

        $general_settings = new GeneralSettings();
        $general_settings->header = $this->form->getState()['header'];
        $general_settings->footer = $this->form->getState()['footer'];
        $general_settings->save();

        Notification::make()
            ->title('Anasayfa yapısı düzenlendi!')
            ->success()
            ->send();
    }

    public function getViewList(string $folder)
    {
        $theme = app(AdministratorSettings::class)->theme;
        $parentsFound = collect();
        $found = collect();

        ThemesManager::enable($theme);
        $parent = ThemesManager::current()->getParent();
        $themePath = ThemesManager::current()->getPath();
        $themeFolder = $themePath.'resources/views/'.$folder;

        if (file_exists($themeFolder) && is_dir($themeFolder)) {
            $found = collect(scandir($themeFolder))
                ->filter(function ($file) {
                    return ! in_array($file, ['.', '..', 'components']);
                })
                ->mapWithKeys(function ($file) {
                    $filename = str_replace('.blade.php', '', $file);
                    $label = str_replace('_', ' ', $filename);
                    $label = ucwords($label);

                    return [$filename => $label];
                });
        }

        if ($parent) {
            $parentThemePath = $parent->getPath();
            $parentThemeFolder = $parentThemePath.'resources/views/'.$folder;

            if (file_exists($parentThemeFolder) && is_dir($parentThemeFolder)) {
                $parentsFound = collect(scandir($parentThemeFolder))
                    ->filter(function ($file) {
                        return ! in_array($file, ['.', '..', 'components']);
                    })
                    ->mapWithKeys(function ($file) {
                        $filename = str_replace('.blade.php', '', $file);
                        $label = str_replace('_', ' ', $filename);
                        $label = ucwords($label);

                        return [$filename => $label];
                    });
            }
        }

        return $parentsFound->merge($found)->unique();
    }
}
