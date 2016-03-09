<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>实名认证</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="keywords" content="摩利控股，摩利方线上理财，摩利P2P，摩利理财，P2P理财" />
<meta name="description" content="摩利方理财是摩利控股旗下的线上P2P理财平台，是集摩利金融、摩利银世影业、融资租赁、票据于一体的综合金融理财平台" />
<meta name="copyright"  content="本页版权归摩利控股所有. all rights reserved"  />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

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
                         <span class="icon icon-weixin" onmousemove="$(this).find('.m-tip').show();"
                               onmouseout="$(this).find('.m-tip').hide();">
                              <div class="m-tip">
                                  <div class="m-tip-panel edai-weixin-tip">
                                      <i></i>
                                      <span class="m-graphics graphics-arrow graphics-opacity black"></span>
                                      <img src="/themes/simplebootx/Public/images/qr_code02.jpg"/>
                                      <p>关注摩利方微信</p>
                                      <span class="hover-view"></span>
                                  </div>
                              </div>
                         </span>
                         <span class="icon icon-sina" onmousemove="$(this).find('.m-tip').show();"
                               onmouseout="$(this).find('.m-tip').hide();">
                             <div class="m-tip">
                                 <div class="m-tip-panel edai-weixin-tip">
                                     <i></i>
                                     <span class="m-graphics graphics-arrow graphics-opacity black"></span>
                                     <img src="/themes/simplebootx/Public/images/app_qrcode.jpg"/>
                                     <p>关注摩利方微博</p>
                                     <span class="hover-view"></span>
                                 </div>
                             </div>
                         </span>
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
                                    <li class="white"><a target="_blank" href="/index.php/user/Recharge/index"
                                                         onclick="javacript:_hmt.push(['_trackEvent', 'cz', 'click', 'dhcz']);">充值</a>
                                    </li>
                                    <li class="white"><a target="_blank" href="/index.php/user/index/withDraw"
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
        <h4 style="">在线客服</h4></a>
</div>


<script src="/themes/simplebootx/Public/js/jquery-1.8.3.min.js"></script>
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
<div class="wdg-account-header">
    <div class="main-section">
        <ul class="account-menu fn-clear">
            <li class=""><a href="/index.php/user/index/index">账户总览</a></li>
            <li class="active"><a href="/index.php/user/index/accountinfo">账户设置</a></li>
        </ul>
    </div>
</div>

<!-- main区域 -->
<div class="mains">
    <div class="mainContents">
        <form id="realform" action="/index.php/user/index/add_realinfo" method="post">
            <h1><span class="child3">实名认证信息</span></h1>
            <div class="content">
                <p class="child4">
                    <span class="ffer1 cid"><b>*</b>姓名</span>
                    <input class="realitems" name="realname" type="text" placeholder="姓名"/>
                        <span class="fly1" style="display: none">
                            <img src="/themes/simplebootx/Public/images/xx01.png"/><span></span>
                        </span>
                </p>
                <p class="child5">
                    <span class="ffer2 cid"><b>*</b>身份证号</span>
                    <input class="realitems" name="idnumber" type="text" value="" maxlength="18" placeholder="身份证号"/>
                        <span class="fly2" style="display: none">
                            <img src="/themes/simplebootx/Public/images/xx01.png"/><span></span>
                        </span>
                </p>
                <span class="subs"><a href="javascript:void(0)" id="realsubmit">提交</a></span>
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
                <p class="c-aaa">邮编：200000 Email：morleyfun@morley.com.cn</p>
                <p>摩利财富金融信息服务（上海）有限公司</p>
            </div>
        </div>
    </div>
</div>

<script src="/themes/simplebootx/Public/js/jquery-1.8.3.min.js"></script>
<script src="/themes/simplebootx/Public/js/realme.js"></script>
<script>
    $(document).ready(function () {
        $('#accountinfo').click(function () {
            location.href = '/index.php/user/index/index';
        })
        $('#accountset').click(function () {
            location.href = '/index.php/user/index/accountinfo';
        })
    })
</script>
</body>
</html>