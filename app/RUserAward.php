<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RUserAward extends Model
{
    protected $fillable = ['awards_id', 'awards_name', 'wechat_id','wechat_nickname'];
}