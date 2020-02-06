<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductEvaluation extends Model
{
    use SoftDeletes;

    protected $table = 'product_evaluation';

    protected $fillable = [
        'user_id', 'product_id', 'content', 'stars_number'
    ];

    public function getUser () {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
