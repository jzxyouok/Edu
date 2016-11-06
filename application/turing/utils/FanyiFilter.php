<?php
/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/11/6
 * Time: 21:06
 */

namespace app\turing\utils;

require_once(APP_PATH."/baidu_transapi.php");


class FanyiFilter extends WordFilter
{
    protected $keyword = "翻译";

    public function innerFilter($question)
    {
        // TODO: Implement innerFilter() method.
        if(preg_match('/[a-zA-Z,\.\-\'"?]/', $question)){
            $result = translate($question, "auto", "zh");
            return ["code"=>200, "content"=>$result["trans_result"][0]["dst"]];
        }
    }
}