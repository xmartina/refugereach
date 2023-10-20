<?php


namespace App\Helpers\DataTableHelpers;


use App\Helpers\DonationHelpers;

class Donation
{
    public static function infoColumn($row)
    {
        $output = '<ul>';
        $output .= '<li><strong>' . __('Title') . ':</strong> ' . purify_html($row->title) . '</li>';
        $output .= '<li><strong>' . __('Created At') . ':</strong> ' . date("d - M - Y", strtotime($row->created_at)) . '</li>';
        $output .= '<li><strong>' . __('Created By') . ':</strong> ';
        if ($row->created_by === 'user') {
            $output .= optional($row->user)->name ?? __('Anonymous') . ' (' . optional($row->user)->username ?? __('username not found') . ')';
        } else {
            $output .= optional($row->admin)->name ?? __('Anonymous') . ' (' . optional($row->admin)->username ?? __('username not found') . ')';
        }
        
        $output .= '<li><strong>' . __('Goal') . ':</strong> ' . amount_with_currency_symbol($row->amount) . '</li>';
        $output .= '<li><strong>' . __('Raised') . ':</strong> ';
        $output .= $row->raised ? amount_with_currency_symbol($row->raised) : amount_with_currency_symbol(0);
        $output .= '</li>';
        
        
        $donation_charge_form = get_static_option('donation_charge_form');

        if ($row->created_by === 'user' && !empty($row->withdraws)) {
         

            $withdraw_able_amount_without_admin_charge = $row->raised - optional($row->withdraws)->where('payment_status', '!=', 'reject')->pluck('withdraw_request_amount')->sum();
            
            
            if ($donation_charge_form === 'campaign_owner'){
                $output .= '<li><strong>'.__('Admin Charged').': </strong> '.amount_with_currency_symbol( DonationHelpers::get_donation_charge_for_campaign_owner($row->raised)).'</li>';
                $withdraw_able_amount_without_admin_charge -= DonationHelpers::get_donation_charge_for_campaign_owner($row->raised);
            }else if($donation_charge_form === 'donor'){ 
                $output .= '<li><strong>'.__('Admin Tips').': </strong> '.amount_with_currency_symbol(optional(optional($row->cause_logs)->pluck('admin_charge'))->sum()).'</li>';
            }
             $output .= '<li><strong>'.__('Available For Withdraw').': </strong> '.amount_with_currency_symbol($withdraw_able_amount_without_admin_charge).'</li>';
             
            $output .= '<li><strong>' . __('Withdraw') . ':</strong> ' . amount_with_currency_symbol($row->withdraws->where('payment_status', 'approved')->pluck('withdraw_request_amount')->sum()) . '</li>';
            $output .= '<li><strong>' . __('Withdraw Pending') . ':</strong> ' . amount_with_currency_symbol($row->withdraws->where('payment_status', 'pending')->pluck('withdraw_request_amount')->sum()) . '</li>';
           
        }else{
            if ($donation_charge_form === 'donor'){
                 $adin_tips = is_null($row->cause_logs) ? 0 : $row->cause_logs->where('cause_id',$row->id)->pluck('admin_charge')->sum();
                 $output .= '<li><strong>'.__('Admin Tips').': </strong> '.amount_with_currency_symbol($adin_tips).'</li>';
            }
               
        }
        $output .= ' <li class="donation-status"><strong>' . __('Status') . ':</strong> ' . __($row->status) . '</li>';
        $output .= '</ul>';
        return $output;
    }

    public static function aboutUpdate($id)
    {
        $title = __('Add/Edit Update About Cause');
        $url = route('add.new.update.cause.page',$id);
        return <<<HTML
        <a href="{$url}"
           class="btn btn-info text-white mb-3 mr-1">{$title}
        </a>
HTML;
    }
    public static function comments($id)
    {
        $title = __('Cause Comments');
        $url = route('all.cause.comment.page',$id);
        return <<<HTML
        <a href="{$url}"
           class="btn btn-success text-white mb-3 mr-1">{$title}
        </a>
HTML;
    }

    public static function campaignApprove($id){
        $title = __('Approve This Campaign');
        $csrf = csrf_field();
        $action = route('admin.donation.approve');
        return <<<HTML
    <form action="{$action}" method="post"
          enctype="multipart/form-data">
          {$csrf}
        <input type="hidden" name="id" value="{$id}">
        <button class="btn btn-warning text-white mb-2"
                type="submit">{$title}
        </button>
    </form>
HTML;

    }

    public static function paymentInfoColumn($row){

        $data = $row->recurings;

        $id = '';
        foreach ($data as $it){
            $id = $it->cause_log_id ?? '';
        }
        $monthly_payment_check = !empty($id) ? '<li class="text-primary"><strong class="text-primary">'.__('Payment type').': </strong> '.__('Monthly').'</li>' : '';

        $output = '<ul>';
        $output .= $monthly_payment_check;
        $output .= '<li><strong>'.__('Donation Title:').' </strong> '.purify_html(optional($row->cause)->title).'</li>';
        $output .= '<li><strong>'.__('Amount').': </strong> '.amount_with_currency_symbol($row->amount).'</li>';
        $output .= '<li><strong>'.__('Name').': </strong> '.purify_html($row->name).'</li>';
        $output .= '<li><strong>'.__('Email').': </strong> '.purify_html($row->email).'</li>';

        if(!empty($row->gift)){
            $output .= '<li><strong>'.__('Gift Title').': </strong> '.purify_html(optional($row->gift)->title).'</li>';
            $output .= '<li><strong>'.__('Phone').': </strong> '.purify_html($row->phone).'</li>';
            $output .= '<li><strong>'.__('Address').': </strong> '.purify_html($row->address).'</li>';
            $output .= '<li><strong>'.__('Delivery Date').': </strong> '.purify_html(optional($row->gift)->delivery_date).'</li>';

            $gifts = optional($row->gift)->gifts;
            $colors = ['warning','info','primary','success'];

            $output.= '<li>';
            $output.= '<strong>'.__('Gifts :').'</strong>';
                foreach (json_decode($gifts) ?? [] as $key => $item){
                    $output.= '<span class=" mx-1 badge badge-'.$colors[$key % count($colors)].'">' .$item.'</span>' ;
                }
             $output.= '</li>';
          }


        $output .= '<li><strong>'.__('Admin Charge').': </strong> '.amount_with_currency_symbol($row->admin_charge).'</li>';
        $output .= '<li><strong>'.__('Payment Gateway').': </strong> '.ucwords(str_replace('_',' ',$row->payment_gateway)).'</li>';
        if ($row->status === 'complete' && $row->payment_gateway != 'manual_payment'){
            $output .= '<li><strong>'.__('Transaction ID').': </strong> '.$row->transaction_id.'</li>';
        }
        $output .= '<li><strong>'.__('Date').': </strong> '.date_format($row->created_at,'d M Y').'</li>';


        //Custom Fields and attachments
        $attachments = $row->attachments;
        $attachment_item = json_decode($attachments,true) ?? [];
        $fields = $row->custom_fields;


            if(!empty($attachment_item)):
                $output.='<li class="mt-2"> <strong class="text-info ">'.__('Custom Attachments').'</strong>';
            foreach($attachment_item as $attach):
                $attachment_name = str_replace('assets/uploads/attachment/applicant/','',$attach);
                $output.= '<div class="att mb-2">';
                        $output.='<strong class="text-dark ">'.__('Attachment:').'</strong>';
                        $output.= '<a target="_blank" href="'.url($attach).'">"'.$attachment_name.'"</a><br>';
                $output.= '</div></li>';
            endforeach;
            endif;

            if(!empty($all_custom_fields)):
                $output.= '<li class="mt-2"><strong class="mb-2 text-info ">'.__("Custom Fields").'</strong>';
                
                
            $all_custom_fields = json_decode($fields,true) ?? [];
        
            dd($all_custom_fields);
             
               
            foreach($all_custom_fields as $key=> $field):
                       
        
                $output.= '<div class="att">';
                $output.='<strong class="text-dark"> '.ucfirst($key) ?? ''.' : </strong>';
                $output.= '<span>' .$field ?? ''.'</span>';
                $output.=  '</div></li>';
            endforeach;
            endif;


        $output .= '</ul>';

        return $output;
    }


    public static function withdrawInfoColumn($row){
        
        $output = '<ul>';
        $output .= '<li><strong>'.__('Cause').': </strong> '.purify_html(optional($row->cause)->title).'</li>';
        $output .= '<li><strong>'.__('Requested By').': </strong> '.purify_html(optional($row->user)->name ?? __('untitled')).' ('.optional($row->user)->username.')'.'</li>';
        if(!empty($row->cause)){
            $withdraw_able_amount_without_admin_charge = optional($row->cause)->raised - optional($row->cause)->withdraws->where('payment_status' ,'!=', 'reject')->pluck('withdraw_request_amount')->sum();
            $charge_text = '';
            $donation_charge_form = get_static_option('donation_charge_form');
            if ($donation_charge_form === 'campaign_owner'){
                $charge_text = __('after admin charge applied');
                $output .= '<li><strong>'.__('Admin Charged From This Campaign').': </strong> '.amount_with_currency_symbol( DonationHelpers::get_donation_charge_for_campaign_owner($withdraw_able_amount_without_admin_charge)).'</li>';
                $withdraw_able_amount_without_admin_charge -= DonationHelpers::get_donation_charge_for_campaign_owner($withdraw_able_amount_without_admin_charge);
            }
            $output .= '<li><strong>'.__('Available For Withdraw Amount').' '.$charge_text.': </strong> '.amount_with_currency_symbol($withdraw_able_amount_without_admin_charge).'</li>';
        }

        $output .= '<li><strong>'.__('Requested Withdraw Amount').': </strong> '.amount_with_currency_symbol($row->withdraw_request_amount).'</li>';
        $output .= '<li><strong>'.__('Payment Gateway').': </strong> '.ucwords(str_replace('_',' ',$row->payment_gateway)).'</li>';
        $output .= '<li><strong>'.__('Payment Status').': </strong> '.$row->payment_status.'</li>';
        $output .= '<li><strong>'.__('Date').': </strong> '.date_format($row->created_at,'d M Y').'</li>';
        if($row->payment_status === 'approved'){
            $output .= '<li><strong>'.__('Approved Date').': </strong> '.date_format($row->updated_at,'d M Y').'</li>';
        }
        $output .= '</ul>';
        return $output;
    }

}