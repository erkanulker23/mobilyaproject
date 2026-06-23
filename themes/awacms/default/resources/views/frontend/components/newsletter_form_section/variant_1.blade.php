<section class="newsletter_variant1"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="newsletter-title-1">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <div class="newsletter_v1_badge">📧 Newsletter</div>
                <h2 id="newsletter-title-1" class="newsletter_v1_title">{{ $title }}</h2>
                <p class="newsletter_v1_subtitle">{{ $subtitle }}</p>

                <div class="newsletter_v1_form_wrapper">
                    <livewire:newsletter-form view="frontend.components.newsletter_form_section.components.variant_1_form" />
                </div>

                <p class="newsletter_v1_privacy">
                    <span class="icon">🔒</span>
                    Gizliliğinize saygı duyuyoruz. E-posta adresiniz asla paylaşılmayacaktır.
                </p>
            </div>
        </div>
    </div>
</section>
