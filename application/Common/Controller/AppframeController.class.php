<?php

namespace Common\Controller;

use Think\Controller;

class AppframeController extends Controller
{

    protected $MerId = '808080301001449';
    protected $CuryId = '156';
    protected $transtype = '0001';
    protected $Version = '20141120';
            function _initialize()
    {
        $this->assign("waitSecond", 3);
        $time = time();
        $this->assign("js_debug", APP_DEBUG ? "?v=$time" : "");
        if (APP_DEBUG)
        {
            
        }
    }

    /**
     * Ajax方式返回数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param String $type AJAX返回数据格式
     * @return void
     */
    protected function ajaxReturn($data, $type = '', $json_option = 0)
    {

        $data['referer'] = $data['url'] ? $data['url'] : "";
        $data['state'] = $data['status'] ? "success" : "fail";

        if (empty($type))
            $type = C('DEFAULT_AJAX_RETURN');
        switch (strtoupper($type)) {
            case 'JSON' :
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data, $json_option));
            case 'XML' :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                exit(xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler = isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
                exit($handler . '(' . json_encode($data, $json_option) . ');');
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                exit($data);
            case 'AJAX_UPLOAD':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:text/html; charset=utf-8');
                exit(json_encode($data, $json_option));
            default :
                // 用于扩展其他返回格式数据
                Hook::listen('ajax_return', $data);
        }
    }

    //分页
    protected function page($Total_Size = 1, $Page_Size = 0, $Current_Page = 1, $listRows = 6, $PageParam = '', $PageLink = '', $Static = FALSE)
    {
        import('Page');
        if ($Page_Size == 0)
        {
            $Page_Size = C("PAGE_LISTROWS");
        }
        if (empty($PageParam))
        {
            $PageParam = C("VAR_PAGE");
        }
        $Page = new \Page($Total_Size, $Page_Size, $Current_Page, $listRows, $PageParam, $PageLink, $Static);
        $Page->SetPager('default', '{first}{prev}{liststart}{list}{listend}{next}{last}', array("listlong" => "9", "first" => "首页", "last" => "尾页", "prev" => "上一页", "next" => "下一页", "list" => "*", "disabledclass" => ""));
        return $Page;
    }

    //空操作
    public function _empty()
    {
        $this->error('该页面不存在！');
    }

    /**
     * 检查操作频率
     * @param int $duration 距离最后一次操作的时长
     */
    protected function check_last_action($duration)
    {

        $action = MODULE_NAME . "-" . CONTROLLER_NAME . "-" . ACTION_NAME;
        $time = time();

        if (!empty($_SESSION['last_action']['action']) && $action == $_SESSION['last_action']['action'])
        {
            $mduration = $time - $_SESSION['last_action']['time'];
            if ($duration > $mduration)
            {
                $this->error("您的操作太过频繁，请稍后再试~~~");
            } else
            {
                $_SESSION['last_action']['time'] = $time;
            }
        } else
        {
            $_SESSION['last_action']['action'] = $action;
            $_SESSION['last_action']['time'] = $time;
        }
    }

    /*
     * 到期还本付息
     * borrow_days 借款时间
     * rate 借款年利率
     * money 投资金额
     * return array
     */

    public function getInterestByTerm($borrow_days, $rate, $money)
    {
        $return = [];
        if ($borrow_days && $money && $rate)
        {
            //获取还款时间
            $repay_time = time() + $borrow_days * 24 * 3600 + 24 * 3600; //隔日计息
            $repay_time = date('Y-m-d', $repay_time) . ' 23:59:59';
            //获取利息
            $repay_interest = $money * $rate / 100 / 365 * $borrow_days;
            $return[] = array(
                'repay_time' => $repay_time,
                'money_type' => '利息',
                'repay_money' => round($repay_interest, 2),
                'is_last' => '是',
                'periods' => '1'
            );
            $return [] = array(
                'repay_type' => repay_time,
                'money_type' => '本金',
                'repay_money' => $money,
                'is_last' => '是',
                'periods' => '1'
            );
        }
        return $return;
    }

    /*
     * 按月付息到期还款
     * borrow_days 借款时间
     * rate 借款年利率
     * money 投资金额
     * 每个月按照30天计算
     * return array
     */

    public function getInterestByInstallment($borrow_days, $rate, $money)
    {
        $return = [];
        if ($borrow_days && $money && $rate)
        {
            //获取总还款利息
            $repay_interest_all = $money * $rate / 100 / 365 * $borrow_days;
            //获取还款期数
            $periods = ceil($borrow_days / 30);
            if ($periods >= 1)
            {
                for ($i = 1; $i <= $periods; $i++)
                {
                    $month = 30;
                    $is_last = '否';
                    $repay_interest = $money * $rate / 100 / 365 * $month;
                    if ($i == $periods)
                    {
                        $is_last = '是';
                        $month = $borrow_days % 30;
                        $repay_interest = $repay_interest_all - $other_interest;
                        $return[$i + 1] = array(
                            'repay_type' => repay_time,
                            'money_type' => '本金',
                            'repay_money' => $money,
                            'is_last' => $is_last,
                            'periods' => $i
                        );
                    }
                    $repay_time = time() + $month * 24 * 3600 * $i + 24 * 3600; //隔日计息
                    $repay_time = date('Y-m-d', $repay_time) . ' 23:59:59';
                    $return[$i] = array(
                        'repay_time' => $repay_time,
                        'money_type' => '利息',
                        'repay_money' => round($repay_interest, 2),
                        'is_last' => $is_last,
                        'periods' => $i
                    );
                    $other_interest += $repay_interest;
                }
            }
        }
        return $return;
    }

    //发送短信
    public function sendSms($phone, $content)
    {
        $url = 'http://cloud.hikehu.com/API/index_utf8.asp?LoginName=guxin&passwd=D094412911C55DE6A32105C2F2E61265';
        $phone = $phone ? $phone : 0;
        $content = $content ? $content : 0;
        if (!$phone || !$content)
            return false;
        $url .= '&PhoneNumber=' . $phone;
        $url .= '&SmsContent=' . $content;
        $result = file_get_contents($url);
        return $result;
    }

    //页面跳转模式                                                                                                                                                                                                 
    protected function autoRedirect1($reqData = array(), $url = '', $target = '')
    {
        if ($target)
            $target = '_blank';
        header('Content-type: text/html; charset=gbk');
        $str = '<h1>支付交易</h1>
                <h3>支付测试方法</h3>
                <h4>点击“支付”按钮，跳转到农商行网关支付页面后，输入卡密和验证码即可完成支付，输入密码时请选择“键盘”</h4>
                <h5>卡号：[1234567890000000000]</h5>
                <h5>密码：[000000]</h5>
                <h5><a href="javascript:window.location.reload()">刷新本页以改变订单号</a></h5>
                <form action="'.$url.'" method="post" target="_blank">';
        foreach ($reqData as $key => $value)
        {
            $html .= '<input type="hidden" value=\'' . $value . '\' name="' . $key . '" />';
        }
        $html .= "</form>";
        return $html;
    }
    
        //页面跳转模式
    protected function autoRedirect($reqData = array(), $url = '', $target = '')
    {
        if ($target)
            $target = '_blank';
        $html = <<<HTML
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK"/>
<head><body onload="document.getElementById('autoRedirectForm').submit();">
<div class="margin:10px;font-size:14px;">......</div>
<form id="autoRedirectForm" method="POST" action="$url" target="$target">
HTML;
        foreach ($reqData as $key => $value)
        {
            $html .= '<input type="hidden" value=\'' . $value . '\' name="' . $key . '" />';
        }
        
        $html .= "</form>";
        $html .= "</body></html>";
        return $html;
    }

}
