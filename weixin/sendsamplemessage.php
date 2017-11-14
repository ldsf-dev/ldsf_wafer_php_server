<?php

require "http_request.php"; 
require "get_access_token.php"; 

$token = getAccessToken(); 

//$name = $_GET['name'];
//$gift = $_GET['gift'];

//$data = '{"touser":"oXXigwgnK8gKdxAHhwW0Tew4xYEE","template_id":"ASDwqGzOG2CjwCR2a_BRQQ3F7pEOtivD5a3fNzqoKyQ","url":"http://weixin.qq.com/download","data":{"first":{"value":"购买成功！","color":"#173177"},"keyword1":{"value":"您购买了一个'.$gift.'","color":"#173177"},"keyword2":{"value":"'.$name.'","color":"#173177"},"keyword3":{"value":"2017年3月6日","color":"#173177"},"remark":{"value":"欢迎再次购买","color":"#173177"}}}';
$data = '{"touser":"oXXigwgnK8gKdxAHhwW0Tew4xYEE","template_id":"awC-pnebafLCpeqCzx6Q741xBnUH9rKowjouWmzc0WE","url":"https://64458061.gift4fang.com/admin/selectdeliverysbydelidate/1/200/2017-10-22","data":{"first":{"value":"购买成功！","color":"#173177"},"keyword1":{"value":"您购买了一个商品","color":"#173177"},"keyword2":{"value":"zheshishangping","color":"#173177"},"remark":{"value":"平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06\n平安,1280：何百磊 13911020553 北京 朝阳区 百子湾路金都杭城东区3号楼2单元2303\n盛虹,980：申祖应 15851685535 江苏 苏州 吴江区 盛泽镇西二环路盛虹集团总部\n平安,1280：张萍萍 13510281167 广东 深圳 罗湖区 新安路联城美园怡美阁26A06","color":"#173177"}}}';
$ret = https_request("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token",$data);

echo '<html>
<body>
<h1>'.$ret.'</h1>
</body>
</html>';