<?php
/**
 * Created by PhpStorm.
 * User: 60501
 * Date: 2016/10/31
 * Time: 19:40
 */

namespace app\turing\controller;
require_once(APP_PATH."/turing/common.php");

class Turing
{
    public function talk($message){
        json_encode(turingGet($message, null));
        return "<br/>end;";
    }
}