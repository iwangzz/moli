<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/",
    JS_ROOT: "public/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
    <div class="wrap js-check-wrap">
        <ul class="nav nav-tabs">
            <li class="active"><a href="<?php echo U('borrowType/index');?>"><?php echo L('ADMIN_BORROW_TYPE_LIST');?></a></li>
            <li><a href="<?php echo U('borrowType/add');?>"><?php echo L('ADMIN_BORROW_TYPE_ADD');?></a></li>
        </ul>
        <table class="table table-hover table-bordered table-list">
            <thead>
                <tr>
                    <th width="50">ID</th>
                    <th><?php echo L('ADMIN_BORROW_TYPE_NAME');?></th>
                    <th><?php echo L('ADMIN_BORROW_TYPE_IS_HOUSE');?></th>
                    <th><?php echo L('ADMIN_BORROW_TYPE_IS_CAR');?></th>
                    <th><?php echo L('ADMIN_BORROW_TYPE_ADD_TIME');?></th>
                    <th><?php echo L('ADMIN_BORROW_TYPE_STATUS');?></th>
                    <th width="120"><?php echo L('ACTIONS');?></th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["is_house"]); ?></td>
                    <td><?php echo ($vo["is_car"]); ?></td>
                    <td><?php echo ($vo["create_time"]); ?></td>
                    <td><?php echo ($vo["status"]); ?></td>
                    <td>
                        <a href="<?php echo U('borrowType/edit',array('id'=>$vo['id']));?>"><?php echo L('EDIT');?></a>|
                <?php if($vo["status"] == "禁用"): ?><a href="<?php echo U('borrowType/change_status',array('id'=>$vo['id'], 'status' => '启用'));?>"><?php echo L('ENABLED');?></a>
                    <?php else: ?>
                    <a href="<?php echo U('borrowType/change_status',array('id'=>$vo['id'], 'status' => '禁用'));?>"><?php echo L('DISABLED');?></a>|
                    <a href="<?php echo U('borrow/add',array('id'=>$vo['id']));?>"><?php echo L('ADMIN_BORROW_ADD');?></a><?php endif; ?>
                </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th width="50">ID</th>
                    <th><?php echo L('ADMIN_BORROW_TYPE_NAME');?></th>
                    <th><?php echo L('ADMIN_BORROW_TYPE_IS_HOUSE');?></th>
                    <th><?php echo L('ADMIN_BORROW_TYPE_IS_CAR');?></th>
                    <th><?php echo L('ADMIN_BORROW_TYPE_ADD_TIME');?></th>
                    <th><?php echo L('ADMIN_BORROW_TYPE_STATUS');?></th>
                    <th width="120"><?php echo L('ACTIONS');?></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <script src="/public/js/common.js"></script>
</body>
</html>