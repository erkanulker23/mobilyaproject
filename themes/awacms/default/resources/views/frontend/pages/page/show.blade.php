@extends('frontend.layouts.app')

@push('metas')
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $page->seoDescription ?: Str::limit(strip_tags($page->content), 155) }}">
    <meta name="keywords" content="{{ $page->title }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $page->seoTitle ?: $page->title }}">
    <meta property="og:description" content="{{ $page->seoDescription ?: Str::limit(strip_tags($page->content), 155) }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')
<div style="font-family:'Manrope',system-ui,sans-serif;color:#1F1C18;background:#fff">

    @include('frontend.partials.page-hero', [
        'eyebrow' => 'Kurumsal',
        'title' => $page->title,
        'subtitle' => $page->shortDescription,
        'breadcrumbs' => [$page->title => null],
        'bg' => $heroImage,
    ])

    <section class="kal-section" style="background:#fff;padding:90px 0 110px">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div class="kal-split" style="display:grid;grid-template-columns:.85fr 2.15fr;gap:64px;align-items:start">

                {{-- YAN ŞERİT --}}
                <aside data-reveal style="opacity:0;position:sticky;top:100px">
                    <div style="display:flex;align-items:center;gap:13px;margin-bottom:18px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">{{ $page->title }}</span></div>
                    @if($page->shortDescription)
                        <p style="font-size:18px;line-height:1.65;color:#2B2926;font-weight:500;margin-bottom:26px">{{ $page->shortDescription }}</p>
                    @endif
                    <div style="background:#F4EFE7;border:1px solid #E6E0D4;border-radius:14px;padding:30px 28px">
                        <div style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:18px;color:#2B2926;margin-bottom:10px">Bir projeniz mi var?</div>
                        <p style="font-size:14px;line-height:1.6;color:#6A6358;margin-bottom:20px">Hedeflerinizi konuşmak ve doğru çözümü birlikte planlamak için bizimle iletişime geçin.</p>
                        <a href="{{ route('contact.index') }}" style="display:inline-flex;align-items:center;gap:10px;background:#D97757;color:#fff;font-weight:700;font-size:14px;padding:15px 26px;text-decoration:none;border-radius:9px;transition:all .3s" style-hover="background:#C2603F;transform:translateY(-2px)">İletişime Geç →</a>
                    </div>
                </aside>

                {{-- ZENGİN İÇERİK --}}
                <article data-reveal data-rd="0.08" style="opacity:0" itemprop="articleBody">
                    <div class="kal-richtext" style="font-size:16.5px;line-height:1.85;color:#5A5349">
                        {!! $page->content ?: '<p>Bu sayfa için içerik yakında eklenecektir.</p>' !!}
                    </div>
                </article>
            </div>
        </div>
    </section>

    <style>
        .kal-richtext h1,.kal-richtext h2,.kal-richtext h3,.kal-richtext h4 { font-family:'Plus Jakarta Sans',system-ui,sans-serif; color:#2B2926; font-weight:800; letter-spacing:-.01em; line-height:1.25; }
        .kal-richtext h1 { font-size:clamp(28px,3.2vw,40px); margin:0 0 22px; }
        .kal-richtext h2 { font-size:clamp(24px,2.6vw,32px); margin:44px 0 18px; }
        .kal-richtext h3 { font-size:21px; margin:34px 0 14px; }
        .kal-richtext h4 { font-size:18px; margin:28px 0 12px; }
        .kal-richtext p { margin:0 0 20px; }
        .kal-richtext a { color:#D97757; text-decoration:none; border-bottom:1px solid rgba(217,119,87,.4); transition:color .3s,border-color .3s; }
        .kal-richtext a:hover { color:#C2603F; border-color:#C2603F; }
        .kal-richtext ul,.kal-richtext ol { margin:0 0 22px; padding-left:24px; }
        .kal-richtext li { margin:0 0 10px; }
        .kal-richtext ul li::marker { color:#D97757; }
        .kal-richtext img { max-width:100%; height:auto; border-radius:14px; margin:26px 0; }
        .kal-richtext blockquote { margin:28px 0; padding:20px 26px; border-left:3px solid #D97757; background:#F4EFE7; border-radius:0 12px 12px 0; font-size:18px; color:#2B2926; font-style:italic; }
        .kal-richtext strong { color:#2B2926; font-weight:700; }
        .kal-richtext hr { border:none; border-top:1px solid #E6E0D4; margin:40px 0; }
        .kal-richtext table { width:100%; border-collapse:collapse; margin:26px 0; font-size:15px; }
        .kal-richtext th,.kal-richtext td { border:1px solid #E6E0D4; padding:12px 16px; text-align:left; }
        .kal-richtext th { background:#F4EFE7; color:#2B2926; font-weight:700; }
        .kal-richtext img:last-child,.kal-richtext p:last-child { margin-bottom:0; }
    </style>

</div>
@endsection
