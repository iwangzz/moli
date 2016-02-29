<?php

namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class BorrowTypeController extends AdminbaseController
{

    protected $borrow_type_model;

    function _initialize()
    {
        parent::_initialize();
        $this->borrow_type_model = M("borrow_type");
    }

    public function index()
    {
        $list = $this->borrow_type_model->select();
        $this->assign('list', $list);
        $this->display();
    }

    public function add()
    {
        $this->display();
    }

    public function add_post()
    {
        if (IS_POST)
        {
            if ($this->borrow_type_model->create())
            {
                $this->borrow_type_model->create_time = date('Y-m-d H:i:s', time());
                if ($this->borrow_type_model->add() !== false)
                {
                    $this->success("添加成功！", U("borrowtype/index"));
                } else
                {
                    $this->error("添加失败！");
                }
            } else
            {
                $this->error($this->borrow_type_model->getError());
            }
        }
    }

    public function edit()
    {
        $id = I("get.id");
        $info = $this->borrow_type_model->where("id=$id")->find();
        $this->assign('info', $info);
        $this->display();
    }

    public function edit_post()
    {
        if (IS_POST)
        {
            if ($this->borrow_type_model->create())
            {
                if ($this->borrow_type_model->save() !== false)
                {
                    $this->success("保存成功！", U("borrowtype/index"));
                } else
                {
                    $this->error("保存失败！");
                }
            } else
            {
                $this->error($this->borrow_type_model->getError());
            }
        }
    }

    public function change_status()
    {
        $id = I("get.id");
        $status = I("get.status");
        $result = $this->borrow_type_model->where(['id' => $id])->save(['status' => $status]);
        if ($result !== false)
            $this->success("保存成功！", U("borrowtype/index"));
        else
            $this->error("保存失败！");
    }

}

?>
