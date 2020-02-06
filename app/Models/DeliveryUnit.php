<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryUnit extends Model
{
    protected $table = 'delivery_unit';
    protected $fillable = ['name', 'time_estate', 'delivery_price'];
}
