{{-- Kalyon İnşaat — SSS Akordeon (variant_6) --}}
@php
    $kalBg = $bgColor ?: '#F4EFE7';
    $kalItems = ($faq && isset($faq->items)) ? $faq->items : collect();
@endphp
@if($kalItems && count($kalItems))
<section class="kal-section" style="position:relative;background:{{ $kalBg }};padding:130px 0;font-family:'Manrope',system-ui,sans-serif;@if($bgImage) background-image:url('{{ $bgImage }}');background-size:cover;background-position:center;@endif">
  <div class="kal-pad" style="max-width:920px;margin:0 auto;padding:0 52px">
    <div data-reveal style="opacity:0;text-align:center;margin-bottom:50px">
      @if($subtitle)
        <div style="display:inline-flex;align-items:center;gap:13px;margin-bottom:16px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#D97757">{{ $subtitle }}</span><span style="width:34px;height:1px;background:#D97757"></span></div>
      @endif
      @if($title)
        <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(30px,3.2vw,52px);line-height:1.06;letter-spacing:-.02em;color:#2B2926;margin:0 auto;max-width:20ch">{{ $title }}</h2>
      @endif
    </div>

    <div style="display:flex;flex-direction:column;gap:14px">
      @foreach($kalItems as $i => $item)
        <div data-faq data-open="0" data-reveal data-rd="{{ ($i % 6) * 0.05 }}" style="opacity:0;background:#fff;border:1px solid #E6E0D4;border-radius:14px;overflow:hidden;transition:border-color .3s" style-hover="border-color:#D97757">
          <button data-faq-q type="button" style="width:100%;display:flex;align-items:center;justify-content:space-between;gap:20px;padding:24px 28px;background:transparent;border:0;cursor:pointer;text-align:left;font-family:'Manrope',system-ui,sans-serif">
            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:17px;color:#2B2926;line-height:1.4">{{ $item->title }}</span>
            <span data-faq-icon style="flex:none;width:30px;height:30px;display:flex;align-items:center;justify-content:center;background:#F4EFE7;color:#D97757;font-size:20px;font-weight:700;border-radius:50%;transition:transform .35s cubic-bezier(.16,1,.3,1)">+</span>
          </button>
          <div data-faq-a style="max-height:0;overflow:hidden;transition:max-height .4s cubic-bezier(.16,1,.3,1)">
            <div style="padding:0 28px 26px;font-size:15px;line-height:1.75;color:#5A5349">{!! $item->description ?? $item->short_description !!}</div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
