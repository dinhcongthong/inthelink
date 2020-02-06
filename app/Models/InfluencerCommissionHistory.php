<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfluencerCommissionHistory extends Model
{
    const PENDING_STATUS = 0;
    const COMPLETED_STATUS = 1;
    const CANCELLED_STATUS = 2;
    
    protected $table = 'influencers_commission_histories';

    protected $fillable = ['influencer_id', 'commission_money', 'order_id', 'status', 'payment_date'];

    public function getOrder() {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }
}
