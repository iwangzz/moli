<?php

/**
 * 会员注册登录
 */

namespace User\Controller;

use Common\Controller\MemberbaseController;

class IndexController extends MemberbaseController
{

    protected $user_model;
    protected $user_coin_model;
    protected $user_bank_model;
    protected $sms_log_model;

    function _initialize()
    {
        parent::_initialize();
        $this->user_model = M("users");
        $this->user_coin_model = M("user_coin");
        $this->user_bank_model = M("user_bank");
        $this->repay_model = M("repay");
        $this->tender_model = M("tender");
        $this->borrow_type_model = M("borrow_type");
        $this->account_log_model = M("account_log");
        $this->borrow_model = M("borrow");
        $this->sms_log_model = M("sms_log");
    }

    //登录
    public function index()
    {
        $id = $_SESSION['user']['id'];
        $user_info = $this->user_model->where(['id' => $id])->find();
        $this->assign('user_info', $user_info);
        if ($user_info) {
            //获取用户资金
            $user_coin_info = $this->user_coin_model->where(['user_id' => $id])->find();
            $this->assign('user_coin_info', $user_coin_info);
            //获取当天利息
            $tender_list = $this->tender_model->where(['tender_user_id' => $id, 'status' => '还款中'])->select();
            $day_money = 0.00;
            $car_ids = [];
            $house_ids = [];
            $new_ids = [];
            $account_info = array(
                'new_money' => 0.00,
                'car_money' => 0.00,
                'house_money' => 0.00,
            );
            if ($tender_list) {
                foreach ($tender_list as $key => $value) {
                    $borrow_info = $this->borrow_model->where(array('id' => $value['borrow_id']))->find();
                    $day_money += round($value['money'] * $borrow_info['rate'] / 365 / 100, 2);
                    if ($borrow_info['is_new'] == '是') {
                        $new_ids[] = $borrow_info['id'];
                    } else {
                        $type_info = $this->borrow_type_model->where(array('id' => $borrow_info['type_id']))->find();
                        if ($type_info['is_car'] == 'Y')
                            $car_ids[] = $borrow_info['id'];
                        if ($type_info['is_house'] == 'Y')
                            $house_ids[] = $borrow_info['id'];
                    }
                }
                $repay_list = $this->repay_model->where(array('status' => '还款中', 'tender_user_id' => $id))->select();
                //获取资金明细
                if ($repay_list) {
                    foreach ($repay_list as $key => $value) {
                        if (in_array($value['borrow_id'], $new_ids)) {
                            $account_info['new_money'] += $value['repay_money'];
                        }
                        if (in_array($value['borrow_id'], $car_ids)) {
                            $account_info['car_money'] += $value['repay_money'];
                        }
                        if (in_array($value['borrow_id'], $house_ids)) {
                            $account_info['house_money'] += $value['repay_money'];
                        }
                    }
                }
            }
//            if (isset($_GET['sign']) && $_GET['sign'] == 'second') {
                $all_account2 = $account_info['new_money'] + $account_info['car_money'] + $account_info['house_money'];
                $second_info = array(
                    'new_money_rate' => round($account_info['new_money'] / $all_account2 * 100, 2),
                    'car_money_rate' => round($account_info['car_money'] / $all_account2 * 100, 2),
                    'house_money_rate' => round($account_info['house_money'] / $all_account2 * 100, 2),
                    'new_money' => $account_info['new_money'],
                    'car_money' => $account_info['car_money'],
                    'house_money' => $account_info['house_money']
                );
                $this->assign('second_info', $second_info);
                $this->assign('sign', $_GET['sign']);
//            }
//            if (isset($_GET['sign']) && $_GET['sign'] == 'third') {
                $all_account3 = $user_coin_info['use_account'] + $user_coin_info['frozen_account'];
                $coin_info = array(
                    'frozen_account_rate' => round($user_coin_info['frozen_account'] / $all_account3 * 100, 2),
                    'use_account_rate' => round($user_coin_info['use_account'] / $all_account3 * 100, 2),
                    'frozen_account' => $user_coin_info['frozen_account'],
                    'use_account' => $user_coin_info['use_account']
                );
                $this->assign('coin_info', $coin_info);
                $this->assign('sign', $_GET['sign']);
//            }
            if (!isset($_GET['sign']))
                $this->assign('sign', 'first');
            $account_info['frozen_money'] = $user_coin_info['frozen_account'];
            $account_info['use_money'] = $user_coin_info['use_account'];
            if ($user_coin_info['all_account']) {
                $account_info['use_money_rate'] = round($account_info['use_money'] / $user_coin_info['all_account'] * 100, 2);
                $account_info['frozen_money_rate'] = round($account_info['frozen_money'] / $user_coin_info['all_account'] * 100, 2);
                $account_info['new_money_rate'] = round($account_info['new_money'] / $user_coin_info['all_account'] * 100, 2);
                $account_info['car_money_rate'] = round($account_info['car_money'] / $user_coin_info['all_account'] * 100, 2);
                $account_info['house_money_rate'] = round($account_info['house_money'] / $user_coin_info['all_account'] * 100, 2);
            }
            $this->assign('account_info', $account_info);
            $this->assign('day_money', $day_money);
            //获取资金记录分页
            $where = array('user_id' => $id);
            $count = $this->account_log_model->where($where)->count();
            $page = $this->page($count, 6);
            $list = $this->account_log_model->order("id DESC")
                ->where($where)
                ->limit($page->firstRow . ',' . $page->listRows)
                ->select();
            $this->assign('Page', $page->show('Admin'));
            $this->assign('account_log_list', $list);
            //判断安全等级
            $level = '低';
            if($user_info['id_number'] && $user_info['user_trade_pass']){
                $level = '高';
            }elseif($user_info['id_number'] || $user_info['user_trade_pass']) {
                $level = '中';
            }
            $this->assign('level', $level);
        }
        $this->display(":index");
    }

    function is_login()
    {
        if (sp_is_user_login()) {
            $this->ajaxReturn(array("status" => 1, "user" => sp_get_current_user()));
        } else {
            $this->ajaxReturn(array("status" => 0, "info" => "此用户未登录！"));
        }
    }

    //退出
    public function logout()
    {
        $ucenter_syn = C("UCENTER_ENABLED");
        $login_success = false;
        if ($ucenter_syn) {
            include UC_CLIENT_ROOT . "client.php";
            echo uc_user_synlogout();
        }
        session("user", null); //只有前台用户退出
        redirect(__ROOT__ . "/");
    }

    public function logout2()
    {
        $ucenter_syn = C("UCENTER_ENABLED");
        $login_success = false;
        if ($ucenter_syn) {
            include UC_CLIENT_ROOT . "client.php";
            echo uc_user_synlogout();
        }
        if (isset($_SESSION["user"])) {
            $referer = $_SERVER["HTTP_REFERER"];
            session("user", null); //只有前台用户退出
            $_SESSION['login_http_referer'] = $referer;
            $this->success("退出成功！", __ROOT__ . "/");
        } else {
            redirect(__ROOT__ . "/");
        }
    }

    //实名认证
    public function realname()
    {
        $id = $_SESSION['user']['id'];
        $userinfo = $this->user_model->where(['id' => $id])->find();
        $realinfo = $userinfo['real_name'];
        if ($realinfo != '')
            $this->error("您已完成使命认证，无须重复认证", '/index.php/user');
        $this->display(":realname");
    }

    //录入实名认证信息
    public function add_realinfo()
    {
        $id = $_SESSION['user']['id'];
        if ($id) {
            $cardinfo = $this->getIDcardInfo($_POST['idnumber']);
            $realdata = array(
                'real_name' => $_POST['realname'],
                'id_number' => $_POST['idnumber'],
                'birthday' => $cardinfo['date'],
                'sex' => $cardinfo['sex']
            );
            $info = $this->user_model->where(['id' => $id])->save($realdata);
            if ($info)
                $this->success("实名认证成功", '/index.php/user/index/realsuccess');
        }
    }

    //实名认证成功
    public function realsuccess()
    {
        $this->display(":realsuccess");
    }

    //账户设置
    public function accountinfo()
    {
        $id = $_SESSION['user']['id'];
        $userinfo = $this->user_model->where(['id' => $id])->find();
        $flag = '0';
        if($userinfo['id_number'] != '')
            $idnumber = substr_replace($userinfo['id_number'], "*************", 4);
        else
            $idnumber = '';
        $sexflag = $userinfo['sex'];
        switch ($sexflag) {
            case 0 :
                $sex = '保密';
                break;
            case 1 :
                $sex = '男';
                break;
            case 2 :
                $sex = '女';
                break;
        };
        $this->assign('userinfo', $userinfo);
        $this->assign('sex', $sex);
        $this->assign('idnumber', $idnumber);
        $this->display(":accountset");
    }

    //我的银行卡页面信息展示
    public function bankcard()
    {
        $id = $_SESSION['user']['id'];
        if ($id) {
            //验证是否实名认证，实名认证通过才能绑定银行卡
            $userinfo = $this->user_model->where(['id' => $id])->find();
            $account_name = $userinfo['real_name'];
            if (!$account_name)
                $this->redirect(U('user/index/realname'));
            $bankinfo = $this->user_bank_model->where(['user_id' => $id])->find();
            $banknum_hide = substr_replace($bankinfo['bank_num'], ' **** **** ****', 4);
            $flag = '0';
            if ($bankinfo) {
                $flag = '1';
                $this->assign('bankinfo', $bankinfo);
            }
            $this->assign('flag', $flag);
            $this->assign('banknum_hide', $banknum_hide);
            $this->assign('account_name', $account_name);
            $this->display(":bankcard");
        }
    }

    //绑定银行卡
    public function bindcard()
    {
        $id = $_SESSION['user']['id'];
        if ($id) {
            $userinfo = $this->user_model->where(['id' => $id])->find();
            $account_name = $userinfo['real_name'];
            $bankdata = array(
                'user_id' => $id,
                'account_name' => $account_name,
                'bank_name' => $_POST['bankname'],
                'bank_num' => $_POST['banknum'],
                'branch_name' => $_POST['branchname'],
                'bank_province' => $_POST['prov'],
                'bank_city' => $_POST['city'],
                'bank_dist' => $_POST['dist'],
                'is_default' => '否',
                'add_ip' => $_SERVER['REMOTE_ADDR'],
                'create_time' => date('Y-m-d H:m:s', time())
            );
            $bankinfo = $this->user_bank_model->add($bankdata);
            if ($bankinfo) {
                $this->success("绑定成功", U('user/index/bankcard'));
            }
            $this->error("绑定失败，请检查信息是否正确", U('user/index/bankcard'));
        }
    }

    //验证身份
    public function idTest()
    {
        $id = $_SESSION['user']['id'];
        $userinfo = $this->user_model->where(['id' => $id])->find();
        $phone_number_hide = substr_replace($userinfo['mobile'], '*****', 3, 5);
        $this->assign("phone_number", $phone_number_hide);
        $this->display(':idtest');
    }

    //验证身份验证码发送
    public function idCode()
    {
        $phone = $_SESSION['user']['mobile'];
        if (isset($_SESSION['verify_time']) && time() - $_SESSION['verify_time'] < 90) {
            $this->ajaxReturn(['status' => 0, 'msg' => '短信发送过于频繁']);
        }
        $_SESSION['verify_time'] = time();
        $_SESSION['verify_code'] = rand(100000, 999999);
        $content = '您的短信验证码为' . $_SESSION['verify_code'];
        $res = $this->sendSms($phone, $content);
        if ($res) {
            $sms_log_data = array(
                'phone' => $phone,
                'content' => $content,
                'type' => '修改手机号',
                'user_ip' => get_client_ip(),
                'add_time' => date('Y-m-d H:m:i', time())
            );
            $this->sms_log_model->data($sms_log_data)->add();
            $this->ajaxReturn(['status' => 1, 'msg' => '发送成功']);
        }
    }

    //校验验证身份验证码
    public function checkidcode()
    {
        if (IS_POST) {
            if (!isset($_SESSION['verify_code'])) {
                $this->ajaxReturn(['status' => 0, 'msg' => '请点击发送验证码']);
            } elseif (isset($_SESSION['verify_time']) && time() - $_SESSION['verify_time'] > 90) {
                $this->ajaxReturn(['status' => 0, 'msg' => '验证码已过期，请重新发送']);
            } elseif (isset($_SESSION['verify_time']) && time() - $_SESSION['verify_time'] < 90) {
                $idinputcode = $_POST['idcode'];
                $session_code = $_SESSION['verify_code'];
                if ($idinputcode != $session_code) {
                    $this->ajaxReturn(['status' => 0, 'msg' => '验证码输入有误']);
                } elseif ($idinputcode == $session_code) {
                    $this->ajaxReturn(['status' => 1, 'flag' => 'open']);
                }
            }
        }
    }

    // 绑定新手机号
    public function bindnewphone()
    {
        $flag = I('get.flag');
        if ($flag !== 'open')
            $this->redirect('Portal/index/index', '', 2, '页面跳转中...');
        $this->display(':bindnewphone');
    }

    //绑定新手机号验证码发送
    public function newphoneCode()
    {
        if (IS_POST) {
            $phone = $_SESSION['user']['mobile'];
            $newphone = $_POST['phone'];
            $samephone = $this->user_model->where(['mobile' => $newphone])->find();
            if ($samephone) {
                $this->ajaxReturn(['status' => 0, 'msg' => '改手机号已注册！']);
            } elseif ($newphone == $phone) {
                $this->ajaxReturn(['status' => 0, 'msg' => '新手机号与现手机号一致无须绑定！']);
            } elseif (isset($_SESSION['new_verify_time']) && time() - $_SESSION['new_verify_time'] < 90) {
                $this->ajaxReturn(['status' => 0, 'msg' => '短信发送过于频繁']);
            }
            $_SESSION['new_verify_time'] = time();
            $_SESSION['new_verify_code'] = rand(100000, 999999);
            $content = '您的短信验证码为' . $_SESSION['new_verify_code'];
            $res = $this->sendSms($newphone, $content);
            if ($res) {
                $sms_log_data = array(
                    'phone' => $phone,
                    'content' => $content,
                    'type' => '修改手机号',
                    'user_ip' => get_client_ip(),
                    'add_time' => date('Y-m-d H:m:i', time())
                );
                $this->sms_log_model->data($sms_log_data)->add();
                $this->ajaxReturn(['status' => 1, 'msg' => '发送成功']);
            }
        }
    }

    //校验新手机号验证码
    public function checknewphoneCode()
    {
        $id = $_SESSION['user']['id'];
        if (IS_POST) {
            if (!isset($_SESSION['new_verify_code'])) {
                $this->ajaxReturn(['status' => 0, 'msg' => '请点击发送验证码']);
            } elseif (isset($_SESSION['new_verify_time']) && time() - $_SESSION['new_verify_time'] > 90) {
                $this->ajaxReturn(['status' => 0, 'msg' => '验证码已过期，请重新发送']);
            } elseif (isset($_SESSION['new_verify_time']) && time() - $_SESSION['new_verify_time'] < 90) {
                $new_inputcode = $_POST['newphonecode'];
                $new_session_code = $_SESSION['new_verify_code'];
                if ($new_inputcode != $new_session_code) {
                    $this->ajaxReturn(['status' => 0, 'msg' => '验证码输入有误']);
                } elseif ($new_inputcode == $new_session_code) {
                    $newphonenum = $_POST['newphonenum'];
                    $data = array(
                        'mobile' => $newphonenum,
                        'user_login' => $newphonenum
                    );
                    $this->user_model->where(['id' => $id])->save($data);
                    $this->ajaxReturn(['status' => 1, 'flag' => 'open']);
                }
            }
        }
    }

    //手机修改成功
    public function phoneSuccess()
    {
        $flag = I('get.flag');
        if ($flag !== 'open')
            $this->redirect('Portal/index/index', '', 2, '页面跳转中...');
        $this->display(':phonesuccess');
    }

    // 获取出生日期和性别
    public function getIDcardInfo($idcardnum)
    {
        $len = strlen($idcardnum);
        if ($len == 18) {
            $year = intval(substr($idcardnum, 6, 4));
            $month = intval(substr($idcardnum, 10, 2));
            $day = intval(substr($idcardnum, 12, 2));
            $both_date = $year . "-" . $month . "-" . $day;
        } elseif ($len == 15) {
            $year = intval("19" . substr($idcardnum, 6, 2));
            $month = intval(substr($idcardnum, 8, 2));
            $day = intval(substr($idcardnum, 10, 2));
            $both_date = $year . "-" . $month . "-" . $day;
        }
        $sex = substr($idcardnum, ($len == 15 ? -2 : -1), 1) % 2 ? 1 : 2;
        $cardinfo['date'] = $both_date;
        $cardinfo['sex'] = $sex;
        return $cardinfo;
    }

    //修改登录密码
    public function changeloginpwd()
    {
        $this->display(':changeloginpwd');
    }

    //修改登录密码
    public function do_changeloginpwd()
    {
        $id = $_SESSION['user']['id'];
        if (IS_POST) {
            $formdata = $_POST;
            $userinfo = $this->user_model->where(['id' => $id])->find();
            $user_pass = $userinfo['user_pass'];
            $oldpwd = sp_password($formdata['oldpwd']);
            $newpwd = sp_password($formdata['renewpwd']);
            if (!$formdata['oldpwd'] || !$formdata['newpwd'] || !$formdata['renewpwd'])
                $this->ajaxReturn(['status' => 0, 'msg' => '信息输入不完整！']);
            if ($oldpwd != $user_pass)
                $this->ajaxReturn(['status' => 0, 'msg' => '原始密码输入不正确！']);
            if ($newpwd == $user_pass)
                $this->ajaxReturn(['status' => 0, 'msg' => '原始密码与现密码一致！']);
            $data = array(
                'user_pass' => $newpwd
            );
            $info = $this->user_model->where(['id' => $id])->save($data);
            if ($info) {
                session("user", null); //只有前台用户退出
                $this->ajaxReturn(['status' => 1, 'msg' => '密码重置成功！']);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => '密码重置失败！']);
            }
        }
    }

    //保存昵称
    public function saveNicename()
    {
        $id = $_SESSION['user']['id'];
        if (IS_POST) {
            $data = array(
                'user_nicename' => $_POST['usernicename'],
            );
            $info = $this->user_model->where(['id' => $id])->save($data);
            if ($info) {
                //刷新用户昵称数据。
                $_SESSION['user']['user_nicename'] = $_POST['usernicename'];
                $this->ajaxReturn(['status' => '1', 'msg' => '昵称修改成功!']);
            }
        }
    }

    //设置交易密码页面
    public function setTradepwd()
    {
        $id = $_SESSION['user']['id'];
        $userinfo = $this->user_model->where(['id' => $id])->find();
        $phone_number_hide = substr_replace($userinfo['mobile'], '*****', 3, 5);
        $this->assign("phone_number", $phone_number_hide);
        $this->display(':settradepwd');
    }

    //设置交易密码 验证码发送
    public function settradepwdCode()
    {
        if (IS_POST) {
            $settradedata = $_POST;
            $phone = $_SESSION['user']['mobile'];
            if (!$settradedata['tradepwd'] || !$settradedata['retradepwd'])
                $this->ajaxReturn(['status' => 0, 'msg' => '信息输入不完整！']);
            if (isset($_SESSION['settrade_time']) && time() - $_SESSION['settrade_time'] < 90) {
                $this->ajaxReturn(['status' => 0, 'msg' => '短信发送过于频繁']);
            }
            $_SESSION['settrade_time'] = time();
            $_SESSION['settrade_code'] = rand(100000, 999999);
            $content = '您的短信验证码为' . $_SESSION['settrade_code'];
            $res = $this->sendSms($phone, $content);
            if ($res) {
                $sms_log_data = array(
                    'phone' => $phone,
                    'content' => $content,
                    'type' => '修改交易密码',
                    'user_ip' => get_client_ip(),
                    'add_time' => date('Y-m-d H:m:i', time())
                );
                $this->sms_log_model->data($sms_log_data)->add();
                $this->ajaxReturn(['status' => 1, 'msg' => '发送成功']);
            }
        }
    }

    //设置交易密码  验证验证码
    public function checktradepwdCode()
    {
        $id = $_SESSION['user']['id'];
        if (IS_POST) {
            if (!isset($_SESSION['settrade_code'])) {
                $this->ajaxReturn(['status' => 0, 'msg' => '请点击发送验证码']);
            } elseif (isset($_SESSION['settrade_time']) && time() - $_SESSION['settrade_time'] > 90) {
                $this->ajaxReturn(['status' => 0, 'msg' => '验证码已过期，请重新发送']);
            } elseif (isset($_SESSION['settrade_time']) && time() - $_SESSION['settrade_time'] < 90) {
                $settradecode = $_POST['settradecode'];
                $session_code = $_SESSION['settrade_code'];
                if ($settradecode != $session_code) {
                    $this->ajaxReturn(['status' => 0, 'msg' => '验证码输入有误']);
                } elseif ($settradecode == $session_code) {
                    $user_trade_pass = sp_password($_POST['retradepwd']);
                    $data = array(
                        'user_trade_pass' => $user_trade_pass,
                    );
                    $this->user_model->where(['id' => $id])->save($data);
                    $this->ajaxReturn(['status' => 1, 'msg' => '设置成功！']);
                }
            }
        }
    }

    //已设置交易密码  修改
    public function changeTradepwd()
    {
        $id = $_SESSION['user']['id'];
        $this->display(':changetradepwd');
    }

    //修改交易密码
    public function changetradepass()
    {
        $id = $_SESSION['user']['id'];
        if (IS_POST) {
            $changetradedata = $_POST;
            $userinfo = $this->user_model->where(['id' => $id])->find();
            $user_trade_pass = $userinfo['user_trade_pass'];
            $oldtradepass = $changetradedata['oldtradepass'];
            $newtradepass = sp_password($_POST['renewtradepass']);
            if (!$changetradedata['oldtradepass'] || !$changetradedata['newtradepass'] || !$changetradedata['renewtradepass'])
                $this->ajaxReturn(['status' => 0, 'msg' => '信息输入不完整！']);
            if ($oldtradepass != $user_trade_pass)
                $this->ajaxReturn(['status' => 0, 'msg' => '原密码输入有误']);
            if ($newtradepass == $user_trade_pass)
                $this->ajaxReturn(['status' => 0, 'msg' => '新密码与原密码一致']);
            $newtradepassdata = array(
                'user_trade_pass' => $newtradepass
            );
            $info = $this->user_model->where(['id' => $id])->save($newtradepassdata);
            if ($info)
                $this->ajaxReturn(['status' => 1, 'msg' => '修改成功！']);
            else
                $this->ajaxReturn(['status' => 0, 'msg' => '修改失败！']);
        }
    }

    //用户取现
    public function withDraw()
    {
        $id = $_SESSION['user']['id'];
        if ($id) {
            //验证是否实名认证，实名认证通过才能绑定银行卡
            $userinfo = $this->user_model->where(['id' => $id])->find();
            $account_name = $userinfo['real_name'];
            if (!$account_name)
                $this->redirect(U('user/index/realname'));
            $bankinfo = $this->user_bank_model->where(['user_id' => $id])->find();
            if (!$bankinfo) {
                $this->redirect(U('user/index/bankcard'));
            }
            $coininfo = $this->user_coin_model->where(['user_id' => $id])->find();
            $use_coin = $coininfo['use_account'];
            $this->assign('use_coin',$use_coin);
            $this->display(':cash');
        }
    }

    //确认投资页面
    public function investconfirm()
    {
        $borrow_id = $_REQUEST['id'] > 0 ? $_REQUEST['id'] : 0;
        $account = $_REQUEST['account'] >= 100 ? $_REQUEST['account'] : 0;
        if ($borrow_id == 0)
            $this->error('非法操作', '/index.php');
        if ($account < 100)
            $this->error('投资金额不能低于100元', '/index.php/borrow/detail/id/' . $borrow_id);
        $user_info = M('users')->where(['id' => $_SESSION['user']['id']])->find();
        if(!$user_info['user_trade_pass'])
            $this->error('请先设置交易密码', '/index.php/user/index/setTradepwd');
        $borrow_info = M('borrow')->where(array('id' => $borrow_id))->find();
        $this->assign('borrow_info', $borrow_info);
        $user_coin = M('user_coin')->where(array('user_id' => $_SESSION['user']['id']))->find();
        $this->assign('user_coin', $user_coin);
        $this->assign('tender_money', $account);
        $this->display(':investconfirm');
    }

}

