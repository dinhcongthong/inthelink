<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Influencers extends Model
{
    const IDENTITY_FONT_THUMB = 'font_thumb';
    const IDENTITY_BACK_THUMB = 'back_thumb';
    const INFLUENCER_PROFILE = 'influencer-profile';

    const WAITING = 0;
    const ACCEPTED = 1;
    const DECLINED = 2;

    protected $table = "influencers";

    protected $fillable = [
        'id', 'user_id', 'bank_name', 'bank_acc_num', 'bank_acc_name', 'commission', 'status'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withTrashed();
    }

    public function getHistorySale() {
        return $this->hasMany('App\Models\InfluencerCommissionHistory', 'influencer_id', 'id');
    }

    public function getSocialLinks() {
        return $this->hasMany('App\Models\Social', 'influencer_id', 'id');
    }

    public function getIdentityFontThumb() {
        return $this->hasMany('App\Models\Gallery', 'target_id', 'id')->whereDir(self::INFLUENCER_PROFILE)->whereTargetType(self::IDENTITY_FONT_THUMB);
    }

    public function getIdentityBackThumb()
    {
        return $this->hasMany('App\Models\Gallery', 'target_id', 'id')->whereDir(self::INFLUENCER_PROFILE)->whereTargetType(self::IDENTITY_BACK_THUMB);
    }
}
