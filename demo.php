<?php

include_once "wxBizDataCrypt.php";


$appid = 'wx3c13313f866a541a';
//$sessionKey = 'dfe3b9fbde85a94ac8ed3c4a1d51daa8';
//
//$encryptedData = "sG2F7xESPmOBBoIU/EHRwl2864S04CWLpqUGxhogs4nLECEeN8eZvDdhfWaDxorbMFubcei560n3hBtPtE4vPlPaNLOI1jnS+9gnLI9s/8EjD/2+D7URZgdNXjrf5dXzsEiHJYPIaalw0mL0V6qoU2vWRMoc7FuFryJ8r0VVOTfrGkGXrtwRbcLZm/K2kDvfrkqDE3UmBuIqNUblGe9Tnz81uOJTtXt5g49rwB1PTFuMuFrFDtpMUL9Iv83O0BkKoc7LhhXaRHDmDI/eiosm+TNF0uyRaRvn2wRa+Jl0j/XMvWD6hhbiQrhxJh/XVBjf0fNgrYqLdihABEoWOEFOTfoyB5F/16vyjAXFQT3/YHhfPSIQx/RKOPDXTF38rNXcbjhJD3s88mlgpgxYGW95NMpJcn2VgWWdh3IQS626weVOWflmI/NAmKOMbEdFy9Ebig3LhAo5X76eEdcMVZId+jVgwiDUeUUTlnYkBcz80nhIaLkaeu/JoIumuaBmvTgzDh1TOIx69v0jHXkIs4ePWg==";
//
//$iv = "6R9bIdF+unpIw2Zcvplazw==";

//$str = file_get_contents("php://input");

$arr = json_decode($str, true);

$encryptedData = "vr/y8KywQgtj2QqJL9Eyp8sbcrPrLxrlML60lHDdFPyRSSmnayQsjF0FC3VREB8fMhvFIV7zL0t+jNNV/LnwMfYj7t6zoKIywjSAz4dpZlBWArT7HFtVtnMHNuX9Mn6X6lGOASKQW/RqRslXh5/gYQLqH9hBLvdQyuyVJBfTwYscmhnUuEepZdcM6t7+6ow7XqdOE7eu0qQ3TfNxoDskc+luXmjXLwfbv18we49MKl9ICuQMlX0An3kZYNr67eDpMRg4jHPFRRElH5EG1LbPM26qlUwWXNDz51qONokkAS2U8yjNS6Y/qXmYZ6va0bdvPH/OAKqXf5LrFkhIAuqi5aF2dyqEU6TsGCmI2HdChYW3tnc+ent/WpIJDDsiTgqy3N3O3nLf1H05dHKvQC2W8VHvCjUhEVa+LAhS5xHsDkFMQXI+yhhgMaGdR2iafuwjS43SrbqMeI1dt+v41pr2R+SyTMEqTgHXvFX13nzhB0cN6fN9iPufxJVZBg6OzJiqq62CMMshuYfOFEWphrtB8A==";

$iv = "RFCVhNAxS0Rag5mlmgZRug==";

$sessionKey = "HpVnCbi2eGLsPCDKSi1aIQ==";

$pc = new WXBizDataCrypt($appid, $sessionKey);
$errCode = $pc->decryptData($encryptedData, $iv, $data);

if ($errCode == 0) {
    echo($data . "\n");
} else {
    echo($errCode . " && postdata:");
}

