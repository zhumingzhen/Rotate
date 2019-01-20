<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<title>jQuery手机转盘抽奖代码 - 站长素材</title>

<link rel="stylesheet" type="text/css" href="{{ asset('css/rotate/index.css') }}">

</head>
<body>
    <input name="" id="uid" class="btn btn-primary" type="hidden" value="{{ $uid }}">
    <input name="" id="csrf_token" class="btn btn-primary" type="hidden" value="{{ csrf_token() }}">
    <div class="zp-box">
        <div class="dp-box">
            <img src="{{ asset('images/rotate/dipan.png') }}" class="g-lottery-img">
        </div>
        <div class="zhizhen">
            <img src="{{ asset('images/rotate/zhizhen.png') }}">
            <div id="cishu-text">点击开始<br><span id="cishu">0</span>次</div>
        </div>
    </div>

    <div class="jl">
        <p>
            <span id="zjjl">中奖纪录》</span>|<span id="look-gz">查看规则》</span>
        </p>
    </div>
    <div class="gdbox">
        <strong>中奖用户</strong>
        <p id="tit">
            <span>手机号</span>
            <span>获得奖励</span>
        </p>
        <div class="zhongj-bbk">
            <div class="zhongj-bb">
                <div class="zhongj-bbl" id="colee" style="overflow:hidden;">
                    <div id="colee1">19310334593</div>
                    <div id="colee2">红包10</div>
                </div>
                <div class="zhongj-bbl" id="colee" style="overflow:hidden;">
                    <div id="colee1">19310334593</div>
                    <div id="colee2">红包10</div>
                </div>
            </div>
        </div>
    </div>

    <!--遮罩&弹框-->
    <div class="zz"></div>
    <!--超级返现规则-->
    <div class="cjfx">
        <img src="{{ asset('images/rotate/close.png') }}" class="cjgz-c">
        <img src="{{ asset('images/rotate/cjgz.png') }}" id="cjgz-img">
    </div>
    <!--转盘规则-->
    <div class="zpgz">
        <img src="{{ asset('images/rotate/close.png') }}" class="cjgz-c">
        <img src="{{ asset('images/rotate/zpgz.png') }}" id="cjgz-img">
    </div>
    <!--中奖纪录-->
    <div class="zj">
        <img src="{{ asset('images/rotate/close.png') }}" class="cjgz-c">
        <img src="{{ asset('images/rotate/zjjl-img.png') }}" id="cjgz-img">
        <div class="zj-content">
            <p>
                <span id="mytime">时间</span>
                <span id="myjl">获得奖励</span>
            </p>
            <ul>
                <li><span>2017.10.31</span><span>0.3%己烯醛</span></li>
                <li><span>2017.10.31</span><span>0.3%己烯醛</span></li>
                <li><span>2017.10.31</span><span>0.3%己烯醛</span></li>
                <li><span>2017.10.31</span><span>0.3%己烯醛</span></li>
                <li><span>2017.10.31</span><span>0.3%己烯醛</span></li>
                <li><span>2017.10.31</span><span>0.3%己烯醛</span></li>
            </ul>
        </div>
    </div>
    <!-- 无次数提示弹框 -->
    <div class="wcs">
        <img src="{{ asset('images/rotate/close.png') }}" class="cjgz-c">
        <img src="{{ asset('images/rotate/wcs-tk.png') }}" class="wcs-img">
        <img src="{{ asset('images/rotate/ok-img.png') }}" class="ok-img">
    </div>
    <!-- 当日是否投资弹框 -->
    <div class="today">
        <img src="{{ asset('images/rotate/close.png') }}" class="cjgz-c">
        <img src="{{ asset('images/rotate/tz-tk.png') }}" class="tz-img">
        <img src="{{ asset('images/rotate/ok-img.png') }}" class="ok-img">
    </div>
    <!-- 抽到奖励弹框 -->
    <div class="jl-tk">
        <img src="{{ asset('images/rotate/close.png') }}" class="cjgz-c">
        <img src="{{ asset('images/rotate/zj-tk.png') }}" class="zj-img">
        <img src="{{ asset('images/rotate/ok-img.png') }}" class="ok-img">
        <p class="texts">恭喜您已获得<br>双季丰满减红包满1000可用50元</p>
    </div>
    <script type="text/javascript" src="{{ asset('js/rotate/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/rotate/jquery.rotate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/rotate/jquery.easing.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/rotate/jquery.jsonp.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/rotate/index.js') }}"></script>
</body>
</html>