<?php

$appid = "wxb0f5b379a85374ce"; 
$appsecret = "fc8d10f449ffd006b8ac00ffb1781530"; 
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$output = https_request($url); 
$jsoninfo = json_decode($output, true); 

var_dump($jsoninfo);

$token = getAccessToken(); 

        $real_file = '@/data/savedfile/qrcode/qrcode_0000000072.jpg;filename=test.jpg;filelength=1024;content-type=image/jpeg';

        $file_info['filename'] = '72.jpg';
        $file_info['content-type'] = 'image/jpeg';
        $file_info['filelength'] = 1024;

        $data['media'] = $real_file;
        //$data['form-data'] = http_build_query($file_info);


$url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".$token."&type=image";
$result = https_request($url, $data); 
echo $result.'###'.$token; 

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
$aStatus = curl_getinfo($curl);
curl_close($curl); 
var_dump($aStatus);
return $output; 
}


function getAccessToken()
{
    $appid = "wxb0f5b379a85374ce";
    $appsecret = "fc8d10f449ffd006b8ac00ffb1781530";
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

    $arr = json_decode(https_request($url), true);

    return $arr['access_token'];
}

?>