@php
$target = $parent .'-accordion-' . $item->slug;
@endphp

<article class="faq_v2_card" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <div class="faq_v2_question"
         role="button"
         data-bs-toggle="collapse"
         data-bs-target="#{{ $target }}"
         aria-expanded="{{ $active ? 'true' : 'false' }}"
         aria-controls="{{ $target }}">
        <h3 class="faq_v2_question_title" itemprop="name">
            {{ $item->title }}
        </h3>
        <div class="faq_v2_icon">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
    <div id="{{ $target }}"
         class="faq_v2_answer collapse {{ $active ? 'show' : '' }}"
         data-bs-parent="#{{ $parent }}-accordion"
         itemscope
         itemprop="acceptedAnswer"
         itemtype="https://schema.org/Answer">
        <div class="faq_v2_answer_text" itemprop="text">
            {!! $item->description !!}
        </div>
    </div>
</article>
