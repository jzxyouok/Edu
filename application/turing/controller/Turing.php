<?php
/**
 * Created by PhpStorm.
 * User: 60501
 * Date: 2016/10/31
 * Time: 19:40
 */

namespace app\turing\controller;
use app\turing\model\Poem;
use think\Controller;

require_once(APP_PATH . "/turing/common.php");

class Turing extends Controller
{
    public function talk($message)
    {

        $res = turingGet($message, ip2location($_SERVER["REMOTE_ADDR"]));
        switch ($res->code) {
            case 100000:
                return json($this->ret_json($res->code, $res->text));
            case 200000:
                return json($this->ret_json($res->code, "已经为您找到了: <a href=\"".$res->text."\" target='_blank' >点我</a>"));
            case 302000:
                return json($this->ret_json($res->code, "这里是今天最新的新闻哦: <a href=\"".$res->text."\" target='_blank' >点我</a>"));
            case 308000:
                return json($this->ret_json($res->code, "您要的菜谱，拿好: <a href=\"".$res->text."\" target='_blank' >点我</a>"));
        }
    }

    private function ret_json($code, $content)
    {
        return ["code" => $code, "content" => $content];
    }
}