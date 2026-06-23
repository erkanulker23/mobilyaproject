@php
$target = $parent .'-accordion-' . $item->slug;
@endphp

<article class="faq_v1_card" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <div class="faq_v1_question collapsed"
         role="button"
         data-bs-toggle="collapse"
         data-bs-target="#{{ $target }}"
         aria-expanded="{{ $active ? 'true' : 'false' }}"
         aria-controls="{{ $target }}">
        <div class="faq_v1_question_content">
            <span class="faq_v1_number">{{ sprintf('%02d', $index) }}</span>
            <h3 class="faq_v1_question_title" itemprop="name">
                {{ $item->title }}
            </h3>
        </div>
        <div class="faq_v1_icon">
            <i class="fas fa-plus"></i>
        </div>
    </div>
    <div id="{{ $target }}"
         class="faq_v1_answer collapse {{ $active ? 'show' : '' }}"
         data-bs-parent="#{{ $parent }}-accordion"
         itemscope
         itemprop="acceptedAnswer"
         itemtype="https://schema.org/Answer">
        <div class="faq_v1_answer_text" itemprop="text">
            {!! $item->description !!}
        </div>
    </div>
</article>
