@extends('frontend.layouts.app')

@push('metas')
    <meta name="description" content="Kalyon İnşaat haberleri, sektörel gelişmeler ve uzman görüşleri. Gündemden son gelişmeleri buradan takip edin.">
    <meta name="keywords" content="haberler, blog, inşaat haberleri, sektörel gelişmeler">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="Haberler">
    <meta property="og:description" content="Gündemden son gelişmeler, sektörel içgörüler ve uzman görüşleri.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
@endpush

@section('content')
<div style="font-family:'Manrope',system-ui,sans-serif;color:#1F1C18;background:#fff">

    @include('frontend.partials.page-hero', [
        'eyebrow' => 'Haberler',
        'title' => 'Gündemden son gelişmeler',
        'subtitle' => 'Sektörel içgörüler, uzman görüşleri ve Kalyon İnşaat dünyasından güncel haberler.',
        'breadcrumbs' => ['Haberler' => null],
        'bg' => optional($posts->first())->listingImage ?? null,
    ])

    {{-- ARAMA + KATEGORİLER --}}
    <section class="kal-section" style="background:#F4EFE7;padding:46px 0;border-bottom:1px solid #E6E0D4">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap">
                {{-- Arama --}}
                <form method="GET" action="{{ route('blog.index') }}" style="flex:1;min-width:260px;max-width:440px;display:flex;align-items:center;background:#fff;border:1px solid #E6E0D4;border-radius:32px;padding:6px 6px 6px 22px">
                    <input type="text" name="query" value="{{ request()->input('query') }}" placeholder="Haberlerde ara..." aria-label="Haberlerde ara" style="flex:1;border:none;outline:none;background:transparent;font-family:'Manrope',sans-serif;font-size:14.5px;color:#1F1C18">
                    <button type="submit" aria-label="Ara" style="display:inline-flex;align-items:center;justify-content:center;width:42px;height:42px;border:none;border-radius:50%;background:#D97757;color:#fff;cursor:pointer;transition:background .3s" style-hover="background:#C2603F">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M21 21L16.5 16.5M19 10.5C19 15.19 15.19 19 10.5 19C5.81 19 2 15.19 2 10.5C2 5.81 5.81 2 10.5 2C15.19 2 19 5.81 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </form>

                {{-- Kategoriler --}}
                @if($categories->count())
                <div style="display:flex;gap:9px;flex-wrap:wrap">
                    <a href="{{ route('blog.index') }}{{ request()->input('query') ? '?query='.request()->input('query') : '' }}" style="font-family:'Manrope',sans-serif;font-size:12.5px;font-weight:700;text-decoration:none;padding:10px 18px;border-radius:28px;transition:all .3s;{{ !request()->has('category') ? 'color:#fff;background:#2B2926;border:1px solid #2B2926' : 'color:#2B2926;background:transparent;border:1px solid #C9BFAD' }}">Tümü</a>
                    @foreach($categories as $category)
                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}{{ request()->input('query') ? '&query='.request()->input('query') : '' }}" style="font-family:'Manrope',sans-serif;font-size:12.5px;font-weight:700;text-decoration:none;padding:10px 18px;border-radius:28px;transition:all .3s;{{ request()->input('category') === $category->slug ? 'color:#fff;background:#2B2926;border:1px solid #2B2926' : 'color:#2B2926;background:transparent;border:1px solid #C9BFAD' }}">{{ $category->name }}</a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- HABERLER GRID --}}
    <section class="kal-section" style="background:#fff;padding:80px 0 120px">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            <div class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
                @forelse($posts as $i => $post)
                    <a data-reveal data-rd="{{ ($i % 3) * 0.08 }}" href="{{ route('blog.post.show', $post->slug) }}" style="opacity:0;text-decoration:none;background:#fff;border:1px solid #E6E0D4;border-radius:14px;overflow:hidden;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.1)">
                        <div style="position:relative;aspect-ratio:16/10;overflow:hidden;background:#0c1018">
                            <img src="{{ $post->listingImage ?: $post->detailImage }}" alt="{{ $post->title }}" loading="lazy" style="width:100%;height:100%;object-fit:cover;transition:transform .8s cubic-bezier(.16,1,.3,1)" style-hover="transform:scale(1.06)">
                            @if($post->category)<div style="position:absolute;top:14px;left:14px;font-size:10.5px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:#fff;background:rgba(43,41,38,.85);padding:7px 13px;border-radius:20px">{{ $post->category->name }}</div>@endif
                        </div>
                        <div style="padding:24px 24px 28px">
                            <div style="font-size:11.5px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#D97757">{{ optional($post->publishAt)->translatedFormat('d F Y') }}</div>
                            <h2 style="font-family:'Plus Jakarta Sans';font-weight:700;font-size:19px;color:#2B2926;margin-top:10px;line-height:1.25">{{ $post->title }}</h2>
                            <p style="margin-top:10px;font-size:14px;line-height:1.6;color:#6A6358">{{ \Illuminate\Support\Str::limit(strip_tags($post->shortDescription), 110) }}</p>
                            <span style="display:inline-flex;align-items:center;gap:8px;margin-top:18px;font-size:13px;font-weight:700;color:#D97757">Devamını Oku
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                        </div>
                    </a>
                @empty
                    <div style="grid-column:1/-1;text-align:center;padding:80px 20px;background:#F4EFE7;border:1px solid #E6E0D4;border-radius:16px">
                        <div style="font-family:'Plus Jakarta Sans';font-weight:800;font-size:26px;color:#2B2926">Yakında</div>
                        <p style="margin-top:12px;font-size:15px;color:#6A6358">Haberlerimiz çok yakında burada yer alacak. Takipte kalın.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
