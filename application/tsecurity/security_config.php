<?php
return [

    //安全设置
    "security"                  =>[
        //登录页面地址
        'login_url'     => 'index/login/index',
        //登录成功的跳转地址 只需要pathinfo
        'login_success'     => 'index/index/index',
        //登录失败的提示信息
        'login_fail'     => '您尚未登录，请先登录',
        //无权限的提示
        'not_permed' => '您没有权限查看本页面',
        //用户表
        'user_table' => [
            //Model完全限定名
            'name' => '\app\index\model\User',
            //用户名字段
            'username' => 'username',
            //密码字段
            'password' => 'password',
            //关联角色字段
            'roles' => 'roles'

        ],
        //角色表的表名(无前缀)
        'role_table' =>[
            //Model完全限定名
            'name' => '\app\index\model\Role',
            //权限字段
            'perms' => 'perms'

        ],
        /**
         * 过滤链
         * 格式：url=>过滤器
         * url：前缀：=必须全等，~正则匹配 无前缀为以url开头
         * 过滤器：'auth'必须登录， 'authn'无需登录， ['perms'] 所需要的权限
         */
        'filter_chain'      =>[
            "=/" => "authn",

        ],
        "login_session_key" => 'security_login_session_key',
    ],

];