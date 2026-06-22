@extends('frontend.layout')

@section('title', ($pick($article->seo_title_tr, $article->seo_title_en) ?: $pick($article->tr, $article->en)) . ' — AWA Mobilya')
@section('description', \Illuminate\Support\Str::limit(strip_tags($pick($article->seo_desc_tr, $article->seo_desc_en) ?: $pick($article->ex_tr, $article->ex_en)), 155))
@if($article->img)@section('og_image', asset($article->img))@endif

@php
    $body = collect(preg_split('/\r?\n/', (string) $pick($article->body_tr, $article->body_en)))->map(fn ($p) => trim($p))->filter();
@endphp

@section('content')
<div class="page">
    <article>
        <section class="wrap page-hero">
            <span class="kicker">{{ $article->date }} · {{ $pick($article->cat_tr, $article->cat_en) }}</span>
            <h1 class="page-hero__title" style="font-size:clamp(34px,5vw,64px)">{{ $pick($article->tr, $article->en) }}</h1>
            @if($pick($article->ex_tr, $article->ex_en))
                <p class="page-hero__lead">{{ $pick($article->ex_tr, $article->ex_en) }}</p>
            @endif
        </section>

        @if($article->img)
            <section class="wrap" style="margin-bottom:48px">
                <img src="{{ asset($article->img) }}" alt="{{ $pick($article->tr, $article->en) }}" style="width:100%;border-radius:var(--radius);aspect-ratio:16/7;object-fit:cover">
            </section>
        @endif

        <section class="wrap" style="padding-bottom:clamp(60px,8vw,110px)">
            <div class="prose">
                @forelse($body as $p)
                    <p>{{ $p }}</p>
                @empty
                    <p>{{ $pick($article->ex_tr, $article->ex_en) }}</p>
                @endforelse
            </div>
        </section>
    </article>

    @if($related->isNotEmpty())
    <section class="section section--white">
        <div class="wrap">
            <header class="section-head"><div><span class="kicker">{{ $L === 'tr' ? 'DİĞER HABERLER' : 'MORE NEWS' }}</span></div></header>
            <div class="grid grid--3">
                @foreach($related as $n)
                    <a href="{{ $route2('article', $n->slug) }}" class="news-card">
                        <span class="news-card__media" style="background-image:url('{{ asset($n->img ?: 'uploads/2.png') }}')"></span>
                        <span class="news-card__meta"><span>{{ $n->date }}</span><span class="news-card__cat">{{ $pick($n->cat_tr, $n->cat_en) }}</span></span>
                        <h3 class="news-card__title">{{ $pick($n->tr, $n->en) }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
