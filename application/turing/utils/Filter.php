<?php
/**
 * Created by PhpStorm.
 * User: 60501
 * Date: 2016/11/4
 * Time: 18:52
 */

namespace app\turing\utils;


/**
 * 解释器过滤器接口，用来拦截问题自己返回答案
 * Interface Filter
 * @package app\turing\utils
 */
interface Filter
{
    public function doFilter($qiestion);
}