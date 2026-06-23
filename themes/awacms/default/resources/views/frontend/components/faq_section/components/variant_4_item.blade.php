@php
$target = $parent .'-accordion-' . $item->slug;
$icons = ['fa-lightbulb', 'fa-question-circle', 'fa-info-circle', 'fa-check-circle', 'fa-star'];
$iconIndex = ($loop->iteration - 1) % count($icons);
@endphp

<article class="faq_v4_card" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <div class="faq_v4_question collapsed"
         role="button"
         data-bs-toggle="collapse"
         data-bs-target="#{{ $target }}"
         aria-expanded="{{ $active ? 'true' : 'false' }}"
         aria-controls="{{ $target }}">
        <div class="faq_v4_icon_wrapper">
            <i class="fas {{ $icons[$iconIndex] }}"></i>
        </div>
        <h3 class="faq_v4_question_title" itemprop="name">
            {{ $item->title }}
        </h3>
        <div class="faq_v4_toggle">
            <i class="fas fa-minus"></i>
        </div>
    </div>
    <div id="{{ $target }}"
         class="faq_v4_answer collapse {{ $active ? 'show' : '' }}"
         data-bs-parent="#{{ $parent }}-accordion"
         itemscope
         itemprop="acceptedAnswer"
         itemtype="https://schema.org/Answer">
        <div class="faq_v4_answer_text" itemprop="text">
            {!! $item->description !!}
        </div>
    </div>
</article>
