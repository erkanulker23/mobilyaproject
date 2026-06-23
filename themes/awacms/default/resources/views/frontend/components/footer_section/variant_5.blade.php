@php
$generalSettings = app(\App\Settings\GeneralSettings::class);
$logoDesc = $logoDescription ?? ($generalSettings->site_description ?? '');
@endphp

<footer class="footer_v5"
        style="@if($bgGradient)background: {{ $bgGradient }};@else background-color: {{ isset($bgColor) ? $bgColor : '#ffffff' }};@endif{{ !empty($bgImage) ? ';background-image:url(\'' . Storage::url($bgImage) . '\'); background-size: cover; background-position: center;' : '' }}">

    <div class="container">
        <!-- Top Section with Icons -->
        <div class="footer_v5_top">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer_v5_brand">
                        <a href="/" class="footer_v5_logo" aria-label="Anasayfa">
                            <img src="{{ Storage::url($generalSettings->footer_logo) }}"
                                 alt="{{ $generalSettings->site_name }}"
                                 loading="lazy"
                                 width="160"
                                 height="45">
                        </a>
                        @if(!empty($logoDesc))
                        <p class="footer_v5_description mt-3">{{ $logoDesc }}</p>
                        @endif
                    </div>
                </div>
                <!-- Contact Cards -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer_v5_card">
                        <div class="footer_v5_card_icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="footer_v5_card_content">
                            <h4 style="color: {{ $titleColor }};">Address</h4>
                            <p style="color: {{ $linkColor }};">{{ $generalSettings->address }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer_v5_card">
                        <div class="footer_v5_card_icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="footer_v5_card_content">
                            <h4 style="color: {{ $titleColor }};">Email</h4>
                            <p><a href="mailto:{{ $generalSettings->email }}" style="color: {{ $linkColor }};">{{ $generalSettings->email }}</a></p>
                        </div>
                    </div>
                </div>
                @if($phone)
                <div class="col-lg-4 col-md-6">
                    <div class="footer_v5_card">
                        <div class="footer_v5_card_icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="footer_v5_card_content">
                            <h4 style="color: {{ $titleColor }};">Phone</h4>
                            <p><a href="tel:{{ $phone }}" style="color: {{ $linkColor }};">{{ $phone }}</a></p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Links Grid -->
        <div class="footer_v5_links">
            <div class="row g-4">
                @foreach($menu->items as $menuItem)
                <div class="col-lg-3 col-md-6 col-6">
                    <h3 class="footer_v5_title" style="color: {{ $titleColor }};">{{ $menuItem->name }}</h3>
                    <ul class="footer_v5_list">
                        @foreach($menuItem->children as $child)
                        <li><a href="{{ $child->link }}" target="{{ $child->target }}" style="color: {{ $linkColor }};">{{ $child->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="footer_v5_bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="footer_v5_copyright">{!! $generalSettings->footer_copyright !!}</p>
                </div>
                <div class="col-md-6">
                    <div class="footer_v5_social">
                        @foreach($socialMediaLinks as $social)
                        <a href="{{ $social->link }}" target="_blank" aria-label="{{ $social->type }}" style="color: {{ $linkColor }};">
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
