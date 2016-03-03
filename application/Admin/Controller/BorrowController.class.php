<?php
//aaaaaa
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class BorrowController extends AdminbaseController
{

    protected $borrow_model;
    protected $borrow_type_model;
    protected $borrow_user_model;
    protected $borrow_car_model;
    protected $borrow_house_model;

    function _initialize()
    {
        parent::_initialize();
        $this->borrow_model = M("borrow");
        $this->borrow_type_model = M("borrow_type");
        $this->borrow_user_model = M("borrow_user");
        $this->borrow_car_model = M("borrow_car");
        $this->borrow_house_model = M("borrow_house");
    }

    //分页查询条件
    public function search($where = [])
    {
        $count = $this->borrow_model->count();
        $page = $this->page($count, 20);
        $list = $this->borrow_model->order("id DESC")->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();
        return array(
            'page' => $page,
            'list' => $list,
        );
    }

    public function index()
    {
        $result = $this->search();
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display();
    }

    public function add()
    {
        $type_id = I('get.id');
        $type_info = $this->borrow_type_model->where(['id' => $type_id])->find();
        $this->assign('type_info', $type_info);
        $this->display();
    }

    //添加借款
    public function add_post()
    {
        if (IS_POST)
        {
            $data = $_POST;
            $type_info = $this->borrow_type_model->where(['id' => $data['type']])->find();
            $check_post = $this->check_post($data, $type_info);
            if ($check_post)
            {
                //增加借款信息
                $borrow_data = array(
                    'borrow_title' => $data['borrow_title'],
                    'money' => $data['money'],
                    'rate' => $data['rate'],
                    'status' => '待审核',
                    'deadline' => $data['deadline'],
                    'repay_type' => $data['repay_type'],
                    'type' => $type_info['name'],
                    'borrow_days' => $data['borrow_days'],
                    'add_time' => date('Y-m-d H:i:s', time()),
                    'invest_lowest' => $data['invest_lowest'],
                    'money_status' => '未满标',
                    'repay_source' => $data['repay_source'],
                    'borrow_uses' => $data['borrow_uses'],
                    'type_id' => $data['type'],
                    'remark' => $data['remark'],
                    'management_views' => $data['management_views'],
                    'is_new' => $data['is_new']
                );
                $borrow_id = $this->borrow_model->data($borrow_data)->add();
                if ($borrow_id > 0)
                {
                    //增加借款用户资料
                    $user_data = array(
                        'real_name' => $data['real_name'],
                        'id_card' => $data['id_card'],
                        'borrow_id' => $borrow_id,
                        'sex' => $data['sex'],
                        'married' => $data['married']
                    );
                    $user_res_id = $this->borrow_user_model->data($user_data)->add();
                    if ($type_info['is_car'] == 'Y')
                    {
                        if (!empty($_POST['car_photos_alt']) && !empty($_POST['car_photos_url']))
                        {
                            foreach ($_POST['car_photos_url'] as $key => $url)
                            {
                                $photourl = sp_asset_relative_url($url);
                                $photoid = $_POST['imageid'];
                                $_POST['smeta']['car']['photo'][] = array("imageid" => $photoid, "url" => $photourl, "alt" => $_POST['car_photos_alt'][$key]);
                            }
                        }
                        $car_data = array(
                            'borrow_id' => $borrow_id,
                            'brand' => $data['brand'],
                            'plate_number' => $data['plate_number'],
                            'exactly' => $data['exactly'],
                            'price' => $data['price'],
                            'mortgage' => $data['mortgage'],
                            'add_time' => date('Y-m-d H:i:s', time()),
                            'images' => json_encode($_POST['smeta']['car'])
                        );
                        $car_id = $this->borrow_car_model->data($car_data)->add();
                    }
                    if ($type_info['is_house'] == 'Y')
                    {
                        if (!empty($_POST['house_photos_alt']) && !empty($_POST['house_photos_url']))
                        {
                            foreach ($_POST['house_photos_url'] as $key => $url)
                            {
                                $photourl = sp_asset_relative_url($url);
                                $photoid = $_POST['houseimageid'];
                                $_POST['smeta']['house']['photo'][] = array("houseimageid" => $photoid, "url" => $photourl, "alt" => $_POST['house_photos_alt'][$key]);
                            }
                        }
                        $house_data = array(
                            'position' => $data['position'],
                            'price' => $data['price'],
                            'acreage' => $data['acreage'],
                            'nature' => $data['nature'],
                            'add_time' => date('Y-m-d H:i:s', time()),
                            'borrow_id' => $borrow_id,
                            'images' => json_encode($_POST['smeta']['house'])
                        );
                        $this->borrow_house_model->data($house_data)->add();
                    }
                    $this->success('添加成功', U("borrow/index"));
                } else
                {
                    $this->error("添加失败！");
                }
            }
        }
    }

    //待审核
    public function waitPending()
    {
        $result = $this->search(['status' => '待审核']);
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display();
    }

    //修改产品状态
    public function changeStatus()
    {
        $id = I("get.id");
        $status = I("get.status");
        $data['status'] = $status;
        if ($status = '初审通过')
        {
            $data['first_trial'] = date('Y-m-d H:i:s', time());
        } elseif ($status = '复审通过')
        {
            $data['second_trial'] = date('Y-m-d H:i:s', time());
        } elseif ($status = '发布')
        {
            $data['release_time'] = date('Y-m-d H:i:s', time());
        };
        $info = $this->borrow_model->where(["id" => $id])->save($data);
        if ($info)
        {
            $this->success("操作成功！", U("borrow/waitRelease"));
        } else
        {
            $this->error("操作失败！");
        }
    }

    //发布展示
    public function release()
    {
        $result = $this->search(['status' => '发布']);
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display();
    }

    //发布
    public function releasing()
    {
        $id = I("get.id");
        $data['status'] = '发布';
        $data['release_time'] = date('Y-m-d H:i:s', time());
        $info = $this->borrow_model->where(['id' => $id])->data($data)->save();
        if ($info)
        {
            $this->success("发布成功！", U("borrow/release"));
        } else
        {
            $this->error("发布失败");
        }
    }

    //还款中列表
    public function repaying()
    {
        $result = $this->search(['status' => '还款中']);
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display();
    }

    //放款
    public function addRepay()
    {
        $id = I('get.id');
        if ($id > 0)
        {
            $borrow_model = M('borrow');
            $tender_model = M('tender');
            $repay_model = M('repay');
            $user_coin_model = M('user_coin');
            $account_log_model = M('account_log');
            $borrow_user_model = M('borrow_user');
            $borrow_info = $borrow_model->where(['id' => $id])->find();
            $tender_list = $tender_model->where(['borrow_id' => $id, 'status' => '投资成功'])->select();
            $borrow_user_info = $borrow_user_model->where(['borrow_id' => $id])->find();
            if ($borrow_info && $tender_list)
            {
                //开启事物
                $repay_model->startTrans();
                //根据投资计算利息
                foreach ($tender_list as $key => $value)
                {
                    $this->addRepayByTenderId($value, $borrow_info, $borrow_user_info);
                }
                //更新借款
                $borrow_data = array(
                    'status' => '还款中',
                    'money_status' => '已放款',
                    'second_trial' => date('Y-m-d H:i:s', time())
                );
                $result = $borrow_model->where(['id' => $borrow_info['id']])->data($borrow_data)->save();
                if ($result)
                {
                    $repay_model->commit();
                    $this->success('放款成功', U('borrow/release'));
                } else
                {
                    $repay_model->rollBack();
                    $this->error('放款失败', U('borrow/release'));
                }
            }
        } else
        {
            $this->error('异常错误');
        }
    }

    //根据投资放款
    public function addRepayByTender()
    {
        $tender_id = I('get.id');
        if ($tender_id > 0)
        {
            $tender_model = M('tender');
            $borrow_model = M('borrow');
            $borrow_user_model = M('borrow_user');
            $tender_info = $tender_model->where(['id' => $tender_id])->find();
            $borrow_info = $borrow_model->where(['id' => $tender_info['borrow_id']])->find();
            $borrow_user_info = $borrow_user_model->where(['borrow_id' => $borrow_info['id']])->find();
            $tender_model->startTrans();
            $result = $this->addRepayByTenderId($tender_info, $borrow_info, $borrow_user_info);
            if ($result)
            {
                //验证是否全部放款
                $tender = $tender_model->where(['status' => '投资成功', 'borrow_id' => $borrow_info['id']])->find();
                if (!$tender)
                {
                    //更新借款
                    $borrow_data = array(
                        'status' => '还款中',
                        'money_status' => '已放款',
                        'second_trial' => date('Y-m-d H:i:s', time())
                    );
                    $result = $borrow_model->where(['id' => $borrow_info['id']])->data($borrow_data)->save();
                }
                $tender_model->commit();
                $this->success('放款成功', U('borrow/tenderList', ['id' => $borrow_info['id']]));
            } else
            {
                $tender_model->rollBack();
                $this->error('放款失败', U('borrow/tender_list', ['id' => $borrow_info['id']]));
            }
        } else
        {
            $this->error('异常错误');
        }
    }

    //根据投资进行放款
    private function addRepayByTenderId($value, $borrow_info, $borrow_user_info)
    {
        $borrow_model = M('borrow');
        $tender_model = M('tender');
        $repay_model = M('repay');
        $user_coin_model = M('user_coin');
        $account_log_model = M('account_log');

        if ($borrow_info['repay_type'] == '到期还本付息')
        {
            $repay_list = $this->getInterestByTerm($borrow_info['borrow_days'], $borrow_info['rate'], $value['money']);
        } elseif ($borrow_info['repay_type'] == '按月付息到期还款')
        {
            $repay_list = $this->getInterestByInstallment($borrow_info['borrow_days'], $borrow_info['rate'], $value['money']);
        }
        if ($repay_list)
        {
            foreach ($repay_list as $k => $v)
            {
                //获取用户资金
                $user_coin_info = $user_coin_model->where(['user_id' => $value['tender_user_id']])->find();
                //更新用户资金
                $interest_all = round($borrow_info['money'] * $borrow_info['rate'] / 100 / 365 * $borrow_info['borrow_days'], 2);
                $user_coin_data = array(
                    'collect_account' => $user_coin_info['collect_account'] + $v['repay_money'],
                );
                if($v['money_type'] == '利息')
                    $user_coin_data['all_account'] = $user_coin_info['all_account'] + $v['repay_money'];
                if ($v['money_type'] == '本金')
                    $user_coin_data['frozen_account'] = $user_coin_info['frozen_account'] - $v['repay_money'];
                $user_coin_model->where(['user_id' => $value['tender_user_id']])->data($user_coin_data)->save();
                //生成还款
                $repay_data = array(
                    'borrow_id' => $borrow_info['id'],
                    'tender_id' => $value['id'],
                    'tender_order' => $value['order_id'],
                    'repay_order' => date('YmdHis') . rand(100000, 999999),
                    'repay_money' => $v['repay_money'],
                    'add_time' => date('Y-m-d H:i:s', time()),
                    'repay_time' => $v['repay_time'],
                    'borrow_user_id' => $borrow_user_info['id'],
                    'tender_user_id' => $value['tender_user_id'],
                    'status' => '还款中',
                    'money_type' => $v['money_type'],
                    'periods' => $v['periods'],
                    'is_last' => $v['is_last']
                );
                $repay_model->add($repay_data);
                //生成资金操作日志
                $account_log_data = array(
                    'user_id' => $value['tender_user_id'],
                    'money' => $v['repay_money'],
                    'type' => '放款',
                    'all_money' => $user_coin_info['all_account'] + $interest_all,
                    'frozen_money' => $user_coin_info['frozen_account'] - $borrow_info['money'],
                    'collection_money' => $user_coin_info['collect_account'] + $borrow_info['money'] + $interest_all,
                    'use_money' => $user_coin_info['use_account'],
                    'add_time' => date('Y-m-d H:i:s', time()),
                    'remark' => '生成还款',
                    'add_ip' => get_client_ip()
                );
                $res = $account_log_model->add($account_log_data);
                //更新投资表
                $tender_data = array(
                    'status' => '还款中'
                );
                $result = $tender_model->where(['id' => $value['id']])->data($tender_data)->save();
            }
            return $result;
        }
    }

    //获取投资列表
    public function tenderList()
    {
        $borrow_id = I('get.id');
        if ($borrow_id > 0)
        {
            $tender_list = M('tender')->where(['borrow_id' => $borrow_id])->select();
            if ($tender_list)
            {
                foreach ($tender_list as $key => $value)
                {
                    $user_info = M('users')->where(['id' => $value['tender_user_id']])->find();
                    $tender_list[$key]['user_name'] = $user_info['user_login'];
                    $borrow_info = M('borrow')->where(['id' => $value['borrow_id']])->find();
                    $tender_list[$key]['borrow_title'] = $borrow_info['borrow_title'];
                }
                $this->assign('tender_list', $tender_list);
            }
        }
        $this->display();
    }

    //获取投资还款列表
    public function tenderRepayList()
    {
        $borrow_id = I('get.id');
        if ($borrow_id > 0)
        {
            $borrow_model = M('borrow');
            $repay_model = M('repay');
            $assign_list = [];
            $borrow_info = $borrow_model->where(['id' => $borrow_id])->find();
            if ($borrow_info)
            {
                $repay_list = $repay_model->where(['borrow_id' => $borrow_id])->select();
                if ($repay_list)
                {
                    foreach ($repay_list as $key => $value)
                    {
                        $assign_list[$value['periods']]['borrow_title'] = $borrow_info['borrow_title'];
                        $assign_list[$value['periods']]['id'] = $borrow_info['id'];
                        $assign_list[$value['periods']]['periods'] = $value['periods'];
                        $assign_list[$value['periods']]['status'] = $value['status'];
                        if (isset($assign_list[$value['periods']]))
                        {
                            $assign_list[$value['periods']]['repay_money'] += $value['repay_money'];
                        } else
                        {
                            $assign_list[$value['periods']]['repay_money'] = $value['repay_money'];
                        }
                    }
                }
            }
            $this->assign('list', $assign_list);
        }
        $this->display();
    }

    //还款
    public function repay()
    {
        $id = I('get.id');
        $periods = I('get.periods');
        if ($id > 0)
        {
            $repay_model = M('repay');
            $borrow_model = M('borrow');
            if ($periods > 1)
            {
                $l_periods = $periods - 1;
                $info = $repay_model->where(['status' => '还款中', 'borrow_id' => $id, 'periods' => $l_periods]);
                if ($info)
                    $this->error('上期还款未还完', U('borrow/tenderRepayList', ['id' => $id]));
            }
            //获取还款列表
            $repay_list = $repay_model->where(['borrow_id' => $id, 'periods' => $periods])->select();
            if ($repay_list)
            {
                //开启事物
                $repay_model->startTrans();
                foreach ($repay_list as $key => $value)
                {
                    if ($value['status'] == '还款中')
                    {
                        $result = $this->repayTrue($value); //执行还款操作
                    }
                }
                if ($result)
                {
                    if ($repay_list[0]['is_last'] == '是')
                    {
                        //更新借款信息
                        $borrow_data = array(
                            'status' => '还款完成',
                            'money_status' => '已还款'
                        );
                        $res = $borrow_model->where(['id' => $id])->data($borrow_data)->save();
                    }
                    $this->success('还款成功', U('borrow/tenderRepayList', ['id' => $id]));
                    $repay_model->commit();
                } else
                {
                    $repay_model->rollBack();
                    $this->error('还款失败', U('borrow/tenderRepayList', ['id' => $id]));
                }
            }
        }
    }

    //还款操作
    public function repayTrue($repay_info)
    {
        if ($repay_info)
        {
            $repay_model = M('repay');
            $borrow_model = M('borrow');
            $user_coin_model = M('user_coin');
            $tender_model = M('tender');
            $account_log_model = M('account_log');
            $borrow_info = $borrow_model->where(['id' => $repay_info['borrow_id']])->find();
            //更新用户资金
            $user_coin_info = $user_coin_model->where(['user_id' => $repay_info['tender_user_id']])->find();
            $user_coin_data = array(
                'use_account' => $user_coin_info['use_account'] + $repay_info['repay_money'],
                'collect_account' => $user_coin_info['collect_account'] - $repay_info['repay_money']
            );
            $user_coin_model->where(['user_id' => $repay_info['tender_user_id']])->data($user_coin_data)->save();
            //更新还款状态
            $repay_data = array(
                'repay_money_true' => $repay_info['repay_money'],
                'status' => '还款完成',
                'repay_time_true' => date('Y-m-d H:i:s', time())
            );
            $repay_model->where(['id' => $repay_info['id']])->data($repay_data)->save();
            //增加用户资金记录
            $account_log_data = array(
                'user_id' => $repay_info['tender_user_id'],
                'money' => $repay_info['repay_money'],
                'type' => '还款',
                'all_money' => $user_coin_info['all_account'],
                'use_money' => $user_coin_data['use_account'],
                'frozen_money' => $user_coin_info['frozen_account'],
                'collection_money' => $user_coin_data['collect_account'],
                'add_time' => date('Y-m-d H:i:s', time()),
                'add_ip' => get_client_ip(),
                'remark' => '收到借款【' . $borrow_info['borrow_title'] . '】第【' . $repay_info['periods'] . '】期【' . $repay_info['money_type'] . '】还款【' . $repay_info['repay_money'] . '】元'
            );
            $result = $account_log_model->add($account_log_data);
            //判断单条投资是否已经还完
            if ($repay_info['is_last'] == '是')
            {
                $tender_data = array(
                    'status' => '还款成功'
                );
                $tender_model->where(['id' => $repay_info['tender_id']])->data($tender_data)->save();
            }
            return $result;
        }
    }

    //还款完成
    public function repayEnd()
    {
        $where = array(
            'status' => '还款完成'
        );
        $result = $this->search($where);
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display();
    }

    //编辑产品
    public function edit()
    {
        $id = I("get.id");
        $borrow_info = $this->borrow_model->where(["id" => $id])->find();
        $type_id = $borrow_info['type_id'];
        $user_info = $this->borrow_user_model->where(["borrow_id" => $id])->find();
        $user_car_info = $this->borrow_car_model->where(["borrow_id" => $id])->find();
        $user_house_info = $this->borrow_house_model->where(["borrow_id" => $id])->find();
        $car_info_img = json_decode($user_car_info['images'], true);
        $house_info_img = json_decode($user_house_info['images'], true);
        $this->assign("borrow_info", $borrow_info);
        $this->assign("user_info", $user_info);
        $this->assign("user_car_info", $user_car_info);
        $this->assign("user_house_info", $user_house_info);
        $this->assign("car_info_img", $car_info_img['photo']);
        $this->assign("house_info_img", $house_info_img['photo']);
        $this->assign("borrow_id", $id);
        $this->assign("type_id", $type_id);
        $this->display();
    }

    //保存编辑
    public function save_change()
    {
        if (IS_POST)
        {
            $data = $_POST;
            $id = $data['borrow_id'];
            $type_id = $data['type_id'];
            $type_info = $this->borrow_type_model->where(['id' => $type_id])->find();
            $check_post = $this->check_post($data, $type_info);
            if ($check_post)
            {
                //保存借款信息
                $borrow_data = array(
                    'borrow_title' => $data['borrow_title'],
                    'money' => $data['money'],
                    'rate' => $data['rate'],
                    'status' => '待审核',
                    'deadline' => $data['deadline'],
                    'repay_type' => $data['repay_type'],
                    'borrow_days' => $data['borrow_days'],
                    'add_time' => date('Y-m-d H:i:s', time()),
                    'invest_lowest' => $data['invest_lowest'],
                    'money_status' => '未满标',
                    'repay_source' => $data['repay_source'],
                    'borrow_uses' => $data['borrow_uses'],
                    'remark' => $data['remark'],
                    'management_views' => $data['management_views'],
                    'is_new' => $data['is_new']
                );
                $borrow_id = $this->borrow_model->where(['id' => $id])->data($borrow_data)->save();
                if ($borrow_id > 0)
                {
                    //增加借款用户资料
                    $user_data = array(
                        'real_name' => $data['real_name'],
                        'id_card' => $data['id_card'],
                        'sex' => $data['sex'],
                        'married' => $data['married']
                    );
                    $this->borrow_user_model->where(['borrow_id' => $id])->data($user_data)->save();
                    if ($type_info['is_car'] == 'Y')
                    {
                        if (!empty($_POST['car_photos_alt']) && !empty($_POST['car_photos_url']))
                        {
                            foreach ($_POST['car_photos_url'] as $key => $url)
                            {
                                $photourl = sp_asset_relative_url($url);
                                $photoid = $_POST['imageid'];
                                $_POST['smeta']['car']['photo'][] = array("imageid" => $photoid, "url" => $photourl, "alt" => $_POST['car_photos_alt'][$key]);
                            }
                        }
                        $car_data = array(
                            'brand' => $data['brand'],
                            'plate_number' => $data['plate_number'],
                            'exactly' => $data['exactly'],
                            'price' => $data['price'],
                            'mortgage' => $data['mortgage'],
                            'add_time' => date('Y-m-d H:i:s', time()),
                            'images' => json_encode($_POST['smeta']['car'])
                        );
                        $this->borrow_car_model->where(['borrow_id' => $id])->data($car_data)->save();
                    }
                    if ($type_info['is_house'] == 'Y')
                    {
                        if (!empty($_POST['house_photos_alt']) && !empty($_POST['house_photos_url']))
                        {
                            foreach ($_POST['house_photos_url'] as $key => $url)
                            {
                                $photourl = sp_asset_relative_url($url);
                                $photoid = $_POST['houseimageid'];
                                $_POST['smeta']['house']['photo'][] = array("houseimageid" => $photoid, "url" => $photourl, "alt" => $_POST['house_photos_alt'][$key]);
                            }
                        }
                        $house_data = array(
                            'position' => $data['position'],
                            'price' => $data['price'],
                            'acreage' => $data['acreage'],
                            'nature' => $data['nature'],
                            'add_time' => date('Y-m-d H:i:s', time()),
                            'images' => json_encode($_POST['smeta']['house'])
                        );
                        $this->borrow_house_model->where(['borrow_id' => $id])->data($house_data)->save();
                    }
                }
            }
            $this->success("保存成功！", U("borrow/index"));
        }
    }

    private
            function check_post($data, $type_info)
    {
        if (!isset($data['money']) || $data['money'] < 100)
            $this->error('借款金额不正确');
        if (!isset($data['rate']) || $data['rate'] <= 0)
            $this->error('借款利率不正确');
        if (!isset($data['deadline']) || $data['deadline'] < 1)
            $this->error('募集期限不正确');
        if (!isset($data['borrow_days']) || $data['borrow_days'] <= 0)
            $this->error('借款期限不正确');
        if (!isset($data['invest_lowest']) || $data['invest_lowest'] <= 0)
            $this->error('最低金额不正确');
        if (!isset($data['real_name']))
            $this->error('真实姓名不正确');
        if (!isset($data['id_card']))
            $this->error('身份证号不正确');
        if (!$type_info['type'] <= 0)
            $this->error('产品类型错误');
        if ($type_info['is_car'] == 'Y')
            if (!$data['brand'] || !$data['plate_number'] || $data['exactly'] < 0 || $data['price'] <= 0 || $data['mortgage'] <= 0)
                $this->error('车辆信息填写错误');
        if ($type_info['is_house'] == 'Y')
            if (!$data['position'] || $data['price'] < 0 || $data['acreage'] <= 0 || !$data['nature'])
                $this->error('房产信息填写错误');
        return true;
    }

    //初审通过
    public function waitRelease()
    {
        $result = $this->search(['status' => '初审通过']);
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display();
    }

}
