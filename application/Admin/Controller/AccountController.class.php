<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class AccountController extends AdminbaseController
{
    public function cash() {
        $result = $this->getCash();
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display();
    }

    public function waitexam() {
        $where = array(
            'status' => '待审核'
        );
        $result = $this->getCash($where);
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display();
    }

    public function cashsuccess() {
        $where = array(
            'status' => '提现成功'
        );
        $result = $this->getCash($where);
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display();
    }

    public function cashfail() {
        $where = array(
            'status' => '提现失败'
        );
        $result = $this->getCash($where);
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display();
    }

    public function getCash($where = []) {
        $cash_model = M('user_cash');
        $count = $cash_model->where($where)->count();
        $page = $this->page($count, 20);
        $list = $cash_model->order("id DESC")->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();
        return array(
            'page' => $page,
            'list' => $list,
        );
    }

    public function edit() {
        $id = I('get.id');
        $cash_model = M('user_cash');
        $bank_model = M('user_bank');
        $cash_info = $cash_model->where(['id' => $id])->find();
        $this->assign('cash_info', $cash_info);
        $bank_info = $bank_model->where(['user_id' => $cash_info['user_id']])->find();
        $this->assign('bank_info', $bank_info);
        $this->display();
    }

    public function edit_post() {
        $status = I('post.status');
        $id = I('post.cash_id');
        $cash_model = M('user_cash');
        $coin_model = M('user_coin');
        $result = $cash_model->where(['id' => $id])->data(['status' => $status])->save();
        if($result){
            $cash_info = $cash_model->where(['id' => $id])->find();
            //更新用户资金
            $coin_info = $coin_model->where(['user_id' => $cash_info['user_id']])->find();
            $coin_data = array(
                'all_account' => $coin_info['all_account'] - $cash_info['money'],
                'frozen_account' => $coin_info['frozen_account'] - $cash_info['money']
            );
            $res = $coin_model->where(['user_id' => $cash_info['user_id']])->data($coin_data)->save();
            if($res)
                $this->success('修改成功', U('account/waitexam'));
        }else{
            $this->error('修改失败');
        }
    }

    public function recharge() {
        $recharge_model = M('user_recharge');
        $count = $recharge_model->count();
        $page = $this->page($count, 20);
        $list = $recharge_model->order("id DESC")->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("page", $page->show('Admin'));
        $this->assign('list', $list);
        $this->display();
    }
}

?>
