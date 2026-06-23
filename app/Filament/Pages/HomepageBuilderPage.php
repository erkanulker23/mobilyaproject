<?php

namespace App\Filament\Pages;

use App\Settings\HomepageSettings;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class HomepageBuilderPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static string $view = 'filament.pages.homepage-builder-page';

    protected static ?string $navigationLabel = 'Anasayfa Düzenleyici';

    public ?array $data = [];

    /**
     * Anasayfada gösterilebilecek bölümler. Sıralama ve açma/kapama buradan yapılır;
     * her blok aktif frontend (AWA Mobilya) temasındaki bir bölüme karşılık gelir.
     */
    public static array $blockLabels = [
        'hero' => 'Hero Slider',
        'featured' => 'Öne Çıkan Bölüm',
        'about' => 'Hakkımızda (İstatistikler)',
        'catalog' => 'Katalog Tanıtımı',
        'categories' => 'Kategoriler',
        'story' => 'Hikaye / Video',
        'showcases' => 'İlham Veren Projeler',
        'products' => 'Ürün Bölümleri',
        'news' => 'Haberler',
        'instagram' => 'Instagram',
    ];

    public function mount(): void
    {
        $content = app(HomepageSettings::class)->content;

        // İçerik boşsa varsayılan blok sırasıyla doldur
        if (empty($content)) {
            $content = array_map(
                fn ($t) => ['type' => $t, 'data' => ['title' => self::$blockLabels[$t]]],
                array_keys(self::$blockLabels)
            );
        }

        $this->form->fill(['content' => $content]);
    }

    public function form(Form $form): Form
    {
        $blocks = [];
        foreach (self::$blockLabels as $type => $label) {
            $blocks[] = Block::make($type)
                ->label($label)
                ->schema([
                    TextInput::make('title')
                        ->label('Başlık (yönetim için not)')
                        ->default($label),
                ]);
        }

        return $form
            ->schema([
                Builder::make('content')
                    ->label('Anasayfa Bölümleri')
                    ->helperText('Bölümleri sürükleyerek sıralayın; istemediğiniz bölümü silin. Anasayfa bu sıraya göre gösterilir.')
                    ->blocks($blocks)
                    ->blockNumbers(false)
                    ->collapsible()
                    ->cloneable(),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $settings = app(HomepageSettings::class);
        $settings->content = $this->form->getState()['content'] ?? [];
        $settings->save();

        Notification::make()
            ->title('Anasayfa düzeni kaydedildi!')
            ->success()
            ->send();
    }
}
