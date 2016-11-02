<?php

/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/10/30
 * Time: 17:38
 */

namespace app\tsecurity\controller;


use think\Controller;
use think\Request;
use think\Url;

require_once(APP_PATH."/tsecurity/common.php");


class SecurityController extends Controller
{

    // 初始化
    protected function _initialize()
    {
        $config = getConfig();
        //获取pathinfo
        $request = Request::instance();
        $pathinfo = $request->pathinfo();


        $filter_chain = $config["filter_chain"];
        $goon = 2;

        if(!$filter_chain){
            return;
        }

        foreach ($filter_chain as $key => $value) {
            if(startWith($key, "~")){
                $key = substr($key, 1);
                if(preg_match($pathinfo, $key)){
                    $isPermed = checkPerms($value);
                    if($goon == 2){
                        $goon = $isPermed;
                    }elseif($goon != 1){
                        $goon = $isPermed;
                    }
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
                $this->error($config["login_fail"], Url::build($config["login_url"]));
                break;
            case -1:
                $this->error($config["not_permed"]);
                break;
        }

    }

    /**
     * 获取当前登录用户
     */
    protected function getLoginUser(){
        $config = getConfig();
        $principle = getLoginPrinciple();
        if($principle){
            $user = new $config["user_table"]["name"];
            return $user->where("username", $principle->username)->find();
        }
    }


}