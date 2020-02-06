<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSelected extends Model
{
    protected $table = 'product_selected';

    protected $fillable = ['user_id', 'product_id'];

    public function getProduct () {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
