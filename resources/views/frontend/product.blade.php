@extends('frontend.layout')

@section('title', ($pick($product->seo_title_tr, $product->seo_title_en) ?: $pick($product->tr, $product->en)) . ' — AWA Mobilya')
@section('description', \Illuminate\Support\Str::limit(strip_tags($pick($product->seo_desc_tr, $product->seo_desc_en) ?: $pick($product->desc_tr, $product->desc_en)), 155))
@if($product->img)@section('og_image', asset($product->img))@endif

@php
    $gallery = collect($product->gallery ?: [])->filter()->values();
    if ($gallery->isEmpty()) $gallery = collect([$product->img])->filter()->values();
    $features = collect(preg_split('/\r?\n/', (string) $pick($product->features_tr, $product->features_en)))->map(fn ($f) => trim($f))->filter();
@endphp

@section('content')
<div class="page">
    <section class="section wrap" style="padding-top:clamp(40px,5vw,72px)">
        <nav style="margin-bottom:28px;font-size:13px;color:var(--muted-2)" aria-label="breadcrumb">
            <a href="{{ $route2('home') }}">{{ $L === 'tr' ? 'Ana Sayfa' : 'Home' }}</a> /
            <a href="{{ $route2('category', optional($product->category)->slug) }}">{{ optional($product->category) ? $pick($product->category->tr, $product->category->en) : '' }}</a> /
            <span style="color:var(--ink)">{{ $pick($product->tr, $product->en) }}</span>
        </nav>

        <div class="product-detail">
            <div class="product-gallery" data-gallery>
                <img class="gallery__main" data-gallery-main src="{{ asset($gallery->first()) }}" alt="{{ $pick($product->tr, $product->en) }}">
                @if($gallery->count() > 1)
                    <div class="gallery__thumbs">
                        @foreach($gallery as $i => $img)
                            <button class="gallery__thumb {{ $i === 0 ? 'is-active' : '' }}" data-gallery-thumb
                                    data-img="{{ asset($img) }}"
                                    style="background-image:url('{{ asset($img) }}')" aria-label="Görsel {{ $i + 1 }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="product-info">
                <span class="product-info__cat">{{ optional($product->category) ? $pick($product->category->tr, $product->category->en) : '' }}</span>
                <h1 class="product-info__title">{{ $pick($product->tr, $product->en) }}</h1>
                @if($pick($product->desc_tr, $product->desc_en))
                    <p class="product-info__desc">{{ $pick($product->desc_tr, $product->desc_en) }}</p>
                @endif

                @if($features->isNotEmpty())
                    <ul class="feature-list">
                        @foreach($features as $f)<li>{{ $f }}</li>@endforeach
                    </ul>
                @endif

                <p style="margin-top:32px">
                    <a href="{{ $route2('contact') }}" class="btn btn--solid">{{ $L === 'tr' ? 'Bilgi İste' : 'Request Info' }}
                        <svg class="btn__arrow" viewBox="0 0 22 10" fill="none"><path d="M0 5h20M16 1l5 4-5 4" stroke="currentColor" stroke-width="1.5"/></svg>
                    </a>
                </p>
            </div>
        </div>
    </section>

    @if($related->isNotEmpty())
    <section class="section section--white">
        <div class="wrap">
            <header class="section-head"><div><span class="kicker">{{ $L === 'tr' ? 'BENZER ÜRÜNLER' : 'RELATED' }}</span><h2 class="section-title section-title--sm">{{ $L === 'tr' ? 'Bunları da inceleyin' : 'You may also like' }}</h2></div></header>
            <div class="grid grid--3">
                @foreach($related as $p)
                    <a href="{{ $route2('product', $p->slug) }}" class="product-card">
                        <span class="product-card__media" style="background-image:url('{{ asset($p->img) }}')"></span>
                        <span class="product-card__cap"><span class="product-card__title">{{ $pick($p->tr, $p->en) }}</span></span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
