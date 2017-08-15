<?php
	$oCurl = curl_init();
        curl_setopt($oCurl, CURLOPT_URL, 'https://64458061.gift4fang.com/goodslist');
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, '');
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
        $sContent = curl_exec($oCurl);
        //$aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);

        echo '##'.$sContent.'##';
?>