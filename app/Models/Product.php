<?php

namespace App\Models;

use App\Models\Influencers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use SoftDeletes;
    const PRODUCT_DIR = 'product';
    const MAIN_IMG_TYPE = 0;
    
    protected $table = 'products';

    protected $fillable = [
        'name', 'author_id', 'category_id', 'price', 'inthelink_commission', 'description', 'content'
        , 'brand' , 'seller_info', 'weight', 'length', 'width', 'height', 'deleted_at'
    ];

    public function getCategory () {
        return $this->belongsTo('App\Models\Categories', 'category_id', 'id');
    }

    public function getEvaluations () {
        return $this->hasMany('App\Models\ProductEvaluation', 'product_id', 'id')->orderBy('updated_at', 'desc');
    }

    public function getSelected() {
        return $this->hasMany('App\Models\ProductSelected', 'product_id', 'id');
    }

    public function getOrders() {
        return $this->hasMany('App\Models\Order', 'product_id', 'id');
    }

    public function getAuthor() {
        return $this->belongsTo('App\Models\User', 'author_id', 'id');
    }

    public function getImgs() {
        return $this->hasMany('App\Models\Gallery', 'target_id', 'id')->whereDir(self::PRODUCT_DIR);
    }

    public function getMainImg() {
        return $this->hasMany('App\Models\Gallery', 'target_id', 'id')->whereDir(self::PRODUCT_DIR)->whereTargetType(self::MAIN_IMG_TYPE);
    }

    public function getProductSelectedAttribute() {
        $product_selected = ProductSelected::where('product_id', $this->id)
            ->where('user_id', Auth::user()->id)
            ->first('product_id');
        return $product_selected;
    }
}
