<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>礼待四方 - 图文素材列表</title>
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
            margin: 10px;
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

        img {
            width: 60px;
            height: 60px;
        }

        .bordered {
            border: solid #ccc 1px;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            border-radius: 6px;
            -webkit-box-shadow: 0 1px 1px #ccc;
            -moz-box-shadow: 0 1px 1px #ccc;
            box-shadow: 0 1px 1px #ccc;
        }

        .bordered tr:hover {
            background: #fbf8e9;
            -o-transition: all 0.1s ease-in-out;
            -webkit-transition: all 0.1s ease-in-out;
            -moz-transition: all 0.1s ease-in-out;
            -ms-transition: all 0.1s ease-in-out;
            transition: all 0.1s ease-in-out;
        }

        .bordered td, .bordered th {
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .bordered th {
            background-color: #dce9f9;
            background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
            background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
            background-image: -moz-linear-gradient(top, #ebf3fc, #dce9f9);
            background-image: -ms-linear-gradient(top, #ebf3fc, #dce9f9);
            background-image: -o-linear-gradient(top, #ebf3fc, #dce9f9);
            background-image: linear-gradient(top, #ebf3fc, #dce9f9);
            -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, .8) inset;
            -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, .8) inset;
            box-shadow: 0 1px 0 rgba(255, 255, 255, .8) inset;
            border-top: none;
            text-shadow: 0 1px 0 rgba(255, 255, 255, .5);
        }

        .bordered td:first-child, .bordered th:first-child {
            border-left: none;
        }

        .bordered th:first-child {
            -moz-border-radius: 6px 0 0 0;
            -webkit-border-radius: 6px 0 0 0;
            border-radius: 6px 0 0 0;
        }

        .bordered th:last-child {
            -moz-border-radius: 0 6px 0 0;
            -webkit-border-radius: 0 6px 0 0;
            border-radius: 0 6px 0 0;
        }

        .bordered th:only-child {
            -moz-border-radius: 6px 6px 0 0;
            -webkit-border-radius: 6px 6px 0 0;
            border-radius: 6px 6px 0 0;
        }

        .bordered tr:last-child td:first-child {
            -moz-border-radius: 0 0 0 6px;
            -webkit-border-radius: 0 0 0 6px;
            border-radius: 0 0 0 6px;
        }

        .bordered tr:last-child td:last-child {
            -moz-border-radius: 0 0 6px 0;
            -webkit-border-radius: 0 0 6px 0;
            border-radius: 0 0 6px 0;
        }
    </style>
</head>
<body>
<table class="bordered">
    <tr>
        <th>素材ID</th>
        <th>标题</th>
        <th>作者</th>
        <th>缩略图ID</th>
        <th>是否显示封面图片</th>
        <th>摘要</th>
        <!--<th>内容</th>-->
        <th>URL</th>
        <th>原文URL</th>
        <th>更新时间</th>
    </tr>
    <?php

    foreach ($arr as $record): ?>
        <tr>
            <td rowspan="<?php echo sizeof($record['content']['news_item']) ?>"><?php echo $record['media_id']; ?></td>
            <td><?php echo $record['content']['news_item'][0]['title']; ?></td>
            <td><?php echo $record['content']['news_item'][0]['author']; ?></td>
            <td><?php echo $record['content']['news_item'][0]['thumb_media_id']; ?></td>
            <td><?php echo $record['content']['news_item'][0]['show_cover_pic']; ?></td>
            <td><?php echo $record['content']['news_item'][0]['digest']; ?></td>
            <!--<td>
                <script type='text/html'
                        style='display:block'><?php //echo $record['content']['news_item'][0]['content']; ?></scipt>
            </td>-->
            <td><?php echo $record['content']['news_item'][0]['url']; ?></td>
            <td><?php echo $record['content']['news_item'][0]['content_source_url']; ?></td>
            <td rowspan="<?php echo sizeof($record['content']['news_item']) ?>"><?php echo date("Y-m-d H:i:s", $record['update_time']); ?></td>
        </tr>
        <?php if (sizeof($record['content']['news_item']) > 1) {
            for ($i = 1; $i < sizeof($record['content']['news_item']); $i++) { ?>
                <tr>
                    <td><?php echo $record['content']['news_item'][$i]['title']; ?></td>
                    <td><?php echo $record['content']['news_item'][$i]['author']; ?></td>
                    <td><?php echo $record['content']['news_item'][$i]['thumb_media_id']; ?></td>
                    <td><?php echo $record['content']['news_item'][$i]['show_cover_pic']; ?></td>
                    <td><?php echo $record['content']['news_item'][$i]['digest']; ?></td>
                    <!--<td>
                        <script type='text/html'
                                style='display:block'><?php //echo $record['content']['news_item'][$i]['content']; ?></scipt>
                    </td>-->
                    <td><?php echo $record['content']['news_item'][$i]['url']; ?></td>
                    <td><?php echo $record['content']['news_item'][$i]['content_source_url']; ?></td>
                </tr>
            <?php }
        } ?>
    <?php endforeach; ?>
</table>
</body>
</html>