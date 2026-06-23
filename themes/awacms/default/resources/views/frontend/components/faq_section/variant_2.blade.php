<section class="faq_variant2"
         style="background-color: {{ isset($bgColor) ? $bgColor : '#ffffff' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\'); background-size: cover; background-position: center;' : '' }};"
         itemscope
         itemtype="https://schema.org/FAQPage"
         aria-labelledby="faq-title-2">

    <div class="container">
        <div class="faq_v2_header text-center">
            <h2 id="faq-title-2" class="faq_v2_title" itemprop="name">
                {{ $title ?? 'Frequently Asked Questions' }}
            </h2>
            <p class="faq_v2_subtitle" itemprop="description">
                {{ $subtitle ?? 'Find answers to common questions' }}
            </p>
        </div>

        <div class="row g-4" id="{{ $faq->slug }}-accordion">
            @php
                $items = $faq->items->toArray();
                $halfCount = ceil(count($items) / 2);
                $leftItems = array_slice($items, 0, $halfCount);
                $rightItems = array_slice($items, $halfCount);
            @endphp

            <!-- Left Column -->
            <div class="col-lg-6">
                @foreach($leftItems as $faqItem)
                    @include('frontend.components.faq_section.components.variant_2_item', [
                        'item' => (object) $faqItem,
                        'active' => $loop->first ? 'active' : '',
                        'parent' => $faq->slug,
                    ])
                @endforeach
            </div>

            <!-- Right Column -->
            <div class="col-lg-6">
                @foreach($rightItems as $faqItem)
                    @include('frontend.components.faq_section.components.variant_2_item', [
                        'item' => (object) $faqItem,
                        'active' => false,
                        'parent' => $faq->slug,
                    ])
                @endforeach
            </div>
        </div>
    </div>
</section>
