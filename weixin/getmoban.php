<?php

require "get_access_token.php";

$token = getAccessToken();

$ret = https_request("https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=$token","{\"template_id_short\":\"TM00015\"}");

echo $ret;
