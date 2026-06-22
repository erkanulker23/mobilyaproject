@extends('frontend.layout')

@section('title', ($L === 'tr' ? 'Haberler' : 'News') . ' — AWA Mobilya')

@section('content')
<div class="page">
    <section class="wrap page-hero">
        <span class="kicker">{{ $L === 'tr' ? 'GÜNCEL' : 'LATEST' }}</span>
        <h1 class="page-hero__title">{{ $L === 'tr' ? 'Haberler & Etkinlikler' : 'News & Events' }}</h1>
    </section>
    <section class="section wrap" style="padding-top:24px">
        <div class="grid grid--3">
            @foreach($news as $n)
                <a href="{{ $route2('article', $n->slug) }}" class="news-card">
                    <span class="news-card__media" style="background-image:url('{{ asset($n->img ?: 'uploads/3.png') }}')"></span>
                    <span class="news-card__meta"><span>{{ $n->date }}</span><span class="news-card__cat">{{ $pick($n->cat_tr, $n->cat_en) }}</span></span>
                    <h2 class="news-card__title">{{ $pick($n->tr, $n->en) }}</h2>
                    <p style="margin-top:10px;color:var(--muted);font-size:15px;line-height:1.6">{{ \Illuminate\Support\Str::limit($pick($n->ex_tr, $n->ex_en), 110) }}</p>
                </a>
            @endforeach
        </div>
    </section>
</div>
@endsection
