<?php
/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/10/30
 * Time: 20:15
 */

namespace app\tsecurity\bean;


use think\Model;

/**
 * Class Role 默认角色类
 * @package app\tsecurity\model
 */
class InnerRole extends Model
{

    /**
     * @param $perms
     * @return mixed
     */
    public function getPermsAttr($perms)
    {
        return json_decode($perms);
    }

    /**
     * @param $perms
     * @return string
     */
    public function setPermsAttr($perms)
    {
        return json_encode($perms);
    }

}