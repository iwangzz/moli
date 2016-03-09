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
class NewerController extends HomebaseController
{

    function _initialize()
    {
        parent::_initialize();

    }

    public function newerguide()
    {
        $this->display(':newerguide');
    }

    //摩利动态页面
    public function companytrends()
    {
        $termid = array(
            '0' => 4,
            '1' => 5,
            '2' => 6,
        );
        $termlist = M('terms')->where(['parent' => '3'])->select();
        $relationships = M('term_relationships')->where(['term_id' => ['in', join(',', $termid)],'status' => '1'])->select();
        $ids = [];
        foreach ($relationships as $k => $v) {
            $ids[] = $v['object_id'];
        }
        //分页
        $count = M('posts')->where(['id' => ['in', join(',', $ids)]])->count();
        $page = $this->page($count, 5);
        $list= M('posts')->where(['id' => ['in', join(',', $ids)]])->limit($page->firstRow . ',' . $page->listRows)->select();
        if (is_array($list) && count($list)) {
            $a = array();
            foreach ($list as $k => $v) {
                $urlobj = json_decode($v['smeta']);
                $a[] = array(
                    'post_excerpt' =>$v['post_excerpt'],
                    'post_title' => $v['post_title'],
                    'id' => $v['id'],
                    'img' => $urlobj->thumb
                );
            }
        }
//        echo '<pre>';
//        print_r($a);
//        echo '</pre>';
//        exit;
        $this->assign("page", $page->show());
        $this->assign('list', $list);
        $this->assign("termlist", $termlist);
        $this->assign("listinfo", $a);
        $this->display(":trendslist");
    }

    //公司动态列表页
    public function trendslist()
    {
        $termid = I('get.id');
        $termlist = M('terms')->where(['parent' => '3'])->select();
        $relationships = M('term_relationships')->where(['term_id' => $termid,'status' => '1'])->select();
        $ids = [];
        foreach ($relationships as $k => $v) {
            $ids[] = $v['object_id'];
        }
        //分页
        $count = M('posts')->where(['id' => ['in', join(',', $ids)]])->count();
        $page = $this->page($count, 5);
        $list= M('posts')->where(['id' => ['in', join(',', $ids)]])->limit($page->firstRow . ',' . $page->listRows)->select();
        if (is_array($list) && count($list)) {
            $a = array();
            foreach ($list as $k => $v) {
                $urlobj = json_decode($v['smeta']);
                $a[] = array(
                    'post_excerpt' =>$v['post_excerpt'],
                    'post_title' => $v['post_title'],
                    'id' => $v['id'],
                    'img' => $urlobj->thumb
                );
            }
        }
        $this->assign("page", $page->show());
        $this->assign('list', $list);
        $this->assign("termid", $termid);
        $this->assign("termlist", $termlist);
        $this->assign("listinfo", $a);
        $this->display(":trendslist");
    }

    //文章详情
    public function article()
    {
        $id = I('get.id');
        $termlist = M('terms')->where(['parent' => '3'])->select();
        $articleinfo = M('posts')->where(['id' => $id])->find();
        $this->assign("termlist", $termlist);
        $this->assign('article', $articleinfo);
        $this->display(":article");
    }

}


