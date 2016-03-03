<?php
namespace Common\Controller;
use Common\Controller\HomebaseController;
class MemberbaseController extends HomebaseController{
	
	function _initialize() {
		parent::_initialize();
		$this->check_login();
		$this->check_user();
        $site_options=get_site_options();
        $this->assign($site_options);
        $ucenter_syn=C("UCENTER_ENABLED");
        if($ucenter_syn){
            if(!isset($_SESSION["user"])){
                if(!empty($_COOKIE['thinkcmf_auth'])  && $_COOKIE['thinkcmf_auth']!="logout"){
                    $thinkcmf_auth=sp_authcode($_COOKIE['thinkcmf_auth'],"DECODE");
                    $thinkcmf_auth=explode("\t", $thinkcmf_auth);
                    $auth_username=$thinkcmf_auth[1];
                    $users_model=M('Users');
                    $where['user_login']=$auth_username;
                    $user=$users_model->where($where)->find();
                    if(!empty($user)){
                        $is_login=true;
                        $_SESSION["user"]=$user;
                    }
                }
            }else{
            }
        }

        if(sp_is_user_login()){
            $this->assign("user",sp_get_current_user());
        }
	}
	
}