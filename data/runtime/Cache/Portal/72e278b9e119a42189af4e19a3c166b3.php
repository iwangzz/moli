<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>投资列表</title>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/investlist.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/css2.css">
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


<!-- main区域 -->
<div class="invest">
    <div class="select">
        <h1 class="lect"><span>精选债权</span></h1>
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
    <div class="pageplugin">
        <div class="pagination"><?php echo ($page); ?></div>
    </div>
    <!--  翻页插件 -->
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
<script>
    function onlyWriteNum(e, obj) {
        var currKey = 0, e = e || event;
        currKey = e.keyCode || e.which || e.charCode;
        var keyName = String.fromCharCode(currKey);
        if (currKey == 37 || currKey == 39 || currKey == 8 || currKey == 46) {
            return;
        }
        if (obj.value.length == 1) {
            obj.value = obj.value.replace(/[^1-9]/g, '');
        }
        else {
            obj.value = obj.value.replace(/\D/g, '');
        }
    }
    function vaildIntegerNumber(evnt) {
        evnt = evnt || window.event;
        var keyCode = window.event ? evnt.keyCode : evnt.which;
        return keyCode >= 48 && keyCode <= 57 || keyCode == 8;
    }

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