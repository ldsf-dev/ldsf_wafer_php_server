<?php

require "http_request.php"; 
require "get_access_token.php";

$token = getAccessToken();

$ret = https_request("https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=$token","{\"type\":\"image\",\"offset\":0,\"count\":20}");

echo $ret;
