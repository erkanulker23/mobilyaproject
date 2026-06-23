<section class="request_form_variant4" @if($bgColor) style="background-color: {{ $bgColor }};" @endif>
    <div class="container">
        <div class="mb-4">
            <span class="request_form_v4_label">İletişim</span>
            <h2 class="request_form_v4_title">{{ $title }}</h2>
            <p class="request_form_v4_subtitle">{{ $subtitle }}</p>
        </div>

        <livewire:request-form
            view="frontend.components.request_form_section.components.variant_4_form"
            :topics="$topics"
            :buttonText="$buttonText"
        />
    </div>
</section>
