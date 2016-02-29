<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>提现</title>
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
<div class="maincontent">   <!--只是覆盖common中mains样式-->
    <div class="mains">
        <div class="withdra">
            <h2 class="dra-tem"><span>申请提现</span></h2>

            <h2 class="dra-tem1">
                <span class="public">可提现金额：</span>
                <span class="cash"><?php echo ($coin_info["use_account"]); ?></span>
            </h2>

            <h2 class="dra-tem2">
                <span class="public">提现银行卡：</span>
                <?php if($bank_info): ?><div class="dar-card">
                    <img class="darimg" src="/themes/simplebootx/Public/images/card1.png"/>
                    <input class="darput1" type="text" value="<?php echo ($bank_info["bank_name"]); ?>"/>
                    <input class="darput2" type="text" value="<?php echo ($bank_info["bank_number"]); ?>"/>
                </div>
                <a class="again" href="javascript:void(0)">重新绑定</a>
                <?php else: ?>
                <a class="again" href="javascript:void(0)">立即绑定</a><?php endif; ?>
            </h2>
            <h2 class="dra-tem3">
                <span class="public">提现金额：</span>

                <div class="darput3">
                    <input type="text" id="account" name="account"/>
                    <span class="doll">元</span>
                </div>
                <span class="dolls">单次提现金额不能低于50元，大于150万</span>
            </h2>
            <!--
            <h2 class="dra-tem4">
                <span class="public">提现手续费：</span>
                <span class="darput4">0.00</span>
            </h2>
            -->
            <h2 class="dra-tem5">
                <span class="public">交易密码：</span>
                <?php if($user_info['user_trade_pass']): ?><input type="password" id="password" name="password"/>
                <a class="findpwd" href="javascript:void(0)">找回交易密码</a>
                <?php else: ?>
                <a class="findpwd" href="/index.php/user/index/setTradepwd">设置交易密码</a><?php endif; ?>
            </h2>
            <?php if($bank_info): ?><a class="application" id='postSubmit' href="javascript:void(0)">申请提现</a>
            <?php else: ?>
            <a class="application" href="/index.php/user/index/bankcard">绑定银行卡</a><?php endif; ?>

            <div class="warmprompt">
                <dl>
                    <dt class="public itemtitle">温馨提示：</dt>
                    <dd>1、请确保您输入银行账号信息准确无误。</dd>
                    <dd>2、双休日和法定节假日期间，用户可以申请提现，摩利方会在下一个工作日进行处理。由此造成的不便，请多多谅解！</dd>
                    <dd>3、平台禁止洗钱、银行卡套现、虚假交易等行为，一经发现并确认，将终止该用户的使用。</dd>
                    <dd>4、禁止洗钱、信用卡套现、虚假交易等行为，一经发现并确认，将终止该账户的使用。</dd>
                    <dd>5、提现常见问题解答，详见客服中心。</dd>
                </dl>
            </div>
        </div>
    </div>
    </div>
</div>
<script>
    $('#postSubmit').click(function(){
            $.ajax({
                type: 'POST',
                url: '/index.php/user/cash/cashForm' ,
                data: {account:$('#account').val(), password:$('#password').val()} ,
                success: function(data) {
                        alert(data.msg); 
                    if(data.status >= 0){
                        window.location.href = '/index.php/user'; 
                    }
                }
                });
            });
</script>
<!--  head区域 -->
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


</body>
</html>