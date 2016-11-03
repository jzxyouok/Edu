<?php
namespace app\index\controller;

use app\tsecurity\controller\SecurityController;

class Index extends SecurityController
{
    public function index()
    {
        $user = $this->getLoginUser();
        $this->assign("user",$user);
        return view();
    }
}
