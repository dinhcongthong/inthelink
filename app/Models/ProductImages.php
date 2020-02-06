<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    const MAIN_IMAGE = 0;
    const IMAGE_FIRST = 1;
    const IMAGE_SECOND = 2;
    const IMAGE_THIRD = 3;

    protected $table = 'product_detail_images';
    protected $fillable = ['product_id', 'gallery_id', 'type'];
}
