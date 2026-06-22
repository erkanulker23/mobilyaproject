@extends('frontend.layout')

@section('title', ($pick($settings['seoTitleTr'] ?? '', $settings['seoTitleEn'] ?? '') ?: ($L === 'tr' ? 'Kurumsal' : 'Corporate')) . ' — AWA Mobilya')

@php
    $stats = json_decode($settings['corp_stats'] ?? '[]', true) ?: [];
    $values = json_decode($settings['corp_values'] ?? '[]', true) ?: [];
@endphp

@section('content')
<div class="page">
    <section class="wrap page-hero">
        <span class="kicker">{{ $L === 'tr' ? 'KURUMSAL' : 'CORPORATE' }}</span>
        <h1 class="page-hero__title">{{ $L === 'tr' ? 'AWA Mobilya' : 'About AWA' }}</h1>
        <p class="page-hero__lead">{{ $pick($settings['aboutTr'] ?? '', $settings['aboutEn'] ?? '') }}</p>
    </section>

    @if(count($stats))
    <section class="section section--dark">
        <div class="wrap" style="display:flex;gap:clamp(24px,4vw,56px);flex-wrap:wrap">
            @foreach($stats as $stat)
                <div>
                    <div data-count="{{ (int) filter_var($stat['value'] ?? '0', FILTER_SANITIZE_NUMBER_INT) }}" data-suffix="{{ preg_replace('/[0-9.]/', '', $stat['value'] ?? '') }}" style="font-family:var(--font-head);font-weight:800;font-size:clamp(38px,4vw,56px);color:#fff">{{ $stat['value'] ?? '' }}</div>
                    <div style="margin-top:6px;font-size:13px;color:#bcae97;max-width:160px">{{ $pick($stat['label_tr'] ?? '', $stat['label_en'] ?? '') }}</div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    @if(count($values))
    <section class="section wrap">
        <div class="grid grid--3">
            @foreach($values as $v)
                <article style="background:var(--bg-card);border:1px solid var(--line);border-radius:var(--radius);padding:34px">
                    <h3 style="font-size:21px">{{ $pick($v['title_tr'] ?? '', $v['title_en'] ?? '') }}</h3>
                    <p style="margin-top:14px;color:var(--muted);font-size:15px;line-height:1.65">{{ $pick($v['desc_tr'] ?? '', $v['desc_en'] ?? '') }}</p>
                </article>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
