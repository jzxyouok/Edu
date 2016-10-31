<?php

/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/10/30
 * Time: 16:41
 */

namespace app\index\model;

use app\tsecurity\bean\InnerUser;

class User extends InnerUser
{

    public function role(){
        return $this->belongsTo("Role");
    }

}