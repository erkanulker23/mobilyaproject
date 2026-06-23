<section class="request_form_variant3"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="request-form-title-3">

    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <h2 id="request-form-title-3" class="request_form_v3_title">{{ $title }}</h2>
                <p class="request_form_v3_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="request_form_v3_card">
                    <livewire:request-form
                        view="frontend.components.request_form_section.components.variant_3_form"
                        :topics="$topics"
                        :buttonText="$buttonText"
                    />

                    <div class="request_form_v3_footer">
                        <div class="request_form_v3_contact_item">
                            <span>📞</span> {{ $phone }}
                        </div>
                        @if($email)
                        <div class="request_form_v3_contact_item">
                            <span>✉️</span> {{ $email }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
