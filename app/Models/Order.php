<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    // PAYMENT
    const NOT_PAID_YET = 0;
    const PAID = 1;

    // status
    const PENDING_STATUS = 0;
    const CONFIRMED_STATUS = 1;
    const ON_GOING_STATUS = 2;
    const DELIVERED_STATUS = 3;
    const CANCELLED_STATUS = 4;

    protected $table = 'orders';
    protected $fillable = [
        'user_id', 'influencer_id', 'product_id', 'evaluation_id', 'delivery_addr', 'delivery_unit'
        , 'person_incharge', 'phone_incharge', 'product_name', 'category_name', 'quantity', 'profit'
        , 'status', 'price', 'total_amount', 'payment_method', 'payment_status', 'note', 'date_receive_est', 'deleted_at'
    ];

    public function getCustomer() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getInfluencer() {
        return $this->belongsTo('App\Models\Influencers', 'influencer_id', 'id');
    }

    public function getInfluencerHistory() {
        return $this->hasOne('App\Models\InfluencerCommissionHistory', 'order_id', 'id');
    }

    public function getDeliveryAddress() {
        return $this->belongsTo('App\Models\DeliveryAddress', 'delivery_addr_id', 'id');
    }

    public function getDeliveryUnit()
    {
        return $this->belongsTo('App\Models\DeliveryUnit', 'delivery_unit_id', 'id');
    }

    public function getProduct() {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function getProductThumb() {
        return $this->belongsTo('App\Models\Gallery', 'product_thumb_id', 'id');
    }

    public function getEvaluation () {
        return $this->belongsTo('App\Models\ProductEvaluation', 'evaluation_id', 'id');
    }
}
