<?php
/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/11/4
 * Time: 22:13
 */

namespace app\turing\utils;


use app\turing\model\Poem;

class PoemFilter extends WordFilter
{
    const SESSION_KEY = "word_filter_session_key";
    const SUFFIX = "需要我为你讲解一下这首诗的意思吗？需要的话回复'解析'或点击<a href='javascript:sendBack(\"解析\")'>这里</a>，不需要的话可以继续问其他问题~";

    protected $keyword = "古文";

    public function innerFilter($question)
    {
        // TODO: Implement innerFilter() method.
        $poem = new Poem();
        $aPoem = $poem->where("title", "eq", trim($question))->find();
        if(!$aPoem){
            $aPoem = $poem->where("title", "like", "%" . trim($question) . "%")->find();
        }

        if ($aPoem == null) {
            $aPoem = $poem->where("content", "like", "%" . trim($question) . "%")->find();
            if($aPoem){
                session(self::SESSION_KEY, $aPoem->id);
                return ["code" => 200, "content" => "您找的古诗是".$aPoem->writer." 的《" . $aPoem->title . "》全文为：" . $aPoem->content . self::SUFFIX];
            }else{
                return null;
            }
        }else{
            session(self::SESSION_KEY, $aPoem->id);
            return ["code"=>200, "content"=>$aPoem->title." ".$aPoem->dy. " ". $aPoem->writer. " ". $aPoem->content. self::SUFFIX];
        }
    }

    public function beforeFilter($question)
    {
        $presult = parent::beforeFilter($question);
        if($presult){
            return $presult;
        }

        $session = session(self::SESSION_KEY);
        if ($session == null) {
            return null;
        }
        session(self::SESSION_KEY, null);
        if (trim($question) == "解析") {
            $poem = new Poem();
            $aPoem = $poem->where("id", "eq", $session)->find();
            return ["code" => 200, "content" => $aPoem->exp];
        }
    }


}