<?php
/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/10/30
 * Time: 20:15
 */

namespace app\security\model;


use think\Model;

/**
 * Class Role 默认角色类
 * @package app\security\model
 */
class Inner_Role extends Model
{

    private $perms;

    /**
     * @return array
     */
    public function getPerms()
    {
        return json_decode($this->perms);
    }

    /**
     * @param array $perms
     */
    public function setPerms($perms)
    {
        $this->perms = json_encode($perms);
    }

}