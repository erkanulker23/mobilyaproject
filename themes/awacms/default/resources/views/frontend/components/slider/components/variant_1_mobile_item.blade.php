<!-- start slider item -->
<div class="swiper-slide overflow-hidden mobilslider">
    <div class="mobileslider w-100 min-vh-70 d-flex align-items-center" data-swiper-parallax="500">

        <!-- Arkaplan görseli (Lazy Load ile) -->
        @php
            $imageUrl = $slide->mobileImageUrl ?? asset('images/default-image.webp');
            $srcset = implode(',', array_filter([
                isset($slide->mobileImageUrlSmall) ? $slide->mobileImageUrlSmall . ' 400w' : null,
                isset($slide->mobileImageUrlMedium) ? $slide->mobileImageUrlMedium . ' 600w' : null,
                isset($slide->mobileImageUrlLarge) ? $slide->mobileImageUrlLarge . ' 800w' : null,
            ]));
        @endphp

        <img src="{{ $imageUrl }}"
             srcset="{{ $srcset }}"
             sizes="(max-width: 500px) 400px, (max-width: 991px) 600px, 800px"
             alt="{{ $slide->title ? $slide->title : 'Slider image' }}"
             class="w-100 h-100 lazyload"
             width="800" height="925"
             loading="{{ $loop->first ? 'eager' : 'lazy' }}"
             style="object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;"
             data-no-retina="">

        <div class="container">
            <div class="row justify-content-start">
                <div class="col-12 col-md-8 mobilpadding position-relative text-left"
                     data-anime='@json([
                         "el" => "childs",
                         "translateX" => [500, 0]
                     ])'>

                    @if(!empty($slide->title) || !empty($slide->subtitle) || !empty($slide->content))
                        <!-- Başlık (küçük) -->
                        @if(!empty($slide->title) || $slide->showTitleOnMobile)
                            <div
                                class="ps-25px pe-25px pt-5px pb-5px mb-25px text-uppercase @if ($slide->titleColor) text-white @endif fs-12 ls-1px fw-600 border-radius-100px bg-gradient-dark-gray-transparent d-flex w-70 sm-w-100"
                                @if ($slide->subtitleColor) style="color: {{ $slide->subtitleColor }} @endif>
                                {{ $slide->title }}
                            </div>
                        @endif

                        <!-- Alt Başlık (kalın ve büyükçe) -->
                        @if(!empty($slide->subtitle) || $slide->showSubtitleOnMobile)
                            <div class="fw-700 @if ($slide->subtitleColor) text-white @endif  text-uppercase fs-55 mb-2"
                                @if ($slide->subtitleColor) style="color: {{ $slide->subtitleColor }} @endif
                                >
                                {{ $slide->subtitle }}
                            </div>
                        @endif

                        <!-- Açıklama (İçerik) -->
                        @if(!empty($slide->content) || $slide->showContentOnMobile)
                            <p class="fs-15 @if ($slide->contentColor) text-white @endif mb-3"
                               @if ($slide->contentColor) style="color: {{ $slide->contentColor }} @endif>
                                {{ $slide->content }}
                            </p>
                        @endif
                    @endif

                    <!-- Eğer buton (ctaText) eklenmişse ve link varsa göster -->
                    @if(!empty($slide->ctaText) && !empty($slide->linkUrl))
                        <a aria-label="{{ $slide->subtitle ?? 'Başlık' }} {{ $slide->ctaText }}"
                           href="{{ $slide->linkUrl }}"
                           class="btn btn-black btn-small btn-round-edge d-inline-block">
                            {{ $slide->ctaText }}
                        </a>
                    @endif

                </div>
            </div>
        </div>
     </div>

</div>



