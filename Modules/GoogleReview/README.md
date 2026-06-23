# Google Review Module

Google yorumlarını yönetmek ve görüntülemek için modül.

## Özellikler

- Google yorumlarını manuel olarak ekleme ve yönetme
- Farklı widget tipleri (Grid, List, Slider, Masonry)
- Yorum filtreleme (rating'e göre)
- Yorumları gizleme/gösterme
- Yorumcu ismini anonim yapma seçeneği
- Çoklu dil desteği
- SEO uyumlu
- Responsive tasarım

## Kurulum

Modül otomatik olarak yüklenecektir. Migration'ları çalıştırmak için:

```bash
php artisan migrate
```

## Kullanım

### Admin Panelinde

1. Admin panelinde "Google Yorumları" menüsüne gidin
2. Yeni yorum ekleyin veya mevcut yorumları düzenleyin
3. Widget oluşturun ve ayarlarını yapılandırın

### Frontend'de

Widget'ı sayfanızda göstermek için:

```blade
<x-googlereview::widget :widget-id="1" />
```

## Lisans

Proprietary

