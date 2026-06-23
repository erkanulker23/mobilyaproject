<section class="request_form_variant2"
         @if($bgColor) style="background-color: {{ $bgColor }};" @endif
         aria-labelledby="request-form-title-2">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center mb-5">
                <h2 id="request-form-title-2" class="request_form_v2_title">{{ $title }}</h2>
                <p class="request_form_v2_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="request_form_v2_info_card">
                    <h3>İletişim Bilgileri</h3>
                    <ul class="request_form_v2_info_list">
                        <li>
                            <span class="icon">📞</span>
                            <div>
                                <strong>Telefon</strong>
                                <a href="tel:{{ $phone }}">{{ $phone }}</a>
                            </div>
                        </li>
                        @if($email)
                        <li>
                            <span class="icon">✉️</span>
                            <div>
                                <strong>E-Posta</strong>
                                <a href="mailto:{{ $email }}">{{ $email }}</a>
                            </div>
                        </li>
                        @endif
                        <li>
                            <span class="icon">⏰</span>
                            <div>
                                <strong>Çalışma Saatleri</strong>
                                <span>Pzt-Cuma: 09:00 - 18:00</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="request_form_v2_form_card">
                    <livewire:request-form
                        view="frontend.components.request_form_section.components.variant_2_form"
                        :topics="$topics"
                        :buttonText="$buttonText"
                    />
                </div>
            </div>
        </div>
    </div>
</section>
