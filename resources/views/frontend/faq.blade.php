@extends('frontend.layout')

@section('title', ($L === 'tr' ? 'Sıkça Sorulan Sorular' : 'FAQ') . ' — AWA Mobilya')

@php
    $faqs = $L === 'tr' ? [
        ['Online satış yapıyor musunuz?', 'Hayır. AWA Mobilya kurumsal bir üreticidir ve ürünlerini yetkili bayileri aracılığıyla sunar. Web sitemiz bir vitrin ve katalog platformudur.'],
        ['Kumaş ve renk seçeneği var mı?', 'Evet. Her model için geniş bir kumaş ve renk yelpazesi mevcuttur; detaylar için bayilerimizle iletişime geçebilirsiniz.'],
        ['Teslimat süresi ne kadar?', 'Üretim ve teslimat süreleri sipariş onayını takiben bayiniz tarafından bildirilir.'],
        ['Garanti veriyor musunuz?', 'Tüm ürünlerimiz 2 yıl üretici garantisi kapsamındadır.'],
    ] : [
        ['Do you sell online?', 'No. AWA Mobilya is a contract manufacturer and offers its products through authorised dealers. Our website is a showcase and catalog platform.'],
        ['Are there fabric and colour options?', 'Yes. A wide range of fabrics and colours is available for each model; contact our dealers for details.'],
        ['What is the delivery time?', 'Production and delivery times are communicated by your dealer after order confirmation.'],
        ['Do you offer a warranty?', 'All our products come with a 2-year manufacturer warranty.'],
    ];
@endphp

@section('content')
<div class="page">
    <section class="wrap page-hero">
        <span class="kicker">{{ $L === 'tr' ? 'YARDIM' : 'HELP' }}</span>
        <h1 class="page-hero__title">{{ $L === 'tr' ? 'Sıkça Sorulan Sorular' : 'Frequently Asked Questions' }}</h1>
    </section>
    <section class="section wrap" style="padding-top:24px;max-width:920px">
        @foreach($faqs as $f)
            <details class="accordion__item">
                <summary class="accordion__q">{{ $f[0] }}<span class="accordion__icon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 4v12M4 10h12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span></summary>
                <p class="accordion__a">{{ $f[1] }}</p>
            </details>
        @endforeach
    </section>
</div>
@endsection
