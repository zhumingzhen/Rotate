<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RWechat extends Model
{
    private $fillable = [
        'subscribeb','openid','nickname','sex','city','province','country','headimgurl','subscribe_time','subscribe_scene'
    ];
}
