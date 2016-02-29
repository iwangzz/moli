<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>设置支付密码</title>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/style.css">
</head>
<body>
<!--  head区域 -->
<div class="m-page">
    <div class="m-header">
        <div class="m-head">
            <div class="welcome">欢迎来到摩利方财富中心！</div>
            <div class="sub-info">
                <p class="si-text">全国服务热线：400-601-6188</p>|
                <a href="/index.php/portal/newer/newerguide" rel="nofollow">帮助中心</a>|
                <div class="edai-about clearfix" rel="nofollow">
                    <div class="a-si">
                        <span rel="nofollow">关注我们</span>
         <span class="icon icon-weixin" onmousemove="$(this).find('.m-tip').show();" onmouseout="$(this).find('.m-tip').hide();">
         </span>
                        <a href=""><span class="icon icon-sina"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-nav">
        <div class="site-win clearfix">
            <a href="/" class="logo">
                <img src="/themes/simplebootx/Public/images/logo.png" alt=""/>
            </a>

            <div class="right">
                <div class="user-msg">
                    <div class="user-login">
                        <a class="login" href="/index.php/user/login"
                           onclick="javacript:_hmt.push(['_trackEvent', 'dl', 'click', ' dhdl', 'dh']);"> <span
                                class="icon icon-logout"></span>登录 </a>
                        <span class="logspn">|</span>

                        <a class="teredfor" href="/index.php/user/register"
                           onclick="javacript:_hmt.push(['_trackEvent', 'zc', 'click', ' dhzc', 'dh']);">注册</a>
                    </div>
                    <div class="user-info">
                        <a href="/index.php/user/index/" class="login clearfix">

                            <span class="icon icon-logout">

                            </span>
                            <strong><?php echo ($user["user_nicename"]); ?></strong>
                            <span class="icon icon-triangle-small"></span>
                        </a>

                        <div class="m-tip">
                            <div class="m-tip-panel">
                                <i></i>
                                <span class="m-graphics graphics-arrow graphics-opacity black"></span>
                                <ul>
                                    <li><a href="/index.php/user/recharge/index"
                                           onclick="javacript:_hmt.push(['_trackEvent', 'cz', 'click', 'dhcz']);">充值</a>
                                    </li>
                                    <li><a href="/index.php/user/cash"
                                           onclick="javacript:_hmt.push(['_trackEvent', 'tx', 'click', 'dhtx']);">提现</a>
                                    </li>
                                    <li><a href="/index.php/user/index/logout">退出</a></li>
                                </ul>
                                <span class="hover-view"></span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="menu clearfix">
                    <ul>
                        <?php
 $effected_id="main-nav"; $filetpl="<a href='\$href' target='\$target'>\$label</a>"; $foldertpl="<a href='\$href' target='\$target' class='dropdown-toggle' data-toggle='dropdown'>\$label
                        <b class='caret'></b></a>"; $dropdown='dropdown'; $ul_class="dropdown-menu"; $li_class="" ; $style=""; $showlevel=6; echo sp_get_menu("main",$effected_id,$filetpl,$foldertpl,$ul_class,$li_class,$style,$showlevel,$dropdown); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/themes/simplebootx/Public/js/jquery-1.8.3.js"></script>
<script>
    $(document).ready(function () {
        var user = '<?php echo ($user["id"]); ?>';
//        console.log(user);
        $('.user-info').hide();
        if (user != '') {
            $('.user-info').show();
            $('.user-login').hide();
        } else {
            $('.user-login').show();
            $('.user-info').hide();
        }
        $("#main-nav a").each(function () {
            if ($(this)[0].href == String(window.location) && $(this).attr('href') != "") {
                $(this).addClass("current-active");
            }
        });
    });
</script>

<!--mainhead区域-->
<div class="maintab">
    <a href="/index.php/user/index/index"  class="tab tab01">账户总览</a>
    <a href="/index.php/user/index/mytender"  class="tab">我的投资</a>
    <a href="/index.php/user/index/accountinfo"  class="tab">账户设置</a>
</div>

<!-- main区域 -->
<div class="mainey">
    <div class="maingers">
        <h1><span class="child3">设置支付密码</span></h1>

        <form id="settradeform">
            <div class="content">
                <p class="child4">
                    <span class="ffer1"><b>*</b>输入密码</span>
                    <input name="tradepwd" type="password" class="passy1" placeholder="请输入交易密码" value="" maxlength="6"
                           onkeyup="onlyWriteNum(event,this);"
                           onkeypress="return vaildIntegerNumber(event) "
                           onpaste="return !clipboardData.getData('text').match(/\D/) "
                           ondragenter="return false" style="ime-mode:Disabled " />
        				<span class="fly1" style="display: none;">
        					<img src="/themes/simplebootx/Public/images/xx01.png"/>
        					<span></span>
        				</span>
                </p>

                <p class="child4 line1">
                    <span class="ffer1"><b>*</b>确认密码</span>
                    <input  name="retradepwd" class="passy2" type="password" placeholder="请确认交易密码" value="" maxlength="6"
                           onkeyup="onlyWriteNum(event,this);"
                           onkeypress="return vaildIntegerNumber(event) "
                           onpaste="return !clipboardData.getData('text').match(/\D/) "
                           ondragenter="return false" style="ime-mode:Disabled "/>
        				<span class="fly2" style="display: none;">
        					<img src="/themes/simplebootx/Public/images/xx01.png"/>
        					<span></span>
        				</span>
                </p>

                <p class="child5">
                    <span class="ffer2"><b>*</b>绑定手机号</span>
                    <span class="ffer3"><?php echo ($phone_number); ?></span>
                </p>

                <p class="child6">
                    <span class="ffer4"><b>*</b>验证码</span>
                    <input  name="settradecode" type="text" class="assy3" placeholder="请输入验证码" maxlength="6"
                           onkeyup="onlyWriteNum(event,this);"
                           onkeypress="return vaildIntegerNumber(event) "
                           onpaste="return !clipboardData.getData('text').match(/\D/) "
                           ondragenter="return false" style="ime-mode:Disabled "/>
                    <a id="sendCode" href="javascript:void(0)">获取验证码</a>
                    	<span class="fly3" style="display: none;">
                    		<img src="/themes/simplebootx/Public/images/xx01.png"/>
        					<span></span>
                    	</span>
                    <span class="nes8" id="times" style="display: none;"><b class="thrity">90</b><span>秒后重新获取</span></span>
                </p>
                <a class="subs clearfix" id="checktradepwdcode" href="javascript:void(0)">提交</a>
            </div>
        </form>
    </div>
</div>

<!--  footer区域 -->
<!--footer 开始-->
<div class="m-footer">
    <div class="more">
        <div class="site-win clearfix">
            <div class="links">
                <ul>
                    <li><p>关于摩利方</p>
                        <a href="/index.php/portal/index/about?id=17" target="_blank" rel="nofollow">摩利方简介</a>
                        <a href="/index.php/portal/index/about?id=18" target="_blank" rel="nofollow">合作伙伴</a>
                        <a href="/index.php/portal/index/about?id=22" target="_blank" rel="nofollow">诚聘英才</a>
                        <a href="/index.php/portal/index/about?id=20" target="_blank" rel="nofollow">联系我们</a></li>
                    <li><p>摩利方风采</p>
                        <a href="/index.php/portal/index/about?id=17" target="_blank" rel="nofollow">企业文化</a>
                        <a href="/index.php/portal/index/about?id=17" target="_blank" rel="nofollow">荣誉资质</a></li>
                    <li><p>安全保障</p>
                        <a href="/index.php/portal/newer/newerguide" target="_blank" rel="nofollow">新手指南</a>
                        <a href="/index.php/portal/index/about?id=21" target="_blank" rel="nofollow">常见问题</a>
                        <a href="/index.php/portal/index/about?id=19" target="_blank" rel="nofollow">网站公告</a>
                    </li>
                </ul>
            </div>
            <div class="spread">
                <p>关注我们：摩利方与你快乐分享</p>

                <div class="weixin">
                    <img src="/themes/simplebootx/Public/images/qr_code02.jpg"/>

                    <p>官方微信</p>
                </div>
                <div class="app">
                    <img src="/themes/simplebootx/Public/images/app_qrcode.jpg"/>

                    <p>新浪微博</p>
                </div>
            </div>
            <div class="contact">
                <p class="title">全国服务热线：</p>
                <a class="tel" href="tel:400-601-6188"><span class="icon icon-tel"></span>400-601-6188</a>

                <p class="c-aaa">地址：上海市长宁区娄山关路523号金虹桥国际中心1座16楼03室</p>
                <p class="c-aaa">邮编：200000 Email：phprince@163.com</p>
                <p>上海摩利方财富管理中心沪ICP备14039925号</p>
            </div>
        </div>
    </div>
</div>

<script src="/themes/simplebootx/Public/js/jquery-1.8.3.min.js"></script>
<script src="/themes/simplebootx/Public/js/settradepwd.js"></script>
<script>
    $(document).ready(function () {
        $('#sendCode').click(function () {
            var tradedata = $('#settradeform').serialize();
            $.ajax({
                url: '/index.php/user/index/settradepwdCode',
                type: 'POST',
                data: tradedata,
                success: function (data) {
                    if (data.status == 0) {
                        alert(data.msg);
                    } else if (data.status == 1) {
//                        alert(data.msg);
                        $('#sendCode').off();
                        timeDown('times', 60);
                    }
                }
            });
        });
        $('#checktradepwdcode').click(function () {
            var tradedata = $('#settradeform').serialize();
            $.ajax({
                url: '/index.php/user/index/checktradepwdCode',
                type: 'POST',
                data: tradedata,
                success: function (data) {
                    if (data.status == 0) {
                        alert(data.msg);
                    } else if (data.status == 1) {
                        alert(data.msg);
                        window.location.href = '/index.php/user/index/accountinfo'
                    }
                }
            });
        });

        function timeDown(id, n) {
            function jishi() {
                n--;
                n = n <= 0 ? 0 : n;
                if (n == 0) {
                    $('#sendCode').css('color', '#0084e8');
                    $('#' + id).empty();
                    $('#' + id).html('<b></b><span>请重新获取</span>');
                } else {
                    $('#' + id).find('span').html('秒后重新获取');
                    $('#' + id).show().find('b').html(n);
                    $('#sendCode').css('color', '#CCCCCC');
                }
            }

            var t = setInterval(function () {
                if (n <= 0) {
                    clearTimeout(t);
                } else {
                    jishi();
                }
            }, 1000);
        }
    });
</script>
</body>
</html>