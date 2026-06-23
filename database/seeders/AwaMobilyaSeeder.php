<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Testimonial;
use App\Settings\GeneralSettings;
use App\Settings\HomepageSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Faq\Entities\Faq;
use Modules\Faq\Entities\FaqItem;
use Modules\Menu\Entities\Menu;
use Modules\Slide\Entities\Slide;
use Modules\Slide\Entities\Slider;

/**
 * AWA Mobilya — gerçek marka içeriğini DB'ye seed eder.
 * Tüm frontend içeriği (marka, ürünler, kategoriler, slaytlar, haberler, SSS,
 * sayfalar, menüler ve anasayfa blokları) buradan/DB'den yönetilir.
 */
class AwaMobilyaSeeder extends Seeder
{
    private string $uploads;

    public function run(): void
    {
        $this->uploads = base_path('furniture/uploads');

        $this->seedSettings();
        $categories = $this->seedCategories();
        $this->seedProducts($categories);
        $slider = $this->seedSlides();
        $faq = $this->seedFaq();
        $this->seedNews();
        $this->seedTestimonials();
        $this->seedPages();
        [$headerMenu, $footerMenu] = $this->seedMenus();
        $this->seedHomepage($slider, $faq);

        $this->command?->info('AWA Mobilya içeriği yüklendi.');
    }

    /** Görseli furniture/uploads'tan modele ekler (orijinali korur). */
    private function addImage($model, string $collection, string $file): void
    {
        $path = $this->uploads.'/'.$file;
        if (! is_file($path)) {
            return;
        }
        try {
            $model->addMedia($path)->preservingOriginal()->toMediaCollection($collection);
        } catch (\Throwable $e) {
            // sessiz geç
        }
    }

    private function seedSettings(): void
    {
        $s = app(GeneralSettings::class);
        $s->site_name = 'AWA Mobilya';
        $s->phone = '444 96 16';
        $s->gsm = '+90 212 000 00 00';
        $s->email = 'info@awamobilya.com';
        $s->whatsapp = 'https://wa.me/904449616';
        $s->address = 'Masko Mobilya Kenti 5. Cadde No: 12, Başakşehir / İstanbul';
        $s->working_hours = 'Hafta içi 09:00 – 18:00 · Cumartesi 10:00 – 17:00';
        $s->seo_title = 'AWA Mobilya — Kurumsal Mobilya & Koltuk Üreticisi';
        $s->seo_description = 'AWA Mobilya; koltuk takımları, köşe takımları, yatak ve yemek odası koleksiyonları üreten kurumsal mobilya markası. 35+ yıllık tecrübe, 40+ ülkeye ihracat.';
        $s->footer_copyright = '© '.date('Y').' AWA Mobilya. Tüm hakları saklıdır.';
        $s->social_media_links = [
            ['name' => 'instagram', 'url' => 'https://instagram.com/awamobilya'],
            ['name' => 'facebook', 'url' => 'https://facebook.com/awamobilya'],
            ['name' => 'linkedin', 'url' => 'https://linkedin.com/company/awamobilya'],
            ['name' => 'youtube', 'url' => 'https://youtube.com/@awamobilya'],
        ];
        $s->save();
    }

    /** @return array<string,ProjectCategory> */
    private function seedCategories(): array
    {
        $defs = [
            ['key' => 'koltuk', 'name' => 'Koltuk Takımları', 'img' => '2.png'],
            ['key' => 'kose', 'name' => 'Köşe Takımları', 'img' => '7.png'],
            ['key' => 'yatak', 'name' => 'Yatak Odası', 'img' => '1.png'],
            ['key' => 'yemek', 'name' => 'Yemek Odası', 'img' => '3.png'],
        ];

        $map = [];
        $order = 1;
        foreach ($defs as $d) {
            $cat = ProjectCategory::updateOrCreate(
                ['slug' => $d['key']],
                ['name' => $d['name'], 'order_column' => $order++]
            );
            $map[$d['key']] = $cat;
        }

        return $map;
    }

    private function seedProducts(array $categories): void
    {
        $dims = [
            'koltuk' => [['label' => 'Üçlü Kanepe', 'value' => 'G 240 · D 95 · Y 85 cm'], ['label' => 'İkili Kanepe', 'value' => 'G 180 · D 95 · Y 85 cm'], ['label' => 'Tekli Berjer', 'value' => 'G 90 · D 88 · Y 82 cm']],
            'kose' => [['label' => 'Köşe Kanepe', 'value' => 'G 320 · D 180 · Y 85 cm'], ['label' => 'Üçlü Modül', 'value' => 'G 240 · D 95 · Y 85 cm'], ['label' => 'Puf', 'value' => 'G 90 · D 70 · Y 42 cm']],
            'yatak' => [['label' => 'Karyola', 'value' => 'G 180 · D 210 · Y 120 cm'], ['label' => 'Komodin', 'value' => 'G 55 · D 42 · Y 50 cm'], ['label' => 'Gardırop', 'value' => 'G 260 · D 62 · Y 220 cm']],
            'yemek' => [['label' => 'Yemek Masası', 'value' => 'G 200 · D 100 · Y 76 cm'], ['label' => 'Sandalye (6)', 'value' => 'G 48 · D 56 · Y 95 cm'], ['label' => 'Konsol', 'value' => 'G 180 · D 45 · Y 85 cm']],
        ];
        $desc = [
            'koltuk' => 'Modern çizgileri ve yumuşak oturum konforuyla yaşam alanınıza karakter katan koltuk takımı.',
            'kose' => 'Geniş aileler ve sosyal yaşam için tasarlanan, mekânı verimli kullanan köşe takımı.',
            'yatak' => 'Huzurlu bir uyku ve şık bir dinlenme alanı için tasarlanmış yatak odası koleksiyonu.',
            'yemek' => 'Sofra keyfini bir araya getiren, zarif ve dayanıklı yemek odası takımı.',
        ];

        $products = [
            ['id' => 'exence', 'cat' => 'koltuk', 'tr' => 'Exence Koltuk Takımı', 'img' => '2.png', 'feat' => true],
            ['id' => 'harmony', 'cat' => 'koltuk', 'tr' => 'Harmony Koltuk Takımı', 'img' => '5.png', 'feat' => true],
            ['id' => 'lucid', 'cat' => 'koltuk', 'tr' => 'Lucid Koltuk Takımı', 'img' => '6.png', 'feat' => true],
            ['id' => 'rivian', 'cat' => 'kose', 'tr' => 'Rivian Köşe Takımı', 'img' => '1.png', 'feat' => true],
            ['id' => 'nova', 'cat' => 'kose', 'tr' => 'Nova Köşe Takımı', 'img' => '8.png', 'feat' => false],
            ['id' => 'corner', 'cat' => 'kose', 'tr' => 'Corner Köşe Takımı', 'img' => '9.png', 'feat' => false],
            ['id' => 'serene', 'cat' => 'yatak', 'tr' => 'Serene Yatak Odası', 'img' => '3.png', 'feat' => true],
            ['id' => 'aura', 'cat' => 'yatak', 'tr' => 'Aura Yatak Odası', 'img' => '4.png', 'feat' => false],
            ['id' => 'vivo', 'cat' => 'yemek', 'tr' => 'Vivo Yemek Odası', 'img' => '7.png', 'feat' => true],
            ['id' => 'lina', 'cat' => 'yemek', 'tr' => 'Lina Yemek Odası', 'img' => '9.png', 'feat' => false],
        ];

        $order = 1;
        foreach ($products as $p) {
            $cat = $categories[$p['cat']] ?? null;
            $project = Project::updateOrCreate(
                ['slug' => Str::slug($p['tr'])],
                [
                    'title' => $p['tr'],
                    'category' => $p['cat'],
                    'project_category_id' => $cat?->id,
                    'status' => 'tamam',
                    'short_description' => $desc[$p['cat']],
                    'content' => '<p>'.$desc[$p['cat']].' El işçiliğiyle üretilen sağlam ahşap karkas, yüksek yoğunluklu oturum süngeri ve leke tutmayan, çıkarılabilir kumaş kılıf. Geniş renk ve kumaş seçeneğiyle 2 yıl üretici garantili.</p>',
                    'specs' => $dims[$p['cat']] ?? [],
                    'is_featured' => $p['feat'],
                    'published' => true,
                    'order_column' => $order++,
                ]
            );

            if (! $project->getFirstMedia('cover')) {
                $this->addImage($project, 'cover', $p['img']);
            }
        }
    }

    private function seedSlides(): Slider
    {
        $slider = Slider::updateOrCreate(['title' => 'Anasayfa Slider'], ['interval' => 6000]);
        // mevcut slaytları temizle (tekrar seed'de çoğalmasın)
        $slider->slides()->each(fn ($s) => $s->delete());

        $slides = [
            ['img' => '1.png', 'sub' => 'KÖŞE TAKIMLARI', 'title' => 'Yaşam alanınıza karakter katın', 'cta' => 'Koleksiyonu Keşfet'],
            ['img' => '3.png', 'sub' => 'KOLTUK TAKIMLARI', 'title' => 'Konforun zarif hali', 'cta' => 'Ürünleri İncele'],
            ['img' => '7.png', 'sub' => 'YENİ KOLEKSİYON', 'title' => '2026 İlkbahar Koleksiyonu', 'cta' => 'Hemen Bak'],
        ];

        $order = 1;
        foreach ($slides as $sl) {
            $slide = Slide::create([
                'slider_id' => $slider->id,
                'title' => ['tr' => $sl['title'], 'en' => $sl['title']],
                'subtitle' => ['tr' => $sl['sub'], 'en' => $sl['sub']],
                'cta_text' => ['tr' => $sl['cta'], 'en' => $sl['cta']],
                'link_url' => ['tr' => '/projeler', 'en' => '/projeler'],
                'title_color' => '#ffffff',
                'subtitle_color' => '#E0A488',
                'order_column' => $order++,
            ]);
            $this->addImage($slide, 'image', $sl['img']);
        }

        return $slider;
    }

    private function seedFaq(): Faq
    {
        $faq = Faq::updateOrCreate(['slug' => 'genel-sss'], [
            'name' => ['tr' => 'Genel Sorular', 'en' => 'General Questions'],
            'description' => ['tr' => 'AWA Mobilya hakkında sıkça sorulan sorular', 'en' => 'Frequently asked questions about AWA Mobilya'],
        ]);

        // Tekrar seed'de duplikasyonu önle
        $oldIds = $faq->items()->pluck('faq_items.id')->all();
        $faq->items()->detach();
        if ($oldIds) {
            FaqItem::whereIn('id', $oldIds)->delete();
        }

        $items = [
            ['q' => 'Ürünleriniz garantili mi?', 'a' => 'Tüm ürünlerimiz 2 yıl üretici garantisi kapsamındadır.'],
            ['q' => 'Teslimat süresi ne kadar?', 'a' => 'Stoktaki ürünler 3-5 iş günü, özel üretim ürünler 4-6 hafta içinde teslim edilir.'],
            ['q' => 'Kumaş ve renk seçeneği var mı?', 'a' => 'Tüm koleksiyonlarımızda geniş kumaş ve renk seçeneği sunuyoruz. Bayilerimizden numune inceleyebilirsiniz.'],
            ['q' => 'Bayilik almak istiyorum, nasıl başvurabilirim?', 'a' => 'Bayilik başvurularınızı iletişim formundan veya info@awamobilya.com adresinden iletebilirsiniz.'],
        ];

        $order = 1;
        foreach ($items as $it) {
            $item = FaqItem::create([
                'slug' => Str::slug($it['q']).'-'.$order,
                'properties' => [],
                'title' => ['tr' => $it['q'], 'en' => $it['q']],
                'short_description' => ['tr' => $it['a'], 'en' => $it['a']],
                'description' => ['tr' => $it['a'], 'en' => $it['a']],
            ]);
            $faq->items()->attach($item->id, ['order_column' => $order]);
            $order++;
        }

        return $faq;
    }

    private function seedNews(): void
    {
        $cat = BlogCategory::updateOrCreate(['slug' => 'haberler'], [
            'name' => 'Haberler',
            'is_active' => true,
            'order_column' => 1,
        ]);

        $news = [
            ['date' => '2026-06-12', 'img' => '3.png', 'tr' => 'AWA Mobilya İstanbul Mobilya Fuarı’nda', 'ex' => 'Yeni koleksiyonumuzu CNR İMOB standımızda ziyaretçilerle buluşturduk.', 'body' => 'AWA Mobilya, bu yıl 28.’si düzenlenen CNR İMOB İstanbul Mobilya Fuarı’nda yerini aldı. Standımızda Exence, Lucid ve Rivian başta olmak üzere 2026 koleksiyonumuzun öne çıkan modellerini sergiledik.'],
            ['date' => '2026-05-28', 'img' => '2.png', 'tr' => '2026 İlkbahar Koleksiyonu yayında', 'ex' => 'Doğal kumaşlar ve sıcak tonlarla tasarlanan yeni serimiz mağazalarda.', 'body' => '2026 İlkbahar Koleksiyonumuz, doğadan ilham alan sıcak tonlar ve yumuşak dokularla hazırlandı. Bouclé ve kadife kumaşların ön plana çıktığı koleksiyonda organik formlar ve yuvarlatılmış hatlar dikkat çekiyor.'],
            ['date' => '2026-04-15', 'img' => '5.png', 'tr' => 'Yeni üretim tesisimiz açıldı', 'ex' => '18.000 m² kapalı alana sahip tesisimizle üretim kapasitemizi ikiye katladık.', 'body' => 'Büyüyen talebi karşılamak için 18.000 m² kapalı alana sahip yeni üretim tesisimizi hizmete aldık. Modern üretim hatları ve nitelikli iş gücüyle kapasitemizi ikiye katladık.'],
            ['date' => '2026-03-02', 'img' => '6.png', 'tr' => 'Sürdürülebilir üretim sertifikası aldık', 'ex' => 'FSC sertifikalı ahşap kullanımıyla çevresel sorumluluğumuzu büyütüyoruz.', 'body' => 'Çevresel sorumluluğumuzun bir parçası olarak FSC sertifikalı ahşap kullanımına geçtik. Üretim süreçlerimizde atık yönetimi ve enerji verimliliği konularında önemli adımlar attık.'],
            ['date' => '2026-01-20', 'img' => '8.png', 'tr' => 'Tasarım ödülüne layık görüldük', 'ex' => 'Lucid serimiz uluslararası bir tasarım ödülünün sahibi oldu.', 'body' => 'Lucid koltuk serimiz, uluslararası jüri tarafından yılın tasarımı ödülüne layık görüldü. Minimal çizgileri ve fonksiyonel detaylarıyla öne çıkan seri, tasarım ekibimizin uzun süreli çalışmasının ürünü.'],
            ['date' => '2025-12-05', 'img' => '4.png', 'tr' => '40. ülkeye ihracata başladık', 'ex' => 'Avrupa ve Orta Doğu’nun ardından ihracat ağımızı genişletmeye devam ediyoruz.', 'body' => 'AWA Mobilya, ihracat ağına 40. ülkeyi ekleyerek küresel büyümesini sürdürüyor. Avrupa, Orta Doğu ve Kuzey Afrika pazarlarının ardından yeni bölgelere açılıyoruz.'],
        ];

        foreach ($news as $n) {
            $post = BlogPost::updateOrCreate(
                ['slug->tr' => Str::slug($n['tr'])],
                [
                    'slug' => ['tr' => Str::slug($n['tr']), 'en' => Str::slug($n['tr'])],
                    'title' => ['tr' => $n['tr'], 'en' => $n['tr']],
                    'short_description' => ['tr' => $n['ex'], 'en' => $n['ex']],
                    'content' => ['tr' => '<p>'.$n['body'].'</p>', 'en' => '<p>'.$n['body'].'</p>'],
                    'publish_at' => Carbon::parse($n['date']),
                ]
            );
            $post->categories()->syncWithoutDetaching([$cat->id]);

            if (! $post->getFirstMedia('listing_image')) {
                $this->addImage($post, 'listing_image', $n['img']);
                $this->addImage($post, 'details_hero', $n['img']);
            }
        }
    }

    private function seedTestimonials(): void
    {
        $items = [
            ['name' => 'Ayşe Demir', 'company' => 'İstanbul', 'desc' => 'Koltuk takımımız hem çok şık hem de son derece konforlu. Teslimat ve montaj kusursuzdu.'],
            ['name' => 'Mehmet Yılmaz', 'company' => 'Ankara', 'desc' => 'Yatak odası takımının işçiliği gerçekten kaliteli. Yıllardır ilk günkü gibi.'],
            ['name' => 'Zeynep Kaya', 'company' => 'İzmir', 'desc' => 'Kumaş seçenekleri çok geniş, tam istediğim tonu buldum. Teşekkürler AWA Mobilya.'],
        ];
        $order = 1;
        foreach ($items as $t) {
            Testimonial::updateOrCreate(
                ['name' => $t['name']],
                [
                    'company' => $t['company'],
                    'description' => $t['desc'],
                    'rating' => 5,
                    'is_active' => true,
                    'date_at' => Carbon::now(),
                    'order_column' => $order++,
                ]
            );
        }
    }

    private function seedPages(): void
    {
        $about = 'Sektörü iyi analiz ederek teknoloji ile el emeğini birleştiren, markalaşmaya önem veren AWA Mobilya; dinamik ve sezgisel yapısıyla sektörün öncü firmalarından biridir. Bu başarıya, günümüz çizgisini yönlendiren ve geleceğin felsefesini şekillendiren ürünler üreterek ulaşmıştır.';

        $pages = [
            ['slug' => 'hakkimizda', 'title' => 'Hakkımızda', 'content' => '<p>'.$about.'</p>'],
            ['slug' => 'kvkk', 'title' => 'KVKK Aydınlatma Metni', 'content' => '<p>AWA Mobilya olarak kişisel verilerinizin güvenliğine önem veriyoruz. 6698 sayılı Kişisel Verilerin Korunması Kanunu kapsamında verileriniz işlenmektedir.</p>'],
            ['slug' => 'gizlilik', 'title' => 'Gizlilik Politikası', 'content' => '<p>Bu gizlilik politikası, AWA Mobilya web sitesini ziyaret ettiğinizde kişisel bilgilerinizin nasıl toplandığını ve kullanıldığını açıklar.</p>'],
            ['slug' => 'mesafeli-satis', 'title' => 'Mesafeli Satış Sözleşmesi', 'content' => '<p>İşbu mesafeli satış sözleşmesi, alıcı ile satıcı AWA Mobilya arasında aşağıdaki şartlar dahilinde akdedilmiştir.</p>'],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(
                ['slug->tr' => $p['slug']],
                [
                    'slug' => ['tr' => $p['slug'], 'en' => $p['slug']],
                    'title' => ['tr' => $p['title'], 'en' => $p['title']],
                    'content' => ['tr' => $p['content'], 'en' => $p['content']],
                ]
            );
        }
    }

    /** @return array{0:Menu,1:Menu} */
    private function seedMenus(): array
    {
        $links = [
            ['name' => 'Anasayfa', 'url' => '/'],
            ['name' => 'Kurumsal', 'url' => '/sayfa/hakkimizda'],
            ['name' => 'Ürünler', 'url' => '/projeler'],
            ['name' => 'Haberler', 'url' => '/blog'],
            ['name' => 'İletişim', 'url' => '/iletisim'],
        ];

        $header = Menu::firstOrCreate(['name' => 'Header Menü']);
        $footer = Menu::firstOrCreate(['name' => 'Footer Menü']);

        foreach ([$header, $footer] as $menu) {
            $menu->items()->delete();
            foreach ($links as $l) {
                $menu->items()->create(['name' => $l['name'], 'url' => $l['url'], 'target' => '_self']);
            }
        }

        // Menüleri ayarlara bağla
        $s = app(GeneralSettings::class);
        $s->header_menu = $header->id;
        $s->footer_menu = $footer->id;
        $s->save();

        return [$header, $footer];
    }

    private function seedHomepage(Slider $slider, Faq $faq): void
    {
        // Hakkımızda görselini public diske kopyala (about_us bloğu için)
        $aboutImg = 'images/about-awa.png';
        try {
            $src = $this->uploads.'/4.png';
            $dest = storage_path('app/public/images');
            if (is_file($src)) {
                File::ensureDirectoryExists($dest);
                File::copy($src, $dest.'/about-awa.png');
            }
        } catch (\Throwable $e) {
            $aboutImg = null;
        }

        $content = [
            [
                'type' => 'hero_slider',
                'data' => [
                    'slider_id' => $slider->id,
                    'view_variant' => 'variant_1',
                ],
            ],
            [
                'type' => 'about_us_section',
                'data' => [
                    'section_title' => 'Markamız',
                    'section_subtitle' => 'AWA Mobilya',
                    'view_variant' => 'variant_1',
                    'section_description' => '<p>Sektörü iyi analiz ederek teknoloji ile el emeğini birleştiren, markalaşmaya önem veren AWA Mobilya; dinamik ve sezgisel yapısıyla sektörün öncü firmalarından biridir.</p>',
                    'image' => $aboutImg,
                    'bg_color' => '#F6F3ED',
                    'button_text' => 'Daha Fazla',
                    'button_link' => '/sayfa/hakkimizda',
                    'list' => [
                        ['title' => 'El işçiliğiyle üretilen sağlam ahşap karkas'],
                        ['title' => 'Yüksek yoğunluklu, yumuşak oturum süngeri'],
                        ['title' => 'Leke tutmayan, çıkarılabilir kumaş kılıf'],
                        ['title' => '2 yıl üretici garantisi'],
                    ],
                ],
            ],
            [
                'type' => 'projects_section',
                'data' => [
                    'eyebrow' => 'Koleksiyon',
                    'section_title' => 'Öne Çıkan Ürünler',
                    'section_subtitle' => 'Koltuk, köşe, yatak ve yemek odası koleksiyonlarımız',
                    'view_variant' => 'variant_1',
                    'limit' => 6,
                    'only_featured' => true,
                    'show_filter' => false,
                    'button_text' => 'Tüm Ürünler',
                    'button_url' => '/projeler',
                    'bg_color' => '#ffffff',
                ],
            ],
            [
                'type' => 'counters_section',
                'data' => [
                    'section_title' => 'Rakamlarla AWA Mobilya',
                    'section_subtitle' => 'Tecrübemiz ve büyümemiz',
                    'view_variant' => 'variant_1',
                    'counters' => [
                        ['title' => 'Yıllık Tecrübe', 'description' => 'Sektördeki tecrübemiz', 'icon' => 'fas fa-calendar-check', 'value' => 35, 'image' => null],
                        ['title' => 'İhracat Ülke', 'description' => 'Dünya genelinde', 'icon' => 'fas fa-globe', 'value' => 40, 'image' => null],
                        ['title' => 'Ürün Modeli', 'description' => 'Geniş koleksiyon', 'icon' => 'fas fa-couch', 'value' => 250, 'image' => null],
                        ['title' => 'Mutlu Müşteri', 'description' => 'Memnun müşterilerimiz', 'icon' => 'fas fa-users', 'value' => 15000, 'image' => null],
                    ],
                ],
            ],
            [
                'type' => 'latest_blog_post_section',
                'data' => [
                    'section_title' => 'Haberler',
                    'section_subtitle' => 'AWA Mobilya’dan son gelişmeler',
                    'view_variant' => 'variant_1',
                ],
            ],
            [
                'type' => 'faqs_section',
                'data' => [
                    'faq_ids' => [$faq->id],
                    'section_title' => 'Sıkça Sorulan Sorular',
                    'section_subtitle' => 'Merak edilenler',
                    'view_variant' => 'variant_1',
                ],
            ],
            [
                'type' => 'request_form_section',
                'data' => [
                    'section_title' => 'Bize Ulaşın',
                    'section_subtitle' => 'Ürünlerimiz ve bayilik hakkında bilgi alın',
                    'view_variant' => 'variant_1',
                    'phone' => '444 96 16',
                    'email' => 'info@awamobilya.com',
                    'button_text' => 'Gönder',
                    'topic_options' => [
                        ['title' => 'Ürün Bilgisi'],
                        ['title' => 'Bayilik'],
                        ['title' => 'Diğer'],
                    ],
                ],
            ],
        ];

        $h = app(HomepageSettings::class);
        $h->content = $content;
        $h->save();
    }
}
