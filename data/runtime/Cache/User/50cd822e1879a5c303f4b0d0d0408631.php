<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>注册页面</title>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/login.css">
</head>
<body>
<!--  head区域 -->
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
<div class="header">
    <div class="head-top">
        <div class="logo registerlogo">
            <a href="/" class="logopic">
                <img src="/themes/simplebootx/Public/images/loginlogo.png" />
            </a>
            <span></span>
            <b>欢迎注册</b>
        </div>
    </div>
</div>
<!-- mainwrapper -->
<div id="login-page">
    <div class="login-con registered-page">
        <form id="registerform" method="post" action="/index.php/user/register/doregister">
            <div class="regiseter-bg">
                <span class="free">免费注册账户</span>
                <input class="user inp-a" type="text" name="mobile" maxlength="11" placeholder="请输入手机号"
                       class="calculate"
                       onkeyup="onlyWriteNum(event,this);"
                       onkeypress="return vaildIntegerNumber(event) "
                       onpaste="return !clipboardData.getData('text').match(/\D/) "
                       ondragenter="return false" />
                 <span class="error-message" style="display: none">
                     <img src="/themes/simplebootx/Public/images/error.png" />
                     <span></span>
                 </span>
                <input class="user inp-b" type="password" name="password" placeholder="密码" maxlength="8"/>
                 <span class="error-pwd" style="display: none">
                     <img src="/themes/simplebootx/Public/images/error.png" />
                     <span></span>
                 </span>
                <input class="user inp-c" type="password" name="reppassword" placeholder="确认密码" maxlength="8"/>
                  <span class="confirm-pwd" style="display: none">
                     <img src="/themes/simplebootx/Public/images/error.png" />
                     <span></span>
                 </span>
                <div class="cation-code" id="sendCodes">
                    <input class="user-code inp-d" id="yzmCode" type="text"  name="regcode" placeholder="输入验证码" maxlength="6"/>

                    <div class="divbg"><a class="obtain-code" id="times" href="javascript:void(0)">获取验证码</a>
                        <span class="second"  style="display: none;"><b>90</b><span>秒后重新获取</span></span></div>

                </div>
                 <span class="time-code" style="display: none">
                     <img src="/themes/simplebootx/Public/images/error.png" />
                     <span></span>
                 </span>


                <h2 class="The-terms">
                    <input type="checkbox" id="is_server"/>
                    <span>我已阅读并同意</span>
                    <a href="/index.php/portal/index/agreement">《摩利方注册及服务协议》</a>
                    <a href="/index.php/portal/index/privacy" style="display:none;">《隐私条款》</a>
                </h2>
                <a class="registered-now" id="register">立即注册</a>
                <h2 class="have-account">
                    <span>已有账户？</span>
                    <a href="/index.php/user/login">登录</a>
                </h2>
            </div>
        </form>
    </div>
</div>

<!--footer2 -->
<div class="folls">
    <div class="following">
        <h2 class="pageone">
            <a href="/">摩利方首页</a>
            <span></span>
            <a href="/index.php/portal/index/investlist">我要理财</a>
            <span></span>
            <a href="/index.php/portal/newer/newerguide">新手引导</a>
            <span></span>
            <a href="/index.php/portal/index/about?id=17">关于我们</a>
        </h2>
        <h2 class="stance">
            Copyright©2012-2017 Corporation.All Rights Reserved.  上海摩利方互联网科技（上海）有限公司  沪ICP备13010370－1
        </h2>
    </div>
</div>

<script src="/themes/simplebootx/Public/js/jquery-1.8.3.min.js"></script>
<script src="/themes/simplebootx/Public/js/register.js"></script>
<!--<script>
    //ajax 提交表单示例代码
    $(document).ready(function () {
        $("#register").click(function () {
            var regdata = $('#register').serialize();
            $.ajax({
                type: "POST",
                url: 'index.php/user/register/doregister',
                data: regdata,
                success: function () {
                }
            })
        });
    });
</script>-->
<script>
    $(document).ready(function () {
        //校验注册验证码
        $('#register').click(function () {

        });
    })
</script>
</body>
</html>