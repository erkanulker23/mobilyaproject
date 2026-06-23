<section class="team-variant3"
style="background-color: {{ isset($bgColor) ? $bgColor : '#2d1866' }}{{ !empty($bgImage) ? ';background-image:url(\'' . $bgImage . '\')' : '' }}">

        <div class="container">
            <div class="sec-head">
            <h6 class="sub-title">{{ $title }}</h6>
            <h2 class="main-title">{{ $subtitle }}</h2>
            </div>
            <div class="swiper team-swiper-3">
                <div class="swiper-wrapper">

                @foreach($members as $member)
                    <div class="swiper-slide">
                        <div class="team-card">
                            <div class="img">
                                <img src="{{ $member->photo }}" alt="{{ $member->fullName }}">
                            </div>
                            <div class="info">
                                <a href="/" class="name">{{ $member->fullName }}</a>
                                <span class="role">{{ $member->position }}</span>
                                <div class="social">
                                @foreach($member->socialMediaLinks as $social)
                                <a aria-label="{{ $social->type }}"
                                href="{{ $social->link }}"
                                target="_blank" class="{{ $social->type }}">

                                    @if($social->icon)
                                    <x-icon :name="$social->icon" style="max-height:15px"/><span></span>
                                    @endif</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>