<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InthelinkInfo extends Model
{
    protected $table = 'inthelink_info';
    protected $fillable = [
        'name', 'phone', 'email', 'website', 'bank_name', 'bank_acc_num', 'momo_info', 'zalopay_info', 'address', 'editor_id'
    ];

    public function getEditor()
    {
        return $this->belongsTo('App\Models\User', 'editor_id', 'id');
    }
}
