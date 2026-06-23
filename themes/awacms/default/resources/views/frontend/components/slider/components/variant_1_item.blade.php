<div class="swiper-slide">



<!-- Desktop Image -->
<img class="slider_variant1-image position-absolute w-100 h-100 slidernew d-none d-md-block"
     src="{{ isset($slide->imageUrl) ? $slide->imageUrl : asset('fallback.jpg') }}"
     alt="{{ $slide->title ?? ($slide->subtitle ?? 'Slider görseli') }}"
     loading="eager">

<!-- Mobile Image -->
<img class="slider_variant1-image position-absolute w-100 h-100 slidernew d-block d-md-none"
     src="{{ isset($slide->mobileImageUrl) ? $slide->mobileImageUrl : (isset($slide->imageUrl) ? $slide->imageUrl : asset('fallback.jpg')) }}"
     alt="{{ $slide->title ?? ($slide->subtitle ?? 'Slider görseli') }}"
     loading="lazy">

                    <div class="slider_variant1-content-container">
                        <div class="slider_variant1-content">

                        @if(!empty($slide->title))
                            @if(!empty($slide->subtitle))
                            <p class="@if (! $slide->titleColor) text-white @endif fs-15 ls-1px fw-600 d-flex"
                            @if ($slide->titleColor) style="color: {{ $slide->titleColor }}" @endif>
                            {{ $slide->subtitle }}
                            </h1>
                            @endif

                            <h1 class="@if (! $slide->titleColor) text-white @endif fs-12 ls-1px fw-600 d-flex"
                            @if ($slide->titleColor) style="color: {{ $slide->titleColor }}" @endif>
                            {{ $slide->title }}
                            </h1>
                            @endif

                            @if(!empty($slide->content))
                            <span class="@if (! $slide->titleColor) text-white @endif fs-25 ls-1px fw-600 d-flex"
                            @if ($slide->titleColor) style="color: {{ $slide->titleColor }}" @endif>
                            {{ $slide->content }}
                            </span>
                            @endif

                            @if(!empty($slide->ctaText))
                            <a href="{{ $slide->linkUrl ?? '#' }}"
                            class="btn btn-large btn-switch-text d-table d-lg-inline-block lg-mb-15px md-mx-auto"
                            aria-label="{{ $slide->ctaText }}">
                            {{ $slide->ctaText }}
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
