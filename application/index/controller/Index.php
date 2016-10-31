<?php
namespace app\index\controller;

use app\tsecurity\controller\SecurityController;

class Index extends SecurityController
{
    public function index()
    {
        return view();
    }
}
