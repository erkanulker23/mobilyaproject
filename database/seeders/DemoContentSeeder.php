<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Catalog;
use App\Models\Project;
use App\Models\ServicePost;
use App\Settings\GeneralSettings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DemoContentSeeder extends Seeder
{
    private function addImage($model, string $collection, ?string $url): void
    {
        if (! $url) {
            return;
        }
        try {
            $model->addMediaFromUrl($url)->toMediaCollection($collection);
        } catch (\Throwable $e) {
            // görsel indirilemezse sessizce geç (fallback kullanılır)
        }
    }

    public function run(): void
    {
        /* ---------- Genel Ayarlar ---------- */
        try {
            $s = app(GeneralSettings::class);
            $s->site_name = 'Kalyon İnşaat';
            $s->phone = '+90 212 000 00 00';
            $s->email = 'info@kalyoninsaat.com';
            $s->address = 'Maslak Mah. Büyükdere Cd. No:1, Sarıyer / İstanbul';
            $s->whatsapp = '902120000000';
            $s->footer_copyright = '© ' . date('Y') . ' Kalyon İnşaat. Tüm hakları saklıdır.';
            $s->social_media_links = [
                ['name' => 'linkedin', 'url' => 'https://linkedin.com'],
                ['name' => 'instagram', 'url' => 'https://instagram.com'],
                ['name' => 'youtube', 'url' => 'https://youtube.com'],
            ];
            $s->save();
        } catch (\Throwable $e) {
        }

        /* ---------- Projeler ---------- */
        $projects = [
            ['Vadi Zekeriyaköy', 'villa', 'Sarıyer, İstanbul', 'devam', true, '45.000 m²', '2024', 'Doğayla iç içe, modern villa yaşamı.', 'https://baynetinsaat.com.tr/uploads/2023/08/VADI-min.jpg', [['label'=>'Blok','value'=>'5'],['label'=>'Villa','value'=>'20'],['label'=>'Sosyal Tesis','value'=>'1']]],
            ['Baynet Terrace', 'rezidans', 'Çayırhisar, Balıkesir', 'devam', true, '28.000 m²', '2024', '116 daire ve ticari ünitelerden oluşan karma proje.', 'https://baynetinsaat.com.tr/uploads/2023/09/2-2-scaled.jpg', [['label'=>'Daire','value'=>'116'],['label'=>'Ticari','value'=>'3']]],
            ['DAP Rezidans', 'rezidans', 'İstanbul', 'tamam', false, '60.000 m²', '2022', 'Şehrin merkezinde prestijli rezidans kompleksi.', 'https://dapyapi.com.tr/dapyapi/cdn/uploads/000006593_dap-45yil-dap-web.webp', [['label'=>'Kule','value'=>'2'],['label'=>'Daire','value'=>'240']]],
            ['NK Mart Ticari', 'ticari', 'İstanbul', 'devam', false, '18.000 m²', '2025', 'Karma kullanımlı ticari kompleks.', 'https://dapyapi.com.tr/dapyapi/cdn/uploads/000006544_nk-mart-website-1920x1080-dap.webp', [['label'=>'Mağaza','value'=>'40']]],
            ['Nefesköy Kayacıklar', 'villa', 'Kepsut, Balıkesir', 'devam', true, '52.000 m²', '2025', 'Doğal yaşamla buluşan müstakil villa projesi.', 'https://images.pexels.com/photos/1396122/pexels-photo-1396122.jpeg?auto=compress&cs=tinysrgb&w=1100', [['label'=>'Villa','value'=>'54']]],
            ['Twin Towers', 'rezidans', 'Karesi, Balıkesir', 'tamam', false, '40.000 m²', '2021', 'İkiz kuleli modern yaşam kompleksi.', 'https://images.pexels.com/photos/1838640/pexels-photo-1838640.jpeg?auto=compress&cs=tinysrgb&w=1100', [['label'=>'Daire','value'=>'104'],['label'=>'Ticari','value'=>'4']]],
        ];
        foreach ($projects as $i => $p) {
            $project = Project::create([
                'title' => $p[0], 'category' => $p[1], 'location' => $p[2], 'status' => $p[3],
                'is_sale' => $p[4], 'area' => $p[5], 'year' => $p[6], 'short_description' => $p[7],
                'content' => '<p>' . $p[7] . ' Kalyon İnşaat mühendislik kalitesi ve sürdürülebilir yapı anlayışıyla hayata geçirilen bu projede konfor, estetik ve dayanıklılık bir arada sunulmaktadır.</p>',
                'specs' => $p[9], 'is_featured' => $i < 3, 'published' => true, 'order_column' => $i + 1,
            ]);
            $this->addImage($project, 'cover', $p[8]);
        }

        /* ---------- Kataloglar ---------- */
        $catalogs = [
            ['Kurumsal Katalog 2024', 'Kalyon İnşaat kurumsal tanıtım kataloğu.', '4.2 MB', '2024', 'https://images.pexels.com/photos/323705/pexels-photo-323705.jpeg?auto=compress&cs=tinysrgb&w=800'],
            ['Konut Projeleri Broşürü', 'Devam eden ve tamamlanan konut projelerimiz.', '3.1 MB', '2024', 'https://images.pexels.com/photos/1546168/pexels-photo-1546168.jpeg?auto=compress&cs=tinysrgb&w=800'],
            ['Ticari Projeler Sunumu', 'Ticari ve karma kullanım projelerimiz.', '5.6 MB', '2023', 'https://images.pexels.com/photos/280222/pexels-photo-280222.jpeg?auto=compress&cs=tinysrgb&w=800'],
        ];
        foreach ($catalogs as $i => $c) {
            $catalog = Catalog::create([
                'title' => $c[0], 'description' => $c[1], 'file_size' => $c[2], 'year' => $c[3],
                'published' => true, 'order_column' => $i + 1,
            ]);
            $this->addImage($catalog, 'cover', $c[4]);
        }

        /* ---------- Hizmetler ---------- */
        $services = [
            ['Mimari Tasarım', 'Konseptten uygulamaya özgün, işlevsel mimari çözümler.', 'Deneyimli mimar kadromuzla projelerinizi konsept aşamasından uygulama detaylarına kadar tasarlıyoruz.'],
            ['İnşaat & Mühendislik', 'Anahtar teslim, deprem güvenli ve denetimli üretim.', 'Güçlü mühendislik altyapımız ve denetimli üretim süreçlerimizle anahtar teslim inşaat hizmeti sunuyoruz.'],
            ['Proje Yönetimi', 'Bütçe, zaman ve kalitede şeffaf raporlamayla yönetim.', 'Projelerinizi bütçe, zaman ve kalite hedeflerine uygun şekilde şeffaf raporlamayla yönetiyoruz.'],
            ['Gayrimenkul & Satış', 'Satış, kiralama ve yatırım danışmanlığında tam destek.', 'Satış, kiralama ve yatırım danışmanlığı süreçlerinde uçtan uca profesyonel destek sağlıyoruz.'],
        ];
        foreach ($services as $i => $sv) {
            try {
                ServicePost::create([
                    'title' => $sv[0], 'short_description' => $sv[1],
                    'content' => '<p>' . $sv[2] . '</p>',
                    'publish_at' => Carbon::now()->subDays(10 - $i),
                ]);
            } catch (\Throwable $e) {
            }
        }

        /* ---------- Haberler ---------- */
        $posts = [
            ['Vadi Zekeriyaköy projemizde kaba inşaat tamamlandı', 'Sarıyer’deki villa projemizde önemli bir aşamayı geride bıraktık.', 'https://images.pexels.com/photos/1216589/pexels-photo-1216589.jpeg?auto=compress&cs=tinysrgb&w=1100'],
            ['Sürdürülebilir inşaat için yeni yatırımlarımız', 'Yenilenebilir enerji ve düşük karbonlu üretim hedeflerimizi büyütüyoruz.', 'https://images.pexels.com/photos/356036/pexels-photo-356036.jpeg?auto=compress&cs=tinysrgb&w=1100'],
            ['Baynet Terrace satış ofisimiz açıldı', 'Balıkesir’deki yeni projemizin satış ofisi ziyaretçilerini ağırlamaya başladı.', 'https://images.pexels.com/photos/1546166/pexels-photo-1546166.jpeg?auto=compress&cs=tinysrgb&w=1100'],
        ];
        foreach ($posts as $i => $po) {
            try {
                $post = BlogPost::create([
                    'title' => $po[0], 'short_description' => $po[1],
                    'content' => '<p>' . $po[1] . ' Detaylar yakında paylaşılacaktır.</p>',
                    'publish_at' => Carbon::now()->subDays(($i + 1) * 5),
                ]);
                $this->addImage($post, 'listing_image', $po[2]);
            } catch (\Throwable $e) {
            }
        }

        /* ---------- Referanslar ---------- */
        try {
            $refClass = \Modules\References\Entities\Reference::class;
            $refs = ['Emlak Konut', 'TOKİ', 'Çevre Bakanlığı', 'İBB', 'Akbank', 'İş Bankası'];
            foreach ($refs as $i => $name) {
                $ref = $refClass::create(['title' => $name, 'logo' => '', 'order_column' => $i + 1]);
                $this->addImage($ref, 'logo', 'https://placehold.co/220x70/efe9de/2B2926?text=' . urlencode($name));
            }
        } catch (\Throwable $e) {
        }
    }
}
