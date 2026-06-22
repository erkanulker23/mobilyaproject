@extends('frontend.layout')

@section('title', ($active ? $pick($active->tr, $active->en) : 'Koleksiyon') . ' — AWA Mobilya')

@section('content')
<div class="page">
    <section class="wrap page-hero">
        <span class="kicker">{{ $L === 'tr' ? 'KOLEKSİYON' : 'COLLECTION' }}</span>
        <h1 class="page-hero__title">{{ $active ? $pick($active->tr, $active->en) : ($L === 'tr' ? 'Tüm Koleksiyon' : 'All Collections') }}</h1>
        @if($active && $pick($active->d_tr, $active->d_en))
            <p class="page-hero__lead">{{ $pick($active->d_tr, $active->d_en) }}</p>
        @endif
    </section>

    <section class="wrap" style="padding-bottom:24px">
        <nav class="main-nav" style="flex-wrap:wrap;gap:12px" aria-label="Kategoriler">
            @foreach($categories as $cat)
                <a href="{{ $route2('category', $cat->slug) }}"
                   class="btn {{ $active && $active->id === $cat->id ? 'btn--solid' : 'btn--ghost' }} btn--sm">{{ $pick($cat->tr, $cat->en) }}</a>
            @endforeach
        </nav>
    </section>

    <section class="section wrap" style="padding-top:40px">
        <div class="grid grid--3">
            @foreach($products as $p)
                <a href="{{ $route2('product', $p->slug) }}" class="product-card">
                    <span class="product-card__media" style="background-image:url('{{ asset($p->img) }}')"></span>
                    <span class="product-card__cap">
                        <span class="product-card__title">{{ $pick($p->tr, $p->en) }}</span>
                        <span class="product-card__cat">{{ optional($p->category) ? $pick($p->category->tr, $p->category->en) : '' }}</span>
                    </span>
                </a>
            @endforeach
        </div>
        @if($products->isEmpty())
            <p style="color:var(--muted)">{{ $L === 'tr' ? 'Bu kategoride ürün bulunmuyor.' : 'No products in this category.' }}</p>
        @endif
    </section>
</div>
@endsection
