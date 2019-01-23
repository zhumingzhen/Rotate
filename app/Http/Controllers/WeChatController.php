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
    protected $app;

    public function __construct()
    {
        $this->app = app('wechat.official_account');
    }

    /**
     *      * 处理微信的请求消息
     *      *
     *      * @return string
     **/
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $this->app->server->push(function($message){
            if ($message['MsgType'] == 'text') {
                if (is_numeric($message['Content'])) {
                    return "<a href='http://zpl.qianligu100.com/wechatUsers?openid=" . $message['FromUserName'] . "&invite=". $message['Content'] ."'>大转盘抽奖</a>";
                }
                if ($message['Content'] == '抽奖') {
                    return "<a href='http://zpl.qianligu100.com/wechatUsers?openid=" . $message['FromUserName'] . "'>大转盘抽奖</a>";
                }
            }
            // return "<a href='http://zp.ryhtgt.ltd/'>大转盘</a>";
            
            return "欢迎".$message['FromUserName'].",关注 馒头生活！";
        });
        return $app->server->serve();
    }


    /**
     * 
     * 服务号用
     * 
     * 查询信息跳到首页
     * 
     */
    public function wechatFWUsers(Request $request)
    {
        $response = $this->app->oauth->scopes(['snsapi_userinfo'])
            ->redirect('http://zpl.qianligu100.com/callback');
        return $response;
    }

    public function callback(Request $request)
    {
        $user = $this->app->oauth->user();
        dd($user);
        $user = $this->app->user->get($user['id']);
        $wechat = $this->createWechat($userInfo);

        if ($user['subscribe'] == 0) {
            return view('subscribe');
        } else {
            // 根据openid查询是否有该用户
            $wechat = RWechat::where('openid', $openId)->first();
            if (!$wechat) {
                // 是否有邀请码
                $invite = $request->input('invite');
                if ($invite) {
                    $user['parent_id'] = $invite;
                    // 邀请用户增加抽奖次数
                    RDrawnumber::where('wechat_id', $invite)->increment('invite_number');
                }
                // 创建用户
                $wechat = $this->createWechat($user);
                $this->createDrawnumber($wechat['id']);
            }
            // 查询中奖用户
            $totle = RUserAward::orderBy('created_at', 'DESC')->get();
            // 查询我的中奖信息
            $my = RUserAward::where('wechat_id', $wechat['id'])->orderBy('created_at', 'DESC')->get();
            // 游戏次数
            $number = $this->getGameNumber($wechat['id']);

            return view('index', compact('uid', 'totle', 'my', 'number'));
        }
    }

    /**
     * 
     * 订阅号用
     * 
     * 查询信息跳到首页
     * 
     */
    public function wechatUsers(Request $request){
        // 获取openid
        $openId = $request->input('openid');
        if(!$openId){
            return view('subscribe');
        }
        // 获取用户信息
        $user = $this->app->user->get($openId);
        // 判断是否关注
        // $user = ['subscribe'=>1];
        if($user['subscribe']==0){
            return view('subscribe');
        }else{
            // 根据openid查询是否有该用户
            $wechat = RWechat::where('openid', $openId)->first();
            if (!$wechat) {
                // 是否有邀请码
                $invite = $request->input('invite');
                if ($invite) {
                    $user['parent_id'] = $invite;
                    // 邀请用户增加抽奖次数
                    RDrawnumber::where('wechat_id', $invite)->increment('invite_number');
                }
                // 创建用户
                $wechat = $this->createWechat($user);
                $this->createDrawnumber($wechat['id']);
            }
            // 查询中奖用户
            $totle = RUserAward::orderBy('created_at', 'DESC')->get();
            // 查询我的中奖信息
            $my = RUserAward::where('wechat_id', $wechat['id'])->orderBy('created_at', 'DESC')->get();
            // 游戏次数
            $number = $this->getGameNumber($wechat['id']);
            
            return view('index',compact('uid','totle','my', 'number'));
        }
    }


    // 创建微信用户
    public function createWechat($wechat)
    {
        $wechat['subscribe_end_time'] = $wechat['subscribe_time'];
        return RWechat::create($wechat);
    }

    // 创建游戏次数表记录
    public function createDrawnumber($wechat_id)
    {
        $award = [
            'wechat_id' => $wechat_id,
            'everyday_number' => 2,
            'invite_number' => 0,
        ];
        return RDrawnumber::create($award);
    }

    // 获取游戏次数
    public function getGameNumber($uid)
    {
        $RDrawnumber = RDrawnumber::where('wechat_id', $uid)->first();
        $number = $RDrawnumber['everyday_number'] + $RDrawnumber['invite_number'];
        return $number;
    }

    

}
