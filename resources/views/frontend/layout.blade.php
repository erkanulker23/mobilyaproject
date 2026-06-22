<!DOCTYPE html>
<html lang="{{ $L }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $pick($settings['seoTitleTr'] ?? 'AWA Mobilya', $settings['seoTitleEn'] ?? 'AWA Mobilya'))</title>
    <meta name="description" content="@yield('description', $pick($settings['seoDescTr'] ?? '', $settings['seoDescEn'] ?? ''))">
    @hasSection('keywords')<meta name="keywords" content="@yield('keywords')">@endif
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="AWA Mobilya">
    <meta property="og:title" content="@yield('title', 'AWA Mobilya')">
    @if(!empty($settings['ogImage']))<meta property="og:image" content="{{ asset($settings['ogImage']) }}">@endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800;900&family=Montserrat:wght@400;500;600;700;800&family=Dancing+Script:wght@500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    @if(!empty($settings['favicon']))<link rel="icon" href="{{ asset($settings['favicon']) }}">@endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(!empty($settings['custom_css']))<style>{!! $settings['custom_css'] !!}</style>@endif
    @stack('head')
</head>
<body>
@php($curr = request()->url())
<header class="site-header @yield('header_hero')" data-header>
    <div class="wrap site-header__bar">
        <a href="{{ $route2('home') }}" class="brand" aria-label="AWA Mobilya">
            @if(!empty($settings['logo']) || !empty($settings['logo_dark']))
                @if(!empty($settings['logo']))<img class="brand__logo brand__logo--light" src="{{ asset($settings['logo']) }}" alt="AWA Mobilya" style="height:34px">@endif
                <img class="brand__logo brand__logo--dark" src="{{ asset($settings['logo_dark'] ?: $settings['logo']) }}" alt="AWA Mobilya" style="height:34px">
            @else
                <span class="brand__name">{{ $settings['brandTr'] ?? 'AWA' }}</span>
                <span class="brand__sub">{{ $settings['brandSub'] ?? 'MOBİLYA' }}</span>
            @endif
        </a>

        <nav class="main-nav" aria-label="Ana menü">
            @foreach($headerMenu as $mi)
                @php($url = $menuUrl($mi))
                @php($label = $pick($mi->label_tr, $mi->label_en))
                @if($mi->type === 'collection')
                    <div class="main-nav__item main-nav__item--drop main-nav__item--mega {{ $curr === $url ? 'is-active' : '' }}">
                        <a href="{{ $url }}" class="main-nav__link">{{ $label }}</a>
                        <div class="mega">
                            <div class="wrap mega__grid">
                                @foreach($megaCategories as $cat)
                                    <div class="mega__col">
                                        <a href="{{ $route2('category', $cat->slug) }}" class="mega__col-head">{{ $pick($cat->tr, $cat->en) }}</a>
                                        <div class="mega__links">
                                            @foreach($cat->products as $p)
                                                <a href="{{ $route2('product', $p->slug) }}" class="mega__link">{{ $pick($p->tr, $p->en) }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <a href="{{ $route2('collection') }}" class="mega__feature" style="background-image:url('{{ asset(optional($megaCategories->first())->img) }}')">
                                    <span class="mega__feature-cap">
                                        <span class="cat-card__title">{{ $L === 'tr' ? 'Koleksiyon' : 'Collection' }}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="main-nav__item {{ $curr === $url ? 'is-active' : '' }}">
                        <a href="{{ $url }}" class="main-nav__link">{{ $label }}</a>
                    </div>
                @endif
            @endforeach
        </nav>

        <div class="header-actions">
            @if(count($locales) > 1)
                <div class="lang-switch is-desktop">
                    @foreach($locales as $i => $lc)
                        @if($i > 0)<span>/</span>@endif
                        <a href="?lang={{ $lc }}" class="{{ $L === $lc ? 'is-active' : '' }}">{{ strtoupper($lc) }}</a>
                    @endforeach
                </div>
            @endif
            <button class="mobile-toggle" data-mobile-toggle aria-label="Menü">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

{{-- Mobil menü --}}
<div class="mobile-menu" data-mobile-menu>
    <div class="mobile-menu__inner">
        <div class="mobile-menu__head">
            <span class="brand"><span class="brand__name" style="color:#fff">AWA</span><span class="brand__sub" style="color:#fff">MOBİLYA</span></span>
            <button class="mobile-menu__close" data-mobile-close aria-label="Kapat">✕</button>
        </div>
        <nav class="mobile-menu__nav" aria-label="Mobil menü">
            @foreach($headerMenu as $i => $mi)
                <a href="{{ $menuUrl($mi) }}" class="mobile-menu__link">
                    <span class="mobile-menu__num">{{ sprintf('%02d', $i + 1) }}</span>
                    <span>{{ $pick($mi->label_tr, $mi->label_en) }}</span>
                </a>
            @endforeach
        </nav>
    </div>
</div>

<main id="main">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="wrap">
        <div class="site-footer__grid">
            <div class="footer-col">
                <span class="brand"><span class="brand__name" style="color:#fff">AWA</span><span class="brand__sub" style="color:#fff">MOBİLYA</span></span>
                <p style="margin-top:18px;max-width:280px;color:#9a8f7e;font-size:14px;line-height:1.7">{{ $pick($settings['addressTr'] ?? '', $settings['addressEn'] ?? '') }}</p>
            </div>
            <div class="footer-col">
                <h4 class="footer-col__title">{{ $L === 'tr' ? 'Koleksiyon' : 'Collection' }}</h4>
                <div class="footer-col__links">
                    @foreach($megaCategories as $cat)
                        <a href="{{ $route2('category', $cat->slug) }}">{{ $pick($cat->tr, $cat->en) }}</a>
                    @endforeach
                </div>
            </div>
            <div class="footer-col">
                <h4 class="footer-col__title">{{ $L === 'tr' ? 'Kurumsal' : 'Corporate' }}</h4>
                <div class="footer-col__links">
                    @foreach($footerMenu as $mi)
                        <a href="{{ $menuUrl($mi) }}">{{ $pick($mi->label_tr, $mi->label_en) }}</a>
                    @endforeach
                </div>
            </div>
            <div class="footer-col">
                <h4 class="footer-col__title">{{ $L === 'tr' ? 'İletişim' : 'Contact' }}</h4>
                <div class="footer-col__links">
                    @if(!empty($settings['phone']))<a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}">{{ $settings['phone'] }}</a>@endif
                    @if(!empty($settings['email']))<a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>@endif
                </div>
                <form method="POST" action="{{ url('/subscribe') }}" style="margin-top:20px;display:flex;gap:8px" data-subscribe>
                    @csrf
                    <input type="email" name="email" class="field" placeholder="{{ $L === 'tr' ? 'E-posta adresiniz' : 'Your e-mail' }}" required style="background:rgba(255,255,255,.06);border-color:#34302a;color:#fff">
                    <button class="btn btn--solid btn--sm" type="submit" style="background:{{ $settings['accent'] ?? '#9c8463' }};color:#1a1610">→</button>
                </form>
            </div>
        </div>
        <div class="site-footer__bottom">
            <span>© {{ date('Y') }} AWA Mobilya. {{ $L === 'tr' ? 'Tüm hakları saklıdır.' : 'All rights reserved.' }}</span>
        </div>
    </div>
</footer>

<script src="{{ asset('js/site.js') }}"></script>
@if(!empty($settings['custom_js']))<script>{!! $settings['custom_js'] !!}</script>@endif
@stack('scripts')
</body>
</html>
