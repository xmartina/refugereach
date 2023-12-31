<div class="contribute-single-item">
    <div class="thumb">
        <a href="{{route('frontend.donations.single',$slug)}}">
           {!! render_image_markup_by_attachment_id($image,'','grid') !!}
        </a>

            <div class="award-flex-position">
                @if(isset($featured) && $featured === 'on')
                    <div class="award-new-icon">
                        <i class="las la-award"></i>
                    </div>
                @endif

                @if(isset($reward) && $reward === 'on')
                    <div class="award-new-icon">
                        <i class="las la-gift"></i>
                    </div>
                @endif
            </div>

    </div>
    <div class="content">
        <div class="progress-content">
            <div class="progress-item">
                <div class="single-progressbar">
                    <div class="donation-progress" data-percentage="{{get_percentage($amount,$raised)}}"></div>
                </div>
            </div>
            <div class="goal">
                <h4 class="raised">{{__('Raised')}}: {{amount_with_currency_symbol($raised ?? 0 )}}</h4>
                <h4 class="raised">{{__('Goal')}}: {{amount_with_currency_symbol($amount)}}</h4>
            </div>
        </div>
        <h3 class="title">
            <a href="{{route('frontend.donations.single',$slug)}}">{{$title}}</a>
        </h3>
        <div class="excpert">
            {{$excerpt}}
        </div>
        <div class="btn-wrapper margin-top-30">
            <a href="{{route('frontend.donations.single',$slug)}}" class="boxed-btn">{{$buttontext}}</a>
        </div>
    </div>
</div>