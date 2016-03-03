<?php

/**
 * 会员注册
 */

namespace User\Controller;

use Common\Controller\MemberbaseController;

include APP_PATH . 'Common/Controller/netpayclient.php';

class RechargeController extends MemberbaseController {

  protected $user_model;
  protected $user_coin;
  protected $user_bank;
  protected $user_recharge_model;

  function _initialize() {
    parent::_initialize();
    $this->user_model = M("users");
    $this->user_coin_model = M("user_coin");
    $this->user_bank_model = M("user_bank");
    $this->user_recharge_model = M('user_recharge');
  }

  /*
   * 用户充值页面展示
   * 验证实名认证－>绑定银行卡－>展示充值页面
   */

  public function index() {
    $id = $_SESSION['user']['id'];
    $user_info = $this->user_model->where(['id' => $id])->find();
    $bank_info = $this->user_bank_model->where(['user_id' => $id])->find();
    $user_coin = $this->user_coin_model->where(['user_id' => $id])->find();
    $real_name = $user_info['real_name'];
    $id_number = $user_info['id_number'];
    //        $user_trade_pass = $user_info['user_trade_pass'];
    $use_account = $user_coin['use_account'];
    if (!$real_name || !$id_number)
      $this->error('您还没有实名认证，请先实名认证', '/index.php/user/index/realname');
    //        if (!$bank_info)
    //            $this->error('您还没有绑定银行卡，请先绑定银行卡才能充值', '/index.php/user/index/bankcard');
    //        if (!$user_trade_pass)
    //            $this->redirect('/user/index/setTradepwd', '', '您还没有设置交易密码，设置交易密码才能执行充值操作', 2);
    $this->assign('use_account', $use_account);
    $this->display(':recharge');
  }

  //用户充值待审核信息创建 recharge
  public function recharge() {
    $id = $_SESSION['user'] ? $_SESSION['user']['id'] : [];
    if (!$id)
      $this->error("您尚未登录，请登录", U('user/login/index'));
    if (IS_POST) {
      $user_login = $_SESSION['user']['user_login'];
      $money = $_POST['rechargemoney'];
      if ($money < 0)
        $this->error('请输入正确的金额', '/index.php/user/recharge/index');
      $order_number = $this->order_number();
      $rechargedata = array(
        'order_number' => $order_number,
        'user_id' => $id,
        'user_name' => $user_login,
        'recharge_money' => $money,
        'recharge_status' => '待审核',
        'create_time' => date('Y-m-d H:i:s', time())
      );
      $rechargeinfo = $this->user_recharge_model->data($rechargedata)->add();
      if ($rechargeinfo) {
        $url = "https://payment.ChinaPay.com/pay/TransGet";
        $merid = buildKey(PRI_KEY);
        if (!$merid) {
          echo "导入私钥文件失败！";
          exit;
        }
        $transdate = date('Ymd', time());
        $back_url = $_SERVER['SERVER_NAME'] . '/index.php/portal/api/rechargeBack';
        $page_url = $_SERVER['SERVER_NAME'] . '/index.php/user/recharge/rechargePage';
        $Priv1 = $_SESSION['user']['id'];
        $GateId = '';
        $money = $money * 100;
        $len_money = strlen($money);
        if ($len_money <= 12) {
          $len_mon = 12 - $len_money;
          for ($i = 1; $i <= $len_mon; $i++) {
            $money = '0' . $money;
          }
        }
        $reqData = array(
          'MerId' => $merid,
          'OrdId' => $order_number,
          'TransAmt' => $money, //交易金额
          'CuryId' => $this->CuryId, //交易币种
          'TransDate' => $transdate, //交易日期
          'TransType' => $this->transtype, //交易类型
          'Version' => $this->Version, //接入版本号
          'BgRetUrl' => $back_url,
          'PageRetUrl' => $page_url,
          'Priv1' => $Priv1,
          'GateId' => $GateId,
        );
        $plain = $merid . $order_number . $money . $this->CuryId . $transdate . $this->transtype . $this->Version . $back_url . $page_url . $GateId . $Priv1;
        $key_sign = sign($plain);
        $reqData['ChkValue'] = $key_sign;
        if (!$key_sign) {
          $this->error('充值失败');
        } else {
          echo $this->autoRedirect($reqData, $url);
        }
      } else {
        $this->ajaxReturn(['status' => 0, 'msg' => '充值失败']);
      }
    }
  }

  public function rechargePage() {

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
      $this->error("充值失败！", '/index.php/user/recharge');
    }
    //交易状态为1001表示交易成功，其他为各类错误，如卡内余额不足等
    if ($status == '1001') {
      $this->success('充值成功', '/index.php/user');
    }else {
      $this->error("充值失败！", '/index.php/user/recharge');
    }
  }

  //用户充值返回信息创建    rechargestatus
  public function rechargestatus() {
    //获取银联返回状态 更新rechare_status 状态
  }

  //生成订单号
  public function order_number() {
    return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
  }

}
