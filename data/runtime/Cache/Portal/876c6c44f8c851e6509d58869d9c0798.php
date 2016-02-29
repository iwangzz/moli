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
            <a href="<?php echo ($href); ?>" class="navus current">加入我们</a>
        </div>
        <div class="contentdiv clearfix">
            <div class="content zxcontent">
                <div class="mb40">
                    <h1 class="rrdcolor-blue-text mt15">招贤纳士</h1>

                    <div class="pg-about-section">
                        <p>我们是一支在互联网和金融领域非常优秀的团队！我们有梦有理想，我们积极乐观，脚踏实地，充满激情！如果你也和我们一样，那么欢迎你加入我们的团队！</p>
                    </div>
                    <div class="pg-about-section mt20">
                        <ul class="li-height30">
                            <li>我们会为你提供</li>
                            <li>在全新的互联网金融行业里开启个人事业的机会</li>
                            <li>富有竞争力的薪酬待遇</li>
                            <li>轻松惬意的工作氛围和充满活力的团队文化</li>
                            <li>完善的培训体系和更多的晋升机会</li>
                        </ul>
                    </div>
                    <div class="pg-about-section mt20">
                        <p>请发送您的简历至<a href="" target="_blank">phprince@163.com</a>，标题请注明所申请职位。
                        </p>
                    </div>
                </div>
                <div class="border-top pt30">
                    <h1 class="rrdcolor-blue-text">在招聘中的职位</h1>
                    <ul class="about-list">
                        <li class="">
                            <h5 class="fn-clear">
                                <p class="fn-left title color-dark-text fn-text-overflow">前端工程师 <i
                                        class="icon icon-hot ml10"></i></p>
                            </h5>
                            <div class="about-list-item color-lightgray-bg color-lightgray-text p20 mb20 mt15"
                                 style="display: block;">
                                <dl class="fn-clear mb30">
                                    <dt class="fn-left w100 mb15">岗位职责：</dt>
                                    <dd class="fn-left w590">
                                        <ol class="ui-style-decimal">
                                            <li class="mb10">依据产品需求完成高质量的Web前端开发和维护；</li>
                                            <li class="mb10">优化Web前端应用，改善用户体验；</li>
                                            <li class="mb10">参与Web前端开发规范的制定及开发流程的优化；</li>
                                            <li class="mb10">解决Web前端页面在各浏览器的兼容性问题；</li>
                                            <li>研究Web前端技术的发展，丰富Web交互方式；</li>
                                        </ol>
                                    </dd>
                                </dl>
                                <dl class="fn-clear">
                                    <dt class="fn-left w100 mb15">任职要求：</dt>
                                    <dd class="fn-left w590">
                                        <ol class="ui-style-decimal">
                                            <li class="mb10">全日制统招大学本科及以上学历，计算机相关专业；</li>
                                            <li class="mb10">2年以上大中型互联网公司前端开发经验；</li>
                                            <li class="mb10">精通各种Web前端技术，包括HTML、CSS、JavaScript、AJAX等；</li>
                                            <li class="mb10">熟悉各浏览器的差异、原理，精通jQuery等JS框架；</li>
                                            <li class="mb10">熟悉针对主流浏览器的代码兼容及优化；</li>
                                            <li class="mb10">熟悉B/S架构和常见页面布局；</li>
                                            <li class="mb10">有PHP、Mobile Web、HTML5实际开发经验者优先；</li>
                                            <li class="mb10">有其他程序语言（如Java、Python、ActionScript等）实践经验者优先；</li>
                                            <li>有良好的审美观和用户体验意识，良好的沟通能力与团队合作意识，能够承担一定工作压力；</li>
                                        </ol>
                                    </dd>
                                </dl>
                                <p class="text-right"><i class="icon icon-snow-top"></i></p>
                            </div>
                        </li>
                    </ul>
                </div>
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