<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新手指南</title>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/style.css">
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
         <div class="newbie">
         	<div class="newbanner">
         		<img src="/themes/simplebootx/Public/images/newbie.png" />
         	</div>
         	<div class="newmain">
         		<div class="understand">
         			<span class="stand1">全面认识摩利方</span>
         			<span class="stand2">摩利方，摩利控股集团旗下独立品牌，注册资金5亿，总部位于上海。是一家基于"互联网+"大环境下新兴的集信用
         			风险评估与管理、小额借款咨询与服务、投资理财、信用数据整合服务等业务与一体的综合性互联网金融平台。</span>
         		</div>
         		<div class="advantage">
         			<span class="stand1">我们的优势</span>
         			<div class="tagepic">
         				<div class="tagefirst">
         					<span class="tage1">
         						<span class="inside1"><img src="/themes/simplebootx/Public/images/bie1.png" /></span>
         						<span class="inside2">真实的抵押物</span>
         					</span>
         					<span class="tage1 tage2">
         						<span class="inside1"><img src="/themes/simplebootx/Public/images/bie2.png" /></span>
         						<span class="inside2">强大的线下风控团队</span>
         					</span>
         					<span class="tage1 tage3">
         						<span class="inside1"><img src="/themes/simplebootx/Public/images/bie3.png" /></span>
         						<span class="inside2">全国实体经营</span>
         					</span>
         				</div>
         				<div class="tagesecond">
         					<span class="tage4">
         						<span class="inside4"><img src="/themes/simplebootx/Public/images/bie4.png" /></span>
         						<span class="inside5">房</span>
         					</span>
         					<span class="tage4 tage5">
         						<span class="inside4"><img src="/themes/simplebootx/Public/images/bie5.png" /></span>
         						<span class="inside5">车</span>
         					</span>
         					<span class="tage4 tage6">
         						<span class="inside4"><img src="/themes/simplebootx/Public/images/bie6.png" /></span>
         						<span class="inside5">人</span>
         					</span>
         					<span class="tage4 tage7">
         						<span class="inside4"><img src="/themes/simplebootx/Public/images/bie7.png" /></span>
         						<span class="inside6">实体店</span>
         					</span>
         				</div>		
         			</div>
         			<div class="operation">
         				<div class="project">
         					<span class="stand1">摩利方是如何运作项目</span>
         					<span class="pro1">摩利方是一家专注于房贷和车贷的互联网金融理财平台</span>
         					<span class="pro2">致力为广大投资用户提供<a class="low">低风险</a><a class="low">高收益</a>的金融理财产品</span>
         				</div>
         				<div class="basic-flow">
         					<div class="flowbox">
         						<img class="box1" src="/themes/simplebootx/Public/images/box1.png" />
         						<div class="boxround">
         							<img class="bund1" src="/themes/simplebootx/Public/images/ffc1.png" />
         						    <span class="bund2">优质小额借款人</span>
         						</div>
         						<div class="boxmiddle">
         							<img class="bund1" src="/themes/simplebootx/Public/images/ffc1.png" />
         						    <span class="bund3">摩利方</span>
         						</div>
         						<div class="boxright">
         							<img class="bund1" src="/themes/simplebootx/Public/images/ffc1.png" />
         							<span class="bund4">摩利投网络理财用户</span>
         						</div>
         						<div class="reimbu">
         							<img class="bund1" src="/themes/simplebootx/Public/images/ffc2.png" />
         							<span class="rei1">按时还款</span>
         						</div>
         						<div class="reimbu semet">
         							<img class="bund1" src="/themes/simplebootx/Public/images/ffc2.png" />
         							<span class="rei1">借贷资金</span>
         						</div>
         						<div class="rrow">
         							<img class="bund1" src="/themes/simplebootx/Public/images/ffcj.png" />
         							<span class="offline">线下实体优质客户</span>
         						</div>
         						<div class="rrow rowright">
         							<img class="bund1" src="/themes/simplebootx/Public/images/ffcj.png" />
         							<span class="offline">严格审核推荐客户</span>
         						</div>
         						<div class="dehouse">
         							<img class="bund1" src="/themes/simplebootx/Public/images/biehouse.png" />
         							<span class="deho">房子</span>
         						</div>
         						<div class="decar">
         							<img class="bund1" src="/themes/simplebootx/Public/images/biecar.png" />
         							<span class="deho1">车子</span>
         						</div>
         						<div class="mortgage">
         							<span class="mort1">半折抵押</span>
         							<span class="mort2">项目稳健可靠</span>
         						</div>
         						<div class="Principal">
         							<img class="prline" src="/themes/simplebootx/Public/images/beline.png" />
         							<div class="rest">
         								<img class="bund1" src="/themes/simplebootx/Public/images/rest.png" />
         								<span class="sub1">100%本息保证</span>
         							</div>
         						</div>
         					</div>
         				</div>
         				<div class="investment">
         					<span class="stand1">摩利方投资流程</span>
         				    <div class="registered">
         				    	<div class="ster regist">
         				    		<img class="rest1" src="/themes/simplebootx/Public/images/rest1.png" />
         				    		<span class="regis">注册</span>
         				    	</div>
         				    	<img class="bluearrow" src="/themes/simplebootx/Public/images/rest3.png" />
         				    	<div class="ster real-name">
         				    		<img class="rest1" src="/themes/simplebootx/Public/images/rest2.png" />
         				    		<span class="real">实名认证</span>
         				    	</div>
         				    	<img class="bluearrow1" src="/themes/simplebootx/Public/images/rest4.png" />
         				    	<div class="ster thetend">
         				    		<img class="rest1" src="/themes/simplebootx/Public/images/rest2.png" />
         				    		<span class="regis the1">投标</span>
         				    	</div>
         				    </div>
         				</div>
         				<div class="computer"> 
         					<ul>
         						<li style="width: 454px;height: 368px;"><img src="/themes/simplebootx/Public/images/computer.png" /></li>
         					</ul>
         					<img class="coleft" src="/themes/simplebootx/Public/images/left.png" />
         					<img class="coright" src="/themes/simplebootx/Public/images/right.png" />
         				</div>
         				<a href="/index.php/user/register" class="welfare">立马注册享受新人福利</a>
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
            <script>
            	var n = 0;//注册-认证-投标 images/images/rest1.png images/images/rest3.png  images/images/rest2.png images/images/rest4.png
            	var list = ['/themes/simplebootx/Public/images/computer.png','/themes/simplebootx/Public/images/computer3.png','/themes/simplebootx/Public/images/computer1.png'];
            	var lists = ['/themes/simplebootx/Public/images/rest1.png','/themes/simplebootx/Public/images/rest3.png','/themes/simplebootx/Public/images/rest2.png','/themes/simplebootx/Public/images/rest4.png'];
            	$('.coleft,.coright').click(function(){
            		if($(this).hasClass('coleft')){
            			if(n == 0){
            				n = 3;
            			}
            			n--;
            		}else{
            			n++;
            		}
            		$('.computer').find('li').find('img').attr('src',list[n%3]);
            		if(n%3 == 0){
            			$('.regist').find('img').attr('src',lists[0]);
            			$('.regist').next().attr('src',lists[1]);
            			$('.real-name').find('img').attr('src',lists[2]);
            			$('.thetend').find('img').attr('src',lists[2]);
            			$('.real-name').next().attr('src',lists[3]);
            			$('.regist').find('span').css('color','#ffffff');
            			$('.real-name').find('span').css('color','#0084e8');
            			$('.thetend').find('span').css('color','#0084e8');
            		}else if(n%3 == 1){
            			$('.real-name').find('img').attr('src',lists[0]);
            			$('.real-name').next().attr('src',lists[1]);
            			$('.regist').find('img').attr('src',lists[2]);
            			$('.thetend').find('img').attr('src',lists[2]);
            			$('.regist').next().attr('src',lists[3]);
            			$('.regist').find('span').css('color','#0084e8');
            			$('.real-name').find('span').css('color','#ffffff');
            			$('.thetend').find('span').css('color','#0084e8');
            		}else if(n%3 == 2){
            			$('.thetend').find('img').attr('src',lists[0]);
            			$('.real-name').find('img').attr('src',lists[2]);
            			$('.real-name').next().attr('src',lists[1]);
            			$('.regist').next().attr('src',lists[3]);
            			$('.regist').find('img').attr('src',lists[2]);
            			$('.regist').find('span').css('color','#0084e8');
            			$('.real-name').find('span').css('color','#0084e8');
            			$('.thetend').find('span').css('color','#ffffff');
            		}
            	})
            </script>
</body>
</html>