<?php
// +----------------------------------------------------------------------
// | 摩利方 [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.摩利方.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace Portal\Controller;

use Common\Controller\HomebaseController;

class BorrowController extends HomebaseController
{

    //借款列表
    public function index()
    {

    }

    //项目详情
    public function projectdetail()
    {
        $this->display(':Borrow:detail');
    }

    //借款详情
    public function detail()
    {
        $id = I('get.id');
        $id = $id > 0 ? $id : 32;
        $user_id = $_SESSION['user']['id'] > 0 ? $_SESSION['user']['id'] : 0;
        if ($id > 0) {
            $borrow_model = M('borrow');
            $tender_model = M('tender');
            $user_coin_model = M('user_coin');
            $user_model = M('users');
            $borrow_type_model = M('borrow_type');
            $can_tender = 1;//判断是否可投资
            //获取借款信息
            $borrow_info = $borrow_model->where(['id' => $id, 'status' => ['in', '发布,还款中,还款完成']])->find();
            if ($borrow_info) {
                //获取借款类型
                $borrow_type = $borrow_type_model->where(['id' => $borrow_info['type_id']])->find();
                if ($borrow_type) {
                    //判断是否有房贷
                    if ($borrow_type['is_house'] == 'Y') {
                        $borrow_house = M('borrow_house')->where(['borrow_id' => $id])->find();
                        if ($borrow_house) {
                            $photo = json_decode($borrow_house['images']);
                            $house_photo = [];
                            foreach ($photo->photo as $key => $value) {
                                $house_photo[] = [
                                    'alt' => $value->alt,
                                    'url' => $value->url
                                ];
                            }
                            $this->assign('borrow_house', $borrow_house);
                            $this->assign('images', $house_photo);
                        }
                    }
                    //判断是否有车贷
                    if ($borrow_type['is_car'] == 'Y') {
                        $borrow_car = M('borrow_car')->where(['borrow_id' => $id])->find();
                        if ($borrow_car) {
                            $photo = json_decode($borrow_car['images']);
                            $car_photo = [];
                            foreach ($photo->photo as $key => $value) {
                                $car_photo[] = [
                                    'alt' => $value->alt,
                                    'url' => $value->url
                                ];
                            }
                            $this->assign('borrow_car', $borrow_car);
                            $this->assign('images', $car_photo);
                        }
                    }
                }
                $this->assign('borrow_info', $borrow_info);
                //获取投资列表
                $tender_info = $tender_model->where(['borrow_id' => $id, 'status' => '投资成功'])->select();
                if ($tender_info)
                    $this->assign('tender_info', $tender_info);
                //获取用户资金
                if ($user_id > 0) {
                    $user_coin = $user_coin_model->where(['user_id' => $user_id])->find();
                    $this->assign('user_coin', $user_coin);
                    $user_info = $user_model->where(['id' => $user_id])->find();
                    $this->assign('user_info', $user_info);
                }
                $this->assign('user_id', $user_id);
                //获取可投金额
                $other_info = [];
                $other_info['post_money'] = $borrow_info['money'] - $borrow_info['invest_money'];
                //判断可投金额
                if($other_info['post_money'] <= 0)
                    $can_tender = 0;
                //获取投资进度
                $other_info['rate_info'] = round(($borrow_info['invest_money'] / $borrow_info['money']) * 100, 2);
                if ($other_info['rate_info'] == 0)
                    $other_info['rate_info'] = '0.00';
                //获取剩余时间
                $last_days = $borrow_info['deadline'] * 24 * 3600 - (time() - strtotime($borrow_info['release_time']));
                if ($last_days <= 0){
                    $last_days = 0;
                    $can_tender = 0;
                }
                $this->assign('can_tender', $can_tender); 
                $other_info['last_days'] = floor($last_days / (24 * 3600)) . '天' . floor(($last_days % (24 * 3600)) / 3600) . '时';
                //获取截止日期
                $other_info['last_time'] = date('Y-m-d H:i:s', strtotime($borrow_info['release_time']) + $borrow_info['deadline'] * 3600 * 24);

                $this->assign('other_info', $other_info);
                //获取投资列表
                $tender_list = $tender_model->where(['borrow_id' => $id])->select();
                $list = [];
                if ($tender_list) {
                    foreach ($tender_list as $key => $value) {
                        $user_info = $user_model->where(['id' => $value['tender_user_id']])->field('user_login,user_nicename')->find();
                        $name = '';
                        if ($user_info['user_nicename']) {
                            $name = mb_substr($user_info['user_nicename'], 0, 8, 'utf-8') . '*';
                        } else {
                            $name = substr($user_info['user_login'], 0, 3) . '*****' . substr($user_info['user_login'], -3);
                        }
                        $list[$key] = array(
                            'name' => $name,
                            'price' => array_shift(explode('.', $value['money'])),
                            'add_time' => substr(array_shift(explode(' ', $value['add_time'])), 2)
                        );
                    }
                    $this->assign('tender_list', $list);
                }
                $this->display();
            }
        }
    }
    //用户投资
    public function tender()
    {
        $account = $_POST['account'];
        $borrow_id = $_POST['borrow_id'];
        $user_id = $_SESSION['user']['id'];
        $user_coin_model = M('user_coin');
        $borrow_model = M('borrow');
        $tender_model = M('tender');
        $account_log_model = M('account_log');
        $borrow_user_model = M('borrow_user');
        $user_model = M('users');
        if (!isset($borrow_id))
            $this->assign('异常错误');
        //判断是否登陆
        if (!$user_id)
            $this->error('您还未登陆', '/index.php/user/login');
        //判断用户可用余额
        $user_coin = $user_coin_model->where(['user_id' => $user_id])->find();
        if (!$user_coin || $user_coin['use_account'] < $account)
            $this->error('余额不足', '/index.php/user/recharge');
        //判断募集期限
        $borrow_info = $borrow_model->where(['id' => $borrow_id])->find();
        //判断投资金额
        if (!isset($account) || $account < $borrow_info['invest_lowest'])
            $this->error('投资金额不正确');
        $invest_money = $borrow_info['invest_money'] + $account;
        if ($invest_money > $borrow_info['money'])
            $this->error('超过募集资金限额');
        if ($borrow_info) {
            $end_time = strtotime($borrow_info['release_time']) + $borrow_info['deadline'] * 3600 * 24;
            if (time() > $end_time)
                $this->error('募集期限已过');
        } else {
            $this->error('异常错误');
        }
        $user_info = $user_model->where(['id' => $user_id])->find();
        if (sp_password($_POST['user_trade_pass']) != $user_info['user_trade_pass'])
            $this->error('交易密码错误');
        //验证是否实名认证
        //增加投资记录
        $borrow_user = $borrow_user_model->where(['borrow_id' => $borrow_id])->find();
        $tender_data = array(
            'borrow_user_id' => $borrow_user['id'],
            'tender_user_id' => $user_id,
            'borrow_id' => $borrow_id,
            'order_id' => date('YmdHis', time()) . rand(100000, 999999),
            'money' => $account,
            'status' => '投资成功',
            'add_time' => date('Y-m-d H:i:s', time())
        );
        $tender_id = $tender_model->add($tender_data);
        if ($tender_id > 0) {
            //更新借款信息
            $borrow_data = array(
                'invest_money' => $invest_money,
            );
            if ($invest_money >= $borrow_info['money']) {
                $borrow_data['full_time'] = date('Y-m-d H:i:s', time());
                $borrow_data['money_status'] = '已满标';
            }
            $borrow_result = $borrow_model->where(['id' => $borrow_id])->data($borrow_data)->save();
            //冻结投资人资金
            $user_coin_data = array(
                'all_account' => $user_coin['all_account'] - $account,
                'frozen_account' => $user_coin['forzen_account'] + $account,
                'use_account' => $user_coin['use_account'] - $account
            );
            //添加资金记录
            $account_log = array(
                'user_id' => $user_id,
                'type' => '投资',
                'money' => $account,
                'all_money' => $user_coin['all_account'] - $account,
                'frozen_money' => $user_coin['forzen_account'] + $account,
                'use_money' => $user_coin['use_account'] - $account,
                'collection_money' => $user_coin['collect_account'],
                'add_time' => date('Y-m-d H:i:s', time()),
                'add_ip' => get_client_ip(),
                'remark' => '投资标的【<a href="/index.php/borrow/detail/id/' . $borrow_info['id'] . '">' . $borrow_info['borrow_title'] . '</a>】'
            );
            $account_log_model->add($account_log);
            $result = $user_coin_model->where(['user_id' => $user_id])->data($user_coin_data)->save();
            if ($result) {
                $this->success('投资成功', '/index.php/borrow/detail/id/' . $borrow_info['id']);
                return;
            }
        }
        $this->error('投资失败');
    }
}
