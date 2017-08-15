<?php
/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/8/9
 * Time: 21:30
 */
require "utils.php";
require "get_access_token.php";
require "http_request.php";
require "db.php";

$token = getAccessToken();

//var_dump(getUserInfo($token,'oXXigwgnK8gKdxAHhwW0Tew4xYEE'));

//echo https_request("https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=$token");

//date_default_timezone_set('PRC');

//echo $token;

//echo strtotime('2017-08-10 01:59:10');

//echo strtotime('+100 minutes',strtotime('2017-08-10 01:59:11'));
//echo strtotime('2017-08-10 03:39:11');
//
//echo time();

//echo date('Y-m-d H:i:s', time());

//$time1 = '2017-08-10 01:59:10';
//$time2 = '2017-09-09 02:59:10';
//
//if ($time1 > $time2) {
//    echo '$time1>$time2';
//} elseif ($time1 == $time2) {
//    echo '$time1=$time2';
//} else {
//    echo '$time1<$time2';
//}

//$res = https_request("https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token");
//
//$arr = json_decode($res, true);
//
//$output = array();
//
//foreach ($arr['data']['openid'] as $item) {
//    $unionid = getUserUnionID($token, $item);
//    $output[$item] = $unionid;
//
//    $con = mysqli_connect("10.66.184.208", "root", "CEGHNi3OQS2y");
//
//    mysqli_query($con, "set names 'utf8'");
//    mysqli_select_db($con, "ldsf");
//
//    mysqli_query($con, "INSERT `t_openpf_user`(`openpf_appid`,`openpf_unionid`,`openpf_openid`) VALUES('wxb0f5b379a85374ce','" . $unionid . "','" . $item . "');");
//
//}
//
//var_dump($output);

$con = db_connect();

?>