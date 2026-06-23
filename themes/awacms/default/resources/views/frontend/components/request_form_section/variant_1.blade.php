<section class="request_form_variant1"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="request-form-title-1">

    <div class="container">
        <div class="request_form_v1_header text-center">
            <span class="request_form_v1_badge">İletişim</span>
            <h2 id="request-form-title-1" class="request_form_v1_title">{{ $title }}</h2>
            <p class="request_form_v1_subtitle">{{ $subtitle }}</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="request_form_v1_card">
                    <livewire:request-form
                        view="frontend.components.request_form_section.components.variant_1_form"
                        :topics="$topics"
                        :buttonText="$buttonText"
                    />
                </div>
            </div>
        </div>

        <div class="request_form_v1_footer text-center">
            <p class="request_form_v1_contact">
                <span>Telefon: <a href="tel:{{ $phone }}">{{ $phone }}</a></span>
                @if($email)
                <span class="separator">|</span>
                <span>E-Posta: <a href="mailto:{{ $email }}">{{ $email }}</a></span>
                @endif
            </p>
        </div>
    </div>
</section>
