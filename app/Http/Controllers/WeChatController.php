<?php
namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RWechat;
use App\RDrawnumber;
use App\RUserAward;

class WeChatController extends Controller
{

    /**
 *      * 处理微信的请求消息
 *           *
 *                * @return string
 *                     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return "<a href='http://zp.ryhtgt.ltd/'>大转盘</a>";
            return "<a href='http://zpl.qianligu100.com/a?openid=".$message['FromUserName']."'>大转盘</a>";
            return "欢迎".$message['FromUserName'].",关注 馒头生活！";
        });
        return $app->server->serve();
    }

    public function a(Request $request){
        $openId = $request->input('openid');
        if(!$openId){
            return view('subscribe');
        }

        $app = app('wechat.official_account');
        $user = $app->user->get($openId);
        if($user['subscribe']==0){
            return view('subscribe');
        }else{
            $wechat = RWechat::where('openid', $openId)->first();
            if (!$wechat) {
                $wechat = $this->createWechat($user);
                $this->createDrawnumber($wechat['id']);
            }
            $uid = $wechat['id'];
            return view('index',compact('uid'));
        }
        return $user;
    }

    public function createWechat($wechat)
    {
        $wechat['subscribe_end_time'] = $wechat['subscribe_time'];
        return RWechat::create($wechat);
    }

    public function createDrawnumber($wechat_id)
    {
        $award = [
            'wechat_id' => $wechat_id,
            'everyday_number' => 2,
            'invite_number' => 0,
        ];
        return RDrawnumber::create($award);
    }


    public function award(Request $request)
    {
        $data['awards_id'] = $request->input('award');
        $data['awards_name'] = "";  //$request->input('awardName')
        $data['wechat_id'] = $request->input('id');

        RUserAward::create($data);

        return true;
    }

}
