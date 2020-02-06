<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfluencerProductLink extends Model
{
    protected $table = 'influencer_product_link';

    protected $fillable = ['influencer_id', 'product_id', 'url', 'influencer_commission', 'advertiser_commission'];

    
}
