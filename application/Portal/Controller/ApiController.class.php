<?php

namespace Portal\Controller;

use Common\Controller\HomebaseController;

include APP_PATH . 'Common/Controller/netpayclient.php';

class ApiController extends HomebaseController {

    public function rechargeBack() {
        //导入公钥文件
        $flag = buildKey(PUB_KEY);
        if (!$flag) {
            echo "导入公钥文件失败！";
            exit;
        }
        //获取交易应答的各项值
        $merid = $_REQUEST["merid"];
        $orderno = $_REQUEST["orderno"];
        $transdate = $_REQUEST["transdate"];
        $amount = $_REQUEST["amount"];
        $currencycode = $_REQUEST["currencycode"];
        $transtype = $_REQUEST["transtype"];
        $status = $_REQUEST["status"];
        $checkvalue = $_REQUEST["checkvalue"];
        $gateId = $_REQUEST["GateId"];
        $priv1 = $_REQUEST["Priv1"];
        //验证签名值，true 表示验证通过
        $flag = verifyTransResponse($merid, $orderno, $amount, $currencycode, $transdate, $transtype, $status, $checkvalue);
        if (!$flag) {
            return false;
        }
        //交易状态为1001表示交易成功，其他为各类错误，如卡内余额不足等
        if ($status == '1001') {
            $user_id = $priv1;
            $where = array(
                'order_number' => $orderno,
                'recharge_status' => '待审核',
                'user_id' => $user_id
            );
            $recharge_model = M('user_recharge');
            $info = $recharge_model->where($where)->find();
            if ($info) {
                $recharge_data = array(
                    'recharge_status' => '充值成功'
                );
                $result = $recharge_model->where($where)->data($recharge_data)->save();
                if ($result) {
                    $user_coin_model = M('user_coin');
                    //更新用户金额
                    $usercoininfo = $user_coin_model->where(['user_id' => $user_id])->find();
                    $all_account = $usercoininfo['all_account'] + $amount / 100;
                    $use_account = $usercoininfo['use_account'] + $amount / 100;
                    $coindata = array(
                        'all_account' => $all_account,
                        'use_account' => $use_account
                    );
                    $usercoininfo = $user_coin_model->where(['user_id' => $user_id])->data($coindata)->save();
                }
            }
        }
    }

}

?>
