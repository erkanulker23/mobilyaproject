@extends('frontend.layouts.app')

@section('content')
<div style="font-family:'Manrope',system-ui,sans-serif;color:#1F1C18;background:#fff">
    @include('frontend.partials.page-hero', [
        'eyebrow' => 'Ürünlerimiz',
        'title' => 'Koleksiyonumuz',
        'subtitle' => 'Koltuk, köşe, yatak ve yemek odası koleksiyonlarımızı keşfedin.',
        'breadcrumbs' => ['Ürünler' => null],
        'bg' => $projects->first()->cover_url ?? null,
    ])

    @php $cats = $projects->map(fn($p) => $p->projectCategory)->filter()->unique('id')->values(); @endphp

    <section class="kal-section" style="background:#fff;padding:80px 0 120px">
        <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
            @if($cats->count() > 1)
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:40px">
                <button data-filterbtn="all" style="font-family:'Manrope',sans-serif;font-size:13px;font-weight:700;color:#fff;background:#1C1813;border:1px solid #1C1813;padding:11px 22px;border-radius:30px;cursor:pointer;transition:all .3s">Tümü</button>
                @foreach($cats as $c)
                <button data-filterbtn="{{ $c->slug }}" style="font-family:'Manrope',sans-serif;font-size:13px;font-weight:700;color:#1C1813;background:transparent;border:1px solid #C9BFAD;padding:11px 22px;border-radius:30px;cursor:pointer;transition:all .3s">{{ $c->name }}</button>
                @endforeach
            </div>
            @endif

            <div data-grid class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
                @forelse($projects as $i => $p)
                    <article data-reveal data-rd="{{ ($i % 3) * 0.08 }}" data-card data-cat="{{ $p->category_filter }}" style="opacity:0;position:relative;aspect-ratio:4/3.4;overflow:hidden;border-radius:14px;background:#0c1018;cursor:pointer">
                        <a href="{{ route('projects.show', $p->slug) }}" style="position:absolute;inset:0;z-index:6" aria-label="{{ $p->title }}"></a>
                        <div style="position:absolute;inset:0;transition:transform 1s cubic-bezier(.16,1,.3,1)" style-hover="transform:scale(1.06)"><img src="{{ $p->cover_url }}" alt="{{ $p->title }}" style="width:100%;height:100%;object-fit:cover"></div>
                        <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(5,12,22,.1) 0%,transparent 32%,rgba(5,12,22,.92))"></div>
                        @if($p->category_label)<div style="position:absolute;top:16px;left:16px;font-size:10.5px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:#fff;background:rgba(43,41,38,.85);padding:7px 13px;border-radius:20px">{{ $p->category_label }}</div>@endif
                        <div style="position:absolute;left:22px;right:22px;bottom:22px"><h3 style="font-weight:700;font-size:24px;color:#fff;line-height:1.1">{{ $p->title }}</h3><div style="font-size:13px;color:rgba(255,255,255,.72);margin-top:6px">{{ $p->category_label }}</div></div>
                    </article>
                @empty
                    <p style="color:#6A6358;grid-column:1/-1">Henüz ürün eklenmemiş. Admin panelinden <strong>Ürünler</strong> bölümünden ekleyebilirsiniz.</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
