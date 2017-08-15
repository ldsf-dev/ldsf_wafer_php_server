#!/usr/bin/php
<?php


$myfile = fopen("/data/savedfile/testdata_" . date("YmdHis") . ".txt", "w") or die("Unable to open file!");
fwrite($myfile, 'time is money,my friend');
fclose($myfile);

?>