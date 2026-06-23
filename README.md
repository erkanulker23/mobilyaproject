# Kalyon İnşaat — Kurumsal Web Sitesi & CMS

İnşaat firması için Laravel 10 + Filament 3 tabanlı, yönetilebilir kurumsal web sitesi.
Temel altyapı [AWA-CMS](https://github.com/Biostate/AWA-CMS) üzerine kurulmuş; frontend tamamen
"Kalyon İnşaat" tasarımıyla yeniden giydirilmiş ve inşaat sektörüne özel içerik tipleri eklenmiştir.

## Özellikler

**Frontend (Kalyon teması)** — Plus Jakarta Sans + Manrope, coral (#D97757) / koyu (#2B2926) paleti:
- Ana sayfa (hero slider, hakkımızda, hizmetler, projeler, sürdürülebilirlik, haberler, referanslar, iletişim CTA)
- Projeler listesi + filtre + proje detay (künye, galeri, diğer projeler)
- Kataloglar (PDF indirme)
- Hizmetler listesi + detay
- Haberler/Blog listesi + detay (yorumlar)
- Hakkımızda (statik sayfa) + İletişim (form)
- Tamamen responsive, mobil menü

**Admin Panel** (`/admin`, Filament 3) — Projeler, Kataloglar, Hizmetler, Haberler, Sayfalar,
Slider, Menü, Referanslar, SSS, Galeri, Google Yorumları, Genel Ayarlar.

**Eklenen içerik tipleri:** `Project` (Projeler) ve `Catalog` (Kataloglar) modelleri + Filament
resource'ları + frontend controller/route'ları. Hizmetler ve Haberler çekirdek AWA-CMS modelleridir.

## Kurulum

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate

# .env içinde MySQL bağlantısını ayarla, ardından:
php artisan migrate --seed
php artisan db:seed --class=DemoContentSeeder   # (opsiyonel) demo içerik + görseller
php artisan storage:link
npm run build
```

Admin kullanıcısı oluşturmak için: `php artisan make:filament-user` (ardından `superadmin` ve `admin`
rollerini atayın) veya bir seeder kullanın.

## Geliştirme

```bash
npm run dev          # Vite
php artisan serve    # veya Laravel Valet (.test domaini)
```

## Teknik Notlar

- Frontend tema dizini: `themes/awacms/default/resources/views/frontend/`
- Kalyon stilleri/JS: `themes/awacms/default/public/css/kalyon.css`, `.../js/kalyon.js`
  (scroll-reveal, sayaç, hero slider, proje filtresi, mobil menü, `style-hover` runtime).
- İç sayfa hero'su: `frontend/partials/page-hero.blade.php` (yeniden kullanılabilir).
- Site ayarları (telefon, e-posta, adres, sosyal medya) admin → Genel Ayarlar'dan yönetilir;
  view'larda `kalyon_setting('phone', 'fallback')` helper'ı ile okunur.
