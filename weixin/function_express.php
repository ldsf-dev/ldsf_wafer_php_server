<?php
/*-------------------------------------------------
|   function_express.php
+--------------------------------------------------
|   Author: Jumponline
+------------------------------------------------*/

function express_details ($keyword)
{
	$url = "http://m.kuaidi100.com/query?type=shunfeng&postid=$keyword";
	$content = json_decode(https_request($url));
	$data = array_reverse($content->data);
	if ($content->status <> 200){
		$dataList = "未查询到快递信息，请检查后重新输入";
	} else {
		$dataList = "物流信息如下：\n";
		foreach ($data as $dataItem){
			$dataList = $dataList.$dataItem->time." ".$dataItem->context."\n";
		 }
	}
	return trim($dataList);
}

function express_latest ($keyword)
{
	$url = "http://m.kuaidi100.com/query?type=shunfeng&postid=$keyword";
	$content = json_decode(https_request($url));
	$data = $content->data;
	if ($content->status <> 200){
		$dataList = "未查询到快递信息，请检查后重新输入\n<a href=\"http://www.163.com/\">点击这里</a>";
	} else {
		$dataList = "最新物流信息：\n".$data[0]->time." ".$data[0]->context."\n"."若需查询全部物流信息，请发送\"详细\"+物流单号即可";
	}
	return trim($dataList);
}

?>