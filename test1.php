<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 0);
curl_setopt($ch,CURLOPT_URL,'http://pan.baidu.com/share/qrcode?w=150&h=150&url=alshgulasuhfuihaSUILDFHILAHFUIALHSUIAOFHUIASHUFIfauiisdhfuilahsndlfhuioluehauldhfuluhuioaiwehlahsdufhlijasdfhuluhaeuiwslhufluahsuidlhfuilehuilwsahuildhfulkadfuiewayeoilryoiqywefhjikda');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$file_content = curl_exec($ch);
curl_close($ch);
$downloaded_file = fopen('/data/savedfile/qrcode/1.jpg', 'w');
fwrite($downloaded_file, $file_content);
fclose($downloaded_file);

?>