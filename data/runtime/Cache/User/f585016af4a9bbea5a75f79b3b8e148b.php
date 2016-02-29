<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>账户总览</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/accountinfo.css">
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

<!--maincontent-->
<div class="maincontent">
    <div class="wdg-account-header">
        <div class="main-section">
            <ul class="account-menu fn-clear">
                <li class="active"><a href="/index.php/user/index/index">账户总览</a></li>
                <li class=""><a href="/index.php/user/index/accountinfo">账户设置</a></li>
            </ul>
        </div>
    </div>
    <div class="main-section" id="getClass">

        <div class="user-info-box fn-clear">
            <div class="user-avatar-container mt5 mb5">

                <img src="/themes/simplebootx/Public/images//touxiang.png">


                <div class="avatar-masking"><a href=""></a></div>
            </div>
            <div class="user-security-container mt5 mb5">
                <div class="user-login-info">
                    <?php echo ($user_info["user_login"]); ?>
                    <span>上次登录时间   <i class="num"><?php echo ($user_info["last_login_time"]); ?></i></span>
                </div>
                <div class="user-security-box fn-clear">
                    <span class="user-security-level">安全等级 <label id="sec-level">低</label></span>
                    <a class="safe-rank cellphone light" href=""
                       data-txt="绑定手机，使您的账户更加安全。||立即绑定"></a>
                    <a class="safe-rank man " href=""
                       data-txt="进行实名认证，让收益找到归宿。||立即认证"></a>
                    <a class="safe-rank lock " href=""
                       data-txt="现在设置交易密码，为收益保驾护航。||立即设置"></a>
                    <!--                    <a class="safe-rank mail " href=""
                                           data-txt="绑定邮箱，使您的账户更加安全。||立即绑定"></a>-->
                </div>
            </div>
            <div class="user-coupon-container">
                <dl>
                    <dt>今日收益</dt>
                    <dd>
                        <span><?php echo ($day_money); ?></span>元
                    </dd>
                </dl>
            </div>
        </div>

        <div class="user-assets-box">

            <div class="inquire-wrap fn-clear" style="display:none;">
                <div class="inquire">
                    <a href="">回账查询&gt;</a>
                    <span>共计 <i>0.00</i>元</span>

                </div>
                <div class="yellowtips-wrap mt10 fn-hide FUND_TIPS">

                    <a href="" class="button-yellow">查看详情</a>
                    <a href="javascript:" class="close"><img src=""></a>
                </div>
            </div>

            <div class="user-assets-box">
                <ul class="recharge-wrap fn-clear">
                    <li><a class="orange" href="/index.php/user/recharge/index">充值</a></li>
                    <li><a class="blue" href="/index.php/user/index/withDraw">提现</a></li>
                </ul>
                <div id="assets-tab" class="set-list">
                    <ul class="account-tab fn-clear">
                        <li class="acc-tab-li active" data-name="total-assets">
                            <a>账户总资产</a>
                            <span class=""><?php echo number_format($user_coin_info['all_account'],2);?> <i>元</i></span>
                        </li>
                        <li class="sign">
                            =
                        </li>
                        <li class="acc-tab-li" data-name="financial-assets">
                            <a>理财资产</a>
                            <span class=""><?php echo number_format($user_coin_info['collect_account'],2);?> <i>元</i></span>
                        </li>
                        <li class="sign">
                            +
                        </li>
                        <li class="acc-tab-li" data-name="balance">
                            <a>账户余额</a>
                            <span class=""><?php echo number_format($user_coin_info['use_account']+$user_coin_info['frozen_account'], 2);?> <i>元</i></span>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="in-round">
                <div id="canvas-holder">  <!--环形插件-->
                    <canvas class="chart-area" width="230" height="230"/>
                </div>
                <div class="in-list">
                    <div class="in-left">
                        <ul class="one-list">
                            <li class="pie-car">
                                <i class="icon"></i>
                                <span class="icon-car">利车宝</span>
                                <span class="icon-num"><?php echo number_format($account_info['car_money'], 2);?></span>
                            </li>
                            <li class="pie-car">
                                <i class="icon icon-b"></i>
                                <span class="icon-car">利房宝</span>
                                <span class="icon-num"><?php echo number_format($account_info['house_money'], 2);?></span>
                            </li>
                            <li class="pie-car">
                                <i class="icon icon-c"></i>
                                <span class="icon-car">福利宝</span>
                                <span class="icon-num"><?php echo number_format($account_info['new_money'], 2);?></span>
                            </li>
                        </ul>
                        <ul class="one-list">
                            <li class="pie-car">
                                <i class="icon"></i>
                                <span class="icon-car">冻结金额</span>
                                <span class="icon-num"><?php echo number_format($user_coin_info['frozen_account'], 2);?></span>
                            </li>
                            <li class="pie-car">
                                <i class="icon icon-b"></i>
                                <span class="icon-car">可用余额</span>
                                <span class="icon-num"><?php echo number_format($user_coin_info['use_account'], 2);?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="in-round" style="display: none;">
                <div id="canvas-holder">  <!--环形插件-->
                    <canvas class="chart-area" width="230" height="230"/>
                </div>
                <div class="in-list">
                    <div class="in-left">
                        <ul class="one-list">
                            <li class="pie-car">
                                <i class="icon"></i>
                                <span class="icon-car">利车宝</span>
                                <span class="icon-num"><?php echo number_format($second_info['car_money'], 2);?></span>
                            </li>
                            <li class="pie-car">
                                <i class="icon icon-b"></i>
                                <span class="icon-car">利房宝</span>
                                <span class="icon-num"><?php echo number_format($second_info['house_money'], 2);?></span>
                            </li>

                        </ul>
                        <ul class="one-list">
                            <li class="pie-car">
                                <i class="icon"></i>
                                <span class="icon-car">福利宝</span>
                                <span class="icon-num"><?php echo number_format($second_info['new_money'], 2);?></span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="in-round" style="display: none;">
                <div id="canvas-holder">  <!--环形插件-->
                    <canvas class="chart-area" width="230" height="230"/>
                </div>
                <div class="in-list">
                    <div class="in-left">
                        <ul class="one-list">
                            <li class="pie-car">
                                <i class="icon"></i>
                                <span class="icon-car">可用余额</span>
                                <span class="icon-num"><?php echo number_format($user_coin_info['use_account'],2);?></span>
                            </li>
                        </ul>
                        <ul class="one-list">
                            <li class="pie-car">
                                <i class="icon"></i>
                                <span class="icon-car">冻结金额</span>
                                <span class="icon-num"><?php echo number_format($user_coin_info['frozen_account'],2);?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="user-trading-box">
                <div class="trading-title">我的交易记录

                </div>
                <!-- transanstioncondition -->
                <ul class="ui-list ui-list-s" id="transactions">
                    <li class="ui-list-header text fn-clear">
                        <span class="ui-list-title w210 fn-left time pl25">交易时间</span>
                        <span class="ui-list-title w210 pl100 fn-left type">交易类型</span>
                        <span class="ui-list-title w200 text-right fn-left pr140 credit">金额</span>
                        <span class="ui-list-title w170 text-right fn-left pr25">结余</span>

                    </li>
                    <?php if($account_log_list): if(is_array($account_log_list)): foreach($account_log_list as $key=>$vo): ?><li class="ui-list-status">
                    <span class="tl fl pl10 w320"><?php echo array_shift(explode(' ', $vo['add_time']));?></span>
                    <span class="tl fl pl10 w205"><?php echo ($vo["type"]); ?></span>
                    <span class="fl w200 text-center"><?php echo ($vo["money"]); ?></span>
                    <span class="tr fr w120 mr24"><?php echo ($vo["use_money"]); ?></span>
                    </li><?php endforeach; endif; ?>
                    <?php else: ?>
                    <li class="ui-list-status">
                        <p class="color-gray-text">没有记录</p>
                    </li><?php endif; ?>
                </ul>
                <div class="pagination"><?php echo ($Page); ?></div>
            </div>
        </div>
        <div class="ui-poptip ui-poptip-new fn-hide" id="tipCon_1"
             style="position: absolute; left: 465.5px; top: 155px; display: none;">
            <div class="">
                <div class="ui-poptip-container">
                    <div class="ui-poptip-arrow ui-poptip-arrow-11">
                        <em></em>
                        <span></span>
                    </div>
                    <div class="ui-poptip-content padding10" data-role="content">
                        <div>进行实名认证，让收益找到归宿。<a href="">立即认证</a><i
                                class="iconfont closeTip"
                                style="position: absolute;right:-1px;top:2px;cursor: pointer;color:#d9c6a4; font-size:16px;padding: 0 2px; height: 16px;line-height: 16px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui-poptip ui-poptip-new fn-hide" id="tipCon_2" data-widget-cid="widget-1">
            <div class="">
                <div class="ui-poptip-container">
                    <div class="ui-poptip-arrow ui-poptip-arrow-10">
                        <em></em>
                        <span></span>
                    </div>
                    <div class="ui-poptip-content" data-role="content">
                        您已完成手机绑定 152****3815。
                        <a href="">修改</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui-poptip ui-poptip-new fn-hide" id="tipCon_3">
            <div class="">
                <div class="ui-poptip-container">
                    <div class="ui-poptip-arrow ui-poptip-arrow-10">
                        <em></em>
                        <span></span>
                    </div>
                    <div class="ui-poptip-content" data-role="content">
                        您已完成实名认证。
                    </div>
                </div>
            </div>
        </div>
        <div class="ui-poptip ui-poptip-new fn-hide" id="tipCon_4">
            <div class="">
                <div class="ui-poptip-container">
                    <div class="ui-poptip-arrow ui-poptip-arrow-10">
                        <em></em>
                        <span></span>
                    </div>
                    <div class="ui-poptip-content" data-role="content">
                        您已设置交易密码。
                        <a href="">修改</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui-poptip ui-poptip-new fn-hide" id="tipCon_5">
            <div class="">
                <div class="ui-poptip-container">
                    <div class="ui-poptip-arrow ui-poptip-arrow-10">
                        <em></em>
                        <span></span>
                    </div>
                    <div class="ui-poptip-content" data-role="content">
                        您已完成邮箱绑定。
                        <a href="">修改</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui-poptip ui-poptip-new fn-hide" id="tipCon_6" data-widget-cid="widget-2">
            <div class="">
                <div class="ui-poptip-container">
                    <div class="ui-poptip-arrow ui-poptip-arrow-10">
                        <em></em>
                        <span></span>
                    </div>
                    <div class="ui-poptip-content padding10" data-role="content">
                        <ul class="frozen-list">
                            <li class="fn-clear">
                                <span class="fro-name">投标冻结金额</span><span class="fro-value">0.00元 </span>
                            </li>
                            <li class="fn-clear">
                                <span class="fro-name">提现冻结金额</span><span class="fro-value">0.00元 </span>
                            </li>
                            <li class="fn-clear">
                                <span class="fro-name">其他冻结金额</span><span class="fro-value">0.00元 </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="fn-hide" id="confirm-not-menu">
            <div class="ui-confirm conform_pay_div">
                <span class="title data-dialog-title">提示</span>

                <div class="ui-confirm-content p20">
                    目前你没有可查阅的账单。
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

    <script src="/themes/simplebootx/Public/js//Chart.Core.js"></script>
    <script src="/themes/simplebootx/Public/js//Chart.Doughnut.js"></script>
    <script type="text/javascript">
        function online_service() {
            window.open('', '_blank', 'height=544, width=644,toolbar=no,scrollbars=no,menubar=no,status=no');
        }
        var doughnutData;
        if (<?php echo ($account_info['house_money_rate']); ?> == 0 && <?php echo ($account_info['car_money_rate']); ?> == 0 && <?php echo ($account_info['new_money_rate']); ?> == 0 && <?php echo ($account_info['frozen_money_rate']); ?> == 0 && <?php echo ($account_info['use_money_rate']); ?> == 0){
            var accountdata = [
                {
                    value: 25,
                    label: "利房宝"
                },
                {
                    value: 25,
                    label: "利车宝"
                },
                {
                    value: 25,
                    label: "福利宝"
                },
                {
                    value: 25,
                    label: "冻结金额"
                },
                {
                    value: 25,
                    label: "可用金额"
                }
            ];
            var tenderdata = [
                {
                    value: 25,
                    label: "利房宝"
                },
                {
                    value: 25,
                    label: "利车宝"
                },
                {
                    value: 25,
                    label: "福利宝"
                }
            ];
            var remainddata = [
                {
                    value: 25,
                    label: "冻结金额"
                },
                {
                    value: 25,
                    label: "可用金额"
                }
            ];
        }else {
            var accountdata = [
                {
                    value: <?php echo ($account_info['house_money_rate']); ?>,
                    label: "利房宝"
                },
                {
                    value: <?php echo ($account_info['car_money_rate']); ?>,
                    label: "利车宝"
                },
                {
                    value: <?php echo ($account_info['new_money_rate']); ?>,
                    label: "福利宝"
                },
                {
                    value: <?php echo ($account_info['frozen_money_rate']); ?>,
                    label: "冻结金额"
                },
                {
                    value: <?php echo ($account_info['use_money_rate']); ?>,
                    label: "可用金额"
                }
            ];
            var tenderdata = [
                {
                    value: <?php echo ($second_info['house_money_rate']); ?>,
                    label: "利房宝"
                },
                {
                    value: <?php echo ($second_info['car_money_rate']); ?>,
                    label: "利车宝"
                },
                {
                    value: <?php echo ($second_info['new_money_rate']); ?>,
                    label: "福利宝"
                }
            ];
            var remainddata = [
                {
                    value: <?php echo ($coin_info['frozen_account_rate']); ?>,
                    label: "冻结金额"
                },
                {
                    value: <?php echo ($coin_info['use_account_rate']); ?>,
                    label: "可用金额"
                }
            ];
        }
        window.onload = function () {
            doughnutData = accountdata;
            var demo = document.getElementById('getClass');
            var dom = getElementsByClassName(demo, 'chart-area');
            var ctx = dom[0].getContext("2d");//刷新/刚进页面，默认加载第一个圆插件
            window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive: true});
        };
        $(function () {
            $(".set-list .account-tab .acc-tab-li").click(function () {
                $(".set-list .account-tab .acc-tab-li").removeClass("active");
                $(".in-round").hide();
                $(".in-round").eq($(this).index() / 2).show();
                $(this).addClass("active");
                if ($(this).find('a').html() == '账户总资产') {
                    doughnutData = accountdata;
                } else if ($(this).find('a').html() == '理财资产') {
                    doughnutData = tenderdata;
                } else if ($(this).find('a').html() == '账户余额') {
                    doughnutData  = remainddata;
                }
                //调一次圆形插件
                var demo = document.getElementById('getClass');
                var dom = getElementsByClassName(demo, 'chart-area');
                var ctx = dom[$(this).index() / 2].getContext("2d");
                window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive: true});
            })
        });
        //获取dom兼容性方法
        function getElementsByClassName(node, classname) {
            if (node.getElementsByClassName) {
                //使用现有方法
                return node.getElementsByClassName(classname);
            } else {
                var results = new Array();
                var elems = node.getElementsByTagName('*');
                for (var i = 0; i < elems.length; i++) {
                    if (elems[i].className.indexOf(classname) != -1) {
                        results[results.length] = elems[i];
                    }
                    return results;
                }
            }
        }
    </script>
</body>
</html>