<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>摩利方财富管理中心</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/index.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/css2.css">
    <script>
        //只能输入数字和编辑符()；
        function onlyNum(event) {
            //Delete  46   BackSpace 8  Left 37  Right 39   period colon  190   space 32
            if (!(event.keyCode == 46) && !(event.keyCode == 8) && !(event.keyCode == 37) && !(event.keyCode == 39) && !(event.keyCode == 190) && !(event.keyCode == 110))
                if (!((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105))) {												           //event.returnValue=false;
                    if (event && event.preventDefault) {
                        event.preventDefault();
                    }
                    else {
                        event.returnvalue = false;
                    }

                }

        }
    </script>
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


<!-- 轮播开始-->
<div class="changeBox-a1" id="change-32">
    <div class="changeDiv" style="display: block;">
        <a target="_blank"
           style="background:url(/themes/simplebootx/Public/images/banner1.png) center center; background-size:cover"></a>
    </div>
    <div class="changeDiv" style="display: none;">
        <a target="_blank"
           style="background:url(/themes/simplebootx/Public/images/banner2.png) center center; background-size:cover"></a>
    </div>
    <div class="changeDiv" style="display: none;">
        <a target="_blank"
           style="background:url(/themes/simplebootx/Public/images/banner3.png) center center; background-size:cover"></a>
    </div>
    <div class="changeDiv" style="display: none;">
        <a target="_blank"
           style="background:url(/themes/simplebootx/Public/images/banner1.png) center center; background-size:cover"></a>
    </div>
    <div class="changeDiv" style="display: none;">
        <a target="_blank"
           style="background:url(/themes/simplebootx/Public/images/banner2.png) center center; background-size:cover"></a>
    </div>
    <div class="changeDiv" style="display: block;">
        <a target="_blank"
           style="background:url(/themes/simplebootx/Public/images/banner3.png) center center; background-size:cover"></a>
    </div>
    <div class="div-change">
        <!--<div class="btn-bg"></div>-->
        <ul class="ul-change-a2">
            <li><span class="on"></span></li>
            <li><span class=""></span></li>
            <li><span class=""></span></li>
            <li><span class=""></span></li>
            <li><span class=""></span></li>
            <li><span class=""></span></li>
        </ul>
    </div>
    <!--左右按钮-->
    <div class='page pre'>
        <div></div>
    </div>
    <div class='page next'>
        <div></div>
    </div>
    <!--动画弹窗-->
    <div class="banner-center">
        <?php if($user_info == []): ?><div class="integral">
                <div class="background icon-barcode"></div>
                <div class="integral-view" style="display: block;">
                    <div class="user-logout">
                        <!--<span class="icon icon-yard"></span>-->
                        <p class="ul-title">预期年化收益率约</p>

                        <p class="ul-rate">12<span>%</span>-18<span>%</span></p>

                        <div class="ul-line"></div>
                        <div class="ul-message">
                            <div id="investment" class="view" style="width: 270px; height: 40px;">
                                <ul class="items" style="height: 1640px; top: -1200px;">
                                    <?php if(is_array($tender_list)): foreach($tender_list as $key=>$vo): ?><li class="" style="width: 270px; height: 40px;"><?php echo ($vo["user_name"]); ?> 成功投资 <span
                                                class="f60">￥<?php echo ($vo["money"]); ?></span>元
                                        </li><?php endforeach; endif; ?>
                                </ul>
                                <div class="tips" style="opacity: 0.6;">
                                    <div class="title">
                                        <a></a>
                                    </div>
                                    <div class="nums" style="top: 0px;">
                                        <a class="" style="border-radius: 5px;"></a>
                                        <a class="" style="border-radius: 5px;"></a>
                                        <a class="" style="border-radius: 5px;"></a>
                                        <a class="" style="border-radius: 5px;"></a>
                                        <a class="" style="border-radius: 5px;"></a>
                                        <a class="" style="border-radius: 5px;"></a>
                                        <a class="" style="border-radius: 5px;"></a>
                                        <a class="" style="border-radius: 5px;"></a>
                                        <a class="" style="border-radius: 5px;"></a>
                                        <a class="" style="border-radius: 5px;"></a>
                                        <a class="active" style="border-radius: 5px;"></a>
                                        <a style="border-radius: 5px;"></a>
                                        <a style="border-radius: 5px;"></a>
                                        <a style="border-radius: 5px;"></a>
                                        <a style="border-radius: 5px;"></a>
                                        <a style="border-radius: 5px;"></a>
                                        <a style="border-radius: 5px;"></a>
                                        <a style="border-radius: 5px;"></a>
                                        <a style="border-radius: 5px;"></a>
                                        <a style="border-radius: 5px;"></a>
                                        <a style="border-radius: 5px;"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div><a class="m-btn btn-send" href="/index.php/user/register"
                            onclick="javacript:_hmt.push(['_trackEvent', 'zc', 'click', 'bannerzc']);">注册领取</a></div>
                </div>
                <div class="barcode-view" style="display: none;">
                    <img src="/themes/simplebootx/Public/images/qr_code02.jpg"/>

                    <p class="onesweep"><span>微信扫一扫</span></p>

                    <p class="barcode-view-tip"><b></b><span>摩利方官方微信</span><b></b></p>
                </div>
            </div>
            <?php else: ?>
            <div class="integral">
                <div class="background icon-barcode"></div>
                <div class="integral-view">
                    <div class="user-login-info">
                        <p class="name">Hi，<?php echo ($user_info["user_nicename"]); ?></p>

                        <div class="line"></div>
                        <p>欢迎来到摩利方！</p>

                        <p>可用余额 : <span><?php echo ($use_account); ?></span>元<a href="/index.php/user/recharge/index" class="recharge"
                                                                 onclick="javacript:_hmt.push(['_trackEvent', 'cz', 'click', 'bannercz']);">充值</a>
                        </p>
                    </div>
                    <div><a href="/index.php/user/index/" class="m-btn btn-send"
                            onclick="javacript:_hmt.push(['_trackEvent', 'wdzh', 'click', ' bannerwdzh']);">前往我的账户</a></div>
                </div>
            </div><?php endif; ?>
    </div>
</div>

<div class="trade-data clearfix">
    <div class="site-win">
        <div class="title"><span class="icon icon-announcement"></span>摩立方公告</div>
        <div id="notice-list" class="roll" style="width: 980px; height: 16px;">
            <ul class="items" style="height: 48px; top: 0px;">
                <?php if(is_array($posts_list)): foreach($posts_list as $key=>$vo): ?><li class="" style="width: 980px; height: 16px;">
                        <a href="/index.php/portal/index/gonggaodetail/id/<?php echo ($vo["id"]); ?>" title="<?php echo ($vo["post_title"]); ?>"><?php echo ($vo["post_title"]); ?>
                            <span class="time"><?php echo array_shift(explode(' ', $vo['post_modified']));?></span>
                        </a>
                    </li><?php endforeach; endif; ?>
            </ul>
        </div>
        <a href="" rel="nofollow" class="more">更多公告</a>
    </div>
</div>

<!--ad  start-->
<div class="main-section content-section clearfix info-con">
    <div class="info-item">
        <h2><i class="icon icon-1 mr10"></i>安全</h2>

        <p>足额强抵押</p>

        <p>投资才安全</p>
    </div>
    <div class="info-item">
        <h2><i class="icon icon-2 mr10"></i>优质</h2>

        <p>优质投资项目</p>

        <p>经过严格筛选</p>
    </div>
    <div class="info-item">
        <h2><i class="icon icon-3 mr10"></i>省心</h2>

        <p>用户利益保障机制</p>

        <p>一站式财富管理平台</p>
    </div>
    <div class="info-item info-item-last">
        <h2><i class="icon icon-4 mr10"></i>灵活</h2>

        <p>急需用钱</p>

        <p>灵活赎回本息</p>
    </div>
</div>

<!--轮播结束-->
<div class="content">
    <div class="novice">
        <?php if($new_borrow_info): ?><span class="enjoy">新手尊享</span><?php endif; ?>
        <h1><span class="enjoy">精选债权</span><a class="right-more" href="/index.php/portal/index/investlist" target="_blank">更多>></a></h1>
        <!--tenderlistitem-->
        <div class="main-view">
            <div class="container">
                <div class="row">
                    <div class="span12 separate">
                        <?php if(is_array($borrow_info)): foreach($borrow_info as $key=>$vo): ?><div class="ui-project-item clearfix" allowtime="18" allowtimeunit="1" rate="15">
                                <div class="col-l">
                                    <div class="col-l-wraper">
                                        <div class="b-1 clearfix">
										<span class="sp sp-title">
											<a href="/index.php/borrow/detail/id/<?php echo ($vo["id"]); ?>"><?php echo ($vo["borrow_title"]); ?></a>
										</span>
                                        </div>
                                        <div class="b-2 clearfix">
                                            <div class="sp">
                                                <div class="value s-1">
                                                    <span class="f-1 rate"><?php echo ($vo["rate"]); ?></span>
                                                    <span class="f-2">%</span>
                                                </div>
                                                <div class="text">年化利率
                                                </div>
                                            </div>
                                            <div class="sp">
                                                <div class="value s-2">
                                                    <span class="f-1 time"><?php echo ($vo["borrow_days"]); ?></span>
												<span class="f-3">
													天
													</span>
                                                </div>
                                                <div class="text">融资期限</div>
                                            </div>
                                            <div class="sp">
                                                <div class="value s-2">
                                                    <span class="f-2">¥ </span>
                                                    <span class="f-1"><?php echo ($vo['money']/10000); ?></span>
                                                    <span class="f-3">万</span>
                                                </div>
                                                <div class="text">融资金额</div>
                                            </div>

                                            <div class="sp progress-range">
                                                <div class="b-progress clearfix">
                                                    <div class="project-progress">
                                                        <div class="progress progress-striped active">
                                                            <div class="bar"
                                                                 style="width:<?php echo ($vo['invest']/$vo['money']*100); ?>%;"></div>
                                                        </div>
                                                        <span class="text"><?php echo ($vo['invest']/$vo['money']*100); ?>%</span>
                                                    </div>

                                                </div>
                                                <div class="b-total clearfix">
                                                    <span class="s-1 money-blue"><?php echo ($vo['money']-$vo['invest']); ?></span>
                                                    <span class="s-2 money-userable">元可投</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="b-3 clearfix">
										<span class="sp sp-type2">
												按月还息到期还本
										</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-r" style="position:relative;">
                                    <div class="b-3">
                                        <div class="touzi-money">
                                            投资金额
                                            <div class="controls input-append"
                                                 style="margin-bottom:0;position:relative">
                                                <input type="text" maxlength="12" name="invest.amount"
                                                       onkeydown="onlyNum(event);" id="0"
                                                       class="input-small valid calculate"
                                                       style="padding:2px 6px; margin-left:10px;"
                                                       data-max-investment-money="" data-available-money=""
                                                       value="10000.00" id="1">
                                                <span class="add-on" style="padding:2px 5px;">元</span>
                                            </div>
                                            <input id="id" name="id" type="hidden" value="263">
                                            <input id="borrowtype" name="invest.borrowtype" type="hidden" value="0">
                                        </div>
                                        <div class="forever-money">预期收益 <span class="amount-total">
                                            <?php echo round($vo['rate']/36500*10000*$vo['borrow_days'],2);?>
											</span> 元
                                        </div>
                                    </div>

                                    <div class="b-btn-bar">
                                        <button type="button" class="ui-btn ui-btn-orange ui-btn-size-1 ui-btn-login"
                                                id="J_btn-touzhib"
                                                onclick="window.location.href='/index.php/borrow/detail/id/<?php echo ($vo["id"]); ?>'">
                                            立即投资
                                        </button>

                                    </div>
                                </div>
                            </div><?php endforeach; endif; ?>
                    </div>
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

<script src="/themes/simplebootx/Public/js/common.js" type="text/javascript"></script>
<script src="/themes/simplebootx/Public/js/unslider.min.js" type="text/javascript"></script>
<script src="/themes/simplebootx/Public/js/index.js" type="text/javascript"></script>
<!--[if IE]>
<script src="/themes/simplebootx/Public/js/excanvas.js" type="text/javascript"></script><![endif]-->
<script src="/themes/simplebootx/Public/js/new_file.js"></script>
<script src="/themes/simplebootx/Public/js/soChange.js"></script>
<script src="/themes/simplebootx/Public/js/pace.js"></script>
<script src="/themes/simplebootx/Public/js/Marquee.js"></script>
<script src="/themes/simplebootx/Public/js/radialIndicator.min.js"></script>
<script>
    $(function ($) {
        $(".knob").knob({
            draw: function () {
                // "tron" case
                if (this.$.data('skin') == 'tron') {

                    this.cursorExt = 0.3;

                    var a = this.arc(this.cv)  // Arc
                            , pa                   // Previous arc
                            , r = 1;

                    this.g.lineWidth = this.lineWidth;

                    if (this.o.displayPrevious) {
                        pa = this.arc(this.v);
                        this.g.beginPath();
                        this.g.strokeStyle = this.pColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                        this.g.stroke();
                    }

                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                    this.g.stroke();

                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();

                    return false;
                }
            }
        });
    });

    $(document).ready(function () {
        $(".calculate").bind("input", function () {
            var money = parseFloat($(this).val());
            var monthrate = parseFloat($(this).parents('.col-r').prev().find('.rate').html()) / 365;
            var time = parseFloat($(this).parents('.col-r').prev().find('.time').html());
            var income = Number(monthrate * money * time / 100).toFixed(2);
            $(this).parents('.touzi-money').next().find('.amount-total').html(income);
        })
    })
</script>

</body>
</html>