@php
    // Navigasyon admin → Menüler (/admin/menus) üzerinden yönetilir.
    // 1) GeneralSettings'te seçili "Header Menü" varsa o; 2) yoksa sistemdeki ilk menü; 3) hiç yoksa varsayılan.
    $navLinks = [];
    try {
        $headerMenuId = kalyon_setting('header_menu');
        $menu = null;
        if ($headerMenuId) {
            $menu = \Modules\Menu\Entities\Menu::find($headerMenuId);
        }
        if (! $menu) {
            $menu = \Modules\Menu\Entities\Menu::query()->oldest('id')->first();
        }
        if ($menu) {
            $items = $menu->items()->whereNull('parent_id')->defaultOrder()->get();
            foreach ($items as $item) {
                $navLinks[] = ['label' => $item->name, 'url' => $item->link ?: ($item->url ?: '#'), 'target' => $item->target ?? '_self'];
            }
        }
    } catch (\Throwable $e) {
        $navLinks = [];
    }
    if (empty($navLinks)) {
        $navLinks = [
            ['label' => 'Ana Sayfa', 'url' => route('home'), 'target' => '_self'],
            ['label' => 'Hakkımızda', 'url' => route('page.show', 'hakkimizda'), 'target' => '_self'],
            ['label' => 'Hizmetler', 'url' => route('services.index'), 'target' => '_self'],
            ['label' => 'Projeler', 'url' => route('projects.index'), 'target' => '_self'],
            ['label' => 'Kataloglar', 'url' => route('catalogs.index'), 'target' => '_self'],
            ['label' => 'Haberler', 'url' => route('blog.index'), 'target' => '_self'],
        ];
    }
    $siteName = kalyon_setting('site_name', 'KALYON İNŞAAT');
    $logo = kalyon_setting('header_logo');
@endphp

<header class="kal-header" data-header style="z-index:100">
  <div class="kal-pad kal-header-inner" style="max-width:1340px;margin:0 auto;padding:0 52px;display:flex;align-items:center;justify-content:space-between">
    <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:12px;text-decoration:none">
        @if($logo)
            <img src="{{ \Illuminate\Support\Facades\Storage::url($logo) }}" alt="{{ $siteName }}" style="height:40px;width:auto">
        @else
            <span class="kal-logo-box" style="display:inline-flex;width:42px;height:42px;align-items:center;justify-content:center;border:1.5px solid #fff;font-family:'Plus Jakarta Sans';font-weight:800;font-size:20px">K</span>
            <span class="kal-logo-text" style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:18px;letter-spacing:2px">KALYON <span class="kal-logo-accent">İNŞAAT</span></span>
        @endif
    </a>

    <nav class="kal-desktop-nav" style="display:flex;align-items:center;gap:30px">
        @foreach($navLinks as $link)
            <a class="kal-nav-link" href="{{ $link['url'] }}" style="font-size:16.5px;font-weight:600;text-decoration:none">{{ $link['label'] }}</a>
        @endforeach
        <a href="{{ route('contact.index') }}" style="display:inline-flex;align-items:center;gap:11px;font-size:15px;font-weight:700;color:#fff;background:linear-gradient(135deg,#E08366,#C2603F);padding:13px 14px 13px 26px;border-radius:40px;text-decoration:none;box-shadow:0 8px 22px rgba(217,119,87,.35);transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="transform:translateY(-2px);box-shadow:0 14px 32px rgba(217,119,87,.5)">
            İletişime Geç
            <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,.18);font-size:14px"><i class="fa-solid fa-phone-volume"></i></span>
        </a>
    </nav>

    {{-- mobil burger --}}
    <button class="kal-burger" data-menu-toggle aria-label="Menü" style="display:none;align-items:center;justify-content:center;width:46px;height:46px;background:#2B2926;border:none;cursor:pointer;flex-direction:column;gap:5px;padding:0">
        <span style="display:block;width:20px;height:2px;background:#fff"></span>
        <span style="display:block;width:20px;height:2px;background:#fff"></span>
        <span style="display:block;width:20px;height:2px;background:#fff"></span>
    </button>
  </div>
</header>

{{-- mobil menü — tam ekran overlay --}}
@php
    $mmPhone = kalyon_setting('phone', '+90 212 000 00 00');
    $mmEmail = kalyon_setting('email', 'info@kalyoninsaat.com');
    $mmSocial = kalyon_setting('social_media_links', []);
@endphp
<div data-mobile-menu class="kal-mobile-menu" aria-hidden="true">
    <div class="kal-mm-inner">
        <div class="kal-mm-head">
            <span class="kal-mm-logo"><span class="kal-mm-logo-box">K</span> KALYON <span style="color:#E0A488">İNŞAAT</span></span>
            <button data-menu-toggle class="kal-mm-close" aria-label="Menüyü kapat"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <nav class="kal-mm-nav">
            @foreach($navLinks as $i => $link)
                <a href="{{ $link['url'] }}" class="kal-mm-link" style="--d:{{ $i * 0.05 }}s">
                    <span class="kal-mm-num">0{{ $i + 1 }}</span>
                    <span class="kal-mm-label">{{ $link['label'] }}</span>
                    <span class="kal-mm-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </a>
            @endforeach
        </nav>
        <div class="kal-mm-foot">
            <a href="{{ route('contact.index') }}" class="kal-mm-cta"><i class="fa-solid fa-phone-volume"></i> İletişime Geç</a>
            <div class="kal-mm-contact">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $mmPhone) }}">{{ $mmPhone }}</a>
                <a href="mailto:{{ $mmEmail }}">{{ $mmEmail }}</a>
            </div>
            @if(!empty($mmSocial))
            <div class="kal-mm-social">
                @foreach($mmSocial as $item)
                    @php $u = is_array($item) ? ($item['url'] ?? '#') : $item; $n = is_array($item) ? strtolower($item['name'] ?? 'link') : 'link'; @endphp
                    <a href="{{ $u }}" target="_blank" rel="noopener" aria-label="{{ $n }}"><i class="fa-brands fa-{{ $n }}"></i></a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
