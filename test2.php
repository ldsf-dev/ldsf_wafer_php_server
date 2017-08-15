<?php
$file_path = "/data/savedfile/qrcode/test.txt";
if (file_exists($file_path)) {
    $file_arr = file($file_path);
    for ($i = 0; $i < count($file_arr); $i++) {//逐行读取文件内容
        echo $file_arr[$i] . '**br**' . "<br />";
    }
    /*
    foreach ($file_arr as $value) {
        echo $value . "<br />";
    }*/
}
?>