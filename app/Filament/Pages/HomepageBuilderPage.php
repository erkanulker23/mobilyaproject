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

    /** Her blokta düzenlenebilir alanlar. */
    public static array $blockFields = [
        'hero' => [],
        'featured' => ['title', 'subtitle', 'text', 'button_text'],
        'about' => ['title', 'subtitle', 'text'],
        'catalog' => ['title', 'text', 'button_text'],
        'categories' => ['title', 'subtitle'],
        'story' => [],
        'showcases' => ['title', 'subtitle'],
        'products' => ['title', 'subtitle'],
        'news' => ['title', 'subtitle'],
        'instagram' => [],
    ];

    /** Blok içeriğinin nereden geldiği — admin açıklaması. */
    public static array $blockSources = [
        'hero' => 'İçerik kaynağı: Slider / Slaytlar. Buradan yalnızca sıra ve görünürlük ayarlanır.',
        'featured' => 'Başlık ve metin buradan düzenlenir. Görseller şablonda sabittir.',
        'about' => 'Başlık buradan; metin boşsa Hakkımızda sayfası / Genel Ayarlar kullanılır.',
        'catalog' => 'Başlık ve metin buradan düzenlenir. Katalog dosyası ayrı yönetilir.',
        'categories' => 'Yalnızca bölüm başlığı buradan. Kartlar Ürün Kategorileri + Ürünlerden otomatik gelir.',
        'story' => 'İçerik kaynağı: Genel Ayarlar → Hikaye / Tanıtım. Buradan sıra ve görünürlük.',
        'showcases' => 'Başlık buradan; proje kartları İlham Veren Projeler kayıtlarından gelir.',
        'products' => 'Her kategori için ayrı ürün satırı otomatik oluşur. Başlıklar kategori adından gelir.',
        'news' => 'Başlık buradan; haber kartları Blog/Haberler kayıtlarından gelir.',
        'instagram' => 'İçerik kaynağı: Genel Ayarlar → Instagram. Buradan sıra ve görünürlük.',
    ];

    public function form(Form $form): Form
    {
        $blocks = [];
        foreach (self::$blockLabels as $type => $label) {
            $fields = self::$blockFields[$type] ?? [];
            $schema = [];
            if (in_array('title', $fields, true)) {
                $schema[] = TextInput::make('title')->label('Başlık');
            }
            if (in_array('subtitle', $fields, true)) {
                $schema[] = TextInput::make('subtitle')->label('Alt Başlık / Etiket');
            }
            if (in_array('text', $fields, true)) {
                $schema[] = \Filament\Forms\Components\Textarea::make('text')->label('Metin')->rows(3);
            }
            if (in_array('button_text', $fields, true)) {
                $schema[] = TextInput::make('button_text')->label('Buton Yazısı');
            }
            if (empty($schema)) {
                $schema[] = \Filament\Forms\Components\Placeholder::make('info')
                    ->label('İçerik kaynağı')
                    ->content(self::$blockSources[$type] ?? 'Bu bölümün sırasını ve görünürlüğünü buradan ayarlayın.');
            } else {
                array_unshift($schema, \Filament\Forms\Components\Placeholder::make('source_'.$type)
                    ->label('İçerik kaynağı')
                    ->content(self::$blockSources[$type] ?? ''));
            }
            $blocks[] = Block::make($type)->label($label)->schema($schema);
        }

        return $form
            ->schema([
                Builder::make('content')
                    ->label('Anasayfa Bölümleri')
                    ->helperText('Bölümleri sürükleyerek sıralayın; istemediğiniz bölümü silin. Kaydettiğiniz sıra anasayfaya yansır. Metin alanı olan bloklar başlık/metin düzenler; diğerleri ilgili admin sayfasından beslenir (Slider, Ürünler, Genel Ayarlar).')
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
