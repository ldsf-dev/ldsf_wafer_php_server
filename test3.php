<?php
$host = "http://jisuarea.market.alicloudapi.com";
$path = "/area/all";
$method = "GET";
$appcode = "bf7eddb49cc04cd5b0e8f20155ec8385";
$headers = array();
array_push($headers, "Authorization:APPCODE " . $appcode);
$querys = "";
$bodys = "";
$url = $host . $path;

$curl = curl_init();
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_FAILONERROR, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl, CURLOPT_HEADER, true);
if (1 == strpos("$" . $host, "https://")) {
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
}
echo curl_exec($curl);
?>