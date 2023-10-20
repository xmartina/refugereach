<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventAttendance extends Model
{
    protected $table = 'event_attendances';
    protected $fillable = ['status','payment_status','quantity','event_id','event_name','checkout_type','user_id','event_cost','custom_fields','attachment'];
    
    protected $casts = [
        'user_id' => 'integer'
    ];
        
    public function event(){
        return $this->belongsTo('App\Events','event_id');
    }

    public function log(){
        return $this->hasOne(EventPaymentLogs::class,'attendance_id','id');
    }
}
