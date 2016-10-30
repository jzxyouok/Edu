<?php

/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/10/30
 * Time: 17:38
 */

namespace app\security\controller;


use think\Controller;
use think\Request;
use think\Url;

require_once(APP_PATH."/security/common.php");

define("LOGIN_SESSION_KEY", "security_login_session_key");


class SecurityController extends Controller
{


    // 初始化
    protected function _initialize()
    {
        $config = config("security");

        //获取pathinfo
        $request = Request::instance();
        $pathinfo = "/" . $request->pathinfo();


        $filter_chain = require(APP_PATH."/security/security_config.php");
        $goon = 1;

        if(!$filter_chain){
            return;
        }

        foreach ($filter_chain as $key => $value) {
            if(startWith($key, "~")){
                $key = substr($key, 1);
                if(preg_match($pathinfo, $key)){
                    $goon = checkPerms($value);
                }
            }elseif (startWith($key, "=")){
                $key = substr($key, 1);
                if($key ==  $pathinfo){
                    $goon = checkPerms($value);
                }
            }else{
                if(startWith($pathinfo, $key)){
                    $goon = checkPerms($value);
                }

            }
        }

        switch ($goon){
            case 0:
                $this->error($config["login_fail"], Url::build("/security/login/index"));
                break;
            case -1:
                $this->error($config["not_permed"]);
                break;
        }

    }


}