<?php
use app\security\exception\PermsError;

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
    $principle = session(LOGIN_SESSION_KEY);

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