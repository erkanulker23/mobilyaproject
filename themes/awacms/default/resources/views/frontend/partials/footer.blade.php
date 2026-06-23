@php
    $phone = kalyon_setting('phone', '+90 212 000 00 00');
    $address = kalyon_setting('address', 'Maslak, Sarıyer, İstanbul, Türkiye');
    $email = kalyon_setting('email', 'info@kalyoninsaat.com');
    $copyright = kalyon_setting('footer_copyright', '© ' . date('Y') . ' Kalyon İnşaat. Tüm hakları saklıdır.');
    $social = kalyon_setting('social_media_links', []);

    // Footer linkleri admin → Menüler'deki "Footer Menü"den gelir (fallback'li)
    $footerLinks = [];
    try {
        $fmId = kalyon_setting('footer_menu');
        $fmenu = $fmId ? \Modules\Menu\Entities\Menu::find($fmId) : null;
        if (! $fmenu) {
            $fmenu = \Modules\Menu\Entities\Menu::where('name', 'Footer Menü')->first();
        }
        if ($fmenu) {
            foreach ($fmenu->items()->whereNull('parent_id')->defaultOrder()->get() as $item) {
                $footerLinks[] = ['label' => $item->name, 'url' => $item->link ?: ($item->url ?: '#')];
            }
        }
    } catch (\Throwable $e) {
        $footerLinks = [];
    }
    if (empty($footerLinks)) {
        $footerLinks = [
            ['label' => 'Hakkımızda', 'url' => route('page.show', 'hakkimizda')],
            ['label' => 'Hizmetler', 'url' => route('services.index')],
            ['label' => 'Projeler', 'url' => route('projects.index')],
            ['label' => 'Kataloglar', 'url' => route('catalogs.index')],
            ['label' => 'Haberler', 'url' => route('blog.index')],
            ['label' => 'İletişim', 'url' => route('contact.index')],
        ];
    }
    $footerChunks = array_chunk($footerLinks, (int) ceil(count($footerLinks) / 2));
@endphp

<footer style="background:#1C1A17;color:#fff;padding:80px 0 36px">
    <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
        <div class="kal-footer-grid kal-grid-4" style="display:grid;grid-template-columns:1.6fr 1fr 1fr 1.2fr;gap:44px;padding-bottom:50px;border-bottom:1px solid rgba(255,255,255,.1)">
            <div>
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px"><span style="display:inline-flex;width:36px;height:36px;align-items:center;justify-content:center;background:#D97757;color:#fff;font-family:'Plus Jakarta Sans';font-weight:800;font-size:16px">K</span><span style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:16px;letter-spacing:2px">KALYON <span style="color:#E0A488">İNŞAAT</span></span></div>
                <p style="font-size:14px;line-height:1.7;color:rgba(255,255,255,.55);max-width:42ch">1976'dan bu yana mühendislik gücü, dijital teknoloji ve sürdürülebilir vizyonla geleceğin yaşam alanlarını inşa ediyoruz.</p>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#E0A488;margin-bottom:16px">Kurumsal</div>
                <div style="display:flex;flex-direction:column;gap:11px">
                    @foreach(($footerChunks[0] ?? []) as $fl)
                        <a href="{{ $fl['url'] }}" style="font-size:13.5px;color:rgba(255,255,255,.62);text-decoration:none;transition:color .3s" style-hover="color:#fff">{{ $fl['label'] }}</a>
                    @endforeach
                </div>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#E0A488;margin-bottom:16px">Hızlı Erişim</div>
                <div style="display:flex;flex-direction:column;gap:11px">
                    @foreach(($footerChunks[1] ?? []) as $fl)
                        <a href="{{ $fl['url'] }}" style="font-size:13.5px;color:rgba(255,255,255,.62);text-decoration:none;transition:color .3s" style-hover="color:#fff">{{ $fl['label'] }}</a>
                    @endforeach
                </div>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#E0A488;margin-bottom:16px">İletişim</div>
                <div style="display:flex;flex-direction:column;gap:11px;font-size:13.5px;color:rgba(255,255,255,.62)">
                    <span>{{ $address }}</span>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" style="color:rgba(255,255,255,.62);text-decoration:none;transition:color .3s" style-hover="color:#fff">{{ $phone }}</a>
                    <a href="mailto:{{ $email }}" style="color:rgba(255,255,255,.62);text-decoration:none;transition:color .3s" style-hover="color:#fff">{{ $email }}</a>
                    <a href="{{ route('contact.index') }}" style="color:#E0A488;text-decoration:none;font-weight:600;transition:color .3s" style-hover="color:#fff">İletişim Sayfası →</a>
                </div>
            </div>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;padding-top:26px">
            <span style="font-size:13px;color:rgba(255,255,255,.4)">{{ $copyright }}</span>
            <div style="display:flex;gap:22px">
                @forelse($social as $item)
                    @php $url = is_array($item) ? ($item['url'] ?? '#') : $item; $name = is_array($item) ? ($item['name'] ?? ($item['platform'] ?? 'Sosyal')) : 'Sosyal'; @endphp
                    <a href="{{ $url }}" target="_blank" rel="noopener" style="font-size:13px;color:rgba(255,255,255,.5);text-decoration:none;transition:color .3s" style-hover="color:#E0A488">{{ ucfirst($name) }}</a>
                @empty
                    <a href="#" style="font-size:13px;color:rgba(255,255,255,.5);text-decoration:none;transition:color .3s" style-hover="color:#E0A488">LinkedIn</a>
                    <a href="#" style="font-size:13px;color:rgba(255,255,255,.5);text-decoration:none;transition:color .3s" style-hover="color:#E0A488">Instagram</a>
                    <a href="#" style="font-size:13px;color:rgba(255,255,255,.5);text-decoration:none;transition:color .3s" style-hover="color:#E0A488">YouTube</a>
                @endforelse
            </div>
        </div>
    </div>
</footer>
