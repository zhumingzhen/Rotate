var basepath = "http://192.168.1.100:8085/portal-bos";
// 倒计时
var interval = 1000;


//超级返现规则
$("#gz-b").on('click', function() {
	$(".zz").show();
	$(".cjfx").show();
});
$(".cjgz-c").on('click', function() {
	$(".zz").hide();
	$(".cjfx").hide();
});
//大转盘规则
$("#look-gz").on('click', function() {
	$(".zz").show();
	$(".zpgz").show();
});
$(".cjgz-c").on('click', function() {
	$(".zz").hide();
	$(".zpgz").hide();
});
//中奖纪录
$("#zjjl").on('click', function() {
	$(".zz").show();
	$(".zj").show();
});
$(".cjgz-c").on('click', function() {
	$(".zz").hide();
	$(".zj").hide();
});
//无次数弹框
$(".cjgz-c").on('click', function() {
	$(".wcs").hide();
	$(".zz").hide();
});




//抽奖代码
$(function() {
	var $btn = $('.g-lottery-img'); // 旋转的div
	var cishu = $("#number").val(); //初始次数，由后台传入
	$('#cishu').html(cishu); //显示还剩下多少次抽奖机会
	var isture = 0; //是否正在抽奖


	var clickfunc = function (award) {
		//data为随机出来的结果，根据概率后的结果
		switch (award) {
			case 1:
				rotateFunc(1, 25, '双季丰0.1%加息红包');
				break;
			case 2:
				rotateFunc(2, 70, '双季丰满减红包10元');
				break;
			case 3:
				rotateFunc(3, 115, '1元现金红包');
				break;
			case 4:
				rotateFunc(4, 160, '财金币20枚');
				break;
			case 5:
				rotateFunc(5, 203, '20元现金红包');
				break;
			case 6:
				rotateFunc(6, 245, '双季丰0.5%加息红包');
				break;
			case 7:
				rotateFunc(7, 290, '双季丰满减红包50元');
				break;
			case 8:
				rotateFunc(8, 340, '5元现金红包');
				break;
		}
	}
	$(".zhizhen").click(function() {
		//判断是否投资然后是fou抽奖========================================================
		var touzi = "没投资11";
		if (touzi == "没投资") {
			$(".zz").show();
			$(".today").show();
			$(".cjgz-c").on('click', function() {
				$(".zz").hide();
				$(".today").hide();
			});
			$(".ok-img").on('click', function() {
				$(".zz").hide();
				$(".today").hide();
			});
		} else {
			$(".zz").hide()
			$(".today").hide();
			if (isture) return; // 如果在执行就退出
			isture = true; // 标志为 在执行
			if (cishu <= 0) { //当抽奖次数为0的时候执行
				$(".zz").show();
				$(".wcs").show();
				$(".ok-img").on('click', function() {
					$(".wcs").hide();
					$(".zz").hide();
				});
				// alert("没有次数了");
				$('#cishu').html(0); //次数显示为0
				isture = false;
			} else { //还有次数就执行
				cishu = cishu - 1; //执行转盘了则次数减1
				if (cishu <= 0) {
					cishu = 0;
				}
				$('#cishu').html(cishu);

				uid = $("#uid").val();
				csrf_token = $("#csrf_token").val();

				url = '/award'
				$.ajax({
					type: "post",
					url: url,
					//      data: "para="+para,  此处data可以为 a=1&b=2类型的字符串 或 json数据。
					data: {
						// "award": awards,
						// "awardName": text,
						"id": uid,
						"_token": csrf_token
					},
					cache: false,
					async: false,
					dataType: "json",
					success: function (data, textStatus, jqXHR) {
						console.log(data);
						award = data.award;
						/*
						if("true"==data.flag){
						alert("合法！");
							return true;
						}else{
							alert("不合法！错误信息如下："+data.errorMsg);
							return false;
						}
						*/
					},
					error: function (XMLHttpRequest, textStatus, errorThrown) {
						alert("请求失败！");
					}
				});

				console.log(award);
				clickfunc(award);
			}
		}
	});
	var rotateFunc = function(awards, angle, text) {
		isture = true;
		$btn.stopRotate();
		$btn.rotate({
			angle: 0, //旋转的角度数
			duration: 4000, //旋转时间
			animateTo: angle + 1440, //给定的角度,让它根据得出来的结果加上1440度旋转
			callback: function() {
				isture = false; // 标志为 执行完毕
				alert(text);

				$(".texts").html("恭喜您，已获得<br>" + text);
					// console.log(text)
				$(".zz").show();
				$(".jl-tk").show();
				$(".cjgz-c").on('click', function() {
					$(".zz").hide();
					$(".jl-tk").hide();
					location.reload()
				});
				$(".ok-img").on('click', function() {
					$(".zz").hide();
					$(".jl-tk").hide();
					location.reload()
				});

			}
		});
	};
});