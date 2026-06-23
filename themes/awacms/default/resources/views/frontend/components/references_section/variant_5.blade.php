{{-- Kalyon İnşaat — Referanslar / Logo Şeridi (variant_5) --}}
@php
    $kalBg = $bgColor ?: '#fff';
@endphp
@if($references && $references->count())
<section class="kal-section" style="position:relative;background:{{ $kalBg }};padding:90px 0;font-family:'Manrope',system-ui,sans-serif;@if($bgImage) background-image:url('{{ $bgImage }}');background-size:cover;background-position:center;@endif">
  <div class="kal-pad" style="max-width:1340px;margin:0 auto;padding:0 52px">
    <div data-reveal style="opacity:0;text-align:center;margin-bottom:40px">
      @if($subtitle)
        <span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#8B8273">{{ $subtitle }}</span>
      @endif
      @if($title)
        <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(26px,2.6vw,40px);line-height:1.1;letter-spacing:-.02em;color:#2B2926;margin:14px auto 0;max-width:20ch">{{ $title }}</h2>
      @endif
    </div>
    <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:50px">
      @foreach($references as $ref)
        <img src="{{ $ref->logo }}" alt="{{ $ref->title }}" style="height:46px;width:auto;object-fit:contain;filter:grayscale(1);opacity:.6;transition:all .3s" style-hover="filter:grayscale(0);opacity:1">
      @endforeach
    </div>
  </div>
</section>
@endif
