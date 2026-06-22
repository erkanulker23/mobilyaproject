@extends('frontend.layout')

@section('title', ($L === 'tr' ? 'Bayiler' : 'Dealers') . ' — AWA Mobilya')

@section('content')
<div class="page">
    <section class="wrap page-hero">
        <span class="kicker">{{ $L === 'tr' ? 'SATIŞ NOKTALARI' : 'SALES POINTS' }}</span>
        <h1 class="page-hero__title">{{ $L === 'tr' ? 'Bayilerimiz' : 'Our Dealers' }}</h1>
        <p class="page-hero__lead">{{ $L === 'tr' ? 'Türkiye genelindeki yetkili satış noktalarımızdan size en yakınını keşfedin.' : 'Find the nearest authorised sales point across Türkiye.' }}</p>
    </section>
    <section class="section wrap" style="padding-top:24px">
        <div class="dealer-grid">
            @foreach($dealers as $d)
                <article class="dealer-card">
                    <h2 class="dealer-card__city">{{ $d->city }}</h2>
                    @if($d->addr)<p class="dealer-card__addr">{{ $d->addr }}</p>@endif
                    @if($d->tel)<a class="dealer-card__tel" href="tel:{{ preg_replace('/\s+/', '', $d->tel) }}">{{ $d->tel }}</a>@endif
                </article>
            @endforeach
        </div>
    </section>
</div>
@endsection
