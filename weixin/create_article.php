<?php

require "http_request.php"; 
require "get_access_token.php"; 

$token = getAccessToken(); 

$jsondata = '{
    "button": [
        {
            "name": "闻·讯",
            "sub_button": [
                {
                    "type": "click",
                    "name": "城市气质",
                    "key": "LDSF_SZ_MENU_1001"
                },
                {
                    "type": "click",
                    "name": "人物故事",
                    "key": "LDSF_SZ_MENU_1002"
                },
                {
                    "type": "click",
                    "name": "礼仪风俗",
                    "key": "LDSF_SZ_MENU_1003"
                },
                {
                    "type": "view",
                    "name": "节日提醒",
                    "url": "http://cn.mikecrm.com/RpSZl7S"
                }
            ]
        },
        {
            "name": "致·礼",
            "sub_button": [
                {
                    "type": "miniprogram",
                    "name": "礼券申兑",
                    "appid": "wx3c13313f866a541a",
                    "pagepath": "/pages/index",
                    "url": "https://64458061.gift4fang.com/weixin/miniprogram_lowversion.php"
                },
                {
                    "type": "miniprogram",
                    "name": "在线集市",
                    "appid": "wx3c13313f866a541a",
                    "pagepath": "/pages/index",
                    "url": "https://64458061.gift4fang.com/weixin/miniprogram_lowversion.php"
                }
            ]
        }
    ]
}'; 


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu); 
var_dump($result); 

function https_request($url, $data = null) {
$curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL, $url); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); 
if ( ! empty($data)) {
curl_setopt($curl, CURLOPT_POST, 1); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $data); 
}
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($curl); 
curl_close($curl); 
return $output; 
}?>