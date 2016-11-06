<?php
namespace app\turing\utils;

/**
 * Created by PhpStorm.
 * User: 60501
 * Date: 2016/11/4
 * Time: 18:49
 */
class Interceptor
{
    protected $filters = ['\app\turing\utils\PoemFilter', '\app\turing\utils\DicFilter', '\app\turing\utils\FanyiFilter'];

    public function filter($question){
        foreach($this->filters as $filter){
            $f = new $filter();
            $response = $f->doFilter($question);
            if($response){
                return $response;
            }
        }
    }

}