<?php
// +----------------------------------------------------------------------
// | 摩立方 [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2014 http://www.摩立方.com All rights reserved.
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

}


