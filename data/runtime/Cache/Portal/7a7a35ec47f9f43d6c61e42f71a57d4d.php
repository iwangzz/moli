<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>联系我们</title>
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/common.css">
    <link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/css/about.css">
    <link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css"/>
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
                                    <li class="white"><a href="/index.php/user/recharge/index"
                                           onclick="javacript:_hmt.push(['_trackEvent', 'cz', 'click', 'dhcz']);">充值</a>
                                    </li>
                                    <li class="white"><a href="/index.php/user/cash"
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
<div class="main clearfix">
    <!--  main-left -->
    <div class="main-left">
    <a class="item" href="javascript:void(0)">关于我们</a>
    <ul class="left-ul">
        <?php if(is_array($menu)): foreach($menu as $key=>$vo): if($vo["id"] == $menuid): ?><li class="left-li active">
                    <a class="" href="<?php echo ($vo["href"]); ?>"><?php echo ($vo["label"]); ?></a>
                </li>
                <?php else: ?>
                <li class="left-li">
                    <a class="" href="<?php echo ($vo["href"]); ?>"><?php echo ($vo["label"]); ?></a>
                </li><?php endif; ?>
            </li><?php endforeach; endif; ?>
    </ul>
</div>
    <div class="main-right">
        <div class="navright clearfix">
            <a href="javascript:void(0)" class="navus navwe">关于我们</a>
            <span class="separated">></span>
            <a href="<?php echo ($href); ?>" class="navus current">联系我们</a>
        </div>
        <div class="call">
            <img class="line" src="/themes/simplebootx/Public/images/line.png"/>

            <p class="call-fr">
                <img class="callim" src="/themes/simplebootx/Public/images/call.png"/>
                <span>客户服务</span>
            </p>
            <span class="customerservice">如果您在摩利方遇到问题，请联系客服。</span>
            <span class="customerservice">客服热线：400-601-6188</span>
            <span class="customerservice">公司邮箱：kf@molitou.com</span>

            <p class="call-fr">
                <img class="callim" src="/themes/simplebootx/Public/images/addss.png"/>
                <span class="aderss">公司地址</span>
            </p>
            <span class="customerservice">公司地址：娄山关路金虹桥国际中心1号楼16楼</span>
        </div>
        <div style="width: 609px;height: 1000px;margin: 0 auto;">
        <div style="width: 609px; height: 500px;margin: 0 auto;
              	top: 50px;" id="allmap"></div>
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
<script type="text/javascript"
        src="http://api.map.baidu.com/api?v=2.0&ak=Q0O9mkEqXfiLRRfVLUl7sHDZ&v=2.0&services=false"></script>
<script type="text/javascript"
        src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
<script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map('allmap');
    var poi = new BMap.Point(121.409725, 31.214824);
    map.centerAndZoom(poi, 16);
    map.enableScrollWheelZoom();
    var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
            '<img src="/themes/simplebootx/Public/images/5.jpg" alt="" style="float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;"/>' +
            '地址：娄山关路金虹国际中心1号楼16楼<br/>电话：400-500-340<br/>简介：摩利方研发及办公总部，娄山关路金虹桥国际中心1号楼16楼。' +
            '</div>';//<img src='公司图片路径' />

    //创建检索信息窗口对象
    var searchInfoWindow = null;
    searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
        title: "金虹桥国际中心",      //标题
        width: 290,             //宽度
        height: 105,              //高度
        panel: "panel",         //检索结果面板
        enableAutoPan: true,     //自动平移
        searchTypes: [
            BMAPLIB_TAB_SEARCH,   //周边检索
            BMAPLIB_TAB_TO_HERE,  //到这里去
            BMAPLIB_TAB_FROM_HERE //从这里出发
        ]
    });
    var marker = new BMap.Marker(poi); //创建marker对象
    marker.enableDragging(); //marker可拖拽
    marker.addEventListener("click", function (e) {
        searchInfoWindow.open(marker);
    })
    map.addOverlay(marker); //在地图中添加marker
    //样式1
    var searchInfoWindow1 = new BMapLib.SearchInfoWindow(map, "信息框1内容", {
        title: "信息框1", //标题
        panel: "panel", //检索结果面板
        enableAutoPan: true, //自动平移
        searchTypes: [
            BMAPLIB_TAB_FROM_HERE, //从这里出发
            BMAPLIB_TAB_SEARCH   //周边检索
        ]
    });
    function openInfoWindow1() {
        searchInfoWindow1.open(new BMap.Point(121.409725, 31.214824));
    }
    searchInfoWindow.open(marker);
</script>

</body>
</html>