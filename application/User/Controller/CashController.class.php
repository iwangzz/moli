<?php

/**
 * 提现
 */

namespace User\Controller;

use Common\Controller\MemberbaseController;

include APP_PATH . 'Common/Controller/netpayclient.php';

class CashController extends MemberbaseController {

    public function index() {
        $user_id = $_SESSION['user']['id'];
        $coin_model = M('user_coin');
        $user_model = M('users');
        $bank_model = M('user_bank');
        $user_info = $user_model->where(['id' => $user_id])->find();
        $this->assign('user_info', $user_info);
        $coin_info = $coin_model->where(['user_id' => $user_id])->find();
        $this->assign('coin_info', $coin_info);
        $bank_info = $bank_model->where(['user_id' => $user_id])->find();
        if ($bank_info) {
            $bank_info['bank_number'] = substr($bank_info['bank_num'], 0, 4) . '********' . substr($bank_info['bank_num'], -4);
        }
        $this->assign('bank_info', $bank_info);
        $this->display(':withdrawal');
    }

    public function cashForm() {
        $user_id = $_SESSION['user']['id'];
        $money = I('post.account');
        $password = I('post.password');
        $user_model = M('users');
        $coin_model = M('user_coin');
        $cash_model = M('user_cash');
        $account_log_model = M('account_log');
        $user_info = $user_model->where(['id' => $user_id])->find();
        if (sp_password($password) != $user_info['user_trade_pass'])
            $this->ajaxReturn(['status' => -1, 'msg' => '交易密码不正确']);
        $coin_info = $coin_model->where(['user_id' => $user_id])->find();
        if ($coin_info['use_account'] < $money)
            $this->ajaxReturn(['status' => -1, 'msg' => '余额不足']);
        if ($money < 50)
            $this->ajaxReturn(['status' => -1, 'msg' => '最低提现金额为50元']);
        $cash_data = array(
            'order_no' => date('YmdHis') . round(100000, 999999),
            'user_id' => $user_id,
            'user_name' => $_SESSION['user']['user_login'],
            'money' => $money,
            'status' => '待审核',
            'create_time' => date('Y-m-d H:i:s', time())
        );
        $result = $cash_model->add($cash_data);
        if ($result) {
            //冻结提现金额
            $coin_data = array(
                'use_account' => $coin_info['use_account'] - $money,
                'frozen_account' => $coin_info['frozen_account'] + $money
            );
            $res = $coin_model->where(['user_id' => $user_id])->data($coin_data)->save();
            //生成提现资金记录
            $log_data = array(
                'user_id' => $user_id,
                'money' => $money,
                'all_money' => $coin_info['all_account'],
                'use_money' => $coin_data['use_account'],
                'frozen_money' => $coin_data['frozen_account'],
                'collection_money' => $coin_info['collect_account'],
                'add_time' => date('Y-m-d H:i:s', time()),
                'add_ip' => get_client_ip(),
                'remark' => '申请提现成功，冻结金额',
                'type' => '提现'
            );
            $log_id = $account_log_model->add($log_data);
            if ($res) {
                $this->ajaxReturn(['status' => 1, 'msg' => '申请提现成功']);
            } else {
                $this->ajaxReturn(['status' => -1, 'msg' => '申请提现失败']);
            }
        }
    }

}

?>
