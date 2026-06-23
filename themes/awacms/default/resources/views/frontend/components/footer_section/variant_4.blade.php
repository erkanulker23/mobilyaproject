@php
$generalSettings = app(\App\Settings\GeneralSettings::class);
$linkColor = $linkColor ?? '#3b82f6';
$titleColor = $titleColor ?? '#111827';
$logoDesc = $logoDescription ?? ($generalSettings->site_description ?? '');
@endphp

<footer class="footer_v4"
        style="@if($bgGradient)background: {{ $bgGradient }};@else background-color: {{ isset($bgColor) ? $bgColor : '#f8fafc' }};@endif{{ !empty($bgImage) ? ';background-image:url(\'' . Storage::url($bgImage) . '\'); background-size: cover; background-position: center;' : '' }}">

    <div class="container">
        <div class="footer_v4_main">
            <div class="row g-5">
                <!-- Large Logo & Info Column -->
                <div class="col-lg-5">
                    <div class="footer_v4_brand">
                        <a href="/" class="footer_v4_logo" aria-label="Anasayfa">
                            <img src="{{ Storage::url($generalSettings->footer_logo) }}"
                                 alt="{{ $generalSettings->site_name }}"
                                 loading="lazy"
                                 width="150"
                                 height="45">
                        </a>
                        @if(!empty($logoDesc))
                        <p class="footer_v4_tagline">
                            {{ $logoDesc }}
                        </p>
                        @endif

                        <div class="footer_v4_info">
                            <div class="footer_v4_info_item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span style="color: {{ $linkColor }};">{{ $generalSettings->address }}</span>
                            </div>
                            <div class="footer_v4_info_item">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:{{ $generalSettings->email }}" style="color: {{ $linkColor }};">{{ $generalSettings->email }}</a>
                            </div>
                            @if($phone)
                            <div class="footer_v4_info_item">
                                <i class="fas fa-phone"></i>
                                <a href="tel:{{ $phone }}" style="color: {{ $linkColor }};">{{ $phone }}</a>
                            </div>
                            @endif
                        </div>

                        <!-- Email Subscription (TR) -->
                        <form class="footer_v3_newsletter_form mt-3" action="#" method="POST" aria-label="E-posta aboneliği">
                            <div class="footer_v3_input_group">
                                <input type="email" class="footer_v3_input" placeholder="E-posta adresiniz" required aria-label="E-posta adresiniz">
                                <button type="submit" class="footer_v3_button">Abone Ol</button>
                            </div>
                        </form>

                        <!-- Social Media -->
                        <div class="footer_v4_social mt-3">
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

                <!-- Links Column -->
                <div class="col-lg-7">
                    <div class="row g-4">
                        @foreach($menu->items as $menuItem)
                        <div class="col-md-4 col-6">
                            <div class="footer_v4_widget">
                                <h3 class="footer_v4_title" style="color: {{ $titleColor }};">{{ $menuItem->name }}</h3>
                                <ul class="footer_v4_links">
                                    @php $childrenArray = ($menuItem->children ?? [])->toArray(); @endphp
                                    @foreach($childrenArray as $child)
                                    <li>
                                        <a href="{{ $child['link'] }}" target="{{ $child['target'] }}" style="color: {{ $linkColor }}; cursor: pointer;">
                                            <i class="fas fa-chevron-right"></i>
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
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer_v4_bottom">
            <p class="footer_v4_copyright">{!! $generalSettings->footer_copyright !!}</p>
        </div>
    </div>
</footer>
