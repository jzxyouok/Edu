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
        $bres = $this->beforeFilter($question);
        if(!$bres){
            if(startWith($question, $this->keyword)){
                $bres = $this->innerFilter(substr($question, strlen($this->keyword)));
            }
        }
        if($bres){
            $bres["content"] = preg_replace("/(\n)+/", "<br/>", $bres["content"]);
            return $bres;
        }
    }

    public abstract function innerFilter($question);

    public function beforeFilter($question){
        if(trim($question) == $this->keyword){
            try{
                $help_text = file_get_contents(APP_PATH . "turing/resources/" . $this->keyword . ".html");
                return ["code"=>200, "content"=>str_replace("\n", "", $help_text)];
            }catch (\Exception $e){
                //do nothing
            }
        }
    }
}