{{-- Kalyon İnşaat — Hakkımızda (variant_5) --}}
@php
    $kalBg = $bgColor ?: '#fff';
    $kalImg = $image ?: 'https://baynetinsaat.com.tr/uploads/2023/09/2-2-scaled.jpg';
@endphp
<section id="hakkimizda" class="kal-section" style="position:relative;background:{{ $kalBg }};padding:130px 0;font-family:'Manrope',system-ui,sans-serif;@if($bgImage) background-image:url('{{ $bgImage }}');background-size:cover;background-position:center;@endif">
  <div class="kal-pad kal-split" style="max-width:1340px;margin:0 auto;padding:0 52px;display:grid;grid-template-columns:1.05fr 1fr;gap:76px;align-items:center">
    <div>
      @if($subtitle)
        <div data-reveal style="opacity:0;display:flex;align-items:center;gap:13px;margin-bottom:24px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">{{ $subtitle }}</span></div>
      @endif
      @if($title)
        <h2 data-reveal style="opacity:0;font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(32px,3.5vw,56px);line-height:1.06;letter-spacing:-.02em;color:#2B2926;max-width:17ch">{{ $title }}</h2>
      @endif
      @if($description)
        <p data-reveal style="opacity:0;margin-top:26px;font-size:17px;line-height:1.78;color:#5A5349;max-width:52ch">{!! $description !!}</p>
      @endif

      @if(count($list))
        <div data-reveal class="kal-stat-grid" style="opacity:0;display:grid;grid-template-columns:1fr 1fr;gap:1px;margin-top:46px;background:#E6E0D4;border:1px solid #E6E0D4">
          @foreach($list as $item)
            <div style="background:#fff;padding:28px 26px;display:flex;align-items:center;gap:14px">
              <span style="flex:none;width:9px;height:9px;border-radius:50%;background:#D97757"></span>
              <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:16.5px;line-height:1.3;color:#2B2926">{{ $item['title'] ?? '' }}</div>
            </div>
          @endforeach
        </div>
      @endif

      @if($buttonText && $buttonLink)
        <div data-reveal style="opacity:0;margin-top:42px">
          <a href="{{ $buttonLink }}" style="display:inline-flex;align-items:center;gap:13px;background:#D97757;color:#fff;font-weight:700;font-size:14px;letter-spacing:.4px;padding:18px 32px;text-decoration:none;transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="background:#C2603F;transform:translateY(-3px);box-shadow:0 16px 40px rgba(217,119,87,.4)">{{ $buttonText }} <span style="font-size:16px">→</span></a>
        </div>
      @endif
    </div>

    <div data-reveal style="opacity:0;position:relative">
      <div style="position:absolute;left:-12px;top:-12px;width:30px;height:30px;border-left:2px solid #D97757;border-top:2px solid #D97757;z-index:3"></div>
      <div style="position:absolute;right:-12px;bottom:-12px;width:30px;height:30px;border-right:2px solid #D97757;border-bottom:2px solid #D97757;z-index:3"></div>
      <div style="position:relative;aspect-ratio:4/5;overflow:hidden;background:#F0EAE0">
        <img src="{{ $kalImg }}" alt="{{ $title }}" style="width:100%;height:100%;object-fit:cover">
        <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 55%,rgba(43,41,38,.6))"></div>
        @if($subtitle)
          <div style="position:absolute;left:24px;bottom:22px">
            <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#EAC1AC">{{ $subtitle }}</div>
            <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:21px;color:#fff;margin-top:5px">{{ $title }}</div>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
