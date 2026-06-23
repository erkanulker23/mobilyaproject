@php
$generalSettings = app(\App\Settings\GeneralSettings::class);
$linkColor = $linkColor ?? '#60a5fa';
$widgetColor = $widgetColor ?? '#1f2937';
$logoDesc = $logoDescription ?? ($generalSettings->site_description ?? '');
@endphp

<footer class="footer_v6"
        style="@if($bgGradient)background: {{ $bgGradient }};@else background-color: {{ isset($bgColor) ? $bgColor : '#0b1220' }};@endif{{ !empty($bgImage) ? ';background-image:url(\'' . Storage::url($bgImage) . '\'); background-size: cover; background-position: center;' : '' }}">

    <div class="container">
        <div class="row g-4 align-items-start footer_v6_split">
            <!-- Brand Block -->
            <div class="col-lg-4">
                <div class="footer_v6_brand" style="background: {{ $widgetColor }}; border-radius: 16px; padding: 24px;">
                    <a href="/" class="footer_v6_logo" aria-label="Anasayfa">
                        <img src="{{ Storage::url($generalSettings->footer_logo) }}" alt="{{ $generalSettings->site_name }}" loading="lazy" width="160" height="46">
                    </a>
                    @if(!empty($logoDesc))
                    <p class="mt-3" style="color: rgba(255,255,255,.7); font-size:14px;">{{ $logoDesc }}</p>
                    @endif
                    <div class="footer_v6_brand_info mt-3">
                        <div class="d-flex align-items-start gap-2 mb-2"><i class="fas fa-map-marker-alt" style="width:16px;color: {{ $linkColor }}"></i><span style="color:#cbd5e1; font-size:14px;">{{ $generalSettings->address }}</span></div>
                        <div class="d-flex align-items-start gap-2 mb-2"><i class="fas fa-envelope" style="width:16px;color: {{ $linkColor }}"></i><a href="mailto:{{ $generalSettings->email }}" style="color:#cbd5e1; font-size:14px; text-decoration:none;">{{ $generalSettings->email }}</a></div>
                        @if($phone)
                        <div class="d-flex align-items-start gap-2"><i class="fas fa-phone" style="width:16px;color: {{ $linkColor }}"></i><a href="tel:{{ $phone }}" style="color:#cbd5e1; font-size:14px; text-decoration:none;">{{ $phone }}</a></div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Links + Social -->
            <div class="col-lg-8">
                <div class="row g-4">
                    @php $menuItemsArray = $menu->items->toArray(); @endphp
                    @foreach($menuItemsArray as $menuItem)
                    <div class="col-md-4 col-6">
                        <h4 style="color: {{ $titleColor ?? '#ffffff' }}; font-size:15px; text-transform:uppercase; letter-spacing:.5px; margin-bottom:12px;">{{ $menuItem['name'] }}</h4>
                        <ul class="list-unstyled m-0 p-0">
                            @php $children = $menuItem['children'] ?? []; @endphp
                            @foreach($children as $child)
                            <li style="margin-bottom:8px;">
                                <a href="{{ $child['link'] }}" target="{{ $child['target'] }}" style="color: {{ $linkColor }}; text-decoration:none; font-size:14px;">{{ $child['name'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap gap-3">
                    <p class="m-0" style="color: rgba(255,255,255,.6); font-size:13px;">{!! $generalSettings->footer_copyright !!}</p>
                    <div class="d-flex gap-2">
                        @foreach($socialMediaLinks as $social)
                        <a href="{{ $social->link }}" target="_blank" aria-label="{{ $social->type }}" style="width:38px; height:38px; background: rgba(255,255,255,.08); border-radius:50%; display:flex; align-items:center; justify-content:center; color: {{ $linkColor }}; text-decoration:none;">
                            @if($social->customIcon)
                                <i class="{{ $social->customIcon }}"></i>
                            @elseif($social->icon)
                                <x-icon :name="$social->icon" />
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
