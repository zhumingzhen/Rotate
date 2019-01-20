<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RDrawnumber extends Model
{
    protected $fillable = ['wechat_id', 'everyday_number', 'invite_number'];
}
