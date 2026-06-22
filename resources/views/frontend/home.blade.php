@extends('frontend.layout')

@section('header_hero', 'site-header--hero')

@section('content')

{{-- HERO --}}
<section class="hero" data-hero aria-label="Öne çıkan koleksiyonlar">
    @foreach($slides as $i => $slide)
        @php($stitle = $pick($slide->title_tr, $slide->title_en))
        @php($ssub = $pick($slide->sub_tr, $slide->sub_en))
        @php($sdesc = $pick($slide->desc_tr, $slide->desc_en))
        <div class="hero__slide {{ $i === 0 ? 'is-active' : '' }}">
            @if($slide->video)
                <video class="hero__media hero__video" autoplay muted loop playsinline @if($slide->img) poster="{{ asset($slide->img) }}" @endif>
                    <source src="{{ asset($slide->video) }}" type="video/mp4">
                </video>
            @else
                <div class="hero__media hero__media--desktop" style="background-image:url('{{ asset($slide->img) }}')"></div>
                <div class="hero__media hero__media--mobile" style="background-image:url('{{ asset($slide->img_mobile ?: $slide->img) }}')"></div>
            @endif
            <div class="hero__overlay"></div>
            <div class="wrap hero__inner">
                @if($ssub)<p class="hero__sub">{{ $ssub }}</p>@endif
                <h1 class="hero__title">{{ $stitle ?: (optional($slide->product)->tr ? $pick($slide->product->tr, $slide->product->en) : $ssub) }}</h1>
                @if($sdesc)<p class="hero__desc">{{ $sdesc }}</p>@endif
                @if($slide->product)
                    <p style="margin-top:28px">
                        <a href="{{ $route2('product', $slide->product->slug) }}" class="btn btn--ghost" style="color:#fff;border-color:rgba(255,255,255,.5)">
                            {{ $L === 'tr' ? 'Keşfet' : 'Discover' }}
                            <svg class="btn__arrow" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg>
                        </a>
                    </p>
                @endif
            </div>
        </div>
    @endforeach
    @if($slides->count() > 1)
        <div class="wrap" style="position:absolute;left:0;right:0;bottom:clamp(20px,4vh,40px);z-index:2">
            <div class="hero__dots">
                @foreach($slides as $i => $slide)
                    <button class="hero__dot {{ $i === 0 ? 'is-active' : '' }}" data-slide="{{ $i }}" aria-label="Slayt {{ $i + 1 }}">{{ sprintf('%02d', $i + 1) }}</button>
                @endforeach
            </div>
        </div>
    @endif
</section>

{{-- KATALOG / KATEGORİLER --}}
@if($show['catalog'])
<section class="section section--light reveal" aria-label="{{ $L === 'tr' ? 'Koleksiyonlar' : 'Collections' }}">
    <div class="wrap">
        <header class="section-head">
            <div>
                <span class="kicker">{{ $L === 'tr' ? 'KOLEKSİYON' : 'COLLECTION' }}</span>
                <h2 class="section-title">{{ $L === 'tr' ? 'Yaşam alanlarınız için' : 'For your living spaces' }}</h2>
            </div>
            <a href="{{ $route2('collection') }}" class="btn btn--ghost">{{ $L === 'tr' ? 'Tümünü Gör' : 'View All' }}
                <svg class="btn__arrow" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg>
            </a>
        </header>
        <div class="grid grid--4">
            @foreach($categories as $cat)
                <a href="{{ $route2('category', $cat->slug) }}" class="cat-card">
                    <span class="cat-card__media" style="background-image:url('{{ asset($cat->img) }}')"></span>
                    <span class="cat-card__cap">
                        <span class="cat-card__title">{{ $pick($cat->tr, $cat->en) }}</span>
                        <span class="cat-card__count">{{ $cat->products_count }} {{ $L === 'tr' ? 'ürün' : 'products' }}</span>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- KOLEKSİYON VİTRİNLERİ --}}
@if($show['collections'])
    @foreach($categories->take(3) as $idx => $cat)
        @php($items = $products->where('category_id', $cat->id)->take(6))
        @if($items->count())
            <section class="section section--tight {{ $idx % 2 === 1 ? 'section--dark' : 'section--white' }} reveal">
                <div class="wrap">
                    <header class="section-head">
                        <div>
                            <span class="kicker">{{ $pick($cat->tr, $cat->en) }}</span>
                            <h2 class="section-title section-title--sm">{{ $L === 'tr' ? 'Seçili ürünler' : 'Selected pieces' }}</h2>
                        </div>
                        <a href="{{ $route2('category', $cat->slug) }}" class="btn btn--ghost" style="{{ $idx % 2 === 1 ? 'color:#cabfae;border-color:#3a352e' : '' }}">{{ $L === 'tr' ? 'Tümünü Gör' : 'View All' }}
                            <svg class="btn__arrow" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg>
                        </a>
                    </header>
                    <div class="scroller">
                        @foreach($items as $p)
                            <a href="{{ $route2('product', $p->slug) }}" class="product-card">
                                <span class="product-card__media" style="background-image:url('{{ asset($p->img) }}')"></span>
                                <span class="product-card__cap">
                                    <span class="product-card__title">{{ $pick($p->tr, $p->en) }}</span>
                                    <span class="product-card__cat">{{ $pick($cat->tr, $cat->en) }}</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach
@endif

{{-- HABERLER --}}
@if($show['news'] && $news->count())
<section class="section section--white reveal" aria-label="{{ $L === 'tr' ? 'Haberler' : 'News' }}">
    <div class="wrap">
        <header class="section-head">
            <div>
                <span class="kicker">{{ $L === 'tr' ? 'GÜNCEL' : 'LATEST' }}</span>
                <h2 class="section-title">{{ $L === 'tr' ? 'Haberler & Etkinlikler' : 'News & Events' }}</h2>
            </div>
            <a href="{{ $route2('news') }}" class="btn btn--ghost">{{ $L === 'tr' ? 'Tümünü Gör' : 'View All' }}
                <svg class="btn__arrow" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg>
            </a>
        </header>
        <div class="grid grid--3">
            @foreach($news as $n)
                <a href="{{ $route2('article', $n->slug) }}" class="news-card">
                    <span class="news-card__media" style="background-image:url('{{ asset($n->img ?: optional($categories->first())->img) }}')"></span>
                    <span class="news-card__meta"><span>{{ $n->date }}</span><span class="news-card__cat">{{ $pick($n->cat_tr, $n->cat_en) }}</span></span>
                    <h3 class="news-card__title">{{ $pick($n->tr, $n->en) }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- MÜŞTERİ YORUMLARI --}}
@if($show['testimonials'] && $testimonials->count())
<section class="section section--light reveal" aria-label="{{ $L === 'tr' ? 'Müşteri yorumları' : 'Testimonials' }}">
    <div class="wrap">
        <header style="margin-bottom:46px">
            <span class="kicker">{{ $L === 'tr' ? 'MÜŞTERİLERİMİZ' : 'TESTIMONIALS' }}</span>
            <h2 class="section-title">{{ $L === 'tr' ? 'Bizimle çalışanlar ne diyor?' : 'What our partners say' }}</h2>
        </header>
        <div class="grid grid--3">
            @foreach($testimonials as $t)
                <figure class="testi-card">
                    <div class="testi-card__stars" aria-label="{{ $t->rating }}/5">{!! str_repeat('★', $t->rating) . str_repeat('☆', 5 - $t->rating) !!}</div>
                    <blockquote class="testi-card__text">{{ $pick($t->comment_tr, $t->comment_en) }}</blockquote>
                    <figcaption class="testi-card__author">
                        <span class="testi-card__avatar" @if($t->img) style="background-image:url('{{ asset($t->img) }}')" @endif>@if(!$t->img){{ mb_substr($t->name, 0, 1) }}@endif</span>
                        <span>
                            <span class="testi-card__name">{{ $t->name }}</span><br>
                            <span class="testi-card__company">{{ $t->company }}</span>
                        </span>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
