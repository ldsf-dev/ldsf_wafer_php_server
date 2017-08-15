<?php

require "get_access_token.php";

$token = getAccessToken();

$ret = https_request("https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=$token");

echo $ret;
