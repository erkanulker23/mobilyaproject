@extends('frontend.layout')

@section('title', ($pick($page->seo_title_tr, $page->seo_title_en) ?: $pick($page->t_tr, $page->t_en)) . ' — AWA Mobilya')
@if($pick($page->seo_desc_tr, $page->seo_desc_en))@section('description', strip_tags($pick($page->seo_desc_tr, $page->seo_desc_en)))@endif

@php
    $body = collect(preg_split('/\r?\n/', (string) $pick($page->b_tr, $page->b_en)))->map(fn ($p) => trim($p))->filter();
@endphp

@section('content')
<div class="page">
    <section class="wrap page-hero">
        <h1 class="page-hero__title" style="font-size:clamp(34px,5vw,60px)">{{ $pick($page->t_tr, $page->t_en) }}</h1>
    </section>
    <section class="wrap" style="padding-bottom:clamp(60px,8vw,110px)">
        <div class="prose">
            @foreach($body as $p)
                @if(\Illuminate\Support\Str::endsWith($p, ':') || mb_strlen($p) < 60 && !\Illuminate\Support\Str::contains($p, '.'))
                    <h3>{{ $p }}</h3>
                @else
                    <p>{{ $p }}</p>
                @endif
            @endforeach
        </div>
    </section>
</div>
@endsection
