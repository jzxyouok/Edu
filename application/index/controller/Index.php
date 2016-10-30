<?php
namespace app\index\controller;

use app\security\controller\SecurityController;

class Index extends SecurityController
{
    public function index()
    {
        return view();
    }
}
