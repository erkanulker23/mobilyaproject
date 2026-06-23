@extends('frontend.layouts.app')

@section('content')
<div style="font-family:'Manrope',system-ui,sans-serif;color:#1F1C18;background:#fff">
    @include('frontend.partials.page-hero', [
        'eyebrow' => 'Hizmetlerimiz',
        'title' => 'Fikirden anahtar teslime',
        'subtitle' => 'Projenin her aşamasında — tasarımdan mühendisliğe, inşaattan satış sonrası desteğe — uçtan uca çözüm ortağınız oluyoruz.',
        'breadcrumbs' => ['Hizmetler' => null],
        'bg' => $heroImage ?? null,
    ])

    {{-- ARAMA --}}
    <section class="kal-section" style="background:#F4EFE7;padding:34px 0;border-bottom:1px solid #E6E0D4">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <form method="GET" action="{{ url()->current() }}" style="display:flex;gap:12px;align-items:center;max-width:560px;margin:0 auto;flex-wrap:wrap">
                <div style="flex:1;min-width:240px;display:flex;align-items:center;gap:12px;background:#fff;border:1px solid #E6E0D4;border-radius:30px;padding:6px 8px 6px 22px">
                    <input type="text" name="query" value="{{ request()->input('query') }}" placeholder="Hizmetlerde ara..." aria-label="Hizmetlerde ara" style="flex:1;border:none;outline:none;background:transparent;font-family:'Manrope',sans-serif;font-size:15px;color:#1F1C18;padding:10px 0">
                    <button type="submit" aria-label="Ara" style="display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border:none;border-radius:50%;background:#D97757;color:#fff;cursor:pointer;transition:all .3s" style-hover="background:#C2603F">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 21L16.514 16.506M19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
                @if(request()->input('query'))
                    <a href="{{ url()->current() }}" style="font-size:13.5px;font-weight:700;color:#D97757;text-decoration:none;white-space:nowrap">Temizle</a>
                @endif
            </form>
        </div>
    </section>

    {{-- HİZMET KALEMLERİ --}}
    <section class="kal-section" style="background:#fff;padding:90px 0 110px">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            @if(request()->input('query'))
                <p style="margin-bottom:34px;font-size:15px;color:#6A6358"><strong style="color:#2B2926">"{{ request()->input('query') }}"</strong> için sonuçlar</p>
            @endif

            <div class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
                @forelse($services as $i => $service)
                    <article data-reveal data-rd="{{ ($i % 3) * 0.08 }}" itemscope itemtype="https://schema.org/Service" style="opacity:0;display:flex;flex-direction:column;background:#fff;border:1px solid #E6E0D4;border-radius:14px;overflow:hidden;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s,border-color .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.1);border-color:#D97757">
                        <a href="{{ route('services.show', $service->slug) }}" aria-label="{{ $service->title }}" style="position:relative;display:block;aspect-ratio:16/10;overflow:hidden;background:#0c1018">
                            @if($service->listingImage)
                                <picture>
                                    <source media="(max-width:768px)" srcset="{{ $service->listingImageMobile ?: $service->listingImage }}">
                                    <img src="{{ $service->listingImage }}" alt="{{ $service->title }} görseli" itemprop="image" loading="lazy" style="width:100%;height:100%;object-fit:cover;transition:transform .8s cubic-bezier(.16,1,.3,1)" style-hover="transform:scale(1.06)">
                                </picture>
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#3B342D,#2B2926);color:#E0A488;font-family:'Plus Jakarta Sans';font-weight:800;font-size:42px">{{ mb_substr($service->title, 0, 1) }}</div>
                            @endif
                            <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 55%,rgba(5,12,22,.32))"></div>
                        </a>
                        <div style="display:flex;flex-direction:column;flex:1;padding:28px 26px">
                            <h2 itemprop="name" style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:21px;line-height:1.2;color:#2B2926">
                                <a href="{{ route('services.show', $service->slug) }}" style="color:#2B2926;text-decoration:none">{{ $service->title }}</a>
                            </h2>
                            @if($service->shortDescription)
                                <p itemprop="description" style="margin-top:12px;font-size:14.5px;line-height:1.72;color:#6A6358;flex:1">{{ Str::words(strip_tags($service->shortDescription), 18, '...') }}</p>
                            @else
                                <div style="flex:1"></div>
                            @endif
                            <a href="{{ route('services.show', $service->slug) }}" style="margin-top:22px;display:inline-flex;align-items:center;gap:9px;font-size:13.5px;font-weight:700;color:#D97757;text-decoration:none" style-hover="color:#C2603F">
                                Detaylı Bilgi
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div style="grid-column:1/-1;text-align:center;padding:70px 0">
                        <h3 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:26px;color:#2B2926">Yakında</h3>
                        <p style="margin-top:12px;font-size:15px;color:#6A6358">{{ request()->input('query') ? 'Aramanıza uygun bir hizmet bulunamadı.' : 'Hizmetlerimiz çok yakında burada listelenecek.' }}</p>
                    </div>
                @endforelse
            </div>

            @if($paginatedServices->hasPages())
                <div style="margin-top:56px;display:flex;justify-content:center">
                    {{ $paginatedServices->links('frontend.components.pagination') }}
                </div>
            @endif
        </div>
    </section>

    {{-- SÜREÇ --}}
    <section class="kal-section" style="background:#F4EFE7;padding:110px 0">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div data-reveal style="opacity:0;text-align:center;margin-bottom:60px">
                <div style="display:inline-flex;align-items:center;gap:13px;margin-bottom:20px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">Nasıl Çalışıyoruz</span><span style="width:34px;height:1px;background:#D97757"></span></div>
                <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(30px,3.2vw,50px);line-height:1.06;letter-spacing:-.02em;color:#2B2926">Dört adımda projeniz</h2>
            </div>
            <div class="kal-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:22px">
                @php
                    $steps = [
                        ['01', 'Keşif & Analiz', 'İhtiyaç, bütçe ve arazi analizi ile projenin temelini atıyoruz.'],
                        ['02', 'Tasarım', 'Mimari ve mühendislik ekiplerimiz uygulanabilir, estetik çözümler üretir.'],
                        ['03', 'İnşaat', 'Şeffaf raporlama ve kalite kontrolüyle anahtar teslim üretim.'],
                        ['04', 'Teslim & Destek', 'Zamanında teslim ve satış sonrası kesintisiz destek.'],
                    ];
                @endphp
                @foreach($steps as $i => $step)
                    <div data-reveal data-rd="{{ $i * 0.06 }}" style="opacity:0">
                        <div style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:60px;color:#DAD2C2;line-height:1">{{ $step[0] }}</div>
                        <h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:19px;color:#2B2926;margin-top:8px">{{ $step[1] }}</h3>
                        <p style="margin-top:10px;font-size:14.5px;line-height:1.68;color:#6A6358">{{ $step[2] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="kal-section" style="background:#fff;padding:120px 0">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div style="background:linear-gradient(135deg,#2B2926,#3B342D);padding:72px 56px;border-radius:18px;text-align:center;position:relative;overflow:hidden">
                <div style="position:absolute;top:-30%;right:-6%;width:380px;height:380px;background:radial-gradient(circle,rgba(217,119,87,.35),transparent 65%);pointer-events:none"></div>
                <h2 style="position:relative;font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(28px,3vw,46px);line-height:1.08;letter-spacing:-.02em;color:#fff;max-width:22ch;margin:0 auto">Projeniz için ücretsiz danışmanlık alın</h2>
                <div style="position:relative;display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:32px">
                    <a href="{{ route('contact.index') }}" style="display:inline-flex;align-items:center;gap:12px;background:#D97757;color:#fff;font-weight:700;font-size:14px;letter-spacing:.4px;padding:18px 34px;text-decoration:none;transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="background:#fff;color:#2B2926;transform:translateY(-3px)">İletişime Geçin →</a>
                    <a href="{{ route('projects.index') }}" style="display:inline-flex;align-items:center;gap:12px;background:transparent;color:#fff;font-weight:700;font-size:14px;letter-spacing:.4px;padding:18px 34px;text-decoration:none;border:1px solid rgba(255,255,255,.3);transition:all .35s" style-hover="border-color:#fff;transform:translateY(-3px)">Projelerimiz</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
