<?php
namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\RWechat;

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
            return "关注公众号，根据提示参加活动！";
        }
        $app = app('wechat.official_account');
        $user = $app->user->get($openId);
        $this->create($user);
        if($user['subscribe']==0){
            return "尚未关注公众号，请关注公众号，再来参加活动！";
        }else{
            
        }
        return $user;
    }

    public function create($wechat)
    {
        RWechat::create(wechat);
    }

}
