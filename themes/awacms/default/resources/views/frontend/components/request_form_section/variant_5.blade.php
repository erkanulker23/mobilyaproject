<section class="request_form_variant5" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 class="request_form_v5_title">{{ $title }}</h2>
                <p class="request_form_v5_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <livewire:request-form
                    view="frontend.components.request_form_section.components.variant_5_form"
                    :topics="$topics"
                    :buttonText="$buttonText"
                />

                <div class="request_form_v5_contact text-center mt-4">
                    <div class="request_form_v5_contact_item">
                        <span class="icon">📞</span>
                        <a href="tel:{{ $phone }}">{{ $phone }}</a>
                    </div>
                    @if($email)
                    <div class="request_form_v5_contact_item">
                        <span class="icon">✉️</span>
                        <a href="mailto:{{ $email }}">{{ $email }}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
