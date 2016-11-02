<?php
/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/10/30
 * Time: 20:16
 */

namespace app\tsecurity\controller;


use app\tsecurity\bean\Principle;
use think\Controller;
use think\Url;

require_once(APP_PATH."tsecurity/common.php");
/**
 * 安全框架登陆控制器
 * Class Login
 * @package app\tsecurity\controller
 */
class Login extends Controller
{
    /**
     * 登陆方法
     * @param $username
     * @param $password
     */
    public function to_login($username, $password){
        $config = getConfig();
        $user_table = $config["user_table"];
        $user = new $user_table["name"]();
        $find_user = $user->where($user_table["username"], "eq", $username)->find();
        if ($find_user == null || md5($password) != $find_user["password"]){
            $this->error("用户名或密码错误");
            return;
        }
        $principle = new Principle();
        $principle->username = $find_user["username"];
        foreach ($find_user->role()->select() as $role){
            array_merge_recursive($principle->perms, $role->perms);
        }
        session($config["login_session_key"], $principle);
        $this->success("登录成功!",Url::build( $config["login_success"]));
    }

}