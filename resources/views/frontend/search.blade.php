@extends('frontend.layout')

@section('title', ($L === 'tr' ? 'Arama' : 'Search') . ' — AWA Mobilya')

@section('content')
<div class="page">
    <section class="wrap page-hero">
        <span class="kicker">{{ $L === 'tr' ? 'ARAMA' : 'SEARCH' }}</span>
        <h1 class="page-hero__title">{{ $L === 'tr' ? 'Ürün ara' : 'Search products' }}</h1>
        <form method="GET" action="{{ url('/arama') }}" style="margin-top:24px;max-width:560px;display:flex;gap:10px">
            <input class="field" type="search" name="q" value="{{ $q }}" placeholder="{{ $L === 'tr' ? 'Ürün adı...' : 'Product name...' }}" autofocus>
            <button class="btn btn--solid" type="submit">{{ $L === 'tr' ? 'Ara' : 'Search' }}</button>
        </form>
    </section>

    <section class="section wrap" style="padding-top:24px">
        @if($q === '')
            <p style="color:var(--muted)">{{ $L === 'tr' ? 'Aramak istediğiniz ürünü yazın.' : 'Type a product to search.' }}</p>
        @elseif($results->isEmpty())
            <p style="color:var(--muted)">{{ $L === 'tr' ? 'Sonuç bulunamadı.' : 'No results found.' }} — "{{ $q }}"</p>
        @else
            <p style="color:var(--muted);margin-bottom:28px">{{ $results->count() }} {{ $L === 'tr' ? 'sonuç' : 'results' }} — "{{ $q }}"</p>
            <div class="grid grid--3">
                @foreach($results as $p)
                    <a href="{{ $route2('product', $p->slug) }}" class="product-card">
                        <span class="product-card__media" style="background-image:url('{{ asset($p->img) }}')"></span>
                        <span class="product-card__cap">
                            <span class="product-card__title">{{ $pick($p->tr, $p->en) }}</span>
                            <span class="product-card__cat">{{ optional($p->category) ? $pick($p->category->tr, $p->category->en) : '' }}</span>
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
