<?php
/**
 * Created by PhpStorm.
 * User: 60501
 * Date: 2016/10/31
 * Time: 19:40
 */

namespace app\turing\controller;

use think\Controller;

require_once(APP_PATH . "/turing/common.php");

class Turing extends Controller
{
    public function talk($message)
    {
        $res = turingGet($message, null);
        if ($res["code"] == 40007) {
        }
        return $res;
    }

    private function ret_json($code, $content)
    {
        return json_encode(["code" => $code, "content" => $content]);
    }
}