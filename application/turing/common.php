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
function turingGet($message, $location)
{
    session_start();
    $config = config("turing");
    $data = ["key" => $config["apikey"], "info" => $message, "loc" => $location, "userid" => session_id()];
    $dataString = json_encode($data);

    $handle = curl_init("http://www.tuling123.com/openapi/api");
    curl_setopt($handle, CURLOPT_POST, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $dataString);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'));
    $response = curl_exec($handle);
    curl_close($handle);
    return json_decode($response);
}

function ip2location($ip){
    $location = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=".$ip);
    $locarr = json_decode($location, true)["data"];
    try{
        $locastr = $locarr["country"].$locarr["area"].$locarr["region"].$locarr["city"];
    }catch (Exception $e){
        $locastr = "";
    }
    return $locastr;
}
