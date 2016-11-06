<?php
/**
 * Created by PhpStorm.
 * User: wencheng
 * Date: 16/11/5
 * Time: 14:15
 */

namespace app\turing\utils;


use app\turing\model\Bushou;
use app\turing\model\Word;

class DicFilter extends WordFilter
{
    protected $keyword = "词典";
    const BUSHOU = "cidian_session_key_bushou";
    const START = "cidian_session_key_start";

    public function innerFilter($question)
    {
        $question = trim($question);
        if ($question == "部首") {
            session(self::START, true);
            $bushou = new Bushou();
            $bushous = $bushou->select();
            $retstr = "点击您想查询的部首进入下一步：<br/><br/>";
            foreach ($bushous as $abushou) {
                $retstr .= sprintf('<a href="javascript:sendBack(\'部首 %s\')" style="font-size: 16px; margin: 5px;">%s</a>',
                        $abushou->bushou, $abushou->bushou) . ($abushou->isBr ? "<hr style='border-color:#ccc;margin:10px'/>" : "");
            }
            return ["ret" => 200, "content" => $retstr];

        }

        $word = new Word();
        // TODO: Implement innerFilter() method.
        if (preg_match('/[a-zA-Z]+/', $question)) {
            $words = $word->where("pinyin", "like", $question . "%")->order("bihua")->select();
            $ret = "已为您找到以下汉字，请点击您想查找的：";
            foreach ($words as $w) {
                $ret .= sprintf(' <a href="javascript:sendBack(\'词典 %s\')">%s(%s)</a> &nbsp;', $w->word, $w->word, $w->pinyinshow);
            }
            return ["code" => 200, "content" => $ret];
        } elseif (mb_strlen($question, "utf-8") == 1) {
            $words = $word->where("word", "eq", $question)->find();
            if (!$words) {
                return null;
            }
            $exp_str = $words->exp;
            $ret = sprintf("【%s】(%s)——%s", $words->word, $words->pinyinshow, str_replace("相关词语：", "[相关词语]：", str_replace("详细解释", "[详细解释]", $exp_str)));
            return ["code" => 200, "content" => $ret];
        } else {
            $words = $word->where("word", "eq", mb_substr($question, 0, 1, "utf-8"))->find();
            if (!$words) {
                return null;
            }
            $mr = array();
            $exp_str = $words->exp;
            if (!preg_match("/" . $question . "\\s*\n[a-z\\s\\-āáǎàōóǒòēéěèńňīíǐìūúǔùǖǘǚǜüɑɡ]+\n[^\n]+\n/", preg_replace("/\n+/", "\n", $exp_str), $mr)) {
                return null;
            }
            $ret = sprintf("【%s】(%s)——%s", $words->word, $words->pinyinshow, $mr[0]);
            return ["code" => 200, "content" => $ret];
        }
    }

    public function beforeFilter($question)
    {
        $presult = parent::beforeFilter($question);
        if ($presult) {
            return $presult;
        }
        if ($question == "词典") {
            return ["code" => 200, "content" => "您想通过哪种方式进行查询呢？" . ' <a href="javascript:sendBack(\'拼音\')">拼音</a>，  <a href="javascript:sendBack(\'部首\')">部首</a> '];
        }
        $isStart = session(self::START);
        $sbushou = session(self::BUSHOU);
        if (startWith($question, "部首")) {

            $msg = trim(substr($question, strlen($this->keyword)));

            if ($isStart) {
                $bm = new Bushou();
                if ($bm->where("bushou", "eq", $msg)->find()) {
                    session(self::BUSHOU, $msg);
                    return ["code" => 200, "content" => "请输入您想查找的字的全部笔画（包含部首）:"];
                } else {
                    session(self::START, null);
                }
            }
        }
        if ($sbushou && $isStart) {
            if (preg_match("/\\d+/", $question)) {
                $wm = new Word();
                $words = $wm->where("bushou", "eq", $sbushou)->where("bihua", "eq", $question)->select();
                $ret = "已为您找到以下汉字：";
                foreach ($words as $word){
                    $ret .= sprintf('<a href="javascript:sendBack(\'词典 %s\')" style="font-size: 15px; margin: 5px;">%s</a>', $word->word, $word->word);
                }
                return ["code" => 200, "content" => $ret."<br/> 如果没找到想要的字，可以重新输入笔画哦！或者点击<a href='javascript:sendBack(\"词典 部首\")'>这里</a>重新查询"];
            } else {
                session(self::START, null);
                session(self::BUSHOU, null);
            }
        }
    }

}