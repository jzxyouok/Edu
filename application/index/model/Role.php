<?php

/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/10/30
 * Time: 16:41
 */

namespace app\index\model;

use app\tsecurity\bean\InnerRole;

class Role extends InnerRole
{

    public function user(){
        return $this->hasMany("User");
    }

}