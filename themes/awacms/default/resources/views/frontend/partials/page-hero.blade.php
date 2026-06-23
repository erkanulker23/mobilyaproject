{{-- Yeniden kullanılabilir iç sayfa hero'su. Değişkenler: $eyebrow, $title, $subtitle, $breadcrumbs (['label'=>url]), $bg --}}
@php
    $bg = $bg ?? 'https://baynetinsaat.com.tr/uploads/2023/09/2-2-scaled.jpg';
@endphp

@if(!empty($breadcrumbs))
    @php
        $bcItems = [['name' => 'Ana Sayfa', 'item' => route('home')]];
        foreach ($breadcrumbs as $label => $url) {
            $bcItems[] = ['name' => $label, 'item' => $url ?: url()->current()];
        }
    @endphp
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => collect($bcItems)->map(fn ($b, $i) => [
            '@type' => 'ListItem', 'position' => $i + 1, 'name' => $b['name'], 'item' => $b['item'],
        ])->all(),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
@endif
<section class="kal-page-hero" style="position:relative;background:#2B2926;padding:130px 0 70px;overflow:hidden">
    <div style="position:absolute;inset:0;opacity:.22"><img src="{{ $bg }}" alt="" style="width:100%;height:100%;object-fit:cover"></div>
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(28,26,23,.7),rgba(28,26,23,.92))"></div>
    <div class="kal-pad" style="position:relative;max-width:1340px;margin:0 auto;padding:0 52px">
        @if(!empty($breadcrumbs))
            <div style="display:flex;align-items:center;gap:9px;flex-wrap:wrap;margin-bottom:18px;font-size:12.5px;color:rgba(255,255,255,.6)">
                <a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);text-decoration:none" style-hover="color:#E0A488">Ana Sayfa</a>
                @foreach($breadcrumbs as $label => $url)
                    <span style="opacity:.5">/</span>
                    @if($url)
                        <a href="{{ $url }}" style="color:rgba(255,255,255,.6);text-decoration:none" style-hover="color:#E0A488">{{ $label }}</a>
                    @else
                        <span style="color:#E0A488">{{ $label }}</span>
                    @endif
                @endforeach
            </div>
        @endif
        @if(!empty($eyebrow))
            <div style="display:flex;align-items:center;gap:13px;margin-bottom:18px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#EAC1AC">{{ $eyebrow }}</span></div>
        @endif
        <h1 style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:clamp(34px,4.4vw,64px);line-height:1.05;letter-spacing:-.02em;color:#fff;max-width:18ch">{{ $title }}</h1>
        @if(!empty($subtitle))
            <p style="margin-top:18px;max-width:60ch;font-size:16.5px;line-height:1.7;color:rgba(255,255,255,.72)">{{ $subtitle }}</p>
        @endif
    </div>
</section>
