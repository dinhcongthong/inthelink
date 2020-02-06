<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Seller extends Model
{
	protected $table="seller";

	private $modelPath = "App\Models\\";

    protected $fillable = [
        'id','user_id'
    ];
}
