<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>账户总览</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/themes/simplebootx/Public/css/common.css" rel="stylesheet">
    <link href="/themes/simplebootx/Public/css/bootstrap.css" rel="stylesheet">
    <link href="/themes/simplebootx/Public/css/css2.css" rel="stylesheet">
    <link href="/themes/simplebootx/Public/css/rechargeinfo.css" rel="stylesheet">
</head>
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
                                    <li class="white"><a href="/index.php/user/Recharge/index"
                                           onclick="javacript:_hmt.push(['_trackEvent', 'cz', 'click', 'dhcz']);">充值</a>
                                    </li>
                                    <li class="white"><a href="/index.php/user/index/withDraw"
                                           onclick="javacript:_hmt.push(['_trackEvent', 'tx', 'click', 'dhtx']);">提现</a>
                                    </li>
                                    <li class="white"><a href="/index.php/user/index/logout">退出</a></li>
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

<!--在线客服-->
<div class="online-service hidden-phone">
    <a class="online-service-title" href="" target="_blank">
        <div class="social-qq-pure"></div>
        <h4 style="">在线客服</h4> </a>
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


<div class="container ">
    <div id="errordiv"></div>
    <div class="wall">
        <!-- start:Wall -->
        <div class="dpay-title">
            <h4 class="pay-title">申请提现</h4>
        </div>
        <div class="form-horizontal">
            <div class="control-group">
                <div class="controls">
                    <div class="controls selpay">
                        <ul>
                            <li data-title="" data-index="2" class="lianlian-canuse"><span
                                    class="span-canuse">可提现金额：</span><span class="span-canuse"><?php echo round($use_coin,2);?>元</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <form action="" id="llform" name="llform">
                <!--连连支付-->
                <div id="lianlian_content" style="position:relative;">
                    <div class="control-group chinapnr-cash">
                        <?php if($use_coin == '0'): ?><div class="friendship-tip">
                                <h4>友情提示</h4>
                                您所选的账户中没有可提现金额哦。0<br>

                                <div class="controls goback-account">
                                    <a class="ui-btn ui-btn-orange ui-btn-size-2 input-goback" id="act_project_more"
                                       href="/index.php/user/index/">返回账户一览</a>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="cash-sum">
                                <h1><span>提现金额：</span><input type="text" value="0.00"></h1>
                                <button type="submit" class="btn btn-primary" id="cashsure"
                                        >确认提现
                                </button>
                            </div><?php endif; ?>

                    </div>
                    <div class="wenxi-tip">
                        <h3>提现说明：</h3>
                        <ol>
                            <li>提现实行同卡进出原则<br> 为了保障您的资金安全，采用同卡进出原则，即认证银行卡与提现银行卡一致。</li>
                            <li>到账时间<br> 提现申请后1-3个工作日资金到您的银行卡账户。<br>
                                注：实际到账时间将受第三方支付平台及银行端影响。
                            </li>
                            <li>提现手续费<br>
                                快捷账户费每笔为0元，摩利方将为您承担提现时与第三方支付系统所产生的所有手续费。若资金未经过平台，提现时将扣除取现金额的0.25%作为服务费。
                            </li>
                            <li>分账户管理<br>
                                快捷账户与汇付天下的账户余额不可合并使用。因快捷账户与汇付天下属于不同的第三方支付平台, 账户资产不可互通。
                            </li>
                            <li>提现遇到问题<br>
                                提现过程中遇到任何问题，请联系摩利方客服400-601-6188，我们会第一时间协助解决。
                            </li>
                        </ol>
                    </div>
                </div>
            </form>
        </div>
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
</body></html>