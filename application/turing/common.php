<?php
/**
 * Created by PhpStorm.
 * User: 60501
 * Date: 2016/10/31
 * Time: 19:41
 */


/**
 * @param $message
 * @return array 获取图灵回复
 */
function turingGet($message, $location){
    $config = config("turing");
    $data = ["key"=>$config["apikey"], "info"=>$message, "loc"=>$location, "userid"=>session_id()];
    $dataString = json_encode($data);

    $handle = curl_init("http://www.tuling123.com/openapi/api");
    curl_setopt($handle, CURLOPT_POST, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, "data=".$dataString);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($dataString)));
    $response = curl_exec($handle);
    curl_close($handle);
    return json_decode($response);
}


