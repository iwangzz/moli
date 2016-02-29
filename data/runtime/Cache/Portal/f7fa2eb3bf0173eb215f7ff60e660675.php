<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>公司简介</title>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/about.css">
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
                                    <li class="white"><a href="/index.php/user/recharge/index"
                                           onclick="javacript:_hmt.push(['_trackEvent', 'cz', 'click', 'dhcz']);">充值</a>
                                    </li>
                                    <li class="white"><a href="/index.php/user/cash"
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


<!-- main区域 -->
<div class="main clearfix">
    <!--  main-left -->
    <div class="main-left">
    <a class="item" href="javascript:void(0)">关于我们</a>
    <ul class="left-ul">
        <?php if(is_array($menu)): foreach($menu as $key=>$vo): if($vo["id"] == $menuid): ?><li class="left-li active">
                    <a class="" href="<?php echo ($vo["href"]); ?>"><?php echo ($vo["label"]); ?></a>
                </li>
                <?php else: ?>
                <li class="left-li">
                    <a class="" href="<?php echo ($vo["href"]); ?>"><?php echo ($vo["label"]); ?></a>
                </li><?php endif; ?>
            </li><?php endforeach; endif; ?>
    </ul>
</div>
    <div class="main-right">
        <div class="navright clearfix">
            <a href="javascript:void(0)" class="navus navwe">关于我们</a>
            <span class="separated">></span>
            <a href="<?php echo ($href); ?>" class="navus current">摩利方介绍</a>
        </div>
        <div class="contentdiv clearfix">
            <div class="content">
                <img class="line" src="/themes/simplebootx/Public/images/line.png"/>
                <img class="build" src="/themes/simplebootx/Public/images/building.png"/>

                <p class="intro">摩利方介绍</p>

                <p class="tro1">
                    摩利国际控股集团有限公司（以下简称：摩利控股）总部位于英国，运营总部设在香港。在持续的市场发展中，摩利国际控股逐步确立了以环保、传媒、地产、金融四大产业为主体的经营格局，成长为具有成熟商业模式和核心竞争优势的国际性、专业化集团公司。</p>

                <p class="tro1">
                    摩利国际控股同时是一个有责任感的现代企业。多年来，摩利国际控股通过多种方式实践着自己的社会责任，无论是灾害救助、捐资助学、公益赞助还是环保宣传，都努力体现着一个企业公民的基本准则。</p>

                <p class="tro1">摩利国际控股以”融天下财智
                    创常青伟业”为愿景，运用严格的商业准则和创新的商业智慧，实现与社会、客户、合作伙伴、员工及股东的共同发展、共同繁荣。摩利国际控股的长期战略目标是：将环保、地产</p>

                <p class="tro2">
                    金融业务作为未来可持续发展的核心产业，不断争取在行业内的领先地位；同时，持续挖掘增长潜力，促进其他业务的良好发展，形成业务板块之间的良好联动，创造最佳的社会、经济和环境效益。</p>
            </div>
            <div class="field">
                <img class="line" src="/themes/simplebootx/Public/images/line.png"/>

                <h1 class="wefield">我们涵盖的领域</h1>
                <img class="variety" src="/themes/simplebootx/Public/images/more.png"/>
            </div>
            <div class="field">
                <img class="line" src="/themes/simplebootx/Public/images/line.png"/>

                <h1 class="wefield">公司荣誉</h1>
                <img class="mada" src="/themes/simplebootx/Public/images/mada1.png"/>
                <img class="mada" src="/themes/simplebootx/Public/images/mada2.png"/>
                <img class="mada" src="/themes/simplebootx/Public/images/mada3.png"/>
                <img class="mada" src="/themes/simplebootx/Public/images/mada4.png"/>
                <img class="mada" src="/themes/simplebootx/Public/images/mada5.png"/>
                <img class="mada mada1" src="/themes/simplebootx/Public/images/mada6.png"/>
            </div>
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
<script src="/themes/simplebootx/Public/js/jquery-1.8.3.min.js"></script>
<script>
    $('.left-li').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
        $('.contentdiv').hide();
        $('.contentdiv').eq($(this).index() - 1).show();
        $('.navright').find('a').last().html($(this).find('a').html());
    });
</script>

</body>
</html>