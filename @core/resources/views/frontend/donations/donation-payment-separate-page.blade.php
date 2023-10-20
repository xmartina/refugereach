@extends('frontend.frontend-page-master')

@section('og-meta')
    <meta property="og:url" content="{{route('frontend.donations.single',$donation->slug)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$donation->title}}"/>
    {!! render_og_meta_image_by_attachment_id($donation->image) !!}
@endsection

@section('site-title')
    {{$donation->title}}
@endsection

@section('page-title')
    {{$donation->title}}
@endsection

@section('page-meta-data')
    <meta name="description" content="{{$donation->meta_tags}}">
    <meta name="tags" content="{{$donation->meta_description}}">
@endsection

@section('style')
    <x-media.css/>
@endsection


@section('content')
    @php
        $selected_amount = request()->get('number');
    @endphp
    <section class="blog-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="donation_wrapper">
                        <div class="btn-wrapper">
                            <a href="{{route('frontend.donations.single',$donation->slug)}}"
                               class="goback-btn pull-right">{{__('Go Back')}}</a>
                        </div>

                        <x-msg.error/>
                        <x-msg.success/>

                        <form action="{{route('frontend.donations.log.store')}}" method="post" enctype="multipart/form-data" class="donation-form-wrapper">
                         @csrf
                            <input type="hidden" name="cid" value="">
                            <input type="hidden" name="cause_id" value="{{$donation->id}}">
                            <div class="tab_section mb-4">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <input type="hidden" name="payment_type" class="payment_type" value="once">
                                        <a class="nav-link active once_tab" id="nav-home-tab" data-toggle="tab" href="#one_time_donation_tab" role="tab" aria-controls="nav-home" aria-selected="true">{{__('Once')}}</a>
                                        <a class="nav-link ml-2 monthly_tab" id="nav-profile-tab" data-toggle="tab" href="#monthly_donation_tab" role="tab" aria-controls="nav-profile" aria-selected="false">{{__('Monthly')}}</a>
                                    </div>
                                </nav>

                                <div class="tab-content" id="nav-tabContent">
                                    {{--Tab One--}}
                                    <div class="tab-pane fade show active" id="one_time_donation_tab" role="tabpanel" >
                                        <div class="single_amount_wrapper">
                                            @php
                                                $custom_amounts_once  =  get_static_option('donation_custom_amount_once');
                                                $custom_amounts_once = !empty($custom_amounts_once) ? explode(',',$custom_amounts_once) : [50,100,150,200];
                                                $minimum_donation_amount = get_static_option('minimum_donation_amount');
                                            @endphp
                                            @foreach($custom_amounts_once as $amount)
                                                <div class="single_amount @if($selected_amount === $amount) selected @endif" data-value="{{trim($amount)}}" >
                                                    {{amount_with_currency_symbol($amount)}}
                                                </div>
                                            @endforeach
                                        </div>

                                        <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                        <div class="amount_wrapper">
                                            <div class="suffix">{{get_static_option('site_global_currency')}}</div>

                                            <input type="number" name="amount" @php $default_donation_amount = trim(get_static_option('donation_default_amount')); @endphp
                                            value="{{$selected_amount ?? $default_donation_amount}}" step="1" maxlength="6" inputmode="numeric"
                                                   min="1" id="donation_amount_user_input" class="bg-info text-light"><br>
                                        </div>
                                    </div>

                                    {{--Tab Two--}}
                                    <div class="tab-pane fade" id="monthly_donation_tab" role="tabpanel">
                                        <div class="single_amount_wrapper">
                                            @php
                                                $custom_amounts_monthly  =  get_static_option('donation_custom_amount_monthly');
                                                $custom_amounts_monthly = !empty($custom_amounts_monthly) ? explode(',',$custom_amounts_monthly) : [50,100,150,200];
                                                $minimum_donation_amount = get_static_option('minimum_donation_amount');
                                            @endphp
                                            @foreach($custom_amounts_monthly as $amount)
                                                <div class="single_amount @if($selected_amount === $amount) selected @endif" data-value="{{trim($amount)}}" >
                                                    {{amount_with_currency_symbol($amount)}}
                                                </div>
                                            @endforeach
                                        </div>

                                        <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                        <div class="amount_wrapper">
                                            <div class="suffix">{{get_static_option('site_global_currency')}}</div>

                                            <input type="number" name="amount" @php $default_donation_amount = trim(get_static_option('donation_default_amount')); @endphp
                                            value="{{$selected_amount ?? $default_donation_amount}}" step="1" maxlength="6" inputmode="numeric"
                                                   min="1" id="donation_amount_user_input" class="bg-info text-light"><br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            @if(!empty($minimum_donation_amount))
                                <small class="text-primary">{{__('Minimum Donation Amount is:') . amount_with_currency_symbol($minimum_donation_amount)}}</small>
                            @endif

                            <div class="form-group mt-2">
                                <input type="text" name="name" placeholder="{{__('Name')}}"
                                       @if(auth()->guard('web')->check())
                                           value="{{auth()->guard('web')->user()->name}}"
                                       @endif
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="{{__('Email')}}"
                                       @if(auth()->guard('web')->check())
                                           value="{{auth()->guard('web')->user()->email}}"
                                       @endif
                                       class="form-control">
                            </div>


                            {!! render_form_field_for_frontend(get_static_option('donation_page_form_fields')) !!}

                            <div class="form-check">
                                <input type="checkbox" name="anonymous" class="form-check-input" id="anonymous">
                                <label class="form-check-label" for="anonymous">{{__('Donate Anonymously')}}</label>
                            </div>

                            @if(!empty(get_static_option('allow_user_to_add_custom_tip_in_donation')))
                                <input type="hidden" name="admin_tip" value="{{\App\Helpers\DonationHelpers::get_donation_charge($selected_amount ?? $default_donation_amount)}}">
                            @endif

                            {!! render_payment_gateway_for_form() !!}
                            @if(!empty(get_static_option('manual_payment_gateway')))
                                <div class="form-group manual_payment_transaction_field">
                                    <div class="label">{{__('Attach Your Bank Document')}}</div>
                                    <input class="form-control btn btn-warning btn-sm" type="file" name="manual_payment_attachment">
                                    <span class="help-info">{!! get_manual_payment_description() !!}</span>
                                </div>
                            @endif
                            <div class="donate-seperate-page-button">
                                <div class="btn-wrapper">
                                    <button class="boxed-btn reverse-color btn-sm" type="submit">
                                        {{get_static_option('donation_single_form_button_text')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="donation-amount-details-wrapper">
                        <h3 class="title">{{__('Your Donation Details')}}</h3>
                        <div class="your-area-donation-wrap">
                            <div class="thumb">
                                {!! render_image_markup_by_attachment_id($donation->image,'','thumb') !!}
                            </div>
                            <div class="content">
                                <h4 class="title">{{$donation->title}}</h4>
                                <span class="created_by">{{__('Created By')}}
                                    @if($donation->created_by === 'user')
                                        {{\App\User::find($donation->user_id)->name ?? __('Anonymous')}}
                                    @else
                                        {{\App\Admin::find($donation->admin_id)->name ?? __('Anonymous')}}
                                    @endif
                          </span>
                            </div>
                        </div>
                        <ul>
                            <li><span>{{__('Your Donation')}}</span>
                                <span class="price donation_amount">{{amount_with_currency_symbol($selected_amount ?? $default_donation_amount)}}</span>
                            </li>
                            @if(empty(get_static_option('donation_charge_form')) || get_static_option('donation_charge_form') === 'donor')
                                <li>
                                    <span>{{get_static_option('site_title')}} {{__('tip')}}</span>
                                    <span class="price admin_tip">
                                        @if(!empty(get_static_option('allow_user_to_add_custom_tip_in_donation')))
                                        <span class="input-wrap"><input type="number" name="custom_admin_tip" min="1" value="{{\App\Helpers\DonationHelpers::get_donation_charge($selected_amount ?? $default_donation_amount)}}"></span>
                                        @else
                                       <span class="amount"> {{\App\Helpers\DonationHelpers::get_donation_charge($selected_amount ?? $default_donation_amount,true)}}</span>
                                        @endif
                                    </span>
                                </li>
                            @endif
                            <li class="total"><span>{{__('Total')}}</span> <span class="price total_amount">{{\App\Helpers\DonationHelpers::get_donation_total($selected_amount ?? $default_donation_amount,true) }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-media.markup
            :userUpload="true"
            :imageUploadRoute="route('user.upload.media.file')">
    </x-media.markup>
@endsection

@section('scripts')
    <script src="{{asset('assets/frontend/js/jQuery.rProgressbar.min.js')}}"></script>
    <script>
        (function ($) {
            'use strict';
            $(document).ready(function () {

                //Sohan Custom Js
                $(document).on('click','.once_tab',function(){
                    $('.payment_type').val('once')
                })

                $(document).on('click','.monthly_tab',function(){
                    $('.payment_type').val('monthly')
                })

                function updateDonationAmount(){
                    var donation_amount_user_input = $('#donation_amount_user_input').val();
                    var admin_tip = $('input[name="admin_tip"]').val();

                    $.ajax({
                        url: "{{ route('frontend.get.donation.charges.by.ajax') }}",
                        type: 'post',
                        dataType: 'JSON',
                        data: {
                            _token: "{{csrf_token()}}",
                            amount: donation_amount_user_input,
                            admin_tip: admin_tip,
                        },
                        success: function (data) {
                            var parent = $('.donation-amount-details-wrapper');
                            parent.find('.donation_amount').text(data.donation_amount);
                            parent.find('.admin_tip .amount').text(data.tip);
                            parent.find('.total_amount').text(data.total);
                        }
                    });
                }
                //Donation Charge
                $(document).on('keyup change', 'input[name="custom_admin_tip"]', function () {
                    var el = $(this);
                   calcCustomTip(el);
                });

                function calcCustomTip(el){
                    var currentVal = el.val();
                    var changeVal;
                    if(currentVal > 0){
                        changeVal = currentVal
                    }else{
                        el.val(1);
                        changeVal = 1
                    }
                    $('input[name="admin_tip"]').val(changeVal);
                    updateDonationAmount();
                }

                $(document).on('keyup', '#donation_amount_user_input', function () {
                    updateDonationAmount();
                });

                //name="amount"
                $(document).on('input', '#one_time_donation_tab input[name="amount"]', function (e) {
                    e.preventDefault();
                    $('#monthly_donation_tab input[name="amount"]').val($(this).val());
                });

                $(document).on('input', '#monthly_donation_tab input[name="amount"]', function (e) {
                    e.preventDefault();
                    $('#one_time_donation_tab input[name="amount"]').val($(this).val());
                });

                /*------------------------------
                    donate activation
                -------------------------------*/
                $(document).on('click', '.donation_wrapper .single_amount', function (e) {
                    e.preventDefault();
                    $(this).addClass('selected').siblings().removeClass('selected');
                    $('input[name="amount"]').val($(this).data('value')).trigger('keyup');
                });

                var defaulGateway = $('#site_global_payment_gateway').val();
                $('.payment-gateway-wrapper ul li[data-gateway="' + defaulGateway + '"]').addClass('selected');

                $(document).on('click', '.payment-gateway-wrapper > ul > li', function (e) {
                    e.preventDefault();
                    var gateway = $(this).data('gateway');
                    if (gateway == 'manual_payment') {
                        $('.manual_payment_transaction_field').addClass('show');
                    } else {
                        $('.manual_payment_transaction_field').removeClass('show');
                    }
                    $(this).addClass('selected').siblings().removeClass('selected');
                    $('.payment-gateway-wrapper').find(('input')).val(gateway);
                });


            });

        })(jQuery);
    </script>
    <x-media.js
            :deleteRoute="route('user.upload.media.file.delete')"
            :imgAltChangeRoute="route('user.upload.media.file.alt.change')"
            :allImageLoadRoute="route('user.upload.media.file.all')">
    </x-media.js>
@endsection
