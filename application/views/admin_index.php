<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>礼待四方 - 管理界面</title>
    <style type="text/css">

        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            margin: 20px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
            text-decoration: none;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 0;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            padding: 10px 20px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }
    </style>
</head>
<body>
<div id="container">
    <h1>礼待四方 - 管理界面</h1>
    <p>用户管理</p>
    <ul>
        <li><a href="/admin/allprofiles">用户列表</a></li>
        <li><a href="/admin/allloginrecords">用户登录列表</a></li>
    </ul>
    <p>商品管理</p>
    <ul>
        <li><a href="/admin/allgoods">商品列表</a></li>
        <li><a href="/admin/allorders/1">订单列表</a></li>
    </ul>
    <p>卡券管理</p>
    <ul>
        <li><a href="/admin/allcards/1">卡券列表</a></li>
        <li><a href="/admin/alldeliverys/1">卡券提货列表</a></li>
    </ul>
    <p>订单管理</p>
    <ul>
        <li><a href="/admin/updatedelibydate">分日期订单更新</a></li>
    </ul>
    <p>系统管理</p>
    <ul>
        <li><a href="/admin/getareainfofromapi">省市区信息更新</a></li>
    </ul>
    <p>公众号管理</p>
    <ul>
        <li><a href="/admin/getmaterialslist/image">图片素材列表</a></li>
        <li><a href="/admin/getmaterialslist/news">图文素材列表</a></li>
        <li><a href="/admin/newmedia">新建永久媒体素材</a></li>
    </ul>
</div>
</body>
</html>