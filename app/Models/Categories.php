<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use SoftDeletes;

    const PARENTS_ID = 0;
    
    protected $table = "categories";

    protected $fillable = [
        'id', 'name', 'parent_id', 'order', 'description'
    ];

    public function getChilds()
    {
        return $this->hasMany('App\Models\Categories', 'parent_id', 'id');
    }

    public function getProducts() {
        return $this->hasMany('App\Models\Product', 'category_id', 'id');
    }

    public function getParent()
    {
        return $this->belongsTo('App\Models\Categories', 'parent_id', 'id');
    }
}
