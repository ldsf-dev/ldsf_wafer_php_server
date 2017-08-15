<?php

require "http_request.php"; 
require "get_access_token.php"; 

$token = getAccessToken(); 

// $name = $_GET['name'];
// $gift = $_GET['gift'];

// $data = '{"touser":"oXXigwrj-o-fFtUvCqKgi6IfMVxw","template_id":"ASDwqGzOG2CjwCR2a_BRQQ3F7pEOtivD5a3fNzqoKyQ","url":"http://weixin.qq.com/download","data":{"first":{"value":"购买成功！","color":"#173177"},"keyword1":{"value":"您购买了一个'.$gift.'","color":"#173177"},"keyword2":{"value":"'.$name.'","color":"#173177"},"keyword3":{"value":"2017年3月6日","color":"#173177"},"remark":{"value":"欢迎再次购买","color":"#173177"}}}'; 

$ret = https_request("https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=oXXigwrj-o-fFtUvCqKgi6IfMVxw&lang=zh_CN");

echo '<html><body>'.$ret.'</body></html>';