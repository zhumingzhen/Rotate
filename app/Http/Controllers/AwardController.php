<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RWechat;
use App\RUserAward;
use App\RDrawnumber;

class AwardController extends Controller
{

    public function award(Request $request)
    {
        $uid = $request->input('id');;
        $prize = $this->getPrize($uid);

        $data['awards_id'] = $prize['id'];
        $data['awards_name'] = $prize['name'];  //
        $data['wechat_id'] = $uid;
        $RWechat = RWechat::where('id', $request->input('id'))->first();
        $data['wechat_nickname'] = $RWechat->nickname;

        $RDrawnumber = RDrawnumber::where('wechat_id', $uid)->first();
        if ($RDrawnumber['everyday_number'] > 0) {
            $RDrawnumber->decrement('everyday_number');
        }elseif ($RDrawnumber['invite_number'] > 0) {
            $RDrawnumber->decrement('invite_number');
        }else {
            return ['code' => 200, 'message' => '抽奖次数不足'];
        }



        RUserAward::create($data);
        
        return ['code' => 200, 'message' => '抽奖成功', 'award' => $prize['id']];
    }

    // 后台抽奖******
    public function getPrize($uid)
    {
        return ['id'=>1,'name'=>'奖项一'];
    }
}
