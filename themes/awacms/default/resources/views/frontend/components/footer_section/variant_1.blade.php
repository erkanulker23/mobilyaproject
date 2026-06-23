@php
$generalSettings = app(\App\Settings\GeneralSettings::class);
$linkColor = $linkColor ?? '#3b82f6';
$titleColor = $titleColor ?? '#ffffff';
$logoDesc = $logoDescription ?? ($generalSettings->site_description ?? '');
@endphp

<footer class="footer_v1"
        style="@if($bgGradient)background: {{ $bgGradient }};@else background-color: {{ isset($bgColor) ? $bgColor : '#0f172a' }};@endif{{ !empty($bgImage) ? ';background-image:url(\'' . Storage::url($bgImage) . '\'); background-size: cover; background-position: center;' : '' }}">

    <div class="container">
        <!-- Main Footer Content -->
        <div class="footer_v1_main">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer_v1_widget">
                        <a href="/" class="footer_v1_logo" aria-label="Homepage">
                            <img src="{{ Storage::url($generalSettings->footer_logo) }}"
                                 alt="{{ $generalSettings->site_name }}"
                                 loading="lazy"
                                 width="180"
                                 height="50">
                        </a>
                        @if(!empty($logoDesc))
                        <p class="footer_v1_description">
                            {{ $logoDesc }}
                        </p>
                        @endif
                        <div class="footer_v1_contact">
                            <a href="mailto:{{ $generalSettings->email }}" class="footer_v1_contact_item" style="color: {{ $linkColor }};">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $generalSettings->email }}</span>
                            </a>
                            @if($phone)
                            <a href="tel:{{ $phone }}" class="footer_v1_contact_item" style="color: {{ $linkColor }};">
                                <i class="fas fa-phone"></i>
                                <span>{{ $phone }}</span>
                            </a>
                            @endif
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
                    <div class="footer_v1_widget">
                        <h3 class="footer_v1_widget_title" style="color: {{ $titleColor }};">{{ $menuItem['name'] }}</h3>
                        <ul class="footer_v1_links">
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
        <div class="footer_v1_bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="footer_v1_copyright">{!! $generalSettings->footer_copyright !!}</p>
                </div>
                <div class="col-md-6">
                    <div class="footer_v1_social">
                        @foreach($socialMediaLinks as $social)
                        <a href="{{ $social->link }}"
                           class="footer_v1_social_link"
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
        </div>
    </div>
</footer>
