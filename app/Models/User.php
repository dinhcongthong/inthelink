<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable 
{
    const USER_PROFILE = 'user_profile';


    use Notifiable;
    use SoftDeletes;
    private $modelPath = "App\Models\\";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'email_verified_at',  'gender', 'birthday'
        , 'password', 'user_type', 'mobile', 'last_sign_in_ip', 'verify_code', 'remember_token', 'reason_block', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    public function influencer()
    {
        return $this->hasOne('App\Models\Influencers');
    }

    public function social_network()
    {
        return $this->hasMany('App\Models\Social');
    }

    public function getAvatar() {
        return $this->hasOne('App\Models\Gallery', 'target_id', 'id')->whereDir(self::USER_PROFILE);
    }

    public function getAddresses() {
        return $this->hasMany('App\Models\UserAddress', 'user_id', 'id');
    }
}
