<?php

/**
 *
 */

namespace User\Controller;

use Common\Controller\HomebaseController;

class PublicController extends HomebaseController {

    function avatar() {

        $users_model = M("Users");
        $id = I("get.id", 0, "intval");

        $find_user = $users_model->field('avatar')->where(array("id" => $id))->find();

        $avatar = $find_user['avatar'];
        $should_show_default = false;

        if (empty($avatar)) {
            $should_show_default = true;
        } else {
            if (strpos($avatar, "http") === 0) {
                header("Location: $avatar");
                exit();
            } else {
                $avatar_dir = C("UPLOADPATH") . "avatar/";
                $avatar = $avatar_dir . $avatar;
                if (file_exists($avatar)) {
                    $imageInfo = getimagesize($avatar);
                    if ($imageInfo !== false) {
                        $mime = $imageInfo['mime'];
                        header("Content-type: $mime");
                        echo file_get_contents($avatar);
                    } else {
                        $should_show_default = true;
                    }
                } else {
                    $should_show_default = true;
                }
            }
        }

        if ($should_show_default) {
            $imageInfo = getimagesize("public/images/headicon.png");
            if ($imageInfo !== false) {
                $mime = $imageInfo['mime'];
                header("Content-type: $mime");
                echo file_get_contents("public/images/headicon.png");
            }
        }
        exit();
    }

    //找回密码用户身份验证
    public function findtest() {
        $this->display(':findtest');
    }

    //找回密码--验证码发送
    public function sendpwdCode() {
        if (IS_POST) {
            $phone = $_POST['phone'];
            $where['user_login'] = $phone;
            $users_model = M("Users");
            $result = $users_model->where($where)->count();
            if ($phone == '')
                $this->ajaxReturn(['status' => 0, 'msg' => '请输入手机号！']);
            if (!$result)
                $this->ajaxReturn(['status' => 0, 'msg' => '该手机号尚未注册']);
            if (isset($_SESSION['setpwd_time']) && time() - $_SESSION['setpwd_time'] < 90) {
                $this->ajaxReturn(['status' => 0, 'msg' => '短信发送过于频繁']);
            }
            $_SESSION['setpwd_time'] = time();
            $_SESSION['setpwd_code'] = rand(100000, 999999);
            $_SESSION['setpwd_phone'] = $phone;
            $content = '您的短信验证码为' . $_SESSION['setpwd_code'];
            $res = $this->sendSms($phone, $content);
            if ($res) {
                $sms_log_data = array(
                    'phone' => $phone,
                    'content' => $content,
                    'type' => '修改手机号',
                    'user_ip' => get_client_ip(),
                    'add_time' => date('Y-m-d H:m:i', time())
                );
                $smsinfo = M("sms_log")->data($sms_log_data)->add();
                if ($smsinfo)
                    $this->ajaxReturn(['status' => 1, 'msg' => '发送成功']);
                else
                    $this->ajaxReturn(['status' => 0, 'msg' => '验证码无效，请重新获取']);
            }
        }
    }

    //校验找回密码--验证码
    public function checkpwdCode() {
        if (IS_POST) {
            $phone = $_POST['phone'];
            if (!isset($_SESSION['setpwd_code'])) {
                $this->ajaxReturn(['status' => 0, 'msg' => '请点击发送验证码']);
            } elseif ($_SESSION['setpwd_phone'] != $phone) {
                $this->ajaxReturn(['status' => 0, 'msg' => '手机号与待验证手机不一致，请90秒后重新获取']);
            } elseif (isset($_SESSION['setpwd_time']) && time() - $_SESSION['setpwd_time'] > 90) {
                $this->ajaxReturn(['status' => 0, 'msg' => '验证码已过期，请重新发送']);
            } elseif (isset($_SESSION['setpwd_time']) && time() - $_SESSION['setpwd_time'] < 90) {
                $idinputcode = $_POST['code'];
                $session_code = $_SESSION['setpwd_code'];
                if ($idinputcode != $session_code) {
                    $this->ajaxReturn(['status' => 0, 'msg' => '验证码输入有误']);
                } elseif ($idinputcode == $session_code) {
                    $this->ajaxReturn(['status' => 1, 'flag' => 'open', 'msg' => '验证成功！', 'phone' => $phone]);
                }
            }
        }
    }

    //设置新密码页面展示
    public function setnewpassDisplay() {
        $mobile = I('get.mobile');
        $flag = I('get.flag');
        if ($flag == 'open') {
            $this->assign('mobile', $mobile);
            $this->display(':setnewpwd');
        }
    }

    //设置新密码
    public function setnewPass() {
        if (IS_POST) {
            $phone = $_POST['mobile'];
            $user_pwd = $_POST['user_pass'];
            $newpwd = array(
                'user_pass' => sp_password($user_pwd)
            );
            $info = M("users")->where(['user_login' => $phone])->data($newpwd)->save();
            if ($info)
                $this->ajaxReturn(['status' => 1, 'flag' => 'open', 'msg' => '修改成功！']);
            else
                $this->ajaxReturn(['status' => 0, 'msg' => '修改失败！']);
        }
    }

    // 设置新密码成功
    public function setpwdSuccess() {
        $flag = I('get.flag');
        if ($flag == 'open') {
            $this->display(':setpwdsuccess');
        }
    }

}
