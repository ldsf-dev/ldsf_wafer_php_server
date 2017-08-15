<?php
/*-------------------------------------------------
|   http_request.php HTTP����ִ�к���
+--------------------------------------------------
|   Author: Jumponline
+------------------------------------------------*/

function getUserInfo($token, $openid)
{
    return json_decode(https_request("https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid&lang=zh_CN"), true);
}

function getUserNickname($token, $openid)
{
    $userinfo = getUserInfo($token, $openid);

    return $userinfo['nickname'];
}

function getUserUnionID($token, $openid)
{
    $userinfo = getUserInfo($token, $openid);

    return $userinfo['unionid'];
}

?>