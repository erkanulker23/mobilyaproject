<section class="request_form_variant7" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="request_form_v7_box">
                    <div class="row g-0">
                        <div class="col-lg-7">
                            <div class="request_form_v7_form_area">
                                <h2 class="request_form_v7_title">{{ $title }}</h2>
                                <p class="request_form_v7_subtitle">{{ $subtitle }}</p>

                                <livewire:request-form
                                    view="frontend.components.request_form_section.components.variant_7_form"
                                    :topics="$topics"
                                    :buttonText="$buttonText"
                                />
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="request_form_v7_sidebar">
                                <h3>İletişim</h3>
                                <div class="request_form_v7_contact_list">
                                    <div class="item">
                                        <span class="icon">📞</span>
                                        <div>
                                            <strong>Telefon</strong>
                                            <a href="tel:{{ $phone }}">{{ $phone }}</a>
                                        </div>
                                    </div>
                                    @if($email)
                                    <div class="item">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
