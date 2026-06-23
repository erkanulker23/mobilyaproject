{{-- Kalyon İnşaat — İstatistik / Sayaç (variant_5) — premium koyu band --}}
@php
    $kalBg = $bgColor ?: '#2B2926';
    // arka plan açık mı koyu mu (metin rengini ona göre seç)
    $hex = ltrim($kalBg, '#');
    $isLight = false;
    if (strlen($hex) === 6) {
        $r = hexdec(substr($hex,0,2)); $g = hexdec(substr($hex,2,2)); $b = hexdec(substr($hex,4,2));
        $isLight = (0.299*$r + 0.587*$g + 0.114*$b) > 150;
    }
    $titleColor = $isLight ? '#2B2926' : '#fff';
    $numColor = $isLight ? '#2B2926' : '#fff';
    $labelColor = $isLight ? '#8B8273' : 'rgba(255,255,255,.62)';
    $cardBg = $isLight ? '#fff' : 'rgba(255,255,255,.045)';
    $cardBorder = $isLight ? '#E6E0D4' : 'rgba(217,119,87,.22)';
    $gridLine = $isLight ? 'rgba(43,41,38,.05)' : 'rgba(217,119,87,.06)';

    // heroicon / fa eşlemesi
    $iconMap = [
        'heroicon-o-building-office-2' => 'fa-solid fa-building',
        'heroicon-o-building-office' => 'fa-solid fa-building',
        'heroicon-o-calendar' => 'fa-solid fa-calendar-days',
        'heroicon-o-wrench' => 'fa-solid fa-helmet-safety',
        'heroicon-o-users' => 'fa-solid fa-users',
        'heroicon-o-home' => 'fa-solid fa-house',
        'heroicon-o-trophy' => 'fa-solid fa-trophy',
    ];
    $defaultIcons = ['fa-solid fa-building', 'fa-solid fa-calendar-days', 'fa-solid fa-helmet-safety', 'fa-solid fa-users'];
    $kalIcon = function ($raw, $i) use ($iconMap, $defaultIcons) {
        if (!$raw) return $defaultIcons[$i % 4];
        if (isset($iconMap[$raw])) return $iconMap[$raw];
        if (str_starts_with($raw, 'fa-')) return $raw;
        if (str_starts_with($raw, 'heroicon')) return $defaultIcons[$i % 4];
        return $raw;
    };
@endphp
@if($counters && count($counters))
<section class="kal-section" style="position:relative;background:{{ $kalBg }};padding:120px 0;overflow:hidden;font-family:'Manrope',system-ui,sans-serif">
  {{-- arka plan grid deseni --}}
  <div style="position:absolute;inset:0;background-image:linear-gradient({{ $gridLine }} 1px,transparent 1px),linear-gradient(90deg,{{ $gridLine }} 1px,transparent 1px);background-size:54px 54px;-webkit-mask-image:radial-gradient(85% 75% at 50% 35%,#000,transparent);mask-image:radial-gradient(85% 75% at 50% 35%,#000,transparent);pointer-events:none"></div>
  @unless($isLight)
    <div style="position:absolute;top:-120px;left:50%;transform:translateX(-50%);width:680px;height:420px;background:radial-gradient(circle,rgba(217,119,87,.16),transparent 70%);pointer-events:none"></div>
  @endunless

  <div class="kal-pad" style="position:relative;max-width:1340px;margin:0 auto;padding:0 52px">
    @if($title || $subtitle)
      <div data-reveal style="opacity:0;text-align:center;margin-bottom:64px">
        @if($subtitle)
          <div style="display:inline-flex;align-items:center;gap:13px;margin-bottom:18px"><span style="width:34px;height:1px;background:#D97757"></span><span style="font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#E0A488">{{ $subtitle }}</span><span style="width:34px;height:1px;background:#D97757"></span></div>
        @endif
        @if($title)
          <h2 style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(32px,3.6vw,56px);line-height:1.04;letter-spacing:-.025em;color:{{ $titleColor }};margin:0 auto;max-width:20ch">{{ $title }}</h2>
        @endif
      </div>
    @endif

    <div class="kal-grid-4" style="display:grid;grid-template-columns:repeat({{ min(count($counters), 4) }},1fr);gap:20px">
      @foreach($counters as $i => $counter)
        <div data-reveal data-rd="{{ ($i % 4) * 0.1 }}" style="opacity:0;position:relative;background:{{ $cardBg }};border:1px solid {{ $cardBorder }};border-radius:18px;padding:38px 30px;overflow:hidden;transition:transform .45s cubic-bezier(.16,1,.3,1),border-color .45s,box-shadow .45s" style-hover="transform:translateY(-10px);border-color:#D97757;box-shadow:0 26px 60px rgba(0,0,0,.22)">
          {{-- üst köşe coral aksan --}}
          <div style="position:absolute;top:0;left:0;width:100%;height:3px;background:linear-gradient(90deg,#D97757,transparent)"></div>
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:26px">
            <div style="width:54px;height:54px;display:flex;align-items:center;justify-content:center;background:{{ $isLight ? '#2B2926' : 'rgba(217,119,87,.14)' }};color:#D97757;font-size:21px;border-radius:13px"><i class="{{ $kalIcon($counter->icon, $i) }}"></i></div>
            <span style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:15px;color:{{ $isLight ? 'rgba(43,41,38,.12)' : 'rgba(255,255,255,.14)' }}">0{{ $i + 1 }}</span>
          </div>
          <div style="font-family:'Plus Jakarta Sans',sans-serif;font-weight:800;font-size:clamp(40px,4.4vw,58px);line-height:1;letter-spacing:-.02em;color:{{ $numColor }}"><span data-count="{{ $counter->value }}">0</span><span style="color:#D97757">+</span></div>
          <div style="margin-top:14px;height:1px;width:42px;background:#D97757"></div>
          <div style="margin-top:14px;font-size:13px;font-weight:600;letter-spacing:.8px;text-transform:uppercase;color:{{ $labelColor }}">{{ $counter->title }}</div>
          @if($counter->description)
            <div style="margin-top:8px;font-size:13.5px;line-height:1.6;color:{{ $isLight ? '#6A6358' : 'rgba(255,255,255,.5)' }}">{{ $counter->description }}</div>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif
