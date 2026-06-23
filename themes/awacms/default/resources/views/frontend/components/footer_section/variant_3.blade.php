@php
$generalSettings = app(\App\Settings\GeneralSettings::class);
$linkColor = $linkColor ?? '#3b82f6';
$widgetColor = $widgetColor ?? null;
$logoDesc = $logoDescription ?? ($generalSettings->site_description ?? '');
@endphp

<footer class="footer_v3"
        style="@if($bgGradient)background: {{ $bgGradient }};@else background-color: {{ isset($bgColor) ? $bgColor : '#1e293b' }};@endif{{ !empty($bgImage) ? ';background-image:url(\'' . Storage::url($bgImage) . '\'); background-size: cover; background-position: center;' : '' }}">

    <div class="container">
        <!-- Newsletter Section - Extended -->
        <div class="footer_v3_newsletter" @if($widgetColor) style="background: {{ $widgetColor }}" @endif>
            <div class="row align-items-center g-4">
                <div class="col-lg-5">
                    <h3 class="footer_v3_newsletter_title">Güncel Kalın</h3>
                    <p class="footer_v3_newsletter_text">En son gelişmelerden haberdar olmak için e-posta bültenimize abone olun</p>
                </div>
                <div class="col-lg-7">
                    <form class="footer_v3_newsletter_form" action="#" method="POST" aria-label="E-posta aboneliği">
                        <div class="footer_v3_input_group">
                            <input type="email"
                                   class="footer_v3_input"
                                   placeholder="E-posta adresiniz"
                                   required
                                   aria-label="E-posta adresiniz">
                            <button type="submit" class="footer_v3_button">
                                Abone Ol <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        <div class="footer_v3_main">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer_v3_widget">
                        <a href="/" class="footer_v3_logo" aria-label="Anasayfa">
                            <img src="{{ Storage::url($generalSettings->footer_logo) }}"
                                 alt="{{ $generalSettings->site_name }}"
                                 loading="lazy"
                                 width="160"
                                 height="45">
                        </a>
                        @if(!empty($logoDesc))
                        <p class="footer_v3_text">{{ $logoDesc }}</p>
                        @endif
                        <p class="footer_v3_text">{{ $generalSettings->address }}</p>
                    </div>
                </div>

                <!-- Menu Columns -->
                @php
                    $menuItemsArray = $menu->items->toArray();
                    $menuItemsLimited = array_slice($menuItemsArray, 0, 3);
                @endphp
                @foreach($menuItemsLimited as $menuItem)
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="footer_v3_widget">
                        <h4 class="footer_v3_widget_title" style="color: {{ $titleColor }};">{{ $menuItem['name'] }}</h4>
                        <ul class="footer_v3_links">
                            @php $childrenArray = $menuItem['children'] ?? []; @endphp
                            @foreach($childrenArray as $child)
                            <li>
                                <a href="{{ $child['link'] }}"
                                   target="{{ $child['target'] }}" style="color: {{ $linkColor }}; cursor: pointer;">
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
        <div class="footer_v3_bottom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="footer_v3_copyright">{!! $generalSettings->footer_copyright !!}</p>
                </div>
                <div class="col-md-6">
                    <div class="footer_v3_social">
                        @foreach($socialMediaLinks as $social)
                        <a href="{{ $social->link }}"
                           target="_blank"
                           aria-label="{{ $social->type }}"
                           style="cursor: pointer; color: {{ $linkColor }};">
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
