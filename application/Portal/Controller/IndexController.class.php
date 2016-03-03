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

/**
 * 首页
 */
class IndexController extends HomebaseController
{

    protected $borrow_model;
    protected $borrow_type_model;
    protected $tender_model;
    protected $user_model;
    protected $terms_model;
    protected $term_relationships_model;
    protected $posts_model;

    function _initialize()
    {
        parent::_initialize();
        $this->borrow_model = M("borrow");
        $this->borrow_type_model = M("borrow_type");
        $this->tender_model = M('tender');
        $this->user_model = M('users');
        $this->terms_model = M('terms');
        $this->term_relationships_model = M('term_relationships');
        $this->posts_model = M('posts');
    }

    //首页
    public function index()
    {
        //获取单条最新新手标
        $new_borrow_info = $this->borrow_model->where(['status' => ['not in', "'流标','带审核'，'初审通过'"], 'is_new' => '是'])->order('id desc')->find();
        //获取借款列表
        $borrow_list = $this->borrow_model->where(['status' => ['not in', "'流标','初审通过','待审核'"]])->order('id DESC')->select();
        //获取投资列表
        $tender_list = $this->tender_model->order('id desc')->limit('0,20')->select();
        if ($tender_list) {
            foreach ($tender_list as $key => $value) {
                $user = $this->user_model->where(['id' => $value['tender_user_id']])->find();
                $tender_list[$key]['user_name'] = substr($user['user_login'], 0, 3) . '******';
            }
        }
        $this->assign('tender_list', $tender_list);
        //获取公告
        $term_info = $this->terms_model->where(['name' => '公告'])->find();
        $relations_list = $this->term_relationships_model->where(['term_id' => $term_info['term_id'], 'status' => 1])->order('tid desc')->select();
        $ids = [];
        if ($relations_list) {
            foreach ($relations_list as $k => $v) {
                $ids[] = $v['object_id'];
            }
        }
        $posts_list = $this->posts_model->where(['id' => ['in', implode(',', $ids)]])->limit('0,20')->order('id desc')->select();
        $this->assign('posts_list', $posts_list);
        //获取用户信息
        $user_info = $_SESSION['user'] ? $_SESSION['user'] : [];
        $id = $_SESSION['user']['id'];
        $use_coininfo = M('user_coin')->where(['user_id' => $id])->find();
        $use_account = $use_coininfo['use_account'];
        $this->assign('user_info', $user_info);
        $this->assign('use_account', $use_account);
        $this->assign('new_borrow_info', $new_borrow_info);
        $this->assign('borrow_info', $borrow_list);
        $this->display(":index");
    }

    //投资列表页
    public function investlist()
    {
        $borrow_list = $this->borrow_model->where(['status' => ['not in', "'流标','初审通过','待审核'"]])->order('id DESC')->select();
        $result = $this->search(['status' => ['not in', "'流标','初审通过','待审核'"]]);
        $this->assign("borrow_info", $borrow_list);
        $this->assign("page", $result['page']->show('Admin'));
        $this->assign('list', $result['list']);
        $this->display(":investlist");
    }

    // 关于我们
    public function about()
    {
        //获取公告
        $term_info = $this->terms_model->where(['name' => '公告'])->find();
        $relations_list = $this->term_relationships_model->where(['term_id' => $term_info['term_id'], 'status' => 1])->order('tid desc')->select();
        $ids = [];
        if ($relations_list) {
            foreach ($relations_list as $k => $v) {
                $ids[] = $v['object_id'];
            }
        }
        $posts_list = $this->posts_model->where(['id' => ['in', implode(',', $ids)]])->limit('0,20')->order('id desc')->select();
        $menuinfo = $this->selectMenu(7);
        $menuid = I('get.id');
        $thismenu = M("nav")->where(['id' => $menuid])->find();
        $href = $thismenu['href'];
        $this->assign('posts_list', $posts_list);
        $this->assign('menuid', $menuid);
        $this->assign('href', $href);
        $this->assign('menu', $menuinfo);
        switch ($menuid) {
            case 17:
                $this->display(':molifang');
                break;
            case 18:
                $this->display(':partners');
                break;
            case 19:
                $this->display(':gonggao');
                break;
            case 20:
                $this->display(':contact');
                break;
            case 21:
                $this->display(':problems');
                break;
            case 22:
                $this->display(':joinus');
                break;
                dafault:
                $this->display(':molifang');
        }
    }

    // 查询二级菜单
    public function selectMenu($parentid)
    {
        $menuArr = M("nav")->where(['parentid' => $parentid])->order("id asc")->select();
        return $menuArr;
    }

    //分页查询条件
    public function search($where = [])
    {
        $count = $this->borrow_model->count();
        $page = $this->page($count, 5);
        $list = $this->borrow_model->order("id DESC")->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();
        return array(
            'page' => $page,
            'list' => $list,
        );
    }

    //注册协议
    public function agreement()
    {
        $this->display(':agreement');
    }

    //注册协议
    public function privacy()
    {
        $this->display(':privacy');
    }

    //公告详情
    public function gonggaodetail()
    {
        $id = I('get.id');
        $listinfo = $this->posts_model->where(['id' => $id])->find();
        $menuinfo = $this->selectMenu(7);
        $this->assign('list', $listinfo);
        $this->assign('menu', $menuinfo);
        $this->display(':ggdetail');
    }


}


