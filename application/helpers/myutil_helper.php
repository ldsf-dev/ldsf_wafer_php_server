<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/16
 * Time: 23:58
 */
/**
 * POST 请求
 * @param string $url
 * @param array $param
 * @return string content
 */

function http_post($url, $param)
{
    $oCurl = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
    }
    if (is_string($param)) {
        $strPOST = $param;
    } else {
        $aPOST = array();
        foreach ($param as $key => $val) {
            $aPOST[] = $key . "=" . urlencode($val);
        }
        $strPOST = join("&", $aPOST);
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($oCurl, CURLOPT_POST, true);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if (intval($aStatus["http_code"]) == 200) {
        return $sContent;
    } else {
        return false;
    }
}

/**
 * GET 请求
 * @param string $url
 */
function http_get($url)
{
    $oCurl = curl_init();
    if (stripos($url, "https://") !== FALSE) {
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
    }
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    $sContent = curl_exec($oCurl);
    $aStatus = curl_getinfo($oCurl);
    curl_close($oCurl);
    if (intval($aStatus["http_code"]) == 200) {
        return $sContent;
    } else {
        return false;
    }
}

//数组转XML
function arrayToXml($arr)
{
//    $xml = "&lt;?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?&gt;&lt;xml&gt;";
//    foreach ($arr as $key=>$val)
//    {
//        if ($key == 'detail'){
//            $xml.="&lt;".$key."&gt;&lt;![CDATA[".$val."]]&gt;&lt;/".$key."&gt;";
//        }else{
//            $xml.="&lt;".$key."&gt;".$val."&lt;/".$key."&gt;";
//        }
//    }
//    $xml.="&lt;/xml&gt;";
    $xml = "<xml>";
    foreach ($arr as $key => $val) {
        if ($key == 'detail') {
            $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        } else {
            $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
        }
    }
    $xml .= "</xml>";
    return $xml;
}

function FromXml($xml)
{

    libxml_disable_entity_loader(true);
    return json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA));

}

function ToXml($data)
{
    $xml = "<xml>";
    foreach ($data as $key => $val) {
        if (is_numeric($val)) {
            $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
        } else {
            $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
    }
    $xml .= "</xml>";

    return $xml;
}

function createRandomStr($length, $uppercaseonly = false)
{
    if ($uppercaseonly) {
        $str = 'ABCDEFGHJKMNPQRSTWXYZ2345678';//28个字符
        $num = 28;
    } else {
        $str = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';//48个字符
        $num = 48;
    }
    $strlen = $num;
    while ($length > $strlen) {
        $str .= $str;
        $strlen += $num;
    }
    $str = str_shuffle($str);
    return substr($str, 0, $length);
}

function createRandomNumStr($length)
{
    $str = '0123456789';//10个字符
    $strlen = 10;
    while ($length > $strlen) {
        $str .= $str;
        $strlen += 10;
    }
    $str = str_shuffle($str);
    return substr($str, 0, $length);
}

function generate_signature($arr)
{
    $strA = '';

    ksort($arr);
    reset($arr);

    while (list($key, $val) = each($arr)) {
        $strA = $strA . '&' . $key . '=' . $val;
    }
    $strA = substr($strA, 1, strlen($strA) - 1);

    $stringSignTemp = $strA . '&key=MsoPw1ID8q3h0GHtAGKLkJgKxMPZC6cY';

    return strtoupper(md5($stringSignTemp));
}

function encrypt($string, $operation, $key = '')
{
    $key = md5($key);
    $key_length = strlen($key);
    $string = $operation == 'D' ? base64_decode($string) : substr(md5($string . $key), 0, 8) . $string;
    $string_length = strlen($string);
    $rndkey = $box = array();
    $result = '';
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($key[$i % $key_length]);
        $box[$i] = $i;
    }
    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if ($operation == 'D') {
        if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
            return substr($result, 8);
        } else {
            return '';
        }
    } else {
        return str_replace('=', '', base64_encode($result));
    }

}

function generateqrcode($str, $filename, $width = 300, $height = 300)
{
    $host = "http://pan.baidu.com/share/qrcode?";
    $path = "w=" . $width . "&h=" . $height . "&url=" . $str;
    $method = "GET";
    $url = $host . $path;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    if (1 == strpos("$" . $host, "https://")) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $img = curl_exec($curl);

//    $host = "http://qrcode-ali.juheapi.com";
//    $path = "/api.php";
//    $method = "GET";
//    $appcode = "bf7eddb49cc04cd5b0e8f20155ec8385";
//    $headers = array();
//    array_push($headers, "Authorization:APPCODE " . $appcode);
//    $querys = "text=" . $str . "&w=300";
//    $bodys = "";
//    $url = $host . $path . "?" . $querys;
//
//    $curl = curl_init();
//    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
//    curl_setopt($curl, CURLOPT_URL, $url);
//    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//    curl_setopt($curl, CURLOPT_FAILONERROR, false);
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//    //curl_setopt($curl, CURLOPT_HEADER, true);
//    if (1 == strpos("$" . $host, "https://")) {
//        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//    }
//    $img = curl_exec($curl);

    $file = fopen($filename, 'w');
    fwrite($file, $img);
    fclose($file);

    if ($img == false) {
        return 'error';
    } else {
        return $filename;
    }
}

function generateqrcode_individual($str, $width = 300, $height = 300)
{
    $filename = '/data/release/php-weapp-demo/cardqrcode/qrcode_' . date("YmdHis") . "_" . createRandomNumStr(5) . ".jpg";
    return generateqrcode($str, $filename, $width, $height);
}

function generateqrcodewithencode($serialno, $cardno, $password, $width = 300, $height = 300)
{
    $filename = '/data/release/php-weapp-demo/cardqrcode/qrcode_' . $serialno . ".jpg";

    $encryptedStr = encrypt("no=" . $cardno . "&pwd=" . $password, 'E', 'wx3c13313f866a541a');

    generateqrcode(escape_url($encryptedStr), $filename, $width, $height);

    return $encryptedStr;
}

function escape_url($str)
{
    $str = str_replace('%', '%25', $str);
    $str = str_replace('+', '%2B', $str);
    $str = str_replace(' ', '%20', $str);
    $str = str_replace('/', '%2F', $str);
    $str = str_replace('?', '%3F', $str);
    $str = str_replace('#', '%23', $str);
    $str = str_replace('&', '%26', $str);
    $str = str_replace('=', '%3D', $str);

    return $str;
}

function formatcardno($str)
{
    $quotient = floor(strlen($str) / 4);
    //$remainder = strlen($str) % 4;

    $ret = '';
    for ($i = 0; $i < $quotient; $i++) {
        $ret = $ret . substr($str, $i * 4, 4) . ' ';
    }
    $ret = $ret . substr($str, $quotient * 4);

    return $ret;
}

function urldatatoarray($str)
{

    $arr = explode('&', $str);

    $post = [];
    foreach ($arr as $item) {
        $i = explode('=', $item);
        $post[$i[0]] = urldecode($i[1]);
    }

    return $post;
}

function https_request($url, $data = null)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
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

function sendSMSbyapi($content){
    //$host = "http://ali-sms.showapi.com";
    $host = "http://sms.market.alicloudapi.com";
    //$path = "/sendSms";
    $path = "/singleSendSms";
    $method = "GET";
    $appcode = "91f0c581861c4600bc9c282ea7b272dd";
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = $content;
    $bodys = "";
    $url = $host . $path . "?" . $querys;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($curl, CURLOPT_HEADER, true);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $arr = json_decode(curl_exec($curl), true);

    return $arr;
}

function sendExpressNo($contactname,$goodname,$goodspecname,$expressname,$expressno,$mobile){
//    $api_content = 'content='.
//        rawurlencode(
//            '{"name":"'.
//            $contactname.
//            '","gn":"'.
//            $goodname.
//            '","gs":"'.
//            $goodspecname.
//            '","ename":"'.
//            $expressname.
//            '","eno":"'.
//            $expressno.
//            '"}'
//        ).
//        '&mobile='.
//        $mobile.
//        '&tNum=T170317001208';
    $api_content = 'ParamString='.
        rawurlencode(
            '{"name":"'.
            $contactname.
            '","gngs":"'.
            $goodname."-".
            $goodspecname.
            '","ename":"'.
            $expressname.
            '","eno":"'.
            $expressno.
            '"}'
        ).
        '&RecNum='.
        $mobile.
        '&SignName=礼待四方&TemplateCode=SMS_105505059';

    return sendSMSbyapi($api_content);
}
