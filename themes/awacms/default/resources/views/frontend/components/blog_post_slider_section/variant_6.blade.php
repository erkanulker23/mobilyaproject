{{-- Kalyon İnşaat — Haberler (variant_6) --}}
@php
    $kalBg = $bgColor ?: '#F4EFE7';
    $kalFallback = [
        'https://baynetinsaat.com.tr/uploads/2023/08/VADI-min.jpg',
        'https://baynetinsaat.com.tr/uploads/2023/09/2-2-scaled.jpg',
        'https://dapyapi.com.tr/dapyapi/cdn/uploads/000006593_dap-45yil-dap-web.webp',
    ];
@endphp
@if($posts && count($posts))
<section id="haberler" class="kal-section" style="position:relative;background:{{ $kalBg }};padding:130px 0;font-family:'Manrope',system-ui,sans-serif;@if($bgImage) background-image:url('{{ $bgImage }}');background-size:cover;background-position:center;@endif">
  <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
    <div data-reveal style="opacity:0;display:flex;align-items:flex-end;justify-content:space-between;gap:30px;flex-wrap:wrap;margin-bottom:40px">
      <div>
        @if($subtitle)
          <div style="display:flex;align-items:center;gap:13px;margin-bottom:18px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">{{ $subtitle }}</span></div>
        @endif
        @if($title)
          <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(30px,3.2vw,52px);line-height:1.05;letter-spacing:-.02em;color:#2B2926;max-width:16ch">{{ $title }}</h2>
        @endif
      </div>
      <a href="{{ route('blog.index') }}" style="font-size:13.5px;font-weight:700;color:#D97757;text-decoration:none;border-bottom:2px solid #D97757;padding-bottom:5px">Tüm Haberler →</a>
    </div>

    <div class="kal-grid-3" style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px">
      @foreach($posts as $i => $post)
        <a data-reveal data-rd="{{ ($i % 3) * 0.08 }}" href="{{ route('blog.post.show', $post->slug) }}" style="opacity:0;text-decoration:none;background:#fff;border:1px solid #E6E0D4;border-radius:14px;overflow:hidden;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.1)">
          <div style="aspect-ratio:16/10;overflow:hidden;background:#0c1018">
            <img src="{{ $post->listingImage ?: ($post->detailImage ?: $kalFallback[$i % 3]) }}" alt="{{ $post->title }}" style="width:100%;height:100%;object-fit:cover">
          </div>
          <div style="padding:24px 24px 28px">
            @if($post->publishAt)
              <div style="font-size:11.5px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#D97757">{{ $post->publishAt->translatedFormat('d F Y') }}</div>
            @endif
            <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:19px;color:#2B2926;margin-top:10px;line-height:1.25">{{ $post->title }}</h3>
            @if($post->shortDescription)
              <p style="margin-top:10px;font-size:14px;line-height:1.6;color:#6A6358">{{ \Illuminate\Support\Str::limit(strip_tags($post->shortDescription), 100) }}</p>
            @endif
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif
