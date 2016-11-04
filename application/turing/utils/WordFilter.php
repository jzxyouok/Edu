<?php
/**
 * Created by PhpStorm.
 * User: 60501
 * Date: 2016/11/4
 * Time: 18:56
 */

namespace app\turing\utils;


abstract class WordFilter implements Filter
{
    protected $keyword = "";

    public function doFilter($question)
    {
        // TODO: Implement doFilter() method.
        if(startWith($question, $this->keyword)){
        }
    }

    public abstract function innerFilter($question);
}