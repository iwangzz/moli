<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录页面</title>
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
        <div class="logo">
            <a href="/" class="logopic">
                <img src="/themes/simplebootx/Public/images/loginlogo.png" />
            </a>
            <span></span>
            <b>登录</b>
        </div>
    </div>
</div>

<!--  main区域 -->
<div id="login-page">
    <div class="login-con">
        <form id="loginform">
            <div class="login-box">
                <h3>登录</h3>
                <div class="login-none">
                    <span class="login-prompt none" style="display: none">不能为空</span>
                </div>
                <div class="login-item"><input class="login-put lopu1" name="username" type="text" placeholder="请输入手机号码"
                                               onkeyup="onlyWriteNum(event,this);" maxlength="11"
                                               onkeypress="return vaildIntegerNumber(event) "
                                               onpaste="return !clipboardData.getData('text').match(/\D/) "
                                               ondragenter="return false" /></div>
                <div class="login-item"><input class="login-put low" type="password" name="password" placeholder="请输入密码" maxlength="8"/></div>
                <p class="login-check">
                    <input type="checkbox" />
                    <span>记住用户名</span>
                    <a href="/index.php/user/public/findtest">忘记密码？</a>
                </p>
                <a class="login-now" id="login" href="javascript:void(0)">立即登录</a>
                <h2 class="no-account">
                    <span>没有账号？</span>
                    <a href="/index.php/user/register">免费注册</a>
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
<script src="/themes/simplebootx/Public/js/login.js"></script>
<script>
//    $(document).ready(function () {
//        $('#login').click(function () {
//            var logindata = $('#loginform').serialize();
//            $.ajax({
//                url: '/index.php/user/login/dologin',
//                type: 'POST',
//                data: logindata,
//                success: function (data) {
//                    if (data.status == 0) {
//                        alert(data.msg)
//                    } else if (data.status == 1) {
//                        alert(data.msg)
//                        $("#loginform").submit();
//                        window.location.href = '/'
//                    }
//                }
//            })
//        })
//    })
</script>
</body>
</html>