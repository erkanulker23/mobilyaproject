@extends('frontend.layouts.app')

@php
    $gallery = $project->gallery_urls;
    $kunye = collect($project->specs ?? [])->filter(fn($s) => !empty($s['label']) || !empty($s['value']));
    // temel künye satırları
    $baseInfo = array_filter([
        'Konum' => $project->location,
        'Kategori' => $project->category_label,
        'Durum' => $project->status_label,
        'İşveren' => $project->client,
        'Alan' => $project->area,
        'Yıl' => $project->year,
    ]);
@endphp

@section('content')
<div style="font-family:'Manrope',system-ui,sans-serif;color:#1F1C18;background:#fff">

    {{-- HERO --}}
    <section style="position:relative;background:#2B2926;min-height:82vh;display:flex;align-items:flex-end;overflow:hidden">
        <div style="position:absolute;inset:0"><img src="{{ $project->cover_url }}" alt="{{ $project->title }}" style="width:100%;height:100%;object-fit:cover;opacity:.65"></div>
        <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(28,26,23,.25) 0%,rgba(28,26,23,.35) 45%,rgba(28,26,23,.92) 100%)"></div>
        <div class="kal-pad" style="position:relative;max-width:1340px;margin:0 auto;padding:0 52px 64px;width:100%">
            <div style="display:flex;align-items:center;gap:9px;flex-wrap:wrap;margin-bottom:20px;font-size:12.5px;color:rgba(255,255,255,.6)">
                <a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);text-decoration:none">Ana Sayfa</a><span style="opacity:.5">/</span>
                <a href="{{ route('projects.index') }}" style="color:rgba(255,255,255,.6);text-decoration:none">Projeler</a><span style="opacity:.5">/</span>
                <span style="color:#E0A488">{{ $project->title }}</span>
            </div>
            <div style="display:flex;gap:8px;margin-bottom:16px">
                <span style="font-size:10px;font-weight:700;letter-spacing:.6px;text-transform:uppercase;color:#fff;background:{{ $project->status_color }};padding:7px 13px;border-radius:20px">{{ $project->status_label }}</span>
                @if($project->is_sale)<span style="font-size:10px;font-weight:700;letter-spacing:.6px;text-transform:uppercase;color:#fff;background:#D63A3A;padding:7px 13px;border-radius:20px">Satışta</span>@endif
            </div>
            <h1 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(34px,4.6vw,68px);line-height:1.03;letter-spacing:-.02em;color:#fff;max-width:18ch">{{ $project->title }}</h1>
            @if($project->location)<p style="margin-top:14px;font-size:16px;color:rgba(255,255,255,.75)">📍 {{ $project->location }}</p>@endif
        </div>
    </section>

    {{-- KÜNYE ŞERİDİ --}}
    <section style="background:#1C1A17;color:#fff">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:1px;background:rgba(255,255,255,.08)">
                @foreach($baseInfo as $label => $value)
                    <div style="background:#1C1A17;padding:26px 24px">
                        <div style="font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#E0A488">{{ $label }}</div>
                        <div style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:18px;color:#fff;margin-top:8px">{{ $value }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- AÇIKLAMA + ÖZELLİKLER --}}
    <section class="kal-section" style="background:#fff;padding:110px 0">
        <div class="kal-pad kal-split" style="max-width:1340px;margin:0 auto;padding:0 52px;display:grid;grid-template-columns:1.4fr .8fr;gap:64px;align-items:start">
            <div>
                <div style="display:flex;align-items:center;gap:13px;margin-bottom:22px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">Proje Hakkında</span></div>
                @if($project->short_description)
                    <p style="font-size:19px;line-height:1.7;color:#2B2926;font-weight:500;margin-bottom:22px">{{ $project->short_description }}</p>
                @endif
                <div class="kal-richtext" style="font-size:16px;line-height:1.85;color:#5A5349">
                    {!! $project->content ?: '<p>Bu proje hakkında detaylı bilgi yakında eklenecektir.</p>' !!}
                </div>
            </div>
            @if($kunye->count())
            <aside style="background:#F4EFE7;border:1px solid #E6E0D4;padding:32px 30px;border-radius:14px;position:sticky;top:100px">
                <div style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:18px;color:#2B2926;margin-bottom:20px">Teknik Künye</div>
                <div style="display:flex;flex-direction:column;gap:14px">
                    @foreach($kunye as $spec)
                        <div style="display:flex;justify-content:space-between;gap:16px;padding-bottom:14px;border-bottom:1px solid #E6E0D4">
                            <span style="font-size:13.5px;color:#8B8273">{{ $spec['label'] ?? '' }}</span>
                            <span style="font-size:13.5px;font-weight:700;color:#2B2926;text-align:right">{{ $spec['value'] ?? '' }}</span>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('contact.index') }}" style="margin-top:24px;display:flex;align-items:center;justify-content:center;gap:10px;background:#D97757;color:#fff;font-weight:700;font-size:14px;padding:15px;text-decoration:none;transition:all .3s" style-hover="background:#C2603F">Bilgi Alın →</a>
            </aside>
            @endif
        </div>
    </section>

    {{-- PROJE AVANTAJLARI --}}
    <section class="kal-section" style="background:#fff;padding:0 0 110px">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div class="kal-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px">
                @foreach([
                    ['fa-location-dot', 'Merkezi Konum', 'Ulaşım, eğitim ve sosyal donatılara yakın ayrıcalıklı lokasyon.'],
                    ['fa-shield-halved', 'Deprem Güvenli', 'Güncel yönetmeliğe uygun, denetimli ve dayanıklı yapı sistemi.'],
                    ['fa-leaf', 'Sürdürülebilir', 'Enerji verimli, düşük karbonlu ve çevre dostu üretim anlayışı.'],
                    ['fa-key', 'Zamanında Teslim', 'Şeffaf süreç yönetimiyle taahhüt edilen tarihte anahtar teslim.'],
                ] as $i => $adv)
                    <div data-reveal data-rd="{{ $i * 0.06 }}" style="opacity:0;background:#fff;border:1px solid #E6E0D4;border-radius:14px;padding:30px 26px;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s,border-color .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.1);border-color:#D97757">
                        <div style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;background:#2B2926;color:#D97757;font-size:20px;border-radius:11px;margin-bottom:22px"><i class="fa-solid {{ $adv[0] }}"></i></div>
                        <h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:18px;color:#2B2926">{{ $adv[1] }}</h3>
                        <p style="margin-top:10px;font-size:14px;line-height:1.65;color:#6A6358">{{ $adv[2] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- GALERİ --}}
    @if(count($gallery))
    <section class="kal-section" style="background:#F4EFE7;padding:100px 0">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div data-reveal style="opacity:0;display:flex;align-items:center;gap:13px;margin-bottom:14px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">Proje Galerisi</span></div>
            <h2 data-reveal style="opacity:0;font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(28px,3vw,44px);color:#2B2926;margin-bottom:40px">Görsellere göz atın</h2>
            <div class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px">
                @foreach($gallery as $img)
                    <div data-reveal data-lightbox="{{ $img }}" role="button" tabindex="0" aria-label="Görseli büyüt" style="opacity:0;position:relative;aspect-ratio:4/3;overflow:hidden;border-radius:12px;background:#0c1018">
                        <img src="{{ $img }}" alt="{{ $project->title }} - görsel {{ $loop->iteration }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;transition:transform .8s cubic-bezier(.16,1,.3,1)" style-hover="transform:scale(1.06)">
                        <span style="position:absolute;top:12px;right:12px;width:38px;height:38px;display:flex;align-items:center;justify-content:center;background:rgba(43,41,38,.6);backdrop-filter:blur(4px);color:#fff;border-radius:50%;font-size:14px;opacity:0;transition:opacity .3s" class="kal-zoom-ico"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- DİĞER PROJELER --}}
    @if($others->count())
    <section class="kal-section" style="background:#fff;padding:100px 0">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:36px;gap:20px;flex-wrap:wrap">
                <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(26px,2.8vw,42px);color:#2B2926">Diğer Projeler</h2>
                <a href="{{ route('projects.index') }}" style="font-size:13.5px;font-weight:700;color:#D97757;text-decoration:none;border-bottom:2px solid #D97757;padding-bottom:5px">Tümünü Gör →</a>
            </div>
            <div class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
                @foreach($others as $o)
                    <article style="position:relative;aspect-ratio:4/3.4;overflow:hidden;border-radius:14px;background:#0c1018">
                        <a href="{{ route('projects.show', $o->slug) }}" style="position:absolute;inset:0;z-index:6"></a>
                        <div style="position:absolute;inset:0;transition:transform 1s cubic-bezier(.16,1,.3,1)" style-hover="transform:scale(1.06)"><img src="{{ $o->cover_url }}" alt="{{ $o->title }}" style="width:100%;height:100%;object-fit:cover"></div>
                        <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 40%,rgba(5,12,22,.92))"></div>
                        <div style="position:absolute;left:22px;right:22px;bottom:22px"><h3 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:22px;color:#fff">{{ $o->title }}</h3><div style="font-size:13px;color:rgba(255,255,255,.72);margin-top:5px">{{ $o->location }}</div></div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section class="kal-section" style="position:relative;background:#2B2926;padding:90px 0;overflow:hidden">
        <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(217,119,87,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(217,119,87,.05) 1px,transparent 1px);background-size:54px 54px;-webkit-mask-image:radial-gradient(80% 70% at 50% 40%,#000,transparent);mask-image:radial-gradient(80% 70% at 50% 40%,#000,transparent);pointer-events:none"></div>
        <div class="kal-pad" style="position:relative;max-width:1340px;margin:0 auto;padding:0 52px;display:flex;align-items:center;justify-content:space-between;gap:30px;flex-wrap:wrap">
            <div>
                <h2 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(24px,2.8vw,40px);color:#fff;max-width:20ch">{{ $project->title }} hakkında bilgi alın</h2>
                <p style="margin-top:12px;font-size:16px;color:rgba(255,255,255,.7);max-width:52ch">Fiyat, ödeme planı ve daire seçenekleri için uzman ekibimizle iletişime geçin.</p>
            </div>
            <div style="display:flex;gap:14px;flex-wrap:wrap">
                <a href="{{ route('contact.index') }}" style="display:inline-flex;align-items:center;gap:10px;background:#D97757;color:#fff;font-weight:700;font-size:14px;padding:17px 30px;text-decoration:none;transition:all .35s" style-hover="background:#C2603F;transform:translateY(-3px)">İletişime Geçin <i class="fa-solid fa-arrow-right"></i></a>
                <a href="{{ route('catalogs.index') }}" style="display:inline-flex;align-items:center;gap:10px;background:rgba(255,255,255,.08);color:#fff;font-weight:700;font-size:14px;padding:17px 30px;text-decoration:none;border:1px solid rgba(255,255,255,.3);transition:all .35s" style-hover="background:rgba(255,255,255,.16);transform:translateY(-3px)">Katalog İndir</a>
            </div>
        </div>
    </section>
</div>
@endsection
