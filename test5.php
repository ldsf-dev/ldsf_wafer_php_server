<?php
$host = "http://jisujwddz.market.alicloudapi.com";
$path = "/geoconvert/coord2addr";
$method = "GET";
$appcode = "bf7eddb49cc04cd5b0e8f20155ec8385";
$headers = array();
array_push($headers, "Authorization:APPCODE " . $appcode);
$querys = "lat=23.03&lng=113.75&type=baidu";
$bodys = "";
$url = $host . $path . "?" . $querys;

$curl = curl_init();
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_FAILONERROR, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl, CURLOPT_HEADER, true);
if (1 == strpos("$".$host, "https://"))
{
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
}
var_dump(curl_exec($curl));
?>
