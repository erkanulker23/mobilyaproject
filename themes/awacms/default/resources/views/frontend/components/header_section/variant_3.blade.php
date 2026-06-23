<header class="header-with-topbar {{ $wrapperClass }}" style="background-color: {{ $bgColor }}">
    @if($isTopbarActive)
        @include('frontend/components/topbar/'.$topbarViewVariant)
    @endif

    <nav class="navbar navbar-expand-lg header-light bg-white fixed-header header-demo">
        <div class="{{ $width }}">
            <div class="col-auto col-xxl-3 col-lg-2 menu-logo">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ Storage::url($generalSettings->header_logo) }}" data-at2x="{{ Storage::url($generalSettings->header_logo) }}" alt="{{$generalSettings->site_name}}" class="default-logo">
                    <img src="{{ Storage::url($generalSettings->header_logo) }}" data-at2x="{{ Storage::url($generalSettings->header_logo) }}" alt="{{$generalSettings->site_name}}" class="alt-logo">
                    <img src="{{ Storage::url($generalSettings->header_logo) }}" data-at2x="{{ Storage::url($generalSettings->header_logo) }}" alt="{{$generalSettings->site_name}}" class="mobile-logo">
                </a>
            </div>
            <div class="col-auto col-xxl-6 col-lg-8 menu-order">
                <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav fw-600">
                        @foreach($menu->items as $menuItem)
                            @include('frontend.components.header_section.components.variant_1_menu_item', ['menuItem' => $menuItem])
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-auto ms-auto ps-lg-0 d-none d-sm-flex">
                @if($phone)
                    <div class="d-none d-xl-flex me-25px">
                        <div class="d-flex align-items-center widget-text fw-600 alt-font">

                            <div class="pxl-icon-box pxl-icon-box88" data-wow-delay="ms">
                                <div class="pxl-item--inner">
                                  <div class="pxl-item--icon theme-custom-bg-2">
                                    <img loading="lazy" width="22" height="21" src="{{ theme_asset('images/crm/1.png') }}" class="attachment-full" alt="phone" decoding="async">
                                  </div>
                                  <div class="content-right">
                                    <div class="pxl-item--description fw-600">ÇAĞRI MERKEZİ</div>
                                    <h5 class="pxl-item-title el-empty fs-25">
                                      <a href="tel:{{ $phone }}">{{ $phone }}</a>
                                    </h5>
                                  </div>
                                </div>
                              </div>
                    </div>
                    </div>
                @endif
                @if($buttonText && $buttonLink)
                    <div class="header-icon">
                        <div class="header-button">
                            <a href="{{ $buttonLink }}" class="btn theme-custom-bg-2 btn-small btn-round-edge btn-hover-animation-switch">
                            <span>
                                <span class="btn-text fs-15">{{ $buttonText }}</span>
                                <span class="btn-icon"><i class="feather icon-feather-arrow-right icon-very-small"></i></span>
                                <span class="btn-icon"><i class="feather icon-feather-arrow-right icon-very-small"></i></span>
                            </span>
                            </a>
                        </div>
                    </div>
                @endif

                {{-- <div class="header-social-icon icon">
                                       @foreach($socialMediaLinks as $social)
                                           <a href="{{ $social->link }}" target="_blank" aria-label="{{ $social->type }}">
                                               @if($social->customIcon)
                                                   <i class="{{ $social->customIcon }}"></i>
                                               @elseif($social->icon)
                                                   <x-icon :name="$social->icon" style="max-height:20px"/><span></span>
                                               @endif
                                           </a>
                                       @endforeach
                                   </div>  --}}
            </div>

        </div>
        </div>
    </nav>
</header>




