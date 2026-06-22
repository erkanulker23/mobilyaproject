@extends('frontend.layout')

@section('title', ($L === 'tr' ? 'Kurumsal' : 'Corporate') . ' — AWA Mobilya')

@section('content')
<div class="page">
    <section class="wrap page-hero">
        <span class="kicker">{{ $L === 'tr' ? 'KURUMSAL' : 'CORPORATE' }}</span>
        <h1 class="page-hero__title">{{ $L === 'tr' ? 'AWA Mobilya' : 'About AWA' }}</h1>
        <p class="page-hero__lead">{{ $pick($settings['aboutTr'] ?? '', $settings['aboutEn'] ?? '') }}</p>
    </section>

    <section class="section section--dark">
        <div class="wrap" style="display:flex;gap:clamp(24px,4vw,56px);flex-wrap:wrap">
            @foreach([['35+', $L==='tr'?'Yıllık tecrübe':'Years of experience'], ['40+', $L==='tr'?'İhracat ülkesi':'Export countries'], ['18.000 m²', $L==='tr'?'Üretim tesisi':'Production facility']] as $stat)
                <div>
                    <div data-count="{{ (int) filter_var($stat[0], FILTER_SANITIZE_NUMBER_INT) }}" data-suffix="{{ preg_replace('/[0-9.]/', '', $stat[0]) }}" style="font-family:var(--font-head);font-weight:800;font-size:clamp(38px,4vw,56px);color:#fff">{{ $stat[0] }}</div>
                    <div style="margin-top:6px;font-size:13px;color:#bcae97;max-width:150px">{{ $stat[1] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section wrap">
        <div class="grid grid--3">
            @foreach([
                [$L==='tr'?'Kalite':'Quality', $L==='tr'?'El işçiliği ve teknolojiyi birleştirerek uzun ömürlü ürünler üretiyoruz.':'We combine craftsmanship and technology to produce long-lasting pieces.'],
                [$L==='tr'?'Tasarım':'Design', $L==='tr'?'Zamansız ve fonksiyonel tasarımlarla yaşam alanlarına değer katıyoruz.':'We add value to living spaces with timeless, functional designs.'],
                [$L==='tr'?'Sürdürülebilirlik':'Sustainability', $L==='tr'?'FSC sertifikalı ahşap ve çevre dostu üretim süreçleri benimsiyoruz.':'We adopt FSC-certified wood and eco-friendly production.'],
            ] as $v)
                <article style="background:var(--bg-card);border:1px solid var(--line);border-radius:var(--radius);padding:34px">
                    <h3 style="font-size:21px">{{ $v[0] }}</h3>
                    <p style="margin-top:14px;color:var(--muted);font-size:15px;line-height:1.65">{{ $v[1] }}</p>
                </article>
            @endforeach
        </div>
    </section>
</div>
@endsection
