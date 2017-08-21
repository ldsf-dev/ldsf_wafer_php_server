<?php
/*-------------------------------------------------
|   index.php [ 微信公众平台接口 ]
+--------------------------------------------------
|   Author: LimYoonPer
+------------------------------------------------*/

require "http_request.php";
require "template_response_type.php";
require "get_access_token.php";
require "utils.php";
require "db.php";
require "const.php";

include "function_express.php";

$wechatObj = new wechat();
$wechatObj->responseMsg();

class wechat
{
    public function responseMsg()
    {
        //---------- 接 收 数 据 ---------- //
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"]; //获取POST数据
        //用SimpleXML解析POST过来的XML数据
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

        //获取XML数据中的属性
        $fromUsername = $postObj->FromUserName; //获取发送方帐号（OpenID）
        $toUsername = $postObj->ToUserName; //获取接收方账号
        $MsgType = $postObj->MsgType; //获取消息类型
        $MsgID = $postObj->MsgID; //获取消息类型
        //$CreateTime = $postObj->CreateTime; //获取消息发送时间

        //获取当前时间戳
        $time = time();

        $token = getAccessToken();

        //初始化返回消息
        $resultStr = "";

        switch ($MsgType) {
            //处理文本消息
            case "text":
                //---------- 处 理 数 据 ---------- //
                $contentStr = ""; //初始化处理后消息

                $keyword = trim($postObj->Content); //获取消息内容

                $now = date('Y-m-d H:i:s', $time);

                // $data = "{
                // 		\"touser\":\"$fromUsername\",
                // 		\"template_id\":\"ASDwqGzOG2CjwCR2a_BRQQ3F7pEOtivD5a3fNzqoKyQ\",
                // 		\"url\":\"http://weixin.qq.com/download\",
                // 		\"data\":{
                // 				\"first\": {
                // 					\"value\":\"购买成功！\",
                // 					\"color\":\"#173177\"
                // 				},
                // 				\"keyword1\":{
                // 					\"value\":\"您购买了一个礼品\",
                // 					\"color\":\"#173177\"
                // 				},
                // 				\"keyword2\": {
                // 					\"value\":\"礼待四方\",
                // 					\"color\":\"#173177\"
                // 				},
                // 				\"keyword3\": {
                // 					\"value\":\"2017年3月6日\",
                // 					\"color\":\"#173177\"
                // 				},
                // 				\"remark\":{
                // 					\"value\":\"欢迎再次购买\",
                // 					\"color\":\"#173177\"
                // 				}
                // 		}
                // 	}";

                // $contentStr = https_request("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token",$data).$fromUsername;


                // $preg = "/([\x{4e00}-\x{9fa5}]+)?(\d+)/u"; //功能（汉字）+快递编号
                // preg_match_all($preg,$keyword,$newdata);

                // $modeArr = $newdata[1];
                // $codeArr = $newdata[2];

                // $code = $codeArr[0];

                // if (count($modeArr) <> 0 && $modeArr[0] == "详细") {
                // 	$contentStr = express_details($code);
                // } else {
                // 	$contentStr = express_latest($code);
                // }

                $con = mysqli_connect("rm-bp1e5bfxg58i45dkv.mysql.rds.aliyuncs.com", "r65tsd8o72", "Jumponline13");

                mysqli_query($con, "set names 'utf8'");
                mysqli_select_db($con, "r65tsd8o72");

                mysqli_query($con, "INSERT `LDSF_MSG_RECEIVE`(`OPEN_ID`,`MSG_CONTENT`,`MSG_TIME`,`MSG_TYPE`,`MSG_ID`,`TO`) VALUES('" . $fromUsername . "','" . $keyword . "','" . $now . "','" . $MsgType . "','" . $MsgID . "','" . $toUsername . "');");

                $contentStr = '由于系统升级，2016年出售的卡券无法在线提货，如需提货，请将卡券背面拍照发送到此，并提供您的联系人姓名、电话、收货地址，以及希望发货的日期（江浙沪次日可到），我们会尽快安排发货（2017年的卡券不受影响，请通过下方菜单“礼券提货”进行提货）；如有其他问题，可回复关键字“客服”，我们的客服人员会尽快给您答复';

                if ($keyword == '客服') {
                    $resultStr = sprintf(TYPE_TEMPLATE_RESPONSE_CUSTOMER_SERVICE, $fromUsername, $toUsername, $time);

                    $username = getUserNickname($token, $fromUsername);

                    $data = '{"touser":"oXXigwgnK8gKdxAHhwW0Tew4xYEE","template_id":"cjjuPV-1N0bN4pusr16Ny4Cp8kM23QuELSkBUhZF8n8","url":"http://weixin.qq.com/download","data":{"first":{"value":"有新的客服消息需要处理。","color":"#173177"},"keyword1":{"value":"' . $username . '","color":"#173177"},"keyword2":{"value":"' . $now . '","color":"#173177"},"keyword3":{"value":"' . $keyword . '","color":"#173177"},"remark":{"value":"请尽快处理","color":"#173177"}}}';
                    https_request("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token", $data);

                } else {
                    $con = db_connect();

                    $query = db_query($con, "SELECT autoreplyperiod_timestamp FROM t_autoreplyperiod WHERE autoreplyperiod_appid='" . APPID_LDSF . "' AND autoreplyperiod_openid='$fromUsername'");

                    if ($query->num_rows == 0) {
                        db_query($con, "INSERT INTO `t_autoreplyperiod`(`autoreplyperiod_appid`,`autoreplyperiod_openid`,`autoreplyperiod_count`) VALUES('" . APPID_LDSF . "','$fromUsername',1)");

                        $resultStr = sprintf(TYPE_TEMPLATE_RESPONSE_TEXT, $fromUsername, $toUsername, $time, $contentStr);

                    } else {
                        $record = $query->fetch_assoc();

                        if ($time > strtotime('+15 minutes', strtotime($record['autoreplyperiod_timestamp']))) {
                            db_query($con, "UPDATE `t_autoreplyperiod` SET `autoreplyperiod_count`=`autoreplyperiod_count`+1 WHERE `autoreplyperiod_appid`='" . APPID_LDSF . "' AND `autoreplyperiod_openid`='$fromUsername'");

                            $resultStr = sprintf(TYPE_TEMPLATE_RESPONSE_TEXT, $fromUsername, $toUsername, $time, $contentStr);

                        }

                    }

                }

                break;

            //处理图片消息
            case "image":
                $picurl = $postObj->PicUrl;
                $mediaid = $postObj->MediaId;

                $keyword = $mediaid . ' | ' . $picurl;

                $now = date('Y-m-d H:i:s', $time);

                $con = db_connect("rm-bp1e5bfxg58i45dkv.mysql.rds.aliyuncs.com", "r65tsd8o72", "Jumponline13", "r65tsd8o72");

                db_query($con, "INSERT `LDSF_MSG_RECEIVE`(`OPEN_ID`,`MSG_CONTENT`,`MSG_TIME`,`MSG_TYPE`,`MSG_ID`,`TO`) VALUES('" . $fromUsername . "','" . $keyword . "','" . $now . "','" . $MsgType . "','" . $MsgID . "','" . $toUsername . "');");

                break;

            //处理触发事件
            case "event":
                //---------- 处 理 数 据 ---------- //
                $contentStr = ""; //初始化处理后消息

                $eventKey = $postObj->EventKey;
                $event = $postObj->Event; //获取消息事件类型

                $now = date('Y-m-d H:i:s', $time);

                $con = mysqli_connect("rm-bp1e5bfxg58i45dkv.mysql.rds.aliyuncs.com", "r65tsd8o72", "Jumponline13");

                mysqli_query($con, "set names 'utf8'");
                mysqli_select_db($con, "r65tsd8o72");

                mysqli_query($con, "INSERT `LDSF_MSG_RECEIVE`(`OPEN_ID`,`MSG_CONTENT`,`MSG_TIME`,`MSG_TYPE`,`MSG_ID`,`TO`,`EVENT`) VALUES('" . $fromUsername . "','" . $eventKey . "','" . $now . "','" . $MsgType . "','" . $MsgID . "','" . $toUsername . "','" . $event . "');");

                if ($eventKey == "LDSF_SZ_MENU_0002") {
                    $title = "Title标题123";
                    $description = "Description描述321";
                    $picUrl = "http://img2.imgtn.bdimg.com/it/u=3928835941,952471949&fm=21&gp=0.jpg";
                    $url = "http://mp.weixin.qq.com/s?__biz=MzI2NTI5NjQ3Nw==&mid=2247483743&idx=1&sn=5ee6504092c8a29b27e53a613dfc746c&chksm=ea9ece6ddde9477b9480098cb84dd69631c5537c376eb33920cf19c0208362556f04494ae544&scene=0#wechat_redirect";

                    $resultStr = sprintf(TYPE_TEMPLATE_RESPONSE_NEWS, $fromUsername, $toUsername, $time, 1, $title, $description, $picUrl, $url);
                    // }else {
                    // 	$contentStr = "Event:" . $postObj -> Event . " EventKey:" . $postObj -> EventKey . " OpenId:" . $fromUsername;
                    // 	$resultStr = sprintf(TYPE_TEMPLATE_RESPONSE_TEXT, $fromUsername, $toUsername, $time, $contentStr);
                }

                if ($event == "subscribe") {
                    $resultStr = sprintf(TYPE_TEMPLATE_RESPONSE_TEXT, $fromUsername, $toUsername, $time, "欢迎关注礼待四方微信公众号！苏州镇湖云彪黄桃火热上市，点击下方菜单，轻松购买/兑换高品质生鲜！友情提示：由于系统升级，2016年出售的卡券无法在线提货，如需提货，请将卡券背面拍照发送到此，并提供您的联系人姓名、电话、收货地址，以及希望发货的日期（江浙沪次日可到），我们会尽快安排发货");
                    $unionid = getUserUnionID($token, $fromUsername);

                    $con = mysqli_connect("10.66.184.208", "root", "CEGHNi3OQS2y");

                    mysqli_query($con, "set names 'utf8'");
                    mysqli_select_db($con, "ldsf");

                    mysqli_query($con, "INSERT `t_openpf_user`(`openpf_appid`,`openpf_unionid`,`openpf_openid`) VALUES('wxb0f5b379a85374ce','" . $unionid . "','" . $fromUsername . "');");

                }

                break;

        }


        //---------- 返 回 数 据 ---------- //
        echo $resultStr; //输出结果

    }
} ?>