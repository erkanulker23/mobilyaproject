<section class="request_form_variant6" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
    <div class="container">
        <div class="row justify-content-center mb-5 text-center">
            <div class="col-lg-8">
                <h2 class="request_form_v6_title">{{ $title }}</h2>
                <p class="request_form_v6_subtitle">{{ $subtitle }}</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="request_form_v6_info">
                    <div class="request_form_v6_info_badge">Neden Biz?</div>
                    <h3>Bize Ulaşmalısınız</h3>
                    <ul class="request_form_v6_features">
                        <li>
                            <span class="check">✓</span>
                            <span>Hızlı ve Güvenilir Hizmet</span>
                        </li>
                        <li>
                            <span class="check">✓</span>
                            <span>7/24 Kesintisiz Destek</span>
                        </li>
                        <li>
                            <span class="check">✓</span>
                            <span>Uzman Ekip</span>
                        </li>
                    </ul>
                    <div class="request_form_v6_contact_info">
                        <div class="contact_item">
                            <span class="icon">📞</span>
                            <div>
                                <strong>Telefon</strong>
                                <a href="tel:{{ $phone }}">{{ $phone }}</a>
                            </div>
                        </div>
                        @if($email)
                        <div class="contact_item">
                            <span class="icon">✉️</span>
                            <div>
                                <strong>E-Posta</strong>
                                <a href="mailto:{{ $email }}">{{ $email }}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <livewire:request-form
                    view="frontend.components.request_form_section.components.variant_6_form"
                    :topics="$topics"
                    :buttonText="$buttonText"
                />
            </div>
        </div>
    </div>
</section>
