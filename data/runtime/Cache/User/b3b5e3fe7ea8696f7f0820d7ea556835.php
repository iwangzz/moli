<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>账户总览</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/accountinfo.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/accountset.css">
</head>

<body class="body">
<!--  弹出框 -->
<div id="infor" style="display:none;"></div>
<form id="cardform" method="post" action="/index.php/user/index/bindcard">
    <div id="informas" style="display:none;">
        <span class="closed"><img src="/themes/simplebootx/Public/images/close.png"/></span>

        <h1>绑定银行卡</h1>

        <div class="shawed"><span class="err-sh posen"></span></div>
        <h2 class="cardholder">
            <span class="led1">*</span>
            <span class="led-word">持卡人</span>
            <input class="ui-input hidden-input" name="accountname" type="text" value="<?php echo ($account_name); ?>"
                   disabled="disabled"/>
        </h2>

        <div class="shawed"><span class="err-sh cardnum"></span></div>
        <h2>
            <span class="led1">*</span>
            <span class="led-word">卡号</span>
            <input class="ui-input banknum" name="banknum" type="text"/>
        </h2>

        <div class="shawed"><span class="err-sh bank"></span></div>
        <h2>
            <span class="led1">*</span>
            <span class="led-word">银行</span>
            <select class="blan ui-input bankname" name="bankname">
                <option>中国农业银行</option>
                <option>中国建设银行</option>
                <option>中国工商银行</option>
                <option>中国邮政储蓄银行</option>
                <option>中国光大银行</option>
                <option>中国银行</option>
                <option>招商银行</option>
                <option>交通银行</option>
                <option>浦发银行</option>
                <option>中国民生银行</option>
                <option>兴业银行</option>
                <option>华夏银行</option>
                <option>深圳发展银行</option>
                <option>广东发展银行</option>
            </select>
        </h2>
        <h2 class="ope">
            <span class="led1">*</span>
            <span class="led-word">开户城市</span>

            <div id="city_4">
                <select name="prov" class="prov provcity"></select>
                <select name="city" class="city provcity" disabled="disabled"></select>
                <select name="dist" class="dist provcity" disabled="disabled"></select>
            </div>
        </h2>
        <div class="shawed"><span class="err-sh cardzh"></span></div>
        <h2 class="branch card">
            <span class="led1">*</span>
            <span class="led-word">开户支行</span>
            <input class="ui-input branchname" name="branchname" type="text"/>
        </h2>

        <h2 class="save-h2">
            <a class="save surea" id="" href="javascript:void(0)">添加</a>
            <a class="save sureb cancel" href="javascript:void(0)">取消</a>
        </h2>
    </div>
</form>
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
                <li class=""><a href="/index.php/user/index/index">账户总览</a></li>
                <li class="active"><a href="/index.php/user/index/accountinfo">账户设置</a></li>
            </ul>
        </div>
    </div>
    <div class="main-section j-card">
        <div class="">
            <div id="setting-tab" class="ui-tab ui-tab-transparent ui-tab-setting">
                <ul class="ui-tab-items fn-clear">
                    <li class="ui-tab-item  ui-tab-item-2 " data-name="account-info">
                        <a href="/index.php/user/index/accountinfo" target="_self" class="ui-tab-item-link">账户信息</a>
                    </li>
                    <li class="ui-tab-item ui-tab-item-2  ui-tab-item-current  " data-name="my-bank-card">
                        <a href="/index.php/user/index/bankcard" target="_self" class="ui-tab-item-link">我的银行卡</a>
                    </li>
                </ul>
            </div>
            <div class=" color-white-bg">
                <div id="setting-tab-content">
                    <div class="ui-tab-content  fn-clear" data-name="account-info">
                    </div>
                    <div class="ui-tab-content fn-clear  ui-tab-content-current " data-name="my-bank-card">

                        <div class="bank-card-con">
                            <h3 class="bank_title">提现绑卡</h3>
                            <div id="banklis" class="">
                                <ul class="fn-clear bank-card-list">
                                    <?php if($flag == '1'): ?><li class="hiddendiv"><img src="/themes/simplebootx/Public/images/card.png"/>
                                            <span><?php echo ($bankinfo["bank_name"]); ?></span>
                                            <input type="text" value="<?php echo ($banknum_hide); ?>" disabled="disabled"/>
                                            <span id="editcard">编辑</span>
                                        </li>
                                        <?php else: ?>
                                        <li data-url="" class="card-item add-card"
                                            title="新增银行卡"></li><?php endif; ?>
                                </ul>
                            </div>

                            <h3 class="bank_title fund_bank">基金绑卡</h3>

                            <div id="fundbanklis" class="fund-bank-list-box fund_bank"></div>

                        </div>
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
<script src="/themes/simplebootx/Public/js/jquery-1.8.3.min.js"></script>
<script src="/themes/simplebootx/Public/js/cityselect.js"></script>
<script type="text/javascript" src="/themes/simplebootx/Public/js/bindcard.js"></script>
<script>
    $(document).ready(function () {
        var flag = '<?php echo ($flag); ?>';
        if (flag == '1') {
            $('.banknum').val('<?php echo ($banknum_hide); ?>');
            $('.bankname').val('<?php echo ($bankinfo["bank_name"]); ?>');
            $('.branchname').val('<?php echo ($bankinfo["branch_name"]); ?>');
            $("#city_4").citySelect({
                prov: "<?php echo ($bankinfo["bank_province"]); ?>",
                city: "<?php echo ($bankinfo["bank_city"]); ?>",
                dist: "<?php echo ($bankinfo["bank_dist"]); ?>",
                nodata: "none"
            });
        } else {
            $("#city_4").citySelect({
                prov: "北京市",
                city: "东城区",
                nodata: "none"
            });
        }
        $("#addcard").click(function () {
            $('#infor').show();
            $('#informas').show();
        })
        $("#editcard").click(function () {
            $('#infor').show();
            $('#informas').show();
        })
        $(".cancel").click(function () {
            $('#infor').hide();
            $('#informas').hide();
        })
        $('.closed').click(function () {
            $('#informas').hide();
            $('#infor').hide();
        })
        $('.card-item').click(function () {
            $('#informas').show();
            $('#infor').show();
        })
    })
</script>
</body>
</html>