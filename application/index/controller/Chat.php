<?php
/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/11/3
 * Time: 21:56
 */

namespace app\index\controller;


use app\tsecurity\controller\SecurityController;

class Chat extends SecurityController
{
    public function index(){
        $loginUser = $this->getLoginUser();
        $this->assign("user", $loginUser);
        return view();
    }

}