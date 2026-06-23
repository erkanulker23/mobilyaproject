<section class="newsletter_variant2"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="newsletter-title-2">

    <div class="container">
        <div class="newsletter_v2_wrapper">
            <div class="row g-0 align-items-center">
                <div class="col-lg-5">
                    <div class="newsletter_v2_content">
                        <div class="newsletter_v2_icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h2 id="newsletter-title-2" class="newsletter_v2_title">{{ $title }}</h2>
                        <p class="newsletter_v2_subtitle">{{ $subtitle }}</p>

                        <ul class="newsletter_v2_benefits">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Haftalık özel içerikler</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Erken erişim fırsatları</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Özel kampanyalar</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="newsletter_v2_form_area">
                        <livewire:newsletter-form view="frontend.components.newsletter_form_section.components.variant_2_form" />

                        <p class="newsletter_v2_privacy">
                            🔒 E-posta adresiniz güvende. Spam göndermiyoruz.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

