@extends('frontend.layout')

@section('title', ($L === 'tr' ? 'Sıkça Sorulan Sorular' : 'FAQ') . ' — AWA Mobilya')

@section('content')
<div class="page">
    <section class="wrap page-hero">
        <span class="kicker">{{ $L === 'tr' ? 'YARDIM' : 'HELP' }}</span>
        <h1 class="page-hero__title">{{ $L === 'tr' ? 'Sıkça Sorulan Sorular' : 'Frequently Asked Questions' }}</h1>
    </section>
    <section class="section wrap" style="padding-top:24px;max-width:920px">
        @foreach($faqs as $f)
            <details class="accordion__item">
                <summary class="accordion__q">{{ $pick($f->question_tr, $f->question_en) }}<span class="accordion__icon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 4v12M4 10h12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span></summary>
                <p class="accordion__a">{{ $pick($f->answer_tr, $f->answer_en) }}</p>
            </details>
        @endforeach
    </section>
</div>
@endsection
