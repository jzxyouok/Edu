<?php
use app\tsecurity\exception\PermsError;

/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/10/30
 * Time: 18:37
 */

function startWith($str, $needle) {

    return strpos($str, $needle) === 0;

}

/**
 *检查权限是否符合
 * @param $filter
 * @return int  0=未登录，1=成功，-1=无权限
 * @throws PermsError
 */
function checkPerms($filter){
    $principle = getLoginPrinciple();

    if(is_array($filter)){
        if(!$principle || !$principle->perms){
            return 0;
        }
        foreach($principle->perms as $perm){
            foreach ($filter as $afilter){
                if($afilter == $perm){
                    return 1;
                }
            }
        }
    }elseif(is_string($filter)){
        if($filter == "auth"){
            if($principle == null){
                return 0;
            }
        }elseif($filter == "authn"){
            return true;
        }

    }else{
        throw new PermsError("filterchain 权限格式有误");
    }
    return -1;
}
/**
 * 获取安全配置
 * @return array
 */
function getConfig(){
    \think\Config::parse(APP_PATH."/tsecurity/security_config.php");
    return config("security");
}

/**
 * 获取登录信息
 */
function getLoginPrinciple(){
    $security_config = getConfig();
    echo session($security_config["login_session_key"]);
    dump($security_config);
    return session($security_config["login_session_key"]);
}