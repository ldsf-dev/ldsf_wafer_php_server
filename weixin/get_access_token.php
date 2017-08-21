<?php

function getAccessToken($appid = "wxb0f5b379a85374ce", $appsecret = "fc8d10f449ffd006b8ac00ffb1781530")
{
    //$	appid = "wx5447c67d2b39e9b0";
    //$	appsecret = "b11f9f14f994bffd8b11d0f175fd4763";
    //$appid = "wxfa0ab76487cffb89";
    //$appsecret = "2cb83ff640a75dc34fa1308c16313e15";
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

    date_default_timezone_set('PRC');

    $con = mysqli_connect("rm-bp1e5bfxg58i45dkv.mysql.rds.aliyuncs.com", "r65tsd8o72", "Jumponline13");

    mysqli_select_db($con, "r65tsd8o72");

    $query = mysqli_query($con, "SELECT token,token_generate_datetime FROM LDSF_TOKEN;");

    if ($query->num_rows == 0) {

        $arr = json_decode(https_request($url), true);

        $token = $arr['access_token'];

        mysqli_query($con, "INSERT INTO `LDSF_TOKEN`(`TOKEN`) VALUES('" . $token . "');");

        return $token;

    } else {
        $token_record = $query->fetch_assoc();

        //var_dump($token_record);

        $now = time();

        if ($now > strtotime('+100 minutes', strtotime($token_record['token_generate_datetime']))) {
            $arr = json_decode(https_request($url), true);

            $token = $arr['access_token'];

            mysqli_query($con, "UPDATE `LDSF_TOKEN` SET `TOKEN`='" . $token . "'");

            return $token;

        } else {
            return $token_record['token'];

        }

    }

} ?>