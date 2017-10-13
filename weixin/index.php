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

        // 用SimpleXML解析POST过来的XML数据
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

        // 获取XML数据中的属性
        $fromUsername = $postObj->FromUserName; //获取发送方帐号（OpenID）
        $toUsername = $postObj->ToUserName; //获取接收方账号
        $MsgType = $postObj->MsgType; //获取消息类型
        $MsgID = $postObj->MsgID; //获取消息类型
        //$CreateTime = $postObj->CreateTime; //获取消息发送时间

        // 获取当前时间戳
        $time = time();

        // 获取微信接口调用凭据
        $token = getAccessToken();

        // 初始化返回消息
        $resultStr = "";

        switch ($MsgType) {
            // 处理文本消息
            case "text":
                //---------- 处 理 数 据 ---------- //
                $contentStr = ""; //初始化处理后消息

                $keyword = trim($postObj->Content); //获取消息内容

                $now = date(
                    FORMAT_DATETIME_DEFAULT,
                    $time
                );

                $con = db_connect(
                    "rm-bp1e5bfxg58i45dkv.mysql.rds.aliyuncs.com",
                    "r65tsd8o72",
                    "Jumponline13",
                    "r65tsd8o72"
                );

                db_query(
                    $con,
                    "INSERT `LDSF_MSG_RECEIVE`(`OPEN_ID`,`MSG_CONTENT`,`MSG_TIME`,`MSG_TYPE`,`MSG_ID`,`TO`) VALUES('" .
                    $fromUsername .
                    "','" .
                    $keyword .
                    "','" .
                    $now .
                    "','" .
                    $MsgType .
                    "','" .
                    $MsgID .
                    "','" .
                    $toUsername .
                    "');"
                );

                $contentStr = TEXT_AUTOREPLY_MESSAGE;

                if ($keyword == KEYWORD_CUSTOMSERVICE) {
                    $resultStr = sprintf(
                        TYPE_TEMPLATE_RESPONSE_CUSTOMER_SERVICE,
                        $fromUsername,
                        $toUsername,
                        $time
                    );

                    $username = getUserNickname($token, $fromUsername);

                    $data = '{"touser":"oXXigwgnK8gKdxAHhwW0Tew4xYEE","template_id":"cjjuPV-1N0bN4pusr16Ny4Cp8kM23QuELSkBUhZF8n8","url":"http://weixin.qq.com/download","data":{"first":{"value":"有新的客服消息需要处理。","color":"#173177"},"keyword1":{"value":"' . $username . '","color":"#173177"},"keyword2":{"value":"' . $now . '","color":"#173177"},"keyword3":{"value":"' . $keyword . '","color":"#173177"},"remark":{"value":"请尽快处理","color":"#173177"}}}';

                    https_request(
                        "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token",
                        $data
                    );

                } else {
                    $con = db_connect();

                    $query = db_query(
                        $con,
                        "SELECT autoreplyperiod_timestamp FROM t_autoreplyperiod WHERE autoreplyperiod_appid='" .
                        APPID_LDSF .
                        "' AND autoreplyperiod_openid='$fromUsername'"
                    );

                    if ($query->num_rows == 0) {
                        db_query(
                            $con,
                            "INSERT INTO `t_autoreplyperiod`(`autoreplyperiod_appid`,`autoreplyperiod_openid`,`autoreplyperiod_count`) VALUES('" .
                            APPID_LDSF .
                            "','$fromUsername',1)"
                        );

                        $resultStr = sprintf(
                            TYPE_TEMPLATE_RESPONSE_TEXT,
                            $fromUsername,
                            $toUsername,
                            $time,
                            $contentStr
                        );

                    } else {
                        $record = $query->fetch_assoc();

                        if ($time > strtotime(
                                '+15 minutes',
                                strtotime($record['autoreplyperiod_timestamp'])
                            )) {
                            db_query(
                                $con,
                                "UPDATE `t_autoreplyperiod` SET `autoreplyperiod_count`=`autoreplyperiod_count`+1 WHERE `autoreplyperiod_appid`='" .
                                APPID_LDSF .
                                "' AND `autoreplyperiod_openid`='$fromUsername'"
                            );

                            $resultStr = sprintf(
                                TYPE_TEMPLATE_RESPONSE_TEXT,
                                $fromUsername,
                                $toUsername,
                                $time,
                                $contentStr
                            );
                        }
                    }
                }

                break;

            //处理图片消息
            case "image":
                $picurl = $postObj->PicUrl;
                $mediaid = $postObj->MediaId;

                $keyword = $mediaid . ' | ' . $picurl;

                $now = date(
                    FORMAT_DATETIME_DEFAULT,
                    $time
                );

                $con = db_connect(
                    "rm-bp1e5bfxg58i45dkv.mysql.rds.aliyuncs.com",
                    "r65tsd8o72",
                    "Jumponline13",
                    "r65tsd8o72"
                );

                db_query(
                    $con,
                    "INSERT `LDSF_MSG_RECEIVE`(`OPEN_ID`,`MSG_CONTENT`,`MSG_TIME`,`MSG_TYPE`,`MSG_ID`,`TO`) VALUES('" .
                    $fromUsername .
                    "','" .
                    $keyword .
                    "','" .
                    $now .
                    "','" .
                    $MsgType .
                    "','" .
                    $MsgID .
                    "','" .
                    $toUsername .
                    "');"
                );

                break;

            //处理触发事件
            case "event":
                //---------- 处 理 数 据 ---------- //
                $contentStr = ""; //初始化处理后消息

                $eventKey = $postObj->EventKey; //获取消息事件关键字
                $event = $postObj->Event; //获取消息事件类型

                $now = date(
                    FORMAT_DATETIME_DEFAULT,
                    $time
                );

                $con = db_connect(
                    "rm-bp1e5bfxg58i45dkv.mysql.rds.aliyuncs.com",
                    "r65tsd8o72",
                    "Jumponline13",
                    "r65tsd8o72"
                );

                db_query(
                    $con,
                    "INSERT `LDSF_MSG_RECEIVE`(`OPEN_ID`,`MSG_CONTENT`,`MSG_TIME`,`MSG_TYPE`,`MSG_ID`,`TO`,`EVENT`) VALUES('" .
                    $fromUsername .
                    "','" .
                    $eventKey .
                    "','" .
                    $now .
                    "','" .
                    $MsgType .
                    "','" .
                    $MsgID .
                    "','" .
                    $toUsername .
                    "','" .
                    $event .
                    "');"
                );

                if ($eventKey == "LDSF_SZ_MENU_0002") {
                    $title = "Title标题123";
                    $description = "Description描述321";
                    $picUrl = "http://img2.imgtn.bdimg.com/it/u=3928835941,952471949&fm=21&gp=0.jpg";
                    $url = "http://mp.weixin.qq.com/s?__biz=MzI2NTI5NjQ3Nw==&mid=2247483743&idx=1&sn=5ee6504092c8a29b27e53a613dfc746c&chksm=ea9ece6ddde9477b9480098cb84dd69631c5537c376eb33920cf19c0208362556f04494ae544&scene=0#wechat_redirect";

                    $resultStr = sprintf(
                        TYPE_TEMPLATE_RESPONSE_NEWS,
                        $fromUsername,
                        $toUsername,
                        $time,
                        1,
                        $title,
                        $description,
                        $picUrl,
                        $url
                    );
                }

                if ($event == "subscribe") {
                    $resultStr = sprintf(
                        TYPE_TEMPLATE_RESPONSE_TEXT,
                        $fromUsername,
                        $toUsername,
                        $time,
                        TEXT_AUTOREPLY_SUBSCRIBE
                    );
                    $unionid = getUserUnionID($token, $fromUsername);

                    $con = db_connect();

                    db_query(
                        $con,
                        "INSERT `t_openpf_user`(`openpf_appid`,`openpf_unionid`,`openpf_openid`) VALUES('wxb0f5b379a85374ce','" .
                        $unionid .
                        "','" .
                        $fromUsername .
                        "');"
                    );
                }

                break;
        }

        //---------- 返 回 数 据 ---------- //
        echo $resultStr; //输出结果

    }
} ?>