<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    const SET_DEFAULT = 1;

    protected $table = "delivery_addresses";

    protected $fillable = ['user_id', 'name', 'address', 'phone', 'set_default'];
}
