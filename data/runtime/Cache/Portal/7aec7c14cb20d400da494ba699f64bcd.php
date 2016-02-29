<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>项目详情</title>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link href="/themes/simplebootx/Public/css/bootstrap.css" rel="stylesheet">
    <!--样式-->
    <link href="/themes/simplebootx/Public/css/css2.css" rel="stylesheet">
    <!--样式-->
    <link href="/themes/simplebootx/Public/css/socialicon.css" rel="stylesheet">
    <!--QQ-->
    <!-- javascript common file-->
    <script type="text/javascript" src="/themes/simplebootx/Public/js/bootstrap.js"></script>
    <!--输入金额-->
    <script type="text/javascript" src="/themes/simplebootx/Public/js/eden.ui.helper.js"></script>
    <!--输入金额-->
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
        function placeholderSupport() {
            return 'placeholder' in document.createElement('input');
        }
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


<!-- main区域 -->
<div class="wdg-account-header">
    <div class="main-section">
        <a href="">项目列表</a>
    </div>
</div>

<script src="/themes/simplebootx/Public/js/blueimp-gallery.js"></script>
<!--弹层-->
<link href="/themes/simplebootx/Public/css/gallery.css" rel="stylesheet">
<!-- 弹层样式-->
<link href="/themes/simplebootx/Public/css/project-single.css" rel="stylesheet">
<!--样式-->


<div class="container">
    <div class="ui-round-box main-info" style="position:relative;" allowtimeunit="1" allowtime="6" rate="12">
        <div class="row-fluid">
            <div class="span9 col-l">
                <div class="box-title clearfix">
                    <div class="sp-t2"><?php echo ($borrow_info["borrow_title"]); ?></div>
                    <div class="sp-t3 tag" data-toggle="popover" data-placement="right" data-content=""
                         data-trigger="hover" data-html="true" data-original-title="" title="">
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span7 col-l-l">
                        <div class="col-l-l-wraper">
                            <div class="b-1 clearfix">
                                <div class="sp">
                                    <div class="value s-1">
                                        <span class="f-1"><?php echo ($borrow_info["rate"]); ?></span>
                                        <span class="f-2">%</span>
                                    </div>
                                    <div class="text">年化利率
                                    </div>
                                </div>
                                <div class="sp">
                                    <div class="value s-2">
                                        <span class="f-2">¥ </span> 
                                        <span class="f-1"><?php echo ($borrow_info['money']/10000); ?></span> 
                                        <span class="f-3">万</span>
                                    </div>
                                    <div class="text">融资金额</div>
                                </div>
                                <div class="sp">
                                    <div class="value  s-2">
										<span class="f-1">
                                            <?php echo ($borrow_info["borrow_days"]); ?>
										</span>
										<span class="f-3">
											天
																					</span>
                                    </div>
                                    <div class="text">融资期限</div>
                                </div>
                            </div>
                            <div class="b-2">
                                <p>发布时间：
                                <?php echo ($borrow_info["release_time"]); ?>
                                    <!--&nbsp; 还款时间：2016-08-17-->
                                </p>

                                <p>截止时间：
                                <?php echo ($other_info["last_time"]); ?></p>

                                <p>还款方式：
                                    <?php echo ($borrow_info["repay_type"]); ?>
                                </p>
                                <input id="expirydateTimeStamp" type="hidden" value="2016-02-19 23:59:59">

                                <p id="expirydate">剩余时间：<?php echo ($other_info["last_days"]); ?></p>
                                <script>
                                    function expirydate() {
                                        var iTime = $("#expirydateTimeStamp").val();
                                        iTime = iTime.replace(/-/g, "/");
                                        var iTimeB = (new Date(iTime)).getTime() - (new Date()).getTime();
                                        if (iTimeB > 0) {
                                            var iDay = parseInt(iTimeB / 1000 / 60 / 60 / 24, 10);
                                            var iHour = parseInt(iTimeB / 1000 / 60 / 60 % 24, 10);
                                            ;
                                            var iMinute = parseInt(iTimeB / 1000 / 60 % 60, 10);
                                            var iSecond = parseInt(iTimeB / 1000 % 60, 10);
                                            var sDay = "";
                                            if (iDay > 0) {
                                                sDay = iDay + "天";
                                            }
                                            var sTime = sDay + iHour + "小时" + iMinute + "分钟" + iSecond + "秒";
                                            $("#expirydate").html("剩余时间：" + sTime);
                                            setTimeout("expirydate()", 1000);
                                        } else {
                                            $("#expirydate").html("");
                                        }
                                    }
                                    function doCheckExpirydate() {
                                        var iTime = $("#expirydateTimeStamp").val();
                                        iTime = iTime.replace(/-/g, "/");
                                        if (iTime != null && iTime != "") {
                                            var timeBw = (new Date(iTime)).getTime() - (new Date()).getTime();
                                            if (timeBw > 0) {
                                                expirydate();
                                            }
                                        }
                                    }
                                    doCheckExpirydate();
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="span5 col-l-r">
                        <div class="p-item p-item-top clearfix">
                            <div class="sp-text">信用评分</div>
                            <div class="sp-value">9.7分
                            </div>
                        </div>
                        <div class="p-item clearfix">
                            <div class="sp-text">财务实力</div>
                            <div class="project-progress">
                                <div class="progress active">
                                    <div class="bar" style="width: 97%;"></div>
                                </div>
                            </div>
                            <div class="sp-value">97%</div>
                        </div>
                        <div class="p-item clearfix">
                            <div class="sp-text">经营情况</div>
                            <div class="project-progress">
                                <div class="progress active">
                                    <div class="bar" style="width: 97%;"></div>
                                </div>
                            </div>
                            <div class="sp-value">97%</div>
                        </div>
                        <div class="p-item clearfix">
                            <div class="sp-text">偿还能力</div>
                            <div class="project-progress">
                                <div class="progress active">
                                    <div class="bar" style="width:98%;"></div>
                                </div>
                            </div>
                            <div class="sp-value">98%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span3 col-r">
                <div class="col-r-wraper">
                    <!--<form style="" action="" method="post" id="Invest"-->
                          <!--novalidate="novalidate" onsubmit="lltform">-->
                        <div class="b-1 clearfix">
                            <div class="sp-text">投资进度</div>
                            <div class="project-progress">
                                <div class="progress progress-striped   active">
                                    <div class="bar" style="width:50%;"></div>
                                </div>
                            </div>
                            <div class="sp-value"><?php echo round($borrow_info['invest_money']/$borrow_info['money']);?>%</div>
                        </div>
                        <input type="hidden" name="invest.type" value="3" id="type">

                        <div class="b-2 clearfix">
                            <div class="sp-text">可投金额</div>
                            <div class="sp-value"><?php echo ($borrow_info['money']-$borrow_info['invest_money']); ?>&nbsp;元
                            </div>
                        </div>
                        <form name="post_form" id="post_form" action="/index.php/user/index/investconfirm" method="post">
                        <div class="b-3">
                            <div id="tz-error-wraper"></div>
                            <div style="display: inline-block; position: relative; *display: inline; *zoom: 1">
                                投资金额
                                <div class="controls input-append"
                                     style="margin-bottom: 0; position: relative; margin-left: 10px;">
                                    <input type="hidden" name="caninvest" id="caninvest" value="600000"> <input
                                        type="text" maxlength="12" onkeydown="onlyNum(event);" name="account"
                                        class="input-small amount-input valid" data-max-investment-money="600000"
                                        data-available-money="0" value="1000.00" id="tender_account">
                                    <span class="add-on">元</span>
                                </div>
                                <input id="borrow_id" name="id" type="hidden" value="<?php echo ($borrow_info["id"]); ?>">
                            </div>
                            <div class="forever-money">
                                预期收益 <span class="amount-total">
													59.18
											</span> 元
                            </div>
                        </div>
                            
                        <div class="b-4 clearfix">
										<span class="btn-login-tz">
                        <?php if($can_tender > 0): ?><button type="button" id="btnLoginTz" class="ui-btn ui-btn-orange ui-btn-size-1">立即投资</button>
                        <?php else: ?>
                        <button type="button" id="btnLoginTz" class="ui-btn ui-btn-orange ui-btn-size-1">无法投资</button><?php endif; ?>
										</span>
                        </div>
                    </form>
                        <?php if($user_coin): ?><div class="tip-money">
                            可用余额：<?php echo ($user_coin["use_account"]); ?>元
                        </div>
                        <div class="tips">
                            投标金额应不低于
                            <?php echo ($borrow_info["invest_lowest"]); ?>元
                        </div><?php endif; ?>

                    <script type="text/template" id="tpl-availableMoneyError">
                        <div class="b-valid-error-1">
                            <div class="b-valid-error-wraper">
                                <div class="item">您的账户中没有足够的余额</div>
                                <div class="item">
                                    <a class="ui-btn ui-btn-blue ui-btn-noshadow ui-btn-size-3" href="">立即充值</a>
                                </div>
                            </div>
                        </div>
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <article class="span9" style="position: relative">
            <div class="pvinfo-Container">
                <div class="ui-round-box box-xmxx" id="ProjectInfo">
                    <div class="box-title clearfix">
                        <div class="sp-t1">项目信息</div>
                        <a href="" target="_blank"
                           class="ui-btn ui-btn-blue ui-btn-size-min ui-btn-noshadow xy-btn ">投资协议</a>
                    </div>
                    <div class="box-content">

                        <div class="row-fluid">
                            <div class="span12">
                                <dl class="dl-horizontal">
                                    <dt>项目名称</dt>
                                    <dd><?php echo ($borrow_info["borrow_title"]); ?></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <dl class="dl-horizontal">
                                    <dt>年化利率</dt>
                                    <dd><?php echo ($borrow_info["rate"]); ?>%</dd>
                                </dl>
                            </div>
                        </div>

                        <div class="row-fluid">
                            <div class="span12">
                                <dl class="dl-horizontal">
                                    <dt>资金用途</dt>
                                    <dd><?php echo ($borrow_info["borrow_uses"]); ?></dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <dl class="dl-horizontal">
                                    <dt>本期融资金额</dt>
                                    <dd><?php echo ($borrow_info['money']/10000); ?>万元</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <dl class="dl-horizontal">
                                    <dt>本次授信额度</dt>
                                    <dd><?php echo ($borrow_info['money']/10000); ?>万元
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <dl class="dl-horizontal">
                                    <dt>项目情况</dt>
                                    <dd><p>
                                    <?php echo ($borrow_info["remark"]); ?>
                                    </p>
                                        </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                


                <div class="ui-round-box box-fksh">
                    <div class="box-title clearfix">
                        <div class="sp-t1">风控审核</div>
                    </div>
                    <div class="box-content box-content-1">

                        <table class="fk-tb" width="100%">
                            <thead>
                            <tr>
                                <th class="th-l" width="50%">审核项目</th>
                                <th class="th-r" width="50%">状态</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="row-1">
                                <td>身份认证</td>
                                <td><span class="gou">&nbsp;</span></td>
                            </tr>
                            <tr class="row-2">
                                <td>收入认证</td>
                                <td><span class="gou">&nbsp;</span></td>
                            </tr>
                            <tr class="row-1">
                                <td>征信报告</td>
                                <td><span class="gou">&nbsp;</span></td>
                            </tr>
                            <tr class="row-2">
                                <td>实地考察</td>
                                <td><span class="gou">&nbsp;</span></td>
                            </tr>
                            </tbody>
                        </table>

                        <p>&nbsp;</p>

                        <p style="font-weight: bold">还款来源</p>
                        <?php echo ($borrow_info["repay_source"]); ?>
                        <p>&nbsp;</p>

                        <p style="font-weight: bold">风控措施</p>

                        <p>
                        <?php echo ($borrow_info["management_views"]); ?>
                        </p>
                        </div>
                </div>
            </div>
        </article>
        <aside class="span3 side-container">
            <div class="ui-round-box box-cl">

                <div class="box-title clearfix">
                    <div class="sp-t1">相关资料</div>
                </div>
                <div class="box-content">
                    <div class="evidenceList">
                        <hr class="dashed">
                        <h4>相关资料</h4>
                        <div id="Contract" class="gallery">
                        <?php if(is_array($images)): foreach($images as $key=>$vo): ?><a data-gallery="gallery-contract" title="<?php echo ($vo["alt"]); ?>"
                            href="/data/upload/<?php echo ($vo["url"]); ?>" class="document">
                                <div class="img-polaroid">
                                    <div class="thumb">
                                        <img src="/date/upload/<?php echo ($vo["url"]); ?>">
                                    </div>
                                </div>
                                <p class="document-name"><?php echo ($vo["alt"]); ?></p>
                            </a><?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                <div class="slides"></div>
                <h3 class="title"></h3>
                <a class="prev">‹</a> <a class="next">›</a> <a class="close">×</a>
                <ol class="indicator"></ol>
            </div>
            <div class="ui-round-box box-tbjl">
                <div class="box-title clearfix">
                    <div class="sp-t1">投标记录</div>
                </div>
                <div class="box-content">
                    <div class="investmentedList">
                        <div id="investments_area" style="">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>投资人</th>
                                    <th style="text-align: right">投标金额</th>
                                </tr>
                                </thead>
                                <tbody id="investments_area_list">
                                    <?php if(is_array($tender_list)): foreach($tender_list as $key=>$vo): ?><tr title="2016-02-15 10:05:42">
                                    <td><?php echo ($vo["name"]); ?></td>
                                    <td style="text-align: right"><?php echo ($vo["price"]); ?></td>
                                </tr><?php endforeach; endif; ?>
                                </tbody>
                            </table>
                            <div style="text-align: right; display: none;" id="more_investment">
                                <a class="no-link" href="">显示更多</a>
                            </div>
                        </div>
                        <p id="no_investment" style="display: none">该项目暂无投标，抢个头彩吧！</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>

</div>

<!-- 倒计时 -->
<div id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myloginModal"
     aria-hidden="false" data-show="false"
     style="background: #f9f9f9; padding: 1px; border-radius: 10px; width: 320px; height: 230px; margin-top: -115px; top: 50%;">
    <div class="modal-header" style="padding: 0;">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>-->
        <h3 id="myModalLabel"
            style="background: #00adff; border-top-left-radius: 10px; border-top-right-radius: 10px; font-size: 18px; line-height: 60px; padding-left: 22px; color: #fff;">
            友情提示：投资前请先登录</h3>
    </div>
    <div class="modal-body" style="font-size: 12px; color: #666; line-height: 30px; padding: 25px 20px 10px;">
        <p>
            页面将在<span id="J_countdown" style="color: #f00;">5秒</span>内跳转至登录页面，若没有自动跳转，请点击下方按钮。
        </p>
    </div>
    <div class="modal-footer"
         style="background: #f9f9f9; font-size: 12px; color: #666; line-height: 30px; padding: 0 20px 10px;">
        <p style="float: left; font-size: 12px; color: #666; padding: 20px 0 0; margin: 0;">
            没有账户? <a href="">立即注册</a>
        </p>
        <button class="btn btn-large"
                onclick="javascript:window.location.href=&#39;http://jinqup2p.com/user/loginPage.html?returnUrl=/project/detail/711.html&#39;"
                style="background: #00adff; padding: 0 50px; color: #fff; height: 42px;">登录
        </button>
    </div>
</div>


<script type="text/javascript">
   $('#btnLoginTz').click(function(){
        $('#post_form').submit();
//        var tender_account = $('#tender_account').val();
//        var borrow_id = $('#borrow_id').val();
//        window.location.href = "/index.php/user/index/investconfirm/id/"+borrow_id+'/account/'+$tender_account;
    });
    var validate;
    $(function () {
        //投资表单验证
        var form = $("#Invest");
        var btn = $("#act_project_invest");
        btn.removeAttr("disabled");
        var inputAmount = form.find(".amount-input");
        var tplAvailableMoneyError = $("#tpl-availableMoneyError").html();

        function renderErrorTpl(error) {
            return "<div class=\"b-valid-error-1\"><div class=\"b-valid-error-wraper\">" + error + "</div></div>";
        };
        validate = {
            amount: function () {
                var v = $.trim(inputAmount.val());
                var vNumber = Number(v);
                var data = {
                    maxInvestmentMoney: Number(inputAmount.attr("data-max-investment-money")),
                    availableMoney: Number(inputAmount.attr("data-available-money"))
                };
                var isAvailableMoneyError = false;
                var errorMsg = "";
                var rs = false;
                var msgWraper = $("#tz-error-wraper");
                if (v == "") {
                    rs = false;
                    errorMsg = "投标金额不能为空";
                } else if (v > data.availableMoney) {
                    isAvailableMoneyError = true;
                    errorMsg = "可用余额不足";
                    rs = false;
                } else if (v > data.maxInvestmentMoney) {
                    errorMsg = "投标金额不能大于可投金额";
                    rs = false;
                } else if (vNumber % 100 != 0 || v <= 0) {
                    errorMsg = "投标金额应为100的正整数倍";
                    rs = false;
                } else {
                    rs = true;
                }
                ;
                msgWraper.empty();
                if (!rs) {
                    msgWraper.html(isAvailableMoneyError ? tplAvailableMoneyError : renderErrorTpl(errorMsg));
                    var b = msgWraper.find(".b-valid-error-1");
                    b.show().css({
                        top: -(b.height() + 12)
                    });

                }
                ;
                return rs;
            }
        };

        inputAmount.blur(function () {
            if ($.trim(inputAmount.val()) == "") {
                return;
            }
            ;
            validate.amount();
        });
        $("#radio-huifu").click(function () {
            if ($(this).val() == 1) {
                $("#act_project_invest").show();
                $("#act_project_lianlianinvest").hide();
            }
        })
        $("#radio-lianlian").click(function () {
            if ($(this).val() == 2) {
                $("#act_project_lianlianinvest").show();
                $("#act_project_invest").hide();
            }
        })
        $("#act_project_lianlianinvest").hide();
        $("#act_project_invest").hide();

    });
    /**
     * 调用js提交
     */
 
//      立即投资链接
//    function inverst_confirm() {
////alert(11111);return false;
//        $('#post_form').submit();
////        window.location.href = "/index.php/user/index/investconfirm";
////        }
//    }

    function lltform() {
        return false;
    }
    $(document).ready(function () {

        (function () {
            //点击灰色禁止关闭
            $('#loginModal').modal({backdrop: 'static', keyboard: false});
            //5秒倒计时
            $('#J_btn-touzhi').on('click', function (ev) {

                ev.preventDefault();
                var t = 5;

                function countdown() {
                    t--;
                    $("#J_countdown").html(t + '秒');
                    if (t <= 0) {
                        clearInterval(timer);
                        window.location.href = "";
                    }
                }

                var timer = setInterval(countdown, 1000);
            })

        })();


        EDEN_UI_HELPER.HookResponsiveTable();

        var afterTime = $('#AfterTime');
        if (afterTime.length > 0) {
            EDEN_UI_HELPER.countDown(afterTime, afterTime.attr("data-spantime"));
        }
        ;

        $('#no_investment').hide();
        $('#more_investment').hide();

        var skip = 1;
        var take = 20;

        $('#investments_area').show();

        function GetInvest(skip, take) {
            var postdata = {
                "id": "711",
                "pageNumber": skip,
                "pageSize": take,
                "once": +new Date()
            };
            $.getJSON('http://jinqup2p.com/project/InvestOrderlist.html?' + $.param(postdata), function (investmentList) {
                var $showMore = $("#more_investment");
                if (investmentList !== null && investmentList.result.length > 0) {
                    var listArray = [];
                    var records = investmentList.totalCount;
                    if (investmentList.hasNextPage) {
                        records = take;
                        $showMore.show();
                    }
                    else {
                        $showMore.hide();
                    }
                    for (var i = 0; i < investmentList.result.length; i++) {
                        listArray.push('<tr title="' + investmentList.result[i].createdatetimeString + '"><td>' + investmentList.result[i].fromcustomerscreenmobile + '</td><td style="text-align: right">' + investmentList.result[i].amount.toFixed(2) + '</td></tr>');
                    }
                    $("#investments_area_list").append(listArray.join(''));
                } else {
                    $showMore.hide();
                    if (skip === 0) {
                        $('#no_investment').show();
                    }
                }
            });

        }

        var more = $('#more_investment').on('click', function () {
            skip++;
            GetInvest(skip, take);
        });
        GetInvest(skip, take);


        var cal = function (amount, $obj) {
            amount = parseFloat(amount);
            var $amountTotal = $obj.parents('.b-3').find('.amount-total');
            if (isNaN(amount) || amount < minAmount || amount > maxAmount) {
                $amountTotal.html('');
                return;
            }
            var loandays = "180";

            var rate = "12";
            //  var investTip = $("#invest-tip");
            $amountTotal.empty().html((amount * loandays * rate / 100 / 365).toFixed(2));
            /*if(investTip.css("display") == "none"){
             investTip.fadeIn();
             }*/
        }

        var minAmount = parseFloat("1000");
        // var minAmount = parseFloat("1000");
        var maxAmount = parseFloat("600000");

        var t;

        $(".touzi-amount").on("focus", function () {
            var self = $(this);
            clearTimeout(t);
            cal(self.val(), self);
        }).on("keyup", function () {
            var self = $(this);
            cal(self.val(), self);
        }).on("blur", function () {
            t = setTimeout(function () {
            }, 0);
        });

        $(".amount-input").on("focus", function () {
            var self = $(this);
            clearTimeout(t);
            cal(self.val(), self);
        }).on("keyup", function () {
            var self = $(this);
            cal(self.val(), self);
        });
        /*.on("blur", function () {
         t = setTimeout(function () { $("#invest-tip").hide(); }, 0)
         });*/

        (function () {
            $('.main-info').mouseenter(function () {
                var _this = $(this);
                var actDiv = _this.find('.state-active');
                if (actDiv.length) {
                    _this.append('<p class="activity-intro">' + actDiv.attr("rewardDesc") + '</p>');
                }
            }).mouseleave(function () {
                var _this = $(this);
                _this.find('.activity-intro').remove();
            });
        })();
    });

</script>

<div class="online-service hidden-phone">
    <a class="online-service-title"
       href="" target="_blank">
        <div class="social-qq-pure"></div>
        <h4 style="">在线客服</h4></a>
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

<script src="/themes/simplebootx/Public/js/zoom.min.js"></script>
<script>
    $('#post_commit').click(function () {
        $('#post_form').submit();
    });
    $(document).ready(function () {
        var a = <?php echo ($other_info["rate_info"]); ?>;
    $('#putash').hide();
    $('#ash').hide();
    $("#tendernow").click(function () {
        var tendermoney = $('#tendermoney').val();
        // console.log(tendermoney);
        $('.paymoney').html(tendermoney);
        $('#account').val(tendermoney);
        $('#putash').show();
        $('#ash').show();
    })
    $("#cancle").click(function () {
        $('#putash').hide();
        $('#ash').hide();
    })
    function vaildIntegerNumber(evnt) {
        evnt = evnt || window.event;
        var keyCode = window.event ? evnt.keyCode : evnt.which;
        return keyCode >= 48 && keyCode <= 57 || keyCode == 8;
    }
    //输入框只可输入数字
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
    function animate() {
        $(".charts").each(function (i, item) {
            $(item).animate({
                width: a + "%"
            }, 1000);
        });
    }
    animate();

    })

</script>
</body>
</html>