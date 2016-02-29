<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>404</title>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
</head>
<body>
        <!-- main区域 -->
        <div class="errorpage">
        	<div class="error">
        		<img  src="/themes/simplebootx/Public/images/404error.png" />
                <div class="back">
                    <h2><?php echo($error); ?></h2>
                    <b id="wait" style="display:none;">1</b>
                    <span>您可以通过以下方式继续访问……</span>
                    <a href="<?php echo($jumpUrl); ?>" target="">跳转</a>
                </div>
        	</div>
        	
        </div>

        <script type="text/javascript">
            (function(){
                var wait = document.getElementById('wait'),href = document.getElementById('href').href;
                var interval = setInterval(function(){
                    var time = --wait.innerHTML;
                    if(time <= 0) {
                        location.href = href;
                        clearInterval(interval);
                    };
                }, 1000);
            })();
        </script>
</body>
</html>