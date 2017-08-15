<?php

require "http_request.php"; 
require "get_access_token.php"; 

$token = getAccessToken(); 

$name = $_GET['name'];
$gift = $_GET['gift'];

$data = '{"touser":"oXXigwgnK8gKdxAHhwW0Tew4xYEE","template_id":"ASDwqGzOG2CjwCR2a_BRQQ3F7pEOtivD5a3fNzqoKyQ","url":"http://weixin.qq.com/download","data":{"first":{"value":"购买成功！","color":"#173177"},"keyword1":{"value":"您购买了一个'.$gift.'","color":"#173177"},"keyword2":{"value":"'.$name.'","color":"#173177"},"keyword3":{"value":"2017年3月6日","color":"#173177"},"remark":{"value":"欢迎再次购买","color":"#173177"}}}'; 

$ret = https_request("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token",$data);

echo '<html>
<body>
<h1>'.$ret.'</h1>
</body>
</html>';