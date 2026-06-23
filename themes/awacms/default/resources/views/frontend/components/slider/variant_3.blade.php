{{-- Kalyon İnşaat — Hero Slider (variant_3) — her slide kendi metnini gösterir --}}
@php
    $kalSlides = ($slider && isset($slider->slides)) ? $slider->slides : collect();
@endphp
@if($kalSlides && count($kalSlides))
<section data-hero id="anasayfa" class="{{ $wrapperClass }}" style="position:relative;height:100vh;min-height:680px;overflow:hidden;background:#2B2926;font-family:'Manrope',system-ui,sans-serif">
  @foreach($kalSlides as $i => $slide)
    @php $kalImg = $slide->imageUrl ?: $slide->mobileImageUrl; @endphp
    <div data-slide style="position:absolute;inset:0;opacity:{{ $i === 0 ? 1 : 0 }};transition:opacity 1.1s ease">
      {{-- arka plan görseli --}}
      @if($kalImg)
        <img src="{{ $kalImg }}" alt="{{ $slide->title }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;{{ $i === 0 ? 'animation:kenburns 8s ease-out forwards' : '' }}">
      @endif
      {{-- karartma --}}
      <div style="position:absolute;inset:0;background:linear-gradient(90deg,rgba(28,26,23,.92) 0%,rgba(28,26,23,.66) 38%,rgba(28,26,23,.28) 68%,rgba(28,26,23,.5) 100%);pointer-events:none"></div>
      <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(28,26,23,.5) 0%,transparent 22%,transparent 60%,rgba(28,26,23,.65) 100%);pointer-events:none"></div>
      {{-- bu slide'a ait metin --}}
      <div class="kal-pad" style="position:absolute;inset:0;z-index:5;max-width:1340px;margin:0 auto;padding:0 52px;display:flex;flex-direction:column;justify-content:center">
        <div style="max-width:62ch">
          <div style="display:flex;align-items:center;gap:14px;margin-bottom:26px"><span style="width:42px;height:1px;background:#D97757"></span><span style="font-size:12.5px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#EAC1AC">{{ $slide->subtitle ?: 'Mühendislik · Altyapı · Yaşam' }}</span></div>
          @if($slide->title)
            @if($i === 0)
              <h1 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;color:{{ $slide->titleColor ?: '#fff' }};font-size:clamp(44px,5.6vw,98px);line-height:1.02;letter-spacing:-.03em;max-width:15ch;text-shadow:0 2px 40px rgba(0,0,0,.4)">{!! $slide->title !!}</h1>
            @else
              <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;color:{{ $slide->titleColor ?: '#fff' }};font-size:clamp(44px,5.6vw,98px);line-height:1.02;letter-spacing:-.03em;max-width:15ch;text-shadow:0 2px 40px rgba(0,0,0,.4)">{!! $slide->title !!}</h2>
            @endif
          @endif
          @if($slide->content)
            <p style="margin-top:28px;max-width:48ch;font-size:clamp(15px,1.15vw,18px);line-height:1.7;color:{{ $slide->contentColor ?: 'rgba(255,255,255,.82)' }};text-shadow:0 1px 20px rgba(0,0,0,.4)">{!! $slide->content !!}</p>
          @endif
          @php $kalCta = $slide->ctaText ?? null; $kalLink = $slide->linkUrl ?? null; @endphp
          <div style="display:flex;gap:16px;margin-top:40px;flex-wrap:wrap">
            <a href="{{ $kalLink ?: route('projects.index') }}" style="display:inline-flex;align-items:center;gap:13px;background:#D97757;color:#fff;font-weight:700;font-size:14px;letter-spacing:.4px;padding:18px 32px;text-decoration:none;transition:all .35s cubic-bezier(.16,1,.3,1)" style-hover="background:#C2603F;transform:translateY(-3px);box-shadow:0 16px 40px rgba(217,119,87,.4)">{{ $kalCta ?: 'Projelerimizi Keşfedin' }} <span style="font-size:16px">→</span></a>
            <a href="{{ route('contact.index') }}" style="display:inline-flex;align-items:center;gap:13px;background:rgba(255,255,255,.08);color:#fff;font-weight:700;font-size:14px;letter-spacing:.4px;padding:18px 32px;text-decoration:none;border:1px solid rgba(255,255,255,.3);backdrop-filter:blur(6px);transition:all .35s" style-hover="background:rgba(255,255,255,.16);transform:translateY(-3px)">Ücretsiz Danışmanlık</a>
          </div>
        </div>
      </div>
    </div>
  @endforeach

  {{-- alt bar: thumbnaillar + kaydırın (içerik container'ı ile hizalı) --}}
  <div class="kal-pad" style="position:absolute;left:0;right:0;bottom:36px;z-index:6;max-width:1340px;margin:0 auto;padding:0 52px;display:flex;align-items:center;justify-content:space-between;gap:20px">
    @if(count($kalSlides) > 1)
      <div class="kal-hero-thumbs" style="display:flex;align-items:center;gap:12px">
        @foreach($kalSlides as $i => $slide)
          @php $thumb = $slide->imageUrl ?: $slide->mobileImageUrl; @endphp
          <div data-hdot data-thumb class="kal-hthumb {{ $i === 0 ? 'is-active' : '' }}" aria-label="Slayt {{ $i + 1 }}">
            @if($thumb)<img src="{{ $thumb }}" alt="" loading="lazy">@endif
            <span class="kal-hthumb-num">0{{ $i + 1 }}</span>
          </div>
        @endforeach
      </div>
    @else
      <span></span>
    @endif
    <div style="display:flex;align-items:center;gap:14px;flex:none">
      <span style="font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.7)">Kaydırın</span>
      <span style="position:relative;width:40px;height:1px;background:rgba(255,255,255,.4);overflow:hidden"><span style="position:absolute;top:0;left:0;width:14px;height:1px;background:#fff;animation:scrolldot 2s ease-in-out infinite"></span></span>
    </div>
  </div>
</section>
@endif
