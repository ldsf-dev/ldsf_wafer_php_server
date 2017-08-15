<?php
/*-------------------------------------------------
|   template_response_type.php HTTP请求处理后返回消息模版
+--------------------------------------------------
|   Author: Jumponline
+------------------------------------------------*/


// 【回复文本消息】
// ToUserName:接收方帐号（收到的OpenID）
// FromUserName:开发者微信号
// CreateTime:消息创建时间 （整型）
// MsgType:"text"
// Content:回复的消息内容（换行：在content中能够换行，微信客户端就支持换行显示）
DEFINE("TYPE_TEMPLATE_RESPONSE_TEXT","<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType>text</MsgType>
		<Content><![CDATA[%s]]></Content>
		</xml>");

// 【回复图片消息】
// ToUserName:接收方帐号（收到的OpenID）
// FromUserName:开发者微信号
// CreateTime:消息创建时间 （整型）
// MsgType:"image"
// MediaId:通过素材管理中的接口上传多媒体文件，得到的id。
DEFINE("TYPE_TEMPLATE_RESPONSE_IMAGE","<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType>image</MsgType>
		<Image>
		<MediaId><![CDATA[%s]]></MediaId>
		</Image>
		</xml>");

// 【回复语音消息】
// ToUserName:接收方帐号（收到的OpenID）
// FromUserName:开发者微信号
// CreateTime:消息创建时间 （整型）
// MsgType:"voice"
// MediaId:通过素材管理中的接口上传多媒体文件，得到的id。
DEFINE("TYPETEMPLATE_RESPONSE_VOICE","<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType>voice</MsgType>
		<Voice>
		<MediaId><![CDATA[%s]]></MediaId>
		</Voice>
		</xml>");

// 【回复视频消息】
// ToUserName:接收方帐号（收到的OpenID）
// FromUserName:开发者微信号
// CreateTime:消息创建时间 （整型）
// MsgType:"video"
// MediaId:通过素材管理中的接口上传多媒体文件，得到的id。
// Title:视频消息的标题
// Description:视频消息的描述
DEFINE("TYPE_TEMPLATE_RESPONSE_VIDEO","<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType>video</MsgType>
		<Video>
		<MediaId><![CDATA[%s]]></MediaId>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		</Video> 
		</xml>");

// 【回复音乐消息】
// ToUserName:接收方帐号（收到的OpenID）
// FromUserName:开发者微信号
// CreateTime:消息创建时间 （整型）
// MsgType:"music"
// Title:音乐标题
// Description:音乐描述
// MusicUrl:音乐链接
// HQMusicUrl:高质量音乐链接，WIFI环境优先使用该链接播放音乐
// ThumbMediaId:缩略图的媒体id，通过素材管理中的接口上传多媒体文件，得到的id
DEFINE("TYPE_TEMPLATE_RESPONSE_MUSIC","<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType>music</MsgType>
		<Music>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		<MusicUrl><![CDATA[%s]]></MusicUrl>
		<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
		<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
		</Music>
		</xml>");

// 【回复图文消息】
// ToUserName:接收方帐号（收到的OpenID）
// FromUserName:开发者微信号
// CreateTime:消息创建时间 （整型）
// MsgType:"news"
// ArticleCount:图文消息个数，限制为10条以内
// Articles:多条图文消息信息，默认第一个item为大图,注意，如果图文数超过10，则将会无响应
// Title:图文消息标题
// Description:图文消息描述
// PicUrl:图片链接，支持JPG、PNG格式，较好的效果为大图360*200，小图200*200
// Url:点击图文消息跳转链接
DEFINE("TYPE_TEMPLATE_RESPONSE_NEWS","<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType>news</MsgType>
		<ArticleCount>%s</ArticleCount>
		<Articles>
		<item>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		<PicUrl><![CDATA[%s]]></PicUrl>
		<Url><![CDATA[%s]]></Url>
		</item>
		</Articles>
		</xml>");


// 【转发至客服接口】
// ToUserName:接收方帐号（收到的OpenID）
// FromUserName:开发者微信号
// CreateTime:消息创建时间 （整型）
// MsgType:"transfer_customer_service"
DEFINE("TYPE_TEMPLATE_RESPONSE_CUSTOMER_SERVICE","<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType>transfer_customer_service</MsgType>
		</xml>");




?>