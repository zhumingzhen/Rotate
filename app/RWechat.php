<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RWechat extends Model
{
    protected $fillable = [
        'subscribe','openid','nickname','sex','city','province','country','headimgurl','subscribe_time','subscribe_scene', 'subscribe_end_time', 'parent_id'
    ];
}
