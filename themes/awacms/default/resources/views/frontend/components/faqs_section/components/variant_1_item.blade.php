@php
$target = $parent .'-accordion-' .$item->slug;
@endphp




<!-- start accordion item -->
<div class="accordion-item {{ $active }}">
    <div class="accordion-header border-bottom border-color-extra-medium-gray">
        <a
            href="#"
            role="button" 
            data-bs-toggle="collapse"
            data-bs-target="#{{$target}}"
            aria-expanded="true"
            data-bs-parent="#{{ $parent }}">
            <div class="accordion-title mb-0 position-relative text-dark-gray">
                <i class="feather @if($active) icon-feather-plus @else icon-feather-minus @endif fs-18"></i><span class="fs-17 fw-600 ls-minus-05px">
                    {{ $item->title }}
                </span>
            </div>
        </a>
    </div>
    <div id="{{$target}}" class="accordion-collapse collapse" data-bs-parent="#{{ $parent }}">
        <div class="accordion-body text-dark fs-15 last-paragraph-no-margin border-bottom border-color-transparent-dark-very-light">
            {!! $item->description !!}
        </div>
    </div>
</div>
<!-- end accordion item -->
