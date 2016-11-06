<?php
/**
 * Created by PhpStorm.
 * User: 60501
 * Date: 2016/10/31
 * Time: 19:40
 */

namespace app\turing\controller;

use app\turing\model\Poem;
use app\turing\utils\Interceptor;
use think\Controller;
use think\Request;
use think\Response;

require_once(APP_PATH . "/turing/common.php");

class Turing extends Controller
{
    public function talk($message)
    {
        $interceptor = new Interceptor();
        $res = $interceptor->filter($message);
        if ($res) {
            return json($res);
        }
        $res = turingGet($message, ip2location($_SERVER["REMOTE_ADDR"]));
        switch ($res->code) {
            case 100000:
                return json($this->ret_json($res->code, $res->text));
            case 200000:
                return json($this->ret_json($res->code, "已经为您找到了: <a href=\"" . $res->detailurl . "\" target='_blank' >点我</a>"));
            case 302000:
                return json($this->ret_json($res->code, "这里是今天最新的新闻哦: <a href=\"" . $res->detailurl . "\" target='_blank' >点我</a>"));
            case 308000:
                return json($this->ret_json($res->code, "您要的菜谱，拿好: <a href=\"" . $res->detailurl . "\" target='_blank' >点我</a>"));
        }
    }

    public function js($callback)
    {
        $js_str = file_get_contents(APP_PATH . "turing/resources/turing.jsm");
        $js_str = str_replace("#{base}", BASE, $js_str);
        $js_str = str_replace("#{callback}", $callback, $js_str);
        $response = new Response($js_str);
        $response->header(array("ContentType:application/javascript"));
        return $response;
    }

    private function ret_json($code, $content)
    {
        return ["code" => $code, "content" => $content];
    }
}