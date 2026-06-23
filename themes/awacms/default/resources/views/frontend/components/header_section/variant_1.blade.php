<div class="header_variant4-wrapper" id="headerWrapper">
    @if($isTopbarActive)
        @include('frontend/components/topbar/'.$topbarViewVariant)
    @endif
    <nav class="header_variant4 {{ $isTransparent ? 'header_variant4--transparent' : '' }}" style="background-color: {{ $isTransparent ? 'transparent' : (Route::currentRouteName() === 'home' ? 'white' : $bgColor) }}">
        <div class="{{ $width }}">
            <div class="row w-100 align-items-center">
                <div class="col-auto">
                    <div class="header_variant4-logo header_variant4-logo--mobile">
                        <a href="{{ url('/') }}">
                            <img src="{{ Storage::url($generalSettings->dark_header_logo) }}" alt="{{ $generalSettings->site_name }}">
                        </a>
                    </div>
                </div>
                <div class="col d-flex justify-content-end">
                    <button class="navbar-toggler d-md-none" id="mobileMenuToggle">
                    <span class="visually-hidden">Mobil menüyü aç/kapat</span>
                        <i class="fas fa-bars menu-icon"></i>
                        <i class="fas fa-times close-icon"></i>
                    </button>
                    <div class="header_variant4-nav collapse navbar-collapse" id="headerVariant4Navbar">
                        <ul class="header_variant4-nav">
                            @foreach($menu->items as $menuItem)
                                @if($menuItem->children->count() == 0)
                                    <li class="nav-item {{ $menuItem->wrapperClass }}">
                                        <a href="{{ $menuItem->link }}" class="nav-link" target="{{ $menuItem->target }}">
                                            {{ $menuItem->name }}
                                        </a>
                                    </li>
                                @elseif(!$menuItem->megaMenu)
                                    <li class="nav-item dropdown {{ $menuItem->wrapperClass }}" id="{{ $menuItem->id }}Dropdown">
                                        <a href="{{ $menuItem->link }}" class="nav-link {{ $menuItem->linkClass }}" role="button" aria-expanded="false" id="headerVariant4{{ $menuItem->id }}Dropdown">
                                            {{ $menuItem->name }} <i class="fas fa-chevron-down"></i>
                                        </a>
                                        <div class="header_variant4-sub-menu {{ $menuItem->linkClass }}-sub-menu" id="{{ $menuItem->id }}SubMenuDropdown">
                                            <div class="row">
                                                <div class="col-12">
                                                    @foreach($menuItem->children as $childMenuItem)
                                                        @if($loop->index < $menuItem->children->count() / 2)
                                                            <a href="{{ $childMenuItem->link }}" class="sub-link" target="{{ $childMenuItem->target }}">{{ $childMenuItem->name }}</a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-12">
                                                    @foreach($menuItem->children as $childMenuItem)
                                                        @if($loop->index >= $menuItem->children->count() / 2)
                                                            <a href="{{ $childMenuItem->link }}" class="sub-link" target="{{ $childMenuItem->target }}">{{ $childMenuItem->name }}</a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item dropdown {{ $menuItem->wrapperClass }}" id="{{ $menuItem->id }}Dropdown">
                                        <a href="{{ $menuItem->link }}" class="nav-link {{ $menuItem->linkClass }}" role="button" aria-expanded="false" id="headerVariant4{{ $menuItem->id }}Dropdown">
                                            {{ $menuItem->name }} <i class="fas fa-chevron-down"></i>
                                        </a>
                                        <div class="header_variant4-mega-submenu" id="{{ $menuItem->id }}SubmenuDropdown">
                                            <div class="dropdown-content row">
                                                @foreach($menuItem->children as $childMenuItem)
                                                    <div class="dropdown-column col-lg-3 col-md-6">
                                                        <h3>{{ $childMenuItem->name }}</h3>
                                                        @foreach($childMenuItem->children as $childChildMenuItem)
                                                            <a href="{{ $childChildMenuItem->link }}" class="sub-link" target="{{ $childChildMenuItem->target }}">{{ $childChildMenuItem->name }}</a>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-auto d-none d-md-block">
                    <div class="header_variant4-actions">
                        @if($phone)
                            <div class="quick-support">
                                <i class="fas fa-headset"></i>
                                <div class="support-text">
                                    <span>HIZLI DESTEK</span>
                                    <a href="tel:{{ $phone }}">{{ $phone }}</a>
                                </div>
                            </div>
                        @endif
                        @if($buttonText && $buttonLink)
                            <a href="{{ $buttonLink }}" class="login-btn">{{ $buttonText }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="header_variant4-mobile-menu-overlay" id="mobileMenuOverlay"></div>
<div class="header_variant4-mobile-menu" id="mobileMenu">
    <div class="mobile-logo">
        <a href="{{ url('/') }}">
            <img src="{{ Storage::url($generalSettings->dark_header_logo) }}" alt="{{ $generalSettings->site_name }}">
        </a>
    </div>
    <div class="mm-panels">
        <!-- Ana Menü Paneli -->
        <div class="mm-panel mm-panel--opened" id="mm-main">
            <div class="mm-navbar">
                <span class="mm-navbar__title">Menü</span>
                <a class="mm-btn--close" href="#" id="mobileMenuClose" aria-label="Menüyü kapat"><i class="fas fa-times"></i></a>
            </div>
            <ul class="mm-listview">
                @foreach($menu->items as $menuItem)
                    @if($menuItem->children->count() == 0)
                        <li class="mm-listitem">
                            <a href="{{ $menuItem->link }}" class="mm-listitem__text" target="{{ $menuItem->target }}">
                                <i class="fa {{ $menuItem->icon }}"></i>{{ $menuItem->name }}
                            </a>
                        </li>
                    @else
                        <li class="mm-listitem" id="mm-{{ $menuItem->id }}" data-mm-child="mm-{{ $menuItem->id }}-sub">
                            <a class="mm-btn--next mm-listitem__text" href="#mm-{{ $menuItem->id }}-sub">
                                <i class="fa {{ $menuItem->icon }}"></i>{{ $menuItem->name }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <!-- Alt Menü Panelleri -->
        @foreach($menu->items as $menuItem)
            @if($menuItem->children->count() > 0)
                <div class="mm-panel" id="mm-{{ $menuItem->id }}-sub" data-mm-parent="mm-main">
                    <div class="mm-navbar">
                        <a class="mm-btn--prev" href="#mm-main"><i class="fas fa-arrow-left"></i></a>
                        <a class="mm-navbar__title" href="#mm-main">{{ $menuItem->name }}</a>
                        <a class="mm-btn--close" href="#" id="mobileMenuClose{{ $menuItem->id }}" aria-label="Menüyü kapat"><i class="fas fa-times"></i></a>
                    </div>
                    <ul class="mm-listview">
                        @if(!$menuItem->megaMenu)
                            @foreach($menuItem->children as $childMenuItem)
                                <li class="mm-listitem">
                                    <a href="{{ $childMenuItem->link }}" class="mm-listitem__text" target="{{ $childMenuItem->target }}">{{ $childMenuItem->name }}</a>
                                </li>
                            @endforeach
                        @else
                            @foreach($menuItem->children as $childMenuItem)
                                <li class="mm-listitem">
                                    <span class="mm-listitem__text">{{ $childMenuItem->name }}</span>
                                    <ul class="mm-listview">
                                        @foreach($childMenuItem->children as $childChildMenuItem)
                                            <li class="mm-listitem">
                                                <a href="{{ $childChildMenuItem->link }}" class="mm-listitem__text" target="{{ $childChildMenuItem->target }}">{{ $childChildMenuItem->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            @endif
        @endforeach
    </div>
    <div class="mobile-footer">
        <div class="company-name">{{ $generalSettings->site_name }}</div>
        <p><i class="fas fa-envelope"></i>
        <a href="mailto:{{ $generalSettings->email }}">{{ $generalSettings->email }}</a></p>
        <p><i class="fas fa-phone"></i><a href="tel:{{ $phone }}">{{ $phone }}</a></p>
        <div class="social-links">
        @foreach($socialMediaLinks as $social)

                            <a href="{{ $social->link }}" class="footer-social-link" target="_blank" aria-label="{{ $social->type }}">
                                    @if($social->customIcon)
                                        <i class="{{ $social->customIcon }}"></i>
                                    @elseif($social->icon)
                                        <x-icon :name="$social->icon" style="max-height:20px width: 20px;" /><span></span>
                                    @endif
                                </a>


                            @endforeach

        </div>
    </div>
</div>
