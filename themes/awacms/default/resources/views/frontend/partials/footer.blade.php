@php
    $phone = kalyon_setting('phone', '+90 212 000 00 00');
    $address = kalyon_setting('address', 'Maslak, Sarıyer, İstanbul, Türkiye');
    $email = kalyon_setting('email', 'info@awamobilya.com');
    $siteName = kalyon_setting('site_name', 'AWA Mobilya');
    $copyright = kalyon_setting('footer_copyright', '© ' . date('Y') . ' ' . $siteName . '. Tüm hakları saklıdır.');
    $social = kalyon_setting('social_media_links', []);
    $brandParts = explode(' ', trim($siteName), 2);
    $brandMain = mb_strtoupper($brandParts[0]);
    $brandSub = mb_strtoupper($brandParts[1] ?? '');
    $brandInitial = mb_strtoupper(mb_substr($siteName, 0, 1));
    $footerDesc = kalyon_setting('footer_description', 'Teknoloji ile el emeğini birleştiren, markalaşmaya önem veren AWA Mobilya; koltuk, köşe, yatak ve yemek odası koleksiyonlarıyla yaşam alanlarınıza değer katar.');

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
            ['label' => 'Anasayfa', 'url' => route('home')],
            ['label' => 'Kurumsal', 'url' => route('page.show', 'hakkimizda')],
            ['label' => 'Ürünler', 'url' => route('projects.index')],
            ['label' => 'Haberler', 'url' => route('blog.index')],
            ['label' => 'İletişim', 'url' => route('contact.index')],
        ];
    }
    $footerChunks = array_chunk($footerLinks, (int) ceil(count($footerLinks) / 2));
@endphp

<footer style="background:#17140F;color:#fff;padding:80px 0 36px">
    <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
        <div class="kal-footer-grid kal-grid-4" style="display:grid;grid-template-columns:1.6fr 1fr 1fr 1.2fr;gap:44px;padding-bottom:50px;border-bottom:1px solid rgba(255,255,255,.1)">
            <div>
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px"><span style="display:inline-flex;width:36px;height:36px;align-items:center;justify-content:center;background:#9C8463;color:#fff;font-family:'Plus Jakarta Sans';font-weight:800;font-size:16px">{{ $brandInitial }}</span><span style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:16px;letter-spacing:2px">{{ $brandMain }} <span style="color:#C9B79C">{{ $brandSub }}</span></span></div>
                <p style="font-size:14px;line-height:1.7;color:rgba(255,255,255,.55);max-width:42ch">{{ $footerDesc }}</p>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#C9B79C;margin-bottom:16px">Kurumsal</div>
                <div style="display:flex;flex-direction:column;gap:11px">
                    @foreach(($footerChunks[0] ?? []) as $fl)
                        <a href="{{ $fl['url'] }}" style="font-size:13.5px;color:rgba(255,255,255,.62);text-decoration:none;transition:color .3s" style-hover="color:#fff">{{ $fl['label'] }}</a>
                    @endforeach
                </div>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#C9B79C;margin-bottom:16px">Hızlı Erişim</div>
                <div style="display:flex;flex-direction:column;gap:11px">
                    @foreach(($footerChunks[1] ?? []) as $fl)
                        <a href="{{ $fl['url'] }}" style="font-size:13.5px;color:rgba(255,255,255,.62);text-decoration:none;transition:color .3s" style-hover="color:#fff">{{ $fl['label'] }}</a>
                    @endforeach
                </div>
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#C9B79C;margin-bottom:16px">İletişim</div>
                <div style="display:flex;flex-direction:column;gap:11px;font-size:13.5px;color:rgba(255,255,255,.62)">
                    <span>{{ $address }}</span>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" style="color:rgba(255,255,255,.62);text-decoration:none;transition:color .3s" style-hover="color:#fff">{{ $phone }}</a>
                    <a href="mailto:{{ $email }}" style="color:rgba(255,255,255,.62);text-decoration:none;transition:color .3s" style-hover="color:#fff">{{ $email }}</a>
                    <a href="{{ route('contact.index') }}" style="color:#C9B79C;text-decoration:none;font-weight:600;transition:color .3s" style-hover="color:#fff">İletişim Sayfası →</a>
                </div>
            </div>
        </div>
        <div style="display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;padding-top:26px">
            <span style="font-size:13px;color:rgba(255,255,255,.4)">{{ $copyright }}</span>
            <div style="display:flex;gap:22px">
                @forelse($social as $item)
                    @php $url = is_array($item) ? ($item['url'] ?? '#') : $item; $name = is_array($item) ? ($item['name'] ?? ($item['platform'] ?? 'Sosyal')) : 'Sosyal'; @endphp
                    <a href="{{ $url }}" target="_blank" rel="noopener" style="font-size:13px;color:rgba(255,255,255,.5);text-decoration:none;transition:color .3s" style-hover="color:#C9B79C">{{ ucfirst($name) }}</a>
                @empty
                    <a href="#" style="font-size:13px;color:rgba(255,255,255,.5);text-decoration:none;transition:color .3s" style-hover="color:#C9B79C">LinkedIn</a>
                    <a href="#" style="font-size:13px;color:rgba(255,255,255,.5);text-decoration:none;transition:color .3s" style-hover="color:#C9B79C">Instagram</a>
                    <a href="#" style="font-size:13px;color:rgba(255,255,255,.5);text-decoration:none;transition:color .3s" style-hover="color:#C9B79C">YouTube</a>
                @endforelse
            </div>
        </div>
    </div>
</footer>
