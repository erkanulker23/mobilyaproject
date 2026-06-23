@extends('frontend.layouts.app')

@php
    $heroImg = $servicePost->detailHero ?: ($servicePost->detailImage ?: $servicePost->listingImage);
    $categoryName = $servicePost->categories?->first()?->name ?? null;
@endphp

@push('metas')
    <meta name="description" content="{{ $servicePost->seoDescription ?? Str::limit(strip_tags($servicePost->shortDescription ?? $servicePost->content), 155) }}">
    <link rel="canonical" href="{{ $servicePost->url }}">
    <meta property="og:title" content="{{ $servicePost->title }}">
    <meta property="og:description" content="{{ $servicePost->seoDescription ?? Str::limit(strip_tags($servicePost->shortDescription ?? $servicePost->content), 155) }}">
    <meta property="og:image" content="{{ $heroImg }}">
    <meta property="og:url" content="{{ $servicePost->url }}">
    <meta property="og:type" content="article">
@endpush

@section('content')
<div style="font-family:'Manrope',system-ui,sans-serif;color:#1F1C18;background:#fff">

    {{-- HERO --}}
    <section style="position:relative;background:#2B2926;min-height:54vh;display:flex;align-items:flex-end;overflow:hidden">
        @if($heroImg)
            <div style="position:absolute;inset:0"><img src="{{ $heroImg }}" alt="{{ $servicePost->title }}" style="width:100%;height:100%;object-fit:cover;opacity:.5"></div>
        @endif
        <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(28,26,23,.45),rgba(28,26,23,.93))"></div>
        <div class="kal-pad" style="position:relative;max-width:1340px;margin:0 auto;padding:0 52px 64px;width:100%">
            <div style="display:flex;align-items:center;gap:9px;flex-wrap:wrap;margin-bottom:20px;font-size:12.5px;color:rgba(255,255,255,.6)">
                <a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);text-decoration:none" style-hover="color:#E0A488">Ana Sayfa</a><span style="opacity:.5">/</span>
                <a href="{{ route('services.index') }}" style="color:rgba(255,255,255,.6);text-decoration:none" style-hover="color:#E0A488">Hizmetler</a><span style="opacity:.5">/</span>
                <span style="color:#E0A488">{{ $servicePost->title }}</span>
            </div>
            @if($categoryName)
                <div style="display:flex;align-items:center;gap:13px;margin-bottom:16px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#EAC1AC">{{ $categoryName }}</span></div>
            @endif
            <h1 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(34px,4.6vw,68px);line-height:1.04;letter-spacing:-.02em;color:#fff;max-width:20ch">{{ $servicePost->title }}</h1>
            @if($servicePost->shortDescription)
                <p style="margin-top:18px;max-width:60ch;font-size:16.5px;line-height:1.7;color:rgba(255,255,255,.75)">{{ Str::words(strip_tags($servicePost->shortDescription), 30, '...') }}</p>
            @endif
        </div>
    </section>

    {{-- İÇERİK + SIDEBAR --}}
    <section class="kal-section" style="background:#fff;padding:100px 0">
        <div class="kal-pad kal-split" style="max-width:1340px;margin:0 auto;padding:0 52px;display:grid;grid-template-columns:1.5fr .7fr;gap:60px;align-items:start">
            <main>
                <div class="kal-richtext" itemprop="articleBody" style="font-size:16.5px;line-height:1.85;color:#5A5349">
                    {!! $servicePost->content ?: '<p>Bu hizmet hakkında detaylı bilgi çok yakında eklenecektir.</p>' !!}
                </div>

                @if($servicePost->jotformId)
                    <div id="jotform-container-{{ $servicePost->jotformId }}" style="margin-top:40px"></div>
                @endif
            </main>

            <aside style="display:flex;flex-direction:column;gap:24px;position:sticky;top:100px">
                {{-- İletişim kartı --}}
                <div style="background:linear-gradient(135deg,#2B2926,#3B342D);border-radius:16px;padding:32px 30px;color:#fff;position:relative;overflow:hidden">
                    <div style="position:absolute;top:-40%;right:-20%;width:220px;height:220px;background:radial-gradient(circle,rgba(217,119,87,.4),transparent 65%);pointer-events:none"></div>
                    <div style="position:relative">
                        <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#E0A488">Yardıma mı ihtiyacınız var?</div>
                        <h3 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:22px;margin-top:12px;line-height:1.2">Bu hizmet hakkında bilgi alın</h3>
                        <p style="margin-top:12px;font-size:14px;line-height:1.65;color:rgba(255,255,255,.65)">Uzman ekibimiz projeniz için ücretsiz danışmanlık sunar.</p>
                        <a href="{{ route('contact.index') }}" style="margin-top:22px;display:flex;align-items:center;justify-content:center;gap:10px;background:#D97757;color:#fff;font-weight:700;font-size:14px;padding:15px;text-decoration:none;border-radius:8px;transition:all .3s" style-hover="background:#C2603F">İletişime Geçin →</a>
                    </div>
                </div>

                {{-- İlgili hizmetler --}}
                @if($relevantServices->count())
                    <div style="background:#F4EFE7;border:1px solid #E6E0D4;border-radius:16px;padding:28px 26px">
                        <div style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:17px;color:#2B2926;margin-bottom:18px">{{ $categoryName ?? 'Diğer Hizmetler' }}</div>
                        <div style="display:flex;flex-direction:column">
                            @foreach($relevantServices as $rs)
                                <a href="{{ route('services.show', $rs->slug) }}" style="display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px 0;border-bottom:1px solid #E6E0D4;font-size:14.5px;font-weight:600;color:#2B2926;text-decoration:none;transition:color .3s" style-hover="color:#D97757">
                                    <span>{{ $rs->title }}</span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink:0"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Diğer kategoriler --}}
                @if(isset($otherServiceCategories) && $otherServiceCategories->count())
                    <div style="background:#fff;border:1px solid #E6E0D4;border-radius:16px;padding:28px 26px">
                        <div style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:17px;color:#2B2926;margin-bottom:16px">Diğer Kategoriler</div>
                        <div style="display:flex;flex-wrap:wrap;gap:9px">
                            @foreach($otherServiceCategories as $cat)
                                <a href="{{ $cat->url ?? route('services.index') }}" style="font-size:13px;font-weight:600;color:#2B2926;background:#F4EFE7;border:1px solid #E6E0D4;padding:9px 16px;border-radius:30px;text-decoration:none;transition:all .3s" style-hover="background:#D97757;color:#fff;border-color:#D97757">{{ $cat->name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </section>

    {{-- İLGİLİ HİZMET KARTLARI --}}
    @if($relevantServices->count())
        <section class="kal-section" style="background:#F4EFE7;padding:100px 0">
            <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
                <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:36px;gap:20px;flex-wrap:wrap">
                    <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(26px,2.8vw,42px);color:#2B2926">İlgili Hizmetler</h2>
                    <a href="{{ route('services.index') }}" style="font-size:13.5px;font-weight:700;color:#D97757;text-decoration:none;border-bottom:2px solid #D97757;padding-bottom:5px">Tümünü Gör →</a>
                </div>
                <div class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
                    @foreach($relevantServices->take(3) as $rs)
                        <article style="position:relative;display:flex;flex-direction:column;background:#fff;border:1px solid #E6E0D4;border-radius:14px;overflow:hidden;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s,border-color .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.1);border-color:#D97757">
                            <a href="{{ route('services.show', $rs->slug) }}" aria-label="{{ $rs->title }}" style="position:relative;display:block;aspect-ratio:16/10;overflow:hidden;background:#0c1018">
                                @if($rs->listingImage)
                                    <img src="{{ $rs->listingImage }}" alt="{{ $rs->title }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;transition:transform .8s cubic-bezier(.16,1,.3,1)" style-hover="transform:scale(1.06)">
                                @else
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#3B342D,#2B2926);color:#E0A488;font-family:'Plus Jakarta Sans';font-weight:800;font-size:40px">{{ mb_substr($rs->title, 0, 1) }}</div>
                                @endif
                            </a>
                            <div style="display:flex;flex-direction:column;flex:1;padding:24px">
                                <h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:19px;color:#2B2926"><a href="{{ route('services.show', $rs->slug) }}" style="color:#2B2926;text-decoration:none">{{ $rs->title }}</a></h3>
                                @if($rs->shortDescription)
                                    <p style="margin-top:10px;font-size:14px;line-height:1.65;color:#6A6358;flex:1">{{ Str::words(strip_tags($rs->shortDescription), 14, '...') }}</p>
                                @endif
                                <a href="{{ route('services.show', $rs->slug) }}" style="margin-top:18px;display:inline-flex;align-items:center;gap:8px;font-size:13px;font-weight:700;color:#D97757;text-decoration:none" style-hover="color:#C2603F">Detaylı Bilgi →</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
@endsection

@push('scripts')
    {!! $servicePostingScript ?? '' !!}

    @if($servicePost->jotformId)
    <script>
    (function() {
        function loadJotformScript() {
            const container = document.getElementById('jotform-container-{{ $servicePost->jotformId }}');
            if (!container) return;
            const script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://form.jotform.com/jsform/{{ $servicePost->jotformId }}';
            script.async = true;
            script.onerror = function() {};
            document.body.appendChild(script);
        }
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', loadJotformScript);
        } else {
            loadJotformScript();
        }
    })();
    </script>
    @endif
@endpush
