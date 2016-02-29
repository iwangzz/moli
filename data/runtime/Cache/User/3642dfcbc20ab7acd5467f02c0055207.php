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
    <script type="text/javascript">
        $(function () {
            if (!placeholderSupport()) { // 判断浏览器是否支持 placeholder
                $('[placeholder]').focus(function () {
                    var input = $(this);
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                        input.removeClass('placeholder');
                    }
                }).blur(
                        function () {
                            var input = $(this);
                            if (input.val() == ''
                                    || input.val() == input.attr('placeholder')) {
                                input.addClass('placeholder');
                                input.val(input.attr('placeholder'));
                            }
                        }).blur();
            }
            ;
        })

    </script>

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


<div class="container">
    <input type="hidden" name="paytype" id="paytype" value="lianlian">

    <div class="wall">
        <!-- start:Wall -->

        <div id="rechargeTypeDiv">
            <h4 class="pay-title" style="margin-bottom: 10px;">选择充值账户</h4>
            <a onclick="chagePayType(&#39;ll&#39;,&#39;pp&#39;);" href="javascript:void(0);" id="ll" title="快捷账户"
               class="ui-btn ui-btn-blue ui-btn-size-3">快捷账户</a>

        </div>

        <div id="llDiv" style="display:block;">

            <form action="/index.php/user/recharge/recharge" method="post" novalidate="novalidate" id="llform" name="llform"
                  onsubmit="return llSubmit();">
                <input type="hidden" name="uuid" value="39fc0c8c-0506-4998-b9af-7651533cbb6d">
                <input type="hidden" name="llRecharge.bankCode" id="llrecharge_BankCode">
                <input type="hidden" name="oldbankCode" id="oldbankCode">
                <h4 class="card-message">银联支付</h4>
                <div class="yinlian"><img src="/themes/simplebootx/Public/images/yinlianzhifu.jpg" width="200" height="90" /></div>
                <div class="pay-tip">
                    <div id="llpaytip"></div>
                </div>


                <div class="row-fluid form-horizontal">
                    <div id="firstpage">
                        <div class="control-group">
                            <label class="control-label" for="llRecharge.amount">充值金额</label>

                            <div class="controls">
                                <input class="input-xlarge" placeholder="请输入充值金额" data-val="true"
                                       onkeydown="onlyNum(event);" data-val-number="The field 金额 must be a number."
                                       data-val-regex="金额必须大于0且为整数或小数，小数点后不超过2位。"
                                       data-val-regex-pattern="(?!^0\d*$)^\d{1,16}(\.\d{1,2})?$"
                                       data-val-required="请填写金额。" id="llRecharge_Amount" name="rechargemoney"
                                       type="text">
                            </div>
								<span class="help-block"> <span class="field-validation-valid"
                                                                data-valmsg-for="llRecharge.amount"
                                                                data-valmsg-replace="true"></span>
								<span class="field-validation-error" data-valmsg-for="llRechargeAmount"
                                      data-valmsg-replace="true"></span>
							</span>
                        </div>
                    </div>
                </div>
                <div class="control-group add-footer-btn">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary" id="ll_recharge_submit"
                                style="background:#f60;background:#f60;width:190px;height:40px;font-size:18px;">确认充值
                        </button>
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
</body>
</html>