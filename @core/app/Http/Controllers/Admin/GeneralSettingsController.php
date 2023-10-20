<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FlashMsg;
use App\Http\Controllers\Controller;
use App\Language;
use App\Mail\BasicMail;
use App\MediaUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Spatie\Sitemap\SitemapGenerator;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Mail;
use Xgenious\XgApiClient\Facades\XgApiClient;

class GeneralSettingsController extends Controller
{
    private $base_path = 'backend.general-settings.';

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:general-settings-site-identity',['only',['site_identity','update_site_identity']]);
        $this->middleware('permission:general-settings-basic-settings',['only',['basic_settings','update_basic_settings']]);
        $this->middleware('permission:general-settings-color-settings',['only',['color_settings','update_color_settings']]);
        $this->middleware('permission:general-settings-typography',['only',['typography_settings','get_single_font_variant','update_typography_settings']]);
        $this->middleware('permission:general-settings-seo-settings',['only',['seo_settings','update_seo_settings']]);
        $this->middleware('permission:general-settings-third-party-script',['only',['update_scripts_settings','scripts_settings']]);
        $this->middleware('permission:general-settings-email-template',['only',['email_settings','update_email_settings','email_template_settings','update_email_template_settings']]);
        $this->middleware('permission:general-settings-smtp-settings',['only',['smtp_settings','update_smtp_settings','test_smtp_settings']]);
        $this->middleware('permission:general-settings-regenerate-media-image',['only',['regenerate_image_settings','update_regenerate_image_settings']]);
        $this->middleware('permission:general-settings-page-settings',['only',['page_settings','update_page_settings']]);
        $this->middleware('permission:general-settings-payment-gateway',['only',['payment_settings','update_payment_settings']]);
        $this->middleware('permission:general-settings-custom-js',['only',['custom_js_settings','update_custom_js_settings']]);
        $this->middleware('permission:general-settings-custom-css',['only',['custom_css_settings','update_custom_css_settings']]);
        $this->middleware('permission:general-settings-cache-settings',['only',['cache_settings','update_cache_settings']]);
        $this->middleware('permission:general-settings-gdpr-settings',['only',['gdpr_settings','update_gdpr_cookie_settings']]);
        $this->middleware('permission:general-settings-sitemap',['only',['sitemap_settings','update_sitemap_settings']]);
        $this->middleware('permission:general-settings-rss-feed',['only',['rss_feed_settings','update_rss_feed_settings']]);
        $this->middleware('permission:general-settings-database-upgrade',['only',['database-upgrade','database_upgrade_post']]);
        $this->middleware('permission:general-settings-license',['only',['license_settings','update_license_settings']]);
    }

    public function smtp_settings()
    {
        return view($this->base_path . 'smtp-settings');
    }

    public function update_smtp_settings(Request $request){
        $this->validate($request,[
            'site_smtp_mail_host' => 'required|string',
            'site_smtp_mail_port' => 'required|string',
            'site_smtp_mail_username' => 'required|string',
            'site_smtp_mail_password' => 'required|string',
            'site_smtp_mail_encryption' => 'required|string'
        ]);

        update_static_option('site_smtp_mail_mailer',$request->site_smtp_mail_mailer);
        update_static_option('site_smtp_mail_host',$request->site_smtp_mail_host);
        update_static_option('site_smtp_mail_port',$request->site_smtp_mail_port);
        update_static_option('site_smtp_mail_username',$request->site_smtp_mail_username);
        update_static_option('site_smtp_mail_password',$request->site_smtp_mail_password);
        update_static_option('site_smtp_mail_encryption',$request->site_smtp_mail_encryption);

        setEnvValue([
            'MAIL_MAILER' => $request->site_smtp_mail_mailer,
            'MAIL_HOST' => $request->site_smtp_mail_host,
            'MAIL_PORT' => $request->site_smtp_mail_port,
            'MAIL_USERNAME' => $request->site_smtp_mail_username,
            'MAIL_PASSWORD' => '"'.$request->site_smtp_mail_password.'"',
            'MAIL_ENCRYPTION' => $request->site_smtp_mail_encryption
        ]);

        return redirect()->back()->with(['msg' => __('SMTP Settings Updated...'),'type' => 'success']);
    }


    public function test_smtp_settings(Request $request){
        $this->validate($request,[
            'subject' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'message' => 'required|string',
        ]);
        $res_data = [
            'msg' => __('Mail Send Success'),
            'type' => 'success'
        ];
        try {
            Mail::to($request->email)->send(new BasicMail([
                'subject' => $request->subject,
                'message' => $request->message
            ]));
        }catch (\Exception $e){
            return  redirect()->back()->with([
                'type' => 'danger',
                'msg' => $e->getMessage()
            ]);
        }
        return redirect()->back()->with($res_data);
    }


    public function regenerate_image_settings()
    {
        return view($this->base_path . 'regenerate-image');
    }

    public function update_regenerate_image_settings(Request $request)
    {
        $all_media_file = MediaUpload::all();
        foreach ($all_media_file as $img) {

            if (!file_exists('assets/uploads/media-uploader/' . $img->path)) {
                continue;
            }
            $image = 'assets/uploads/media-uploader/' . $img->path;
            $image_dimension = getimagesize($image);;
            $image_width = $image_dimension[0];
            $image_height = $image_dimension[1];

            $image_db = $img->path;
            $image_grid = 'grid-' . $image_db;
            $image_large = 'large-' . $image_db;
            $image_thumb = 'thumb-' . $image_db;

            $folder_path = 'assets/uploads/media-uploader/';
            $resize_grid_image = Image::make($image)->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resize_large_image = Image::make($image)->resize(740, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resize_thumb_image = Image::make($image)->resize(150, 150);

            if ($image_width > 150) {
                $resize_thumb_image->save($folder_path . $image_thumb);
                $resize_grid_image->save($folder_path . $image_grid);
                $resize_large_image->save($folder_path . $image_large);
            }

        }

        return redirect()->back()->with(['msg' => __('Image Regenerate Success...'), 'type' => 'success']);
    }

    public function custom_js_settings()
    {
        $custom_js = '/* Write Custom js Here */';
        if (file_exists('assets/frontend/js/dynamic-script.js')) {
            $custom_js = file_get_contents('assets/frontend/js/dynamic-script.js');
        }
        return view($this->base_path . 'custom-js')->with(['custom_js' => $custom_js]);
    }

    public function update_custom_js_settings(Request $request)
    {
        file_put_contents('assets/frontend/js/dynamic-script.js', $request->custom_js_area);

        return redirect()->back()->with(['msg' => __('Custom Script Added Success...'), 'type' => 'success']);
    }

    public function gdpr_settings()
    {
        return view($this->base_path . 'gdpr');
    }

    public function update_gdpr_cookie_settings(Request $request)
    {

        $this->validate($request, [
            'site_gdpr_cookie_enabled' => 'nullable|string|max:191',
            'site_gdpr_cookie_expire' => 'required|string|max:191',
            'site_gdpr_cookie_delay' => 'required|string|max:191',
        ]);

        $all_language =  Language::orderBy('default','desc')->get();
        foreach ($all_language as $lang) {
            $this->validate($request, [
                "site_gdpr_cookie_title" => 'nullable|string',
                "site_gdpr_cookie_message" => 'nullable|string',
                "site_gdpr_cookie_more_info_label" => 'nullable|string',
                "site_gdpr_cookie_more_info_link" => 'nullable|string',
                "site_gdpr_cookie_accept_button_label" => 'nullable|string',
                "site_gdpr_cookie_decline_button_label" => 'nullable|string',
            ]);
            $_title = "site_gdpr_cookie_title";
            $_message = "site_gdpr_cookie_message";
            $_more_info_label = "site_gdpr_cookie_more_info_label";
            $_more_info_link = "site_gdpr_cookie_more_info_link";
            $_accept_button_label = "site_gdpr_cookie_accept_button_label";
            $decline_button_label = "site_gdpr_cookie_decline_button_label";

            update_static_option($_title, $request->$_title);
            update_static_option($_message, $request->$_message);
            update_static_option($_more_info_label, $request->$_more_info_label);
            update_static_option($_more_info_link, $request->$_more_info_link);
            update_static_option($_accept_button_label, $request->$_accept_button_label);
            update_static_option($decline_button_label, $request->$decline_button_label);
        }

        update_static_option('site_gdpr_cookie_delay', $request->site_gdpr_cookie_delay);
        update_static_option('site_gdpr_cookie_enabled', $request->site_gdpr_cookie_enabled);
        update_static_option('site_gdpr_cookie_expire', $request->site_gdpr_cookie_expire);

        return redirect()->back()->with(['msg' => __('GDPR Cookie Settings Updated..'), 'type' => 'success']);
    }

    public function cache_settings()
    {
        return view($this->base_path . 'cache-settings');
    }

    public function update_cache_settings(Request $request)
    {

        $this->validate($request, [
            'cache_type' => 'required|string'
        ]);

        Artisan::call($request->cache_type . ':clear');

        return redirect()->back()->with(['msg' => __('Cache Cleaned...'), 'type' => 'success']);
    }

    public function license_settings()
    {
        return view($this->base_path . 'license-settings');
    }

    public function update_license_settings(Request $request)
    {
        $this->validate($request, [
            'site_license_key' => 'required|string|max:191',
            'envato_username' => 'required|string|max:191',
        ]);

        $result = XgApiClient::activeLicense($request->site_license_key,$request->envato_username);
        $type = "danger";
        $msg = __("could not able to verify your license key, please try after sometime, if you still face this issue, contact support");
        if (!empty($result["success"]) && $result["success"]){
            update_static_option('site_license_key', $request->site_license_key);
            update_static_option('item_license_status', $result['success'] ? 'verified' : "");
            update_static_option('item_license_msg', $result['message']);
            $type = $result['success'] ? 'success' : "danger";
            $msg = $result['message'];
        }

        return redirect()->back()->with(['msg' => $msg , 'type' => $type]);
    }

    public function custom_css_settings()
    {
        $custom_css = '/* Write Custom Css Here */';
        if (file_exists('assets/frontend/css/dynamic-style.css')) {
            $custom_css = file_get_contents('assets/frontend/css/dynamic-style.css');
        }
        return view($this->base_path . 'custom-css')->with(['custom_css' => $custom_css]);
    }

    public function update_custom_css_settings(Request $request)
    {
        file_put_contents('assets/frontend/css/dynamic-style.css', $request->custom_css_area);

        return redirect()->back()->with(['msg' => __('Custom Style Added Success...'), 'type' => 'success']);
    }

    public function typography_settings()
    {
        $all_google_fonts = file_get_contents('assets/frontend/webfonts/google-fonts.json');
        return view($this->base_path . 'typograhpy')->with(['google_fonts' => json_decode($all_google_fonts)]);
    }

    public function get_single_font_variant(Request $request)
    {
        $all_google_fonts = file_get_contents('assets/frontend/webfonts/google-fonts.json');
        $decoded_fonts = json_decode($all_google_fonts, true);
        return response()->json($decoded_fonts[$request->font_family]);
    }

    public function update_typography_settings(Request $request)
    {
        $this->validate($request, [
            'body_font_family' => 'required|string|max:191',
            'body_font_variant' => 'required',
            'heading_font' => 'nullable|string',
            'heading_font_family' => 'nullable|string|max:191',
            'heading_font_variant' => 'nullable',
        ]);

        $save_data = [
            'body_font_family',
            'heading_font_family',
        ];
        foreach ($save_data as $item) {
            update_static_option($item, $request->$item);
        }
        $body_font_variant = !empty($request->body_font_variant) ? $request->body_font_variant : ['regular'];
        $heading_font_variant = !empty($request->heading_font_variant) ? $request->heading_font_variant : ['regular'];

        update_static_option('heading_font', $request->heading_font);
        update_static_option('body_font_variant', serialize($body_font_variant));
        update_static_option('heading_font_variant', serialize($heading_font_variant));

        return redirect()->back()->with(['msg' => __('Typography Settings Updated..'), 'type' => 'success']);
    }

    public function email_settings()
    {
        return view($this->base_path . 'email-settings');
    }

    public function update_email_settings(Request $request)
    {
        $this->validate($request, [
            'service_query_success_message' => 'nullable|string',
            'case_study_query_success_message' => 'nullable|string',
            'quote_mail_success_message' => 'nullable|string',
            'contact_mail_success_message' => 'nullable|string',
            'get_in_touch_mail_success_message' => 'nullable|string',
            'apply_job_success_message' => 'nullable|string',
            'order_mail_success_message' => 'nullable|string',
            'event_attendance_mail_success_message' => 'nullable|string',
            'feedback_form_mail_success_message' => 'nullable|string',
        ]);

        $fields = [
            'service_query_success_message',
            'case_study_query_success_message',
            'quote_mail_success_message',
            'contact_mail_success_message',
            'get_in_touch_mail_success_message',
            'apply_job_success_message',
            'order_mail_success_message',
            'event_attendance_mail_success_message',
            'feedback_form_mail_success_message',
        ];
        foreach ($fields as $field) {
            update_static_option($field, $request->$field);
        }

        return redirect()->back()->with(['msg' => __('Email Settings Updated..'), 'type' => 'success']);
    }

    public function page_settings()
    {
        return view($this->base_path . 'page-settings');
    }

    public function update_page_settings(Request $request)
    {
        $this->validate($request, [
            'about_page_slug' => 'required|string|max:191',
            'team_page_slug' => 'required|string|max:191',
            'faq_page_slug' => 'required|string|max:191',
            'blog_page_slug' => 'required|string|max:191',
            'contact_page_slug' => 'required|string|max:191',
            'career_with_us_page_slug' => 'required|string|max:191',
            'events_page_slug' => 'required|string|max:191',
            'donation_page_slug' => 'required|string|max:191',
            'testimonial_page_slug' => 'required|string|max:191',
            'image_gallery_page_slug' => 'required|string|max:191',
            'donor_page_slug' => 'required|string|max:191',
            'success_story_page_slug' => 'required|string|max:191',
            'support_ticket_page_slug' => 'required|string|max:191',
        ]);
        $all_page_slug_settings = [
            'about_page',
            'team_page',
            'faq_page',
            'blog_page',
            'contact_page',
            'career_with_us_page',
            'events_page',
            'donation_page',
            'testimonial_page',
            'image_gallery_page',
            'donor_page',
            'success_story_page',
            'support_ticket_page'
        ];

        foreach ($all_page_slug_settings as $slug) {
            if ($request->has($slug . '_slug')) {
                $fi = $slug . '_slug';
                update_static_option($slug . '_slug', Str::slug($request->$fi));
            }
        }
        $this->validate($request, [
            'about_page_name' => 'nullable|string',
            'team_page_name' => 'nullable|string',
            'faq_page_name' => 'nullable|string',
            'blog_page_name' => 'nullable|string',
            'contact_page_name' => 'nullable|string',
            'career_with_us_page_name' => 'nullable|string',
            'events_page_name' => 'nullable|string',
            'donation_page_name' => 'nullable|string',
            'donor_page_name' => 'nullable|string',
            'success_story_page_name' => 'nullable|string',
            'support_ticket_page_name' => 'nullable|string',
        ]);
        foreach ($all_page_slug_settings as $slug) {
            $page_name = $slug . '_name';
            $meta_tags = $slug.'_meta_tags';
            $meta_description = $slug.'_meta_description';
            update_static_option($page_name, $request->$page_name);
            update_static_option($meta_tags, $request->$meta_tags);
            update_static_option($meta_description , $request->$meta_description);
        }

        return redirect()->back()->with(['msg' => __('Settings Updated..'), 'type' => 'success']);
    }

    public function basic_settings()
    {
        return view($this->base_path . 'basic');
    }

    public function update_basic_settings(Request $request)
    {
        $this->validate($request, [
            'site_secondary_color' => 'nullable|string',
            'site_sticky_navbar_enabled' => 'nullable|string',
            'disable_backend_preloader' => 'nullable|string',
            'disable_user_email_verify' => 'nullable|string',
            'og_meta_image_for_site' => 'nullable|string',
            'site_admin_panel_nav_sticky' => 'nullable|string',
            'site_force_ssl_redirection' => 'nullable|string',
        ]);

        $this->validate($request, [
            'site_title' => 'nullable|string',
            'site_tag_line' => 'nullable|string',
            'site_footer_copyright' => 'nullable|string',
        ]);
        $_title = 'site_title';
        $_tag_line = 'site_tag_line';
        $_footer_copyright = 'site_footer_copyright';

        update_static_option($_title, $request->$_title);
        update_static_option($_tag_line, $request->$_tag_line);
        update_static_option($_footer_copyright, $request->$_footer_copyright);


        $all_fields = [
            'site_frontend_nav_sticky',
            'og_meta_image_for_site',
            'site_rtl_enabled',
            'site_maintenance_mode',
            'site_payment_gateway',
            'site_sticky_navbar_enabled',
            'disable_backend_preloader',
            'disable_user_email_verify',
            'site_force_ssl_redirection',
            'preloader_status',
        ];

        foreach ($all_fields as $field) {
            update_static_option($field, $request->$field);
        }

        return redirect()->back()->with(['msg' => __('Basic Settings Update Success'), 'type' => 'success']);
    }

    public function color_settings()
    {
        return view($this->base_path . 'color');
    }

    public function update_color_settings(Request $request)
    {
        $this->validate($request, [
            'site_color' => 'required|string',
            'site_main_color_two' => 'required|string',
            'site_paragraph_color' => 'nullable|string',
            'site_heading_color' => 'nullable|string',
            'site_secondary_color' => 'nullable|string',
        ]);

        $all_fields = [
            'site_color',
            'site_secondary_color',
            'site_main_color_two',
            'site_heading_color',
            'site_paragraph_color',
            'portfolio_home_color',
            'logistics_home_color',
        ];

        foreach ($all_fields as $field) {
            update_static_option($field, $request->$field);
        }
        return redirect()->back()->with(['msg' => __('Color Settings Update Success'), 'type' => 'success']);
    }

    public function seo_settings()
    {
        return view($this->base_path . 'seo');
    }

    public function update_seo_settings(Request $request)
    {

        $this->validate($request, [
            'site_meta_tags' => 'required|string',
            'site_meta_description' => 'required|string'
        ]);

        $site_tags = 'site_meta_tags';
        $site_description = 'site_meta_description';

        update_static_option($site_tags, $request->$site_tags);
        update_static_option($site_description, $request->$site_description);


        return redirect()->back()->with(['msg' => __('SEO Settings Update Success'), 'type' => 'success']);
    }

    public function scripts_settings()
    {
        return view($this->base_path . 'thid-party');
    }

    public function update_scripts_settings(Request $request)
    {

        $this->validate($request, [
            'site_disqus_key' => 'nullable|string',
            'tawk_api_key' => 'nullable|string',
            'site_third_party_tracking_code' => 'nullable|string',
            'site_google_analytics' => 'nullable|string',
            'site_google_captcha_v3_secret_key' => 'nullable|string',
            'site_google_captcha_v3_site_key' => 'nullable|string',
        ]);

        update_static_option('site_disqus_key', $request->site_disqus_key);
        update_static_option('site_google_analytics', $request->site_google_analytics);
        update_static_option('tawk_api_key', $request->tawk_api_key);
        update_static_option('site_third_party_tracking_code', $request->site_third_party_tracking_code);
        update_static_option('site_google_captcha_v3_site_key', $request->site_google_captcha_v3_site_key);
        update_static_option('site_google_captcha_v3_secret_key', $request->site_google_captcha_v3_secret_key);

        $fields = [
            'site_google_captcha_v3_secret_key',
            'site_google_captcha_v3_site_key',
            'site_third_party_tracking_code',
            'site_google_analytics',
            'tawk_api_key',
            'site_disqus_key',
            'enable_google_login',
            'google_client_id',
            'google_client_secret',
            'enable_facebook_login',
            'facebook_client_id',
            'facebook_client_secret',
        ];
        foreach ($fields as $field){
            update_static_option($field,$request->$field);
        }

        setEnvValue([
            'FACEBOOK_CLIENT_ID' => $request->facebook_client_id,
            'FACEBOOK_CLIENT_SECRET' => $request->facebook_client_secret,
            'FACEBOOK_CALLBACK_URL' => route('facebook.callback'),
            'GOOGLE_CLIENT_ID' => $request->google_client_id,
            'GOOGLE_CLIENT_SECRET' => $request->google_client_secret,
            'GOOGLE_CALLBACK_URL' => route('google.callback'),
        ]);


        return redirect()->back()->with(['msg' => __('Third Party Scripts Settings Updated..'), 'type' => 'success']);
    }

    public function email_template_settings()
    {
        return view($this->base_path . 'email-template');
    }

    public function update_email_template_settings(Request $request)
    {

        $this->validate($request, [
            'site_global_email' => 'required|string',
            'site_global_email_template' => 'required|string',
        ]);

        update_static_option('site_global_email', $request->site_global_email);
        update_static_option('site_global_email_template', $request->site_global_email_template);

        return redirect()->back()->with(['msg' => __('Email Settings Updated..'), 'type' => 'success']);
    }

    public function site_identity()
    {
        return view($this->base_path . 'site-identity');
    }

    public function update_site_identity(Request $request)
    {
        $this->validate($request, [
            'site_logo' => 'nullable|string|max:191',
            'site_favicon' => 'nullable|string|max:191',
            'site_breadcrumb_bg' => 'nullable|string|max:191',
            'site_white_logo' => 'nullable|string|max:191',
        ]);
        update_static_option('site_logo', $request->site_logo);
        update_static_option('site_favicon', $request->site_favicon);
        update_static_option('site_breadcrumb_bg', $request->site_breadcrumb_bg);
        update_static_option('site_white_logo', $request->site_white_logo);

        return redirect()->back()->with([
            'msg' => __('Site Identity Has Been Updated..'),
            'type' => 'success'
        ]);
    }

    public function payment_settings()
    {
        return view('backend.general-settings.payment-gateway');
    }

    public function update_payment_settings(Request $request)
    {

        $this->validate($request, [
            'paypal_preview_logo'=> 'nullable|string|max:191',
            'paypal_mode'=> 'nullable|string|max:191',
            'paypal_sandbox_client_id'=> 'nullable|string|max:191',
            'paypal_sandbox_client_secret'=> 'nullable|string|max:191',
            'paypal_sandbox_app_id'=> 'nullable|string|max:191',
            'paypal_live_app_id'=> 'nullable|string|max:191',
            'paypal_payment_action'=> 'nullable|string|max:191',
            'paypal_currency'=> 'nullable|string|max:191',
            'paypal_notify_url'=> 'nullable|string|max:191',
            'paypal_locale'=> 'nullable|string|max:191',
            'paypal_validate_ssl'=> 'nullable|string|max:191',
            'paypal_live_client_id'=> 'nullable|string|max:191',
            'paypal_live_client_secret'=> 'nullable|string|max:191',

            'razorpay_preview_logo' => 'nullable|string|max:191',
            'stripe_preview_logo' => 'nullable|string|max:191',
            'paypal_gateway' => 'nullable|string|max:191',
            'paytm_gateway' => 'nullable|string|max:191',
            'paytm_preview_logo' => 'nullable|string|max:191',
            'paytm_merchant_key' => 'nullable|string|max:191',
            'paytm_merchant_mid' => 'nullable|string|max:191',
            'paytm_merchant_website' => 'nullable|string|max:191',
            'site_global_currency' => 'nullable|string|max:191',
            'site_manual_payment_name' => 'nullable|string|max:191',
            'manual_payment_preview_logo' => 'nullable|string|max:191',
            'site_manual_payment_description' => 'nullable|string|max:191',
            'razorpay_key' => 'nullable|string|max:191',
            'razorpay_secret' => 'nullable|string|max:191',
            'stripe_publishable_key' => 'nullable|string|max:191',
            'stripe_secret_key' => 'nullable|string|max:191',
            'site_global_payment_gateway' => 'nullable|string|max:191',
            'paystack_merchant_email' => 'nullable|string|max:191',
            'paystack_preview_logo' => 'nullable|string|max:191',
            'paystack_public_key' => 'nullable|string|max:191',
            'paystack_secret_key' => 'nullable|string|max:191',
            'cash_on_delivery_gateway' => 'nullable|string|max:191',
            'cash_on_delivery_preview_logo' => 'nullable|string|max:191',
            'mollie_preview_logo' => 'nullable|string|max:191',
            'mollie_public_key' => 'nullable|string|max:191',
            'marcado_pagp_client_id' => 'nullable|string|max:191',
            'marcado_pago_client_secret' => 'nullable|string|max:191',
            'marcado_pago_test_mode' => 'nullable|string|max:191',
        ]);

        $global_currency = get_static_option('site_global_currency');

        $save_data = [
            'cash_on_delivery_preview_logo',
            'paystack_preview_logo',
            'paystack_public_key',
            'paystack_secret_key',
            'paystack_merchant_email',

            'paytm_preview_logo',
            'paytm_merchant_key',
            'paytm_merchant_mid',
            'paytm_merchant_website',
            'site_global_currency',
            'manual_payment_preview_logo',
            'site_manual_payment_name',
            'site_manual_payment_description',

            'razorpay_preview_logo',
            'razorpay_api_key',
            'razorpay_api_secret',

            'stripe_public_key',
            'stripe_secret_key',
            'stripe_preview_logo',
            'stripe_gateway',
            'stripe_test_mode',

            'site_global_payment_gateway',
            'site_usd_to_ngn_exchange_rate',
            'site_euro_to_ngn_exchange_rate',

            'mollie_public_key',
            'mollie_preview_logo',
            'mollie_test_mode',

            'flutterwave_preview_logo',
            'flw_public_key',
            'flw_secret_key',
            'flw_secret_hash',
            'site_currency_symbol_position',
            'site_default_payment_gateway',

            'paypal_preview_logo',
            'paypal_test_mode',
            'paypal_sandbox_client_id',
            'paypal_sandbox_client_secret',
            'paypal_sandbox_app_id',
            'paypal_live_client_id',
            'paypal_live_client_secret',
            'paypal_live_app_id',
            'paypal_payment_action',
            'paypal_currency',
            'paypal_notify_url',
            'paypal_locale',
            'paypal_validate_ssl',

            'site_' . strtolower($global_currency) . '_to_idr_exchange_rate',
            'site_' . strtolower($global_currency) . '_to_inr_exchange_rate',
            'site_' . strtolower($global_currency) . '_to_ngn_exchange_rate',
            'site_' . strtolower($global_currency) . '_to_zar_exchange_rate',
            'site_' . strtolower($global_currency) . '_to_brl_exchange_rate',
            'site_' . strtolower($global_currency) . '_to_myr_exchange_rate',


            'midtrans_preview_logo',
            'midtrans_merchant_id',
            'midtrans_server_key',
            'midtrans_client_key',
            'midtrans_environment',

            'payfast_preview_logo',
            'payfast_merchant_id',
            'payfast_merchant_key',
            'payfast_passphrase',
            'payfast_merchant_env',
            'payfast_itn_url',

            'cashfree_preview_logo',
            'cashfree_test_mode',
            'cashfree_app_id',
            'cashfree_secret_key',

            'instamojo_preview_logo',
            'instamojo_client_id',
            'instamojo_client_secret',
            'instamojo_username',
            'instamojo_password',
            'instamojo_test_mode',

            'marcadopago_preview_logo',
            'marcado_pago_client_id',
            'marcado_pago_client_secret',
            'marcado_pago_test_mode',

            'squareup_gateway',
            'squareup_test_mode',
            'squareup_preview_logo',
            'squareup_access_token',
            'squareup_location_id',

            'cinetpay_preview_logo',
            'cinetpay_gateway',
            'cinetpay_test_mode',
            'cinetpay_api_key',
            'cinetpay_site_id',

            'paytabs_preview_logo',
            'paytabs_gateway',
            'paytabs_test_mode',
            'pay_tabs_currency',
            'pay_tabs_profile_id',
            'pay_tabs_region',
            'pay_tabs_server_key',

            'billplz_preview_logo',
            'billplz_gateway',
            'billplz_test_mode',
            'billplz_key',
            'billplz_version',
            'billplz_x_signature',
            'billplz_collection_name',

            'zitopay_preview_logo',
            'zitopay_gateway',
            'zitopay_test_mode',
            'zitopay_username',

            //Toyyibpay
            'toyyibpay_preview_logo',
            'toyyibpay_gateway',
            'toyyibpay_test_mode',
            'toyyibpay_secret_key',
            'toyyibpay_category_code',

            //Pagali
            'pagali_preview_logo',
            'pagali_gateway',
            'pagali_test_mode',
            'pagali_page_id',
            'pagali_entity_id',

            //authorizenet
            'authorizenet_preview_logo',
            'authorizenet_gateway',
            'authorizenet_test_mode',
            'authorizenet_merchant_login_id',
            'authorizenet_merchant_transaction_id',

            //authorizenet
            'sitesway_preview_logo',
            'sitesway_gateway',
            'sitesway_test_mode',
            'sitesway_brand_id',
            'sitesway_api_key',


        ];

        foreach ($save_data as $item) {
            update_static_option($item, $request->$item);
        }

        update_static_option('enable_disable_decimal_point',$request->enable_disable_decimal_point);

        update_static_option('manual_payment_gateway', $request->manual_payment_gateway);
        update_static_option('paypal_gateway', $request->paypal_gateway);
        update_static_option('paytm_test_mode', $request->paytm_test_mode);
        update_static_option('paypal_test_mode', $request->paypal_test_mode);
        update_static_option('paytm_gateway', $request->paytm_gateway);
        update_static_option('razorpay_gateway', $request->razorpay_gateway);
        update_static_option('razorpay_test_mode', $request->razorpay_test_mode);
        update_static_option('paystack_gateway', $request->paystack_gateway);
        update_static_option('paystack_test_mode', $request->paystack_test_mode);
        update_static_option('mollie_gateway', $request->mollie_gateway);
        update_static_option('cash_on_delivery_gateway', $request->cash_on_delivery_gateway);
        update_static_option('flutterwave_gateway', $request->flutterwave_gateway);
        update_static_option('flutterwave_test_mode', $request->flutterwave_test_mode);
        update_static_option('midtrans_gateway', $request->midtrans_gateway);
        update_static_option('midtrans_test_mode', $request->midtrans_test_mode);
        update_static_option('payfast_gateway', $request->payfast_gateway);
        update_static_option('payfast_test_mode', $request->payfast_test_mode);
        update_static_option('cashfree_gateway', $request->cashfree_gateway);
        update_static_option('instamojo_gateway', $request->instamojo_gateway);
        update_static_option('marcadopago_gateway', $request->marcadopago_gateway);
        update_static_option('marcadopago_test_mode', $request->marcadopago_test_mode);



        //Paypal
        $env_val['SITE_GLOBAL_CURRENCY'] = $request->site_global_currency ;
        $env_val['PAYPAL_MODE'] =  !empty($request->paypal_test_mode) ? true : false;
        $env_val['PAYPAL_SANDBOX_CLIENT_ID'] = $request->paypal_sandbox_client_id ? : 'AUP7AuZMwJbkee-2OmsSZrU-ID1XUJYE-YB-2JOrxeKV-q9ZJZYmsr-UoKuJn4kwyCv5ak26lrZyb-gb';
        $env_val['PAYPAL_SANDBOX_CLIENT_SECRET'] = $request->paypal_sandbox_client_secret ? : 'EEIxCuVnbgING9EyzcF2q-gpacLneVbngQtJ1mbx-42Lbq-6Uf6PEjgzF7HEayNsI4IFmB9_CZkECc3y';
        $env_val['PAYPAL_SANDBOX_APP_ID'] = $request->paypal_sandbox_app_id ? : '456345645645';
        $env_val['PAYPAL_LIVE_CLIENT_ID'] = $request->paypal_live_client_id ? : '';
        $env_val['PAYPAL_LIVE_CLIENT_SECRET'] = $request->paypal_live_client_secret ? : '';
        $env_val['PAYPAL_LIVE_APP_ID'] = $request->paypal_live_app_id ? : '';
        $env_val['PAYPAL_PAYMENT_ACTION'] = $request->paypal_payment_action ? '' : '';
        $env_val['PAYPAL_CURRENCY'] = $request->site_global_currency;
        $env_val['PAYPAL_NOTIFY_URL'] = $request->paypal_notify_url ? '' : 'http://gateway.test/paypal/ipn';
        $env_val['PAYPAL_LOCALE'] = 'en_GB';
        $env_val['PAYPAL_VALIDATE_SSL'] = $request->paypal_validate_ssl ? : 'false';

        $env_val['PAYSTACK_PUBLIC_KEY'] = $request->paystack_public_key ?: 'pk_test_081a8fcd9423dede2de7b4c3143375b5e5415290';
        $env_val['PAYSTACK_SECRET_KEY'] = $request->paystack_secret_key ?: 'sk_test_c874d38f8d08760efc517fc83d8cd574b906374f';
        $env_val['PAYSTACK_TEST_MODE'] = $request->paystack_test_mode ? true : false;

        $env_val['MERCHANT_EMAIL'] = $request->paystack_merchant_email ?: 'example@gmail.com';
        $env_val['MOLLIE_KEY'] = $request->mollie_public_key ?: 'test_SMWtwR6W48QN2UwFQBUqRDKWhaQEvw';
        $env_val['MOLLIE_TEST_MODE'] = $request->mollie_test_mode ? true : false;

        $env_val['FLW_PUBLIC_KEY'] = $request->flw_public_key ?: 'FLWPUBK_TEST-86cce2ec43c63e09a517290a8347fcab-X';
        $env_val['FLW_SECRET_KEY'] = $request->flw_secret_key ?: 'FLWSECK_TEST-d37a42d8917db84f1b2f47c125252d0a-X';
        $env_val['FLW_SECRET_HASH'] = $request->flw_secret_hash ?: 'fundorex';
        $env_val['FLW_TEST_MODE'] = $request->flutterwave_test_mode ? true: false;

        $env_val['RAZORPAY_API_KEY'] = $request->razorpay_api_key ? : 'rzp_test_SXk7LZqsBPpAkj';
        $env_val['RAZORPAY_API_SECRET'] = $request->razorpay_api_secret ? : 'Nenvq0aYArtYBDOGgmMH7JNv';
        $env_val['RAZORPAY_TESTMODE'] = $request->razorpay_test_mode ? true : false;

        $env_val['STRIPE_PUBLIC_KEY'] = $request->stripe_public_key ? : 'pk_test_51GwS1SEmGOuJLTMsIeYKFtfAT3o3Fc6IOC7wyFmmxA2FIFQ3ZigJ2z1s4ZOweKQKlhaQr1blTH9y6HR2PMjtq1Rx00vqE8LO0x';
        $env_val['STRIPE_SECRET_KEY'] = $request->stripe_secret_key ? : 'sk_test_51GwS1SEmGOuJLTMs2vhSliTwAGkOt4fKJMBrxzTXeCJoLrRu8HFf4I0C5QuyE3l3bQHBJm3c0qFmeVjd0V9nFb6Z00VrWDJ9Uw';
        $env_val['STRIPE_TEST_MODE'] = $request->stripe_test_mode ? true : false;

        $env_val['PAYTM_MERCHANT_ID'] = $request->paytm_merchant_mid ?: 'Digita57697814558795';
        $env_val['PAYTM_MERCHANT_KEY'] = '"' . $request->paytm_merchant_key . '"' ?: 'dv0XtmsPYpewNag&';
        $env_val['PAYTM_MERCHANT_WEBSITE'] = '"' . $request->paytm_merchant_website . '"' ?: 'WEBSTAGING';
        $env_val['PAYTM_CHANNEL'] = '"' . $request->paytm_channel . '"' ?: 'WEB';
        $env_val['PAYTM_INDUSTRY_TYPE'] = '"' . $request->paytm_industry_type . '"' ? : 'Retail';
        $env_val['PAYTM_ENVIRONMENT'] = $request->paytm_test_mode  ? true : false;

        $global_currency = get_static_option('site_global_currency');
        $currency_filed_name = 'site_' . strtolower($global_currency) . '_to_usd_exchange_rate';
        update_static_option('site_' . strtolower($global_currency) . '_to_usd_exchange_rate', $request->$currency_filed_name);

        $idr_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_idr_exchange_rate';
        $inr_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_inr_exchange_rate';
        $ngn_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_ngn_exchange_rate';
        $zar_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_zar_exchange_rate';
        $brl_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_brl_exchange_rate';
        $myr_currency_filed_name = 'site_' . strtolower($global_currency) . '_to_myr_exchange_rate';

        $env_val['IDR_EXCHANGE_RATE'] = $request->$idr_currency_filed_name ?? '14365.30';
        $env_val['INR_EXCHANGE_RATE'] = $request->$inr_currency_filed_name ?? '74.85';
        $env_val['NGN_EXCHANGE_RATE'] = $request->$ngn_currency_filed_name ?? '409.91';
        $env_val['ZAR_EXCHANGE_RATE'] = $request->$zar_currency_filed_name ?? '15.86';
        $env_val['BRL_EXCHANGE_RATE'] = $request->$brl_currency_filed_name ?? '5.70';
        $env_val['MYR_EXCHANGE_RATE'] = $request->$myr_currency_filed_name ?? '5.70';

        $env_val['MIDTRANS_MERCHANT_ID'] = $request->midtrans_merchant_id ? : 'G770543580';
        $env_val['MIDTRANS_SERVER_KEY'] =  $request->midtrans_server_key ? : 'SB-Mid-server-9z5jztsHyYxEdSs7DgkNg2on';
        $env_val['MIDTRANS_CLIENT_KEY'] =  $request->midtrans_client_key ? : 'SB-Mid-client-iDuy-jKdZHkLjL_I';
        $env_val['MIDTRANS_ENVIRONTMENT'] =  $request->midtrans_test_mode ? true : false;


        $env_val['PF_MERCHANT_ID'] = $request->payfast_merchant_id ? : '10024000';
        $env_val['PF_MERCHANT_KEY'] =  $request->payfast_merchant_key ? : '77jcu5v4ufdod';
        $env_val['PAYFAST_PASSPHRASE'] =  $request->payfast_passphrase ? : 'testpayfastsohan';
        $env_val['PF_ITN_URL'] = $request->payfast_itn_url  ? : 'https://fundorex.test/donation-payfast';
        $env_val['PF_MERCHANT_ENV'] = $request->payfast_test_mode  ? true : false;

        $env_val['CASHFREE_TEST_MODE'] = $request->cashfree_test_mode ? true : false;
        $env_val['CASHFREE_APP_ID'] =  $request->cashfree_app_id ? : '94527832f47d6e74fa6ca5e3c72549';
        $env_val['CASHFREE_SECRET_KEY'] =  $request->cashfree_secret_key ? : 'ec6a3222018c676e95436b2e26e89c1ec6be2830';

        $env_val['INSTAMOJO_CLIENT_ID'] = $request->instamojo_client_id ? : 'test_nhpJ3RvWObd3uryoIYF0gjKby5NB5xu6S9Z';
        $env_val['INSTAMOJO_CLIENT_SECRET'] =  $request->instamojo_client_secret ? : 'test_iZusG4P35maQVPTfqutbCc6UEbba3iesbCbrYM7zOtDaJUdbPz76QOnBcDgblC53YBEgsymqn2sx3NVEPbl3b5coA3uLqV1ikxKquOeXSWr8Ruy7eaKUMX1yBbm';
        $env_val['INSTAMOJO_USERNAME'] =  $request->instamojo_username ? : '';
        $env_val['INSTAMOJO_PASSWORD'] =  $request->instamojo_password ? : '';
        $env_val['INSTAMOJO_TEST_MODE'] =  $request->instamojo_test_mode ? true : false;

        $env_val['MERCADO_PAGO_CLIENT_ID'] = $request->marcado_pago_client_id ? : 'TEST-0a3cc78a-57bf-4556-9dbe-2afa06347769';
        $env_val['MERCADO_PAGO_CLIENT_SECRET'] = $request->marcado_pago_client_secret ? : 'TEST-4644184554273630-070813-7d817e2ca1576e75884001d0755f8a7a-786499991';
        $env_val['MERCADO_PAGO_TEST_MODE'] = $request->marcadopago_test_mode ? true : false;

        $env_val['SQUAREUP_ACCESS_TOKEN'] = $request->squareup_access_token ;
        $env_val['SQUAREUP_LOCATION_ID'] = $request->squareup_location_id;
        $env_val['SQUAREUP_ACCESS_TEST_MODE'] = $request->squareup_test_mode ? true : false;

        $env_val['CINETPAY_API_KEY'] = $request->cinetpay_api_key ??  '12912847765bc0db748fdd44.40081707';
        $env_val['CINETPAY_SITE_ID'] = $request->cinetpay_site_id ?? '445160';
        $env_val['CINETPAY_TEST_MODE'] = $request->cinetpay_test_mode ? true : false;


        $env_val['PAYTABS_CURRENCY'] = $request->pay_tabs_currency ??  'USD';
        $env_val['PAYTABS_PROFILE_ID'] = $request->pay_tabs_profile_id ?? '96698';
        $env_val['PAYTABS_REGION'] = $request->pay_tabs_region ?? 'GLOBAL';
        $env_val['PAYTABS_SERVER_KEY'] = $request->pay_tabs_server_key ?? 'SKJNDNRHM2-JDKTZDDH2N-H9HLMJNJ2L';
        $env_val['PAYTABS_TEST_MODE'] = $request->paytabs_test_mode ? true : false;

        $env_val['BILLPLZ_KEY'] = $request->billplz_key ??  'b2ead199-e6f3-4420-ae5c-c94f1b1e8ed6';
        $env_val['BILLPLZ_VERSION'] = $request->billplz_version ?? 'v4';
        $env_val['BILLPLZ_X_SIGNATURE'] = $request->billplz_x_signature ?? 'S-HDXHxRJB-J7rNtoktZkKJg';
        $env_val['BILLPLZ_COLLECTION_NAME'] = $request->billplz_collection_name ?? 'kjj5ya006';
        $env_val['BILLPLZ_TEST_MODE'] = $request->billplz_test_mode ? true : false;

        $env_val['ZITOPAY_USERNAME'] = $request->zitopay_username ?? 'dvrobin4';
        $env_val['ZITOPAY_TEST_MODE'] = $request->zitopay_test_mode ? 1 : 0;

        setEnvValue($env_val);
        Artisan::call('cache:clear');

        return redirect()->back()->with([
            'msg' => __('Payment Settings Updated..'),
            'type' => 'success'
        ]);
    }

    public function sitemap_settings()
    {
        $all_sitemap = glob('sitemap/*');
        return view($this->base_path . 'sitemap-settings')->with(['all_sitemap' => $all_sitemap]);
    }

    public function update_sitemap_settings(Request $request)
    {
        $this->validate($request, [
            'site_url' => 'required|url',
            'title' => 'nullable|string',
        ]);

        $title = $request->title ? $request->title : time();

        SitemapGenerator::create(Str::slug($request->site_url))->writeToFile('sitemap/sitemap-' . $title . '.xml');
        return redirect()->back()->with([
            'msg' => __('Sitemap Generated..'),
            'type' => 'success'
        ]);
    }

    public function delete_sitemap_settings(Request $request)
    {
        if (file_exists($request->sitemap_name)) {
            @unlink($request->sitemap_name);
        }
        return redirect()->back()->with(['msg' => __('Sitemap Deleted...'), 'type' => 'danger']);
    }

    public function rss_feed_settings()
    {
        return view($this->base_path . 'rss-feed-settings');
    }

    public function update_rss_feed_settings(Request $request)
    {
        $this->validate($request, [
            'site_rss_feed_url' => 'required|string',
            'site_rss_feed_title' => 'required|string',
            'site_rss_feed_description' => 'required|string',
        ]);
        update_static_option('site_rss_feed_description', $request->site_rss_feed_description);
        update_static_option('site_rss_feed_title', $request->site_rss_feed_title);
        update_static_option('site_rss_feed_url', $request->site_rss_feed_url);

        $env_val['RSS_FEED_URL'] = $request->site_rss_feed_url ? '"' . $request->site_rss_feed_url . '"' : '"rss-feeds"';
        $env_val['RSS_FEED_TITLE'] = $request->site_rss_feed_title ? '"' . $request->site_rss_feed_title . '"' : '"' . get_static_option('site_' . get_default_language() . '_title') . '"';
        $env_val['RSS_FEED_DESCRIPTION'] = $request->site_rss_feed_description ? '"' . $request->site_rss_feed_description . '"' : '"' . get_static_option('site_' . get_default_language() . '_tag_line') . '"';

        setEnvValue(array(
            'RSS_FEED_URL' => $env_val['RSS_FEED_URL'],
            'RSS_FEED_TITLE' => $env_val['RSS_FEED_TITLE'],
            'RSS_FEED_DESCRIPTION' => $env_val['RSS_FEED_DESCRIPTION'],
            'RSS_FEED_LANGUAGE' => get_default_language()
        ));

        return redirect()->back()->with([
            'msg' => __('RSS Settings Update..'),
            'type' => 'success'
        ]);
    }

    public function database_upgrade(){
        return view('backend.general-settings.database-upgrade');
    }
    public function database_upgrade_post(Request $request){
        setEnvValue(['APP_ENV' => 'local']);
        Artisan::call('migrate', ['--force' => true ]);
        Artisan::call('db:seed', ['--force' => true ]);
        setEnvValue(['APP_ENV' => 'production']);
        return back()->with(FlashMsg::item_update('Database Upgrade Success'));
    }

    public function software_update_check_settings(Request $request){
        return view("backend.general-settings.check-update");
    }

    public function update_version_check(Request $request){
        $result = XgApiClient::checkForUpdate(get_static_option("site_license_key"),get_static_option("site_script_version"));

        if (isset($result["success"]) && $result["success"]){


            $productUid = $result['data']['product_uid'] ?? null;
            $clientVersion = $result['data']['client_version'] ?? null;
            $latestVersion = $result['data']['latest_version'] ?? null;
            $productName = $result['data']['product'] ?? null;
            $releaseDate =  $result['data']['release_date'] ?? null;
            $changelog =  $result['data']['changelog'] ?? null;
            $phpVersionReq =  $result['data']['php_version'] ?? null;
            $mysqlVersionReq =  $result['data']['mysql_version'] ?? null;
            $extensions =  $result['data']['extension'] ?? null;
            $isTenant =  $result['data']['is_tenant'] ?? null;
            $daysDiff = $releaseDate;
            $msg = $result['data']['message'] ?? null;

            $output = "";
            $phpVCompare = version_compare(number_format((float) PHP_VERSION, 1), $phpVersionReq == 8 ? '8.0' : $phpVersionReq, '>=');
            $mysqlServerVersion = DB::select('select version()')[0]->{'version()'};
            $mysqlVCompare = version_compare(number_format((float) $mysqlServerVersion, 1), $mysqlVersionReq, '<=');
            $extensionReq = true;
            if ($extensions) {
                foreach (explode(',', str_replace(' ','', strtolower($extensions))) as $extension) {
                    $extensionReq = XgApiClient::extensionCheck($extension);
                }
            }
            if(($phpVCompare === false || $mysqlVCompare === false) && $extensionReq === false){
                $output .='<div class="text-danger">'.__('Your server does not have required software version installed.  Required: Php'). $phpVersionReq == 8 ? '8.0' : $phpVersionReq .', Mysql'.  $mysqlVersionReq . '/ Extensions:' .$extensions . 'etc </div>';
            }

            if (!empty($latestVersion)){
                $output .= '<div class="text-success">'.$msg.'</div>';
                $output .= '<div class="card text-center" ><div class="card-header bg-transparent text-warning" >'.__("Please backup your database & script files before upgrading.").'</div>';
                $output .= '<div class="card-body" ><h5 class="card-title" >'.__("new Version").' ('.$latestVersion.') '.__("is Available for").' '.$productName.'!</h5 >';
                $updateActionUrl = route('admin.general.update.download.settings', [$productUid, $isTenant]);
                $output .= '<a href = "#"  class="btn btn-warning" id="update_download_and_run_update" data-version="'.$latestVersion.'" data-action="'.$updateActionUrl.'"> <i class="fas fa-spinner fa-spin d-none"></i>'.__("Download & Update").' </a>';
                $output .= '<small class="text-warning d-block">'.__('it can take upto 5-10min to complete update download and initiate upgrade').'</small></div>';
                $changesLongByLine = explode("\n",$changelog);
                $output .= '<p class="changes-log">';
                $output .= '<strong>'.__("Released:")." ".$daysDiff." "."</strong><br>";
                $output .= "-------------------------------------------<br>";
                foreach($changesLongByLine as $cg){
                    $output .= $cg."<br>";
                }
                $output .= '</p>';

                $output .='</div>';
            }

            return response()->json(["msg" => $result["message"],"type" => "success","markup" => $output ]);
        }

        return response()->json(["msg" => $result["message"],"type" => "danger","markup" => "<p class='text-danger'>".$result["message"]."</p>" ]);

    }

    public function updateDownloadLatestVersion($productUid, $isTenant){

        $version = \request()->get("version");
        //todo wrap this function through xgapiclient facades
        $getItemLicenseKey = get_static_option('site_license_key');
        $return_val = XgApiClient::downloadAndRunUpdateProcess($productUid, $isTenant,$getItemLicenseKey,$version);

        if (is_array($return_val)){
            return response()->json(['msg' => $return_val['msg'] , 'type' => $return_val['type']]);
        }elseif (is_bool($return_val) && $return_val){
            return response()->json(['msg' => __('system upgrade success') , 'type' => 'success']);
        }
        //it is false
        return response()->json(['msg' => __('Update failed, please contact support for further assistance') , 'type' => 'danger']);
    }

    public function license_key_generate(Request $request){
        $request->validate([
            "envato_purchase_code" => "required",
            "envato_username" => "required",
            "email" => "required",
        ]);
        $res = XgApiClient::VerifyLicense(purchaseCode: $request->envato_purchase_code, email: $request->email, envatoUsername: $request->envato_username);
        $type = $res["success"] ? "success" : "danger";
        $message = $res["message"];
        //store information in database
        if (!empty($res["success"])){
            //success verify
            $res["data"] = is_array($res["data"]) ? $res["data"] : (array) $res["data"];
            update_static_option("license_product_uuid",$res["data"]["product_uid"] ?? "");
            update_static_option("license_verified_key",$res["data"]["license_key"] ?? "");
            update_static_option("site_license_key",$res["data"]["license_key"] ?? "");
        }
        update_static_option("license_purchase_code",$request->envato_purchase_code);
        update_static_option("license_email",$request->email);
        update_static_option("license_username",$request->envato_username);

        return back()->with(["msg" => $message, "type" => $type]);
    }


}
