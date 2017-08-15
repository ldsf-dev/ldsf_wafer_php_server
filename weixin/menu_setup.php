<?php

//$appid = "wx5447c67d2b39e9b0";
// //$appsecret = "b11f9f14f994bffd8b11d0f175fd4763";
// $appid = "wxfa0ab76487cffb89";
// $appsecret = "2cb83ff640a75dc34fa1308c16313e15";
$appid = "wxb0f5b379a85374ce";
$appsecret = "fc8d10f449ffd006b8ac00ffb1781530";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$output = https_request($url);
$jsoninfo = json_decode($output, true);

$access_token = $jsoninfo["access_token"];


$jsonmenu = '{
    "button": [
        {
            "name": "闻·讯",
            "sub_button": [
                {
                    "type": "media_id",
                    "name": "人物故事",
                    "media_id": "K7ccxsGVGcAsrCuinvXuWtkyIk8VSoNhIMPwyquRyZk"
                },
                {
                    "type": "media_id",
                    "name": "礼仪风俗",
                    "media_id": "K7ccxsGVGcAsrCuinvXuWn4bhJ5dntrtochQqdgGTu0"
                }
            ]
        },
        {
            "name": "致·礼",
            "sub_button": [
                {
                    "type": "miniprogram",
                    "name": "在线集市",
                    "appid": "wx3c13313f866a541a",
                    "pagepath": "/pages/index",
                    "url": "https://64458061.gift4fang.com/weixin/miniprogram_lowversion.php"
                }
            ]
        },
        {
            "type": "miniprogram",
            "name": "礼券提货",
            "appid": "wx3c13313f866a541a",
            "pagepath": "/pages/index",
            "url": "https://64458061.gift4fang.com/weixin/miniprogram_lowversion.php"
        }
    ]
}';


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
} ?>