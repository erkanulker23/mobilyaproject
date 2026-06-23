{{-- Kalyon İnşaat — Hizmetler Özeti (variant_4) --}}
@php
    $kalBg = $bgColor ?: '#fff';
    $kalServiceIcons = ['◰','⛭','◈','⌂'];
@endphp
@if($servicePosts && count($servicePosts))
<section class="kal-section" style="position:relative;background:{{ $kalBg }};padding:130px 0;font-family:'Manrope',system-ui,sans-serif;@if($bgImage) background-image:url('{{ $bgImage }}');background-size:cover;background-position:center;@endif">
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
      @if($buttonText && $buttonUrl)
        <a href="{{ $buttonUrl }}" style="font-size:13.5px;font-weight:700;color:#D97757;text-decoration:none;border-bottom:2px solid #D97757;padding-bottom:5px">{{ $buttonText }} →</a>
      @endif
    </div>

    <div class="kal-grid-4" style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px">
      @foreach($servicePosts as $i => $service)
        <a data-reveal data-rd="{{ ($i % 4) * 0.06 }}" href="{{ route('services.show', $service->slug) }}" style="opacity:0;text-decoration:none;background:#fff;border:1px solid #E6E0D4;border-radius:14px;padding:32px 28px;transition:transform .4s cubic-bezier(.16,1,.3,1),box-shadow .4s,border-color .4s" style-hover="transform:translateY(-8px);box-shadow:0 24px 50px rgba(43,41,38,.1);border-color:#D97757">
          <div style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;background:#2B2926;color:#fff;font-size:22px;border-radius:11px;margin-bottom:22px;overflow:hidden">
            @if($service->customIcon)
              <img src="{{ $service->customIcon }}" alt="" style="width:26px;height:26px;object-fit:contain;filter:brightness(0) invert(1)">
            @elseif($service->icon)
              <i class="{{ $service->icon }}"></i>
            @else
              {{ $kalServiceIcons[$i % 4] }}
            @endif
          </div>
          <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:19px;color:#2B2926">{{ $service->title }}</h3>
          @if($service->shortDescription)
            <p style="margin-top:10px;font-size:14px;line-height:1.65;color:#6A6358">{{ \Illuminate\Support\Str::limit(strip_tags($service->shortDescription), 90) }}</p>
          @endif
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif
