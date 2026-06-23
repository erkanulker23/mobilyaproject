<section class="faq_variant4"
         style="background-color: {{ isset($bgColor) ? $bgColor : '#f9fafb' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\'); background-size: cover; background-position: center;' : '' }};"
         itemscope
         itemtype="https://schema.org/FAQPage"
         aria-labelledby="faq-title-4">

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <span class="faq_v4_label">Support</span>
                <h2 id="faq-title-4" class="faq_v4_title" itemprop="name">
                    {{ $title ?? 'How can we help?' }}
                </h2>
                <p class="faq_v4_subtitle" itemprop="description">
                    {{ $subtitle ?? 'Browse through our frequently asked questions' }}
                </p>
            </div>
        </div>

        <div class="faq_v4_list" id="{{ $faq->slug }}-accordion">
            @foreach($faq->items as $faqItem)
                @include('frontend.components.faq_section.components.variant_4_item', [
                    'item' => $faqItem,
                    'active' => $loop->first ? 'active' : '',
                    'parent' => $faq->slug,
                ])
            @endforeach
        </div>
    </div>
</section>
