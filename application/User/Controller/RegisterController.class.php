<?php

/**
 * 会员注册
 */

namespace User\Controller;

use Common\Controller\HomebaseController;

class RegisterController extends HomebaseController {

    function index() {
        if (sp_is_user_login()) { //已经登录时直接跳到首页
            redirect(__ROOT__ . "/");
        } else {
            $this->display(":register");
        }
    }

    function doregister() {
        if (isset($_POST['mobile'])) {
            //手机号注册
            $this->_do_mobile_register();
        } else {
            $this->error("注册方式不存在！");
        }
    }

    private function _do_mobile_register() {
        $rules = array(
            //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
            array('mobile', 'require', '手机号不能为空！', 1),
            array('password', 'require', '密码不能为空！', 1),
        );

        $users_model = M("Users");

        if ($users_model->validate($rules)->create() === false) {
            $this->error($users_model->getError());
        }

        $password = $_POST['password'];
        $mobile = $_POST['mobile'];

        if (strlen($password) < 5 || strlen($password) > 20) {
            $this->error("密码长度至少5位，最多20位！");
        }


        $where['mobile'] = $mobile;
        $users_model = M("Users");
        $result = $users_model->where($where)->count();
        if ($result) {
            $this->error("手机号已被注册！");
        } else {
            $nice_name = $this->createNicename();
            $data = array(
                'user_login' => $_POST['mobile'],
                'user_email' => '',
                'mobile' => $_POST['mobile'],
                'user_nicename' => $nice_name,
                'user_pass' => sp_password($password),
                'last_login_ip' => get_client_ip(0, true),
                'create_time' => date("Y-m-d H:i:s"),
                'last_login_time' => date("Y-m-d H:i:s"),
                'user_status' => 1,
                'is_server' => 1,
                "user_type" => 2, //会员
            );
            $rst = $users_model->add($data);
            if ($rst) {
                $user_coin_data = array(
                    'user_id' => $rst,
                    'all_account' => '0.00',
                    'frozen_account' => '0.00',
                    'use_account' => '0.00',
                    'collect_account' => '0.00'
                );
                M('user_coin')->add($user_coin_data);
                //登入成功页面跳转
                $data['id'] = $rst;
                $_SESSION['user'] = $data;
                $this->success("注册成功！", U("user/index/realname"));
            } else {
                $this->error("注册失败！", U("user/register/index"));
            }
        }
    }

    //发送注册验证码
    public function sendregCode() {
        if (IS_POST) {
            $regphone = $_POST['mobile'];
            $password = $_POST['password'];
            $reppassword = $_POST['reppassword'];
            if (isset($_SESSION['reg_verify_time']) && time() - $_SESSION['reg_verify_time'] < 60) {
                $this->ajaxReturn(['status' => 0, 'msg' => '短信发送过于频繁']);
            }
            if (!$regphone || !$password || !$reppassword) {
                $this->ajaxReturn(['status' => 0, 'msg' => '您输入的信息不完整']);
            } else {
                $where['mobile'] = $regphone;
                $users_model = M("Users");
                $result = $users_model->where($where)->count();
                if ($result) {
                    $this->ajaxReturn(['status' => 0, 'msg' => '手机号已被注册']);
                }
            }
            $_SESSION['reg_verify_time'] = time();
            $_SESSION['reg_verify_code'] = rand(100000, 999999);
            $content = '您的短信验证码为' . $_SESSION['reg_verify_code'];
            $res = $this->sendSms($regphone, $content);
            if ($res) {
                $sms_log_data = array(
                    'phone' => $regphone,
                    'content' => $content,
                    'type' => '注册',
                    'user_ip' => get_client_ip(),
                    'add_time' => date('Y-m-d H:m:i', time())
                );

                M('sms_log')->data($sms_log_data)->add();
                $this->ajaxReturn(['status' => 1, 'msg' => '发送成功']);
            }
        }
    }

    //验证注册验证码
    public function checkregCode() {
        if (IS_POST) {
            if (!isset($_SESSION['reg_verify_code'])) {
                $this->ajaxReturn(['status' => 0, 'msg' => '请点击发送验证码']);
            } elseif (isset($_SESSION['reg_verify_time']) && time() - $_SESSION['reg_verify_time'] > 60) {
                $this->ajaxReturn(['status' => 0, 'msg' => '验证码已过期，请重新发送']);
            } elseif (isset($_SESSION['reg_verify_time']) && time() - $_SESSION['reg_verify_time'] < 60) {
                $reg_inputcode = $_POST['regcode'];
                $reg_session_code = $_SESSION['reg_verify_code'];
                if ($reg_inputcode != $reg_session_code) {
                    $this->ajaxReturn(['status' => 0, 'msg' => '验证码输入有误']);
                } elseif ($reg_inputcode == $reg_session_code) {
                    $this->ajaxReturn(['status' => 1]);
                }
            }
        }
    }

//    private function _do_email_register()
//    {
//
//        if (!sp_check_verify_code()) {
//            $this->error("验证码错误！");
//        }
//
//        $rules = array(
//            //array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
//            array('email', 'require', '邮箱不能为空！', 1),
//            array('password', 'require', '密码不能为空！', 1),
//            array('repassword', 'require', '重复密码不能为空！', 1),
//            array('repassword', 'password', '确认密码不正确', 0, 'confirm'),
//            array('email', 'email', '邮箱格式不正确！', 1), // 验证email字段格式是否正确
//
//        );
//
//
//        $users_model = M("Users");
//
//        if ($users_model->validate($rules)->create() === false) {
//            $this->error($users_model->getError());
//        }
//
//        $password = $_POST['password'];
//        $email = $_POST['email'];
//        $username = str_replace(array(".", "@"), "_", $email);
//        //用户名需过滤的字符的正则
//        $stripChar = '?<*.>\'"';
//        if (preg_match('/[' . $stripChar . ']/is', $username) == 1) {
//            $this->error('用户名中包含' . $stripChar . '等非法字符！');
//        }
//
//        // 	    $banned_usernames=explode(",", sp_get_cmf_settings("banned_usernames"));
//
//        // 	    if(in_array($username, $banned_usernames)){
//        // 	        $this->error("此用户名禁止使用！");
//        // 	    }
//
//        if (strlen($password) < 5 || strlen($password) > 20) {
//            $this->error("密码长度至少5位，最多20位！");
//        }
//
//        $where['user_login'] = $username;
//        $where['user_email'] = $email;
//        $where['_logic'] = 'OR';
//
//        $ucenter_syn = C("UCENTER_ENABLED");
//        $uc_checkemail = 1;
//        $uc_checkusername = 1;
//        if ($ucenter_syn) {
//            include UC_CLIENT_ROOT . "client.php";
//            $uc_checkemail = uc_user_checkemail($email);
//            $uc_checkusername = uc_user_checkname($username);
//        }
//
//        $users_model = M("Users");
//        $result = $users_model->where($where)->count();
//        if ($result || $uc_checkemail < 0 || $uc_checkusername < 0) {
//            $this->error("用户名或者该邮箱已经存在！");
//        } else {
//            $uc_register = true;
//            if ($ucenter_syn) {
//
//                $uc_uid = uc_user_register($username, $password, $email);
//                //exit($uc_uid);
//                if ($uc_uid < 0) {
//                    $uc_register = false;
//                }
//            }
//            if ($uc_register) {
//                $need_email_active = C("SP_MEMBER_EMAIL_ACTIVE");
//                $data = array(
//                    'user_login' => $username,
//                    'user_email' => $email,
//                    'user_nicename' => $username,
//                    'user_pass' => sp_password($password),
//                    'last_login_ip' => get_client_ip(0, true),
//                    'create_time' => date("Y-m-d H:i:s"),
//                    'last_login_time' => date("Y-m-d H:i:s"),
//                    'user_status' => $need_email_active ? 2 : 1,
//                    "user_type" => 2,//会员
//                );
//                $rst = $users_model->add($data);
//                if ($rst) {
//                    //登入成功页面跳转
//                    $data['id'] = $rst;
//                    $_SESSION['user'] = $data;
//
//                    //发送激活邮件
//                    if ($need_email_active) {
//                        $this->_send_to_active();
//                        unset($_SESSION['user']);
//                        $this->success("注册成功，激活后才能使用！", U("user/login/index"));
//                    } else {
//                        $this->success("注册成功！", __ROOT__ . "/");
//                    }
//
//                } else {
//                    $this->error("注册失败！", U("user/register/index"));
//                }
//
//            } else {
//                $this->error("注册失败！", U("user/register/index"));
//            }
//
//        }
//    }
//
//    function active()
//    {
//        $hash = I("get.hash", "");
//        if (empty($hash)) {
//            $this->error("激活码不存在");
//        }
//
//        $users_model = M("Users");
//        $find_user = $users_model->where(array("user_activation_key" => $hash))->find();
//
//        if ($find_user) {
//            $result = $users_model->where(array("user_activation_key" => $hash))->save(array("user_activation_key" => "", "user_status" => 1));
//
//            if ($result) {
//                $find_user['user_status'] = 1;
//                $_SESSION['user'] = $find_user;
//                $this->success("用户激活成功，正在登录中...", __ROOT__ . "/");
//            } else {
//                $this->error("用户激活失败!", U("user/login/index"));
//            }
//        } else {
//            $this->error("用户激活失败，激活码无效！", U("user/login/index"));
//        }
//
//
//    }
    //首次注册随机生成昵称
    public function createNicename() {
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = str_shuffle($str);
        return substr($str, 0, 5);
    }

}
