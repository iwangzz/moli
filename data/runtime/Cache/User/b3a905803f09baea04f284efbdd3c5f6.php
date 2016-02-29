<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>跳转页面</title>
  <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
	<link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/style.css">
</head>
<body>
        <!-- main区域 -->
        <div class="success">
        	<div class="successdiv">
        		<img src="/themes/simplebootx/Public/images/succ.png" />
        	</div>
        	<h2 class="succfollow">
        		页面将于<span class="click"><span id="wait">2</span>秒</span>后自动跳转，立即跳转请<a id="href" class="click" href="<?php echo($jumpUrl); ?>">点击此处</a>
        	</h2>
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