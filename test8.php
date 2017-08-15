#!/usr/bin/php
<?php

$output = shell_exec('sh /data/release/php-weapp-demo/runat.sh');

var_dump($output);
var_dump($_SERVER);
echo shell_exec("id -a");
?>