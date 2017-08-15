<?php

require "http_request.php"; 
require "get_access_token.php"; 

$token = getAccessToken(); 

$arr_item = json_decode(https_request("https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=oXXigwu6VqiaeIm19R358XGeviKA&lang=zh_CN"),true);

$output = 'subscribe:' . $arr_item['subscribe'] . ', unionid:' . $arr_item['unionid'] . ', openid:' . $item . ', nickname:' . $arr_item['nickname']; 

echo '<html><body>' . $output . '</body></html>'; 