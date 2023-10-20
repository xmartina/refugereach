@extends('backend.admin-master')
@section('site-title')
    {{__('Donation Settings')}}
@endsection

@section('style')
    <x-media.css/>
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">

            <div class="col-12 mt-5">
                <x-msg.success/>
                <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Donation Settings")}}</h4>
                        <form action="{{route('admin.donations.settings')}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="navbar_button">{{__('Donation Charge - Active/Deactivate')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_charge_active_deactive_button"
                                           @if(!empty(get_static_option('donation_charge_active_deactive_button'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="donation_charge_form">{{__('Donation Charge From')}}</label>
                                <select class="form-control" name="donation_charge_form">
                                    <option value="donor" @if (get_static_option('donation_charge_form') == 'donor')  selected @endif >{{ __('Donor') }}</option>
                                    <option value="campaign_owner"  @if (get_static_option('donation_charge_form') == 'campaign_owner') selected @endif>{{ __('Campaign Owner') }}</option>
                                </select>
                                <span class="info-text">{{__('you can set where you charge from donor (user) or campaign owner ( who created campaign )')}}</span>
                            </div>
                            <div class="form-group">
                                <label for="donation_button_text">{{__('Donation Charge Type')}}</label>
                                <select class="form-control" name="charge_amount_type">
                                    <option value="fixed"
                                            @if (get_static_option('charge_amount_type') == 'fixed')  selected @endif >{{ __('Fixed Amount') }}</option>
                                    <option value="percentage"
                                            @if (get_static_option('charge_amount_type') == 'percentage') selected @endif>{{ __('Percentage Amount') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="donation_button_text">{{__('Donation Charge')}}</label>
                                <input type="text" name="charge_amount" class="form-control"
                                       value="{{get_static_option('charge_amount')}}" id="donation_button_text">
                            </div>
                            <div class="form-group">
                                <label for="allow_user_to_add_custom_tip_in_donation">{{__('Allow User To Add Custom Tip In Donation')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="allow_user_to_add_custom_tip_in_donation"
                                           @if(!empty(get_static_option('allow_user_to_add_custom_tip_in_donation'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="user_campaign_metadata_status">{{__('User Campaign Meta Data Input - Active/Deactivate')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="user_campaign_metadata_status"
                                           @if(!empty(get_static_option('user_campaign_metadata_status'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="donation_button_text">{{__('Donation Button Text')}}</label>
                                <input type="text" name="donation_button_text" class="form-control"
                                       value="{{get_static_option('donation_button_text')}}" id="donation_button_text">
                            </div>
                            <div class="form-group">
                                <label for="donation_raised_text">{{__('Raised Text')}}</label>
                                <input type="text" name="donation_raised_text" class="form-control"
                                       value="{{get_static_option('donation_raised_text')}}" id="donation_raised_text">
                            </div>
                            <div class="form-group">
                                <label for="donation_goal_text">{{__('Goal Text')}}</label>
                                <input type="text" name="donation_goal_text" class="form-control"
                                       value="{{get_static_option('donation_goal_text')}}" id="donation_goal_text">
                            </div>

                            <div class="form-group">
                                <label for="site_events_post_items">{{__('Donation Page Items')}}</label>
                                <input type="text" name="donor_page_post_items" class="form-control"
                                       value="{{get_static_option('donor_page_post_items')}}"
                                       id="donor_page_post_items">
                                <span class="info-text">{{__('how many item you want to show in donation page')}}</span>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="donation_single_form_button_text">{{__('Form Button Title')}}</label>
                                <input type="text" name="donation_single_form_button_text"  class="form-control" value="{{get_static_option('donation_single_form_button_text')}}">
                            </div>
                            <div class="form-group">
                                <label for="donation_single_recent_donation_text">{{__('Recent Donation Title')}}</label>
                                <input type="text" name="donation_single_recent_donation_text"  class="form-control" value="{{get_static_option('donation_single_recent_donation_text')}}">
                            </div>
                            <div class="form-group">
                                <label for="donation_single_faq_title">{{__('Donation Page Faq Title')}}</label>
                                <input type="text" name="donation_single_faq_title"  class="form-control" value="{{get_static_option('donation_single_faq_title')}}">
                            </div>
                            <div class="form-group">
                                <label for="donation_custom_amount">{{__('Custom Donation Once Amount')}}</label>
                                <input type="text" name="donation_custom_amount_once"  class="form-control" value="{{get_static_option('donation_custom_amount_once')}}" id="donation_custom_amount_once">
                                <p>{{__('Separate amount by comma (,)')}}</p>
                            </div>
                            <div class="form-group">
                                <label for="donation_custom_amount">{{__('Custom Donation Monthly Amount')}}</label>
                                <input type="text" name="donation_custom_amount_monthly"  class="form-control" value="{{get_static_option('donation_custom_amount_monthly')}}" id="donation_custom_amount_monthly">
                                <p>{{__('Separate amount by comma (,)')}}</p>
                            </div>
                            <div class="form-group">
                                <label for="donation_default_amount">{{__('Default Donation Amount')}}</label>
                                <input type="number" name="donation_default_amount"  class="form-control" value="{{get_static_option('donation_default_amount')}}" id="donation_default_amount">
                            </div>
                            <div class="form-group">
                                <label for="minimum_donation_amount">{{__('Minimum Donation Amount')}}</label>
                                <input type="number" name="minimum_donation_amount"  class="form-control" value="{{get_static_option('minimum_donation_amount')}}" id="minimum_donation_amount">
                                <small>{{__('If you dont want to set minimum amount of donation than you can leave this field blank..!')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="donation_notify_mail">{{__('Donation Notify Email')}}</label>
                                <input type="email" name="donation_notify_mail"  class="form-control" value="{{get_static_option('donation_notify_mail')}}" id="donation_notify_mail">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="cause_single_donate_button_text">{{__('Cause Single Page Donate Button Text')}}</label>
                                <input type="text" name="cause_single_donate_button_text"  class="form-control" value="{{get_static_option('cause_single_donate_button_text')}}" id="cause_single_donate_button_text">
                            </div>
                            <div class="form-group">
                                <label for="cause_single_donate_sidebar_text">{{__('Cause Single Page sidebar Text')}}</label>
                                <input type="text" name="cause_single_donate_sidebar_text"  class="form-control" value="{{get_static_option('cause_single_donate_sidebar_text')}}" >
                            </div>
                            <div class="form-group">
                                <label for="navbar_button">{{__('Show/Hide Donation Countdown')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_single_page_countdown_status"
                                           @if(!empty(get_static_option('donation_single_page_countdown_status'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <hr>

                            <div class="form-group">
                                <label for="donation_success_page_title">{{__('Success Page Main Title')}}</label>
                                <input type="text" name="donation_success_page_title"  class="form-control" value="{{get_static_option('donation_success_page_title')}}" id="donation_success_page_title">
                            </div>
                            <div class="form-group">
                                <label for="donation_success_page_description">{{__('Success Page Description')}}</label>
                                <textarea name="donation_success_page_description" class="form-control" id="donation_success_page_description" cols="30" rows="5">{{get_static_option('donation_success_page_description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="donation_cancel_page_description">{{__('Cancel Description')}}</label>
                                <textarea name="donation_cancel_page_description" class="form-control" id="donation_cancel_page_description" cols="30" rows="5">{{get_static_option('donation_cancel_page_description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="donation_cancel_page_title">{{__('Cancel Main Title')}}</label>
                                <input type="text" name="donation_cancel_page_title"  class="form-control" value="{{get_static_option('donation_cancel_page_title')}}" id="donation_cancel_page_title">
                            </div>
                            <div class="form-group">
                                <label for="donation_deadline_text">{{__('Donation Deadline Text')}}</label>
                                <input type="text" name="donation_deadline_text" class="form-control" id="donation_deadline_text" value="{{get_static_option('donation_deadline_text')}}">
                            </div>
                            <div class="form-group">
                                <label for="donation_deadline_text">{{__('Medical Document Button Text')}}</label>
                                <input type="text" name="donation_medical_document_button_text" class="form-control" id="donation_deadline_text" value="{{get_static_option('donation_medical_document_button_text')}}">
                            </div>
                            <div class="form-group">
                                <label for="donation_deadline_text">{{__('Emmergency Donation Text')}}</label>
                                <input type="text" name="emmergency_donation_text" class="form-control" id="emmergency_donation_text" value="{{get_static_option('emmergency_donation_text')}}">
                            </div>
                            <div class="form-group">
                                <label for="donation_deadline_text">{{__('Related Donation Text')}}</label>
                                <input type="text" name="releated_donation_text" class="form-control" id="emmergency_donation_text" value="{{get_static_option('releated_donation_text')}}">
                            </div>

                            <div class="form-group">
                                <label for="donation_deadline_text">{{__('Reward Heading')}}</label>
                                <input type="text" name="donation_single_reward_heading" class="form-control" id="donation_single_reward_heading" value="{{get_static_option('donation_single_reward_heading')}}">
                            </div>
                            <div class="form-group">
                                <label for="donation_deadline_text">{{__('Reward title')}}</label>
                                <input type="text" name="donation_single_reward_title" class="form-control" id="donation_single_reward_title" value="{{get_static_option('donation_single_reward_title')}}">
                            </div>

                            <div class="form-group">
                                <label for="donation_deadline_text">{{__('Enter how many days ago user will get notification monthly recuring donation invoice with email')}}</label>
                                <input type="number" min="1" class="form-control" name="how_many_days_ago_user_get_recuring_notification" value="{{get_static_option('how_many_days_ago_user_get_recuring_notification')}}">
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="donation_deadline_text">{{__('Reward Image')}}</label>
                                <x-image :name="'donation_single_reward_image'" :id="'donation_single_reward_image'" :value="'donation_single_reward_image'"/>
                            </div>

                            <div class="form-group">
                                <label for="navbar_button">{{__('Show/Hide Donation Medical Document Button')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_medical_document_button_show_hide"
                                           @if(!empty(get_static_option('donation_medical_document_button_show_hide'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button">{{__('Show/Hide Donation Flag')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_flag_show_hide"
                                           @if(!empty(get_static_option('donation_flag_show_hide'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="navbar_button">{{__('Show/Hide Donation FAQ')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_faq_show_hide"
                                           @if(!empty(get_static_option('donation_faq_show_hide'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button">{{__('Show/Hide Donation Description')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_descriptions_show_hide"
                                           @if(!empty(get_static_option('donation_descriptions_show_hide'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button">{{__('Show/Hide Donation Updates')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_updates_show_hide"
                                           @if(!empty(get_static_option('donation_updates_show_hide'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button">{{__('Show/Hide Donation Comments')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_comments_show_hide"
                                           @if(!empty(get_static_option('donation_comments_show_hide'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button">{{__('Show/Hide Social Share ')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_social_icons_show_hide"
                                           @if(!empty(get_static_option('donation_social_icons_show_hide'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button">{{__('Show/Hide Recent Donors')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_recent_donors_show_hide"
                                           @if(!empty(get_static_option('donation_recent_donors_show_hide'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="navbar_button">{{__('Show/Hide Donate Button (Only Login user can see and Donate)')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="donation_login_user_donate_show_hide"
                                           @if(!empty(get_static_option('donation_login_user_donate_show_hide'))) checked @endif >
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <button id="update" type="submit"
                                    class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection

@section('script')
    <script>
        <x-btn.update/>
    </script>
        <x-media.js/>
@endsection
