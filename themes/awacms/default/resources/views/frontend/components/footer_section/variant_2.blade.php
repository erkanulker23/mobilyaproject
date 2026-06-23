@php
$generalSettings = app(\App\Settings\GeneralSettings::class);
$linkColor = $linkColor ?? '#6b7280';
$titleColor = $titleColor ?? '#111827';
$logoDesc = $logoDescription ?? ($generalSettings->site_description ?? '');
@endphp

<footer class="footer_v2"
        style="@if($bgGradient)background: {{ $bgGradient }};@else background-color: {{ isset($bgColor) ? $bgColor : '#ffffff' }};@endif{{ !empty($bgImage) ? ';background-image:url(\'' . Storage::url($bgImage) . '\'); background-size: cover; background-position: center;' : '' }}">

    <div class="container">
        <!-- Main Footer Content -->
        <div class="footer_v2_main">
            <div class="row g-5">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer_v2_brand">
                        <a href="/" class="footer_v2_logo" aria-label="Anasayfa">
                            <img src="{{ Storage::url($generalSettings->footer_logo) }}"
                                 alt="{{ $generalSettings->site_name }}"
                                 loading="lazy"
                                 width="180"
                                 height="50">
                        </a>
                        @if(!empty($logoDesc))
                        <p class="footer_v2_description">
                            {{ $logoDesc }}
                        </p>
                        @endif

                        <!-- Contact Info -->
                        <div class="footer_v2_contact">
                            <div class="footer_v2_contact_item">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:{{ $generalSettings->email }}" style="color: {{ $linkColor }};">{{ $generalSettings->email }}</a>
                            </div>
                            @if($phone)
                            <div class="footer_v2_contact_item">
                                <i class="fas fa-phone"></i>
                                <a href="tel:{{ $phone }}" style="color: {{ $linkColor }};">{{ $phone }}</a>
                            </div>
                            @endif
                            <div class="footer_v2_contact_item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span style="color: {{ $linkColor }};">{{ $generalSettings->address }}</span>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="footer_v2_social">
                            @foreach($socialMediaLinks as $social)
                            <a href="{{ $social->link }}"
                               class="footer_v2_social_link"
                               target="_blank"
                               aria-label="{{ $social->type }}"
                               style="color: {{ $linkColor }};">
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

                <!-- Menu Links -->
                @php
                    $menuItemsArray = $menu->items->toArray();
                    $menuItemsLimited = array_slice($menuItemsArray, 0, 3);
                @endphp
                @foreach($menuItemsLimited as $menuItem)
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="footer_v2_widget">
                        <h4 class="footer_v2_widget_title" style="color: {{ $titleColor }};">{{ $menuItem['name'] }}</h4>
                        <ul class="footer_v2_links">
                            @php $childrenArray = $menuItem['children'] ?? []; @endphp
                            @foreach($childrenArray as $child)
                            <li>
                                <a href="{{ $child['link'] }}"
                                   target="{{ $child['target'] }}"
                                   class="{{ $child['linkClass'] ?? '' }}"
                                   style="color: {{ $linkColor }};">
                                    {{ $child['name'] }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer_v2_bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="footer_v2_copyright">{!! $generalSettings->footer_copyright !!}</p>
                </div>
                <div class="col-md-6">
                    <div class="footer_v2_bottom_links">
                        <a href="/privacy" style="color: {{ $linkColor }};">Gizlilik Politikası</a>
                        <span>•</span>
                        <a href="/terms" style="color: {{ $linkColor }};">Kullanım Şartları</a>
                        <span>•</span>
                        <a href="/cookies" style="color: {{ $linkColor }};">Çerez Politikası</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
