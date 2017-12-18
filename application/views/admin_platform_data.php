<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>网站后台管理系统HTML模板--模板之家 www.cssmoban.com</title>
    <link href="<?php echo $arr['base_path']; ?>css/style.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo $arr['base_path']; ?>js/jquery.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".click").click(function () {
                $(".tip").fadeIn(200);
            });

            $(".tiptop a").click(function () {
                $(".tip").fadeOut(200);
            });

            $(".sure").click(function () {
                $(".tip").fadeOut(100);
            });

            $(".cancel").click(function () {
                $(".tip").fadeOut(100);
            });

        });
    </script>


</head>


<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <?php foreach ($arr['navstr'] as $record): ?>
            <li><a href="#"><?php echo $record; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="rightinfo">

    <div class="tools">

        <ul class="toolbar">
            <li class="click"><span><img src="<?php echo $arr['base_path']; ?>images/t01.png"/></span>添加</li>
            <li class="click"><span><img src="<?php echo $arr['base_path']; ?>images/t02.png"/></span>修改</li>
            <li><span><img src="<?php echo $arr['base_path']; ?>images/t03.png"/></span>删除</li>
            <li><span><img src="<?php echo $arr['base_path']; ?>images/t04.png"/></span>统计</li>
        </ul>


        <ul class="toolbar1">
            <li><span><img src="<?php echo $arr['base_path']; ?>images/t05.png"/></span>设置</li>
        </ul>

    </div>


    <table class="tablelist">
        <thead>
        <tr>
            <th><input name="" type="checkbox" value="" checked="checked"/></th>
            <?php foreach (array_keys($arr['data'][0]) as $key): ?>
                <th>
                    <?php echo $key; ?>
                    <?php if ($key == $arr['sortkey']) { ?>
                        <i class="sort"><img src="<?php echo $arr['base_path']; ?>images/px.gif"/></i>
                    <?php } ?>
                </th>
            <?php endforeach; ?>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($arr['data'] as $record): ?>
            <tr>
                <td><input name="" type="checkbox" value=""/></td>
                <?php foreach ($record as $key => $value): ?>
                    <?php if ($key == $arr['pickey']) { ?>
                        <td><img src="<?php echo $value; ?>" style="width:20px;height:20px;"/></td>
                    <?php } else { ?>
                        <td title="<?php echo $value; ?>"><?php echo $value; ?></td>
                    <?php } ?>
                <?php endforeach; ?>
                <td><a href="#" class="tablelink">查看</a> <a href="#" class="tablelink"> 删除</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


    <div class="pagin">
        <div class="message"><i class="blue"><?php echo $arr['countall'] ?></i>条记录，共<i
                    class="blue"><?php echo $arr['pagecount'] ?></i>页，当前显示第&nbsp;<i
                    class="blue"><?php echo $arr['currentpage'] ?>&nbsp;</i>页
        </div>
        <ul class="paginList">
            <li class="paginItem"><a
                        href="<?php echo $arr['currentpage'] == 1 ? 'javascript:;' : $arr['url'] . '/' . $arr['prevpage'] ?>"><span
                            class="pagepre"></span></a></li>
            <?php foreach ($arr['pagearr'] as $record): ?>
                <li class="paginItem
                <?php echo $record == $arr['currentpage'] ? ' current' : '' ?>
                <?php echo $record == '…' ? ' more' : '' ?>
                ">
                    <a href="<?php echo $record == $arr['currentpage'] ? 'javascript:;' : $arr['url'] . '/' . $record ?>"><?php echo $record; ?></a>
                </li>
            <?php endforeach; ?>
            <li class="paginItem"><a
                        href="<?php echo $arr['currentpage'] == $arr['pagecount'] ? 'javascript:;' : $arr['url'] . '/' . $arr['nextpage'] ?>"><span
                            class="pagenxt"></span></a></li>
        </ul>
    </div>


    <div class="tip">
        <div class="tiptop"><span>提示信息</span><a></a></div>

        <div class="tipinfo">
            <span><img src="<?php echo $arr['base_path']; ?>images/ticon.png"/></span>
            <div class="tipright">
                <p>是否确认对信息的修改 ？</p>
                <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
            </div>
        </div>

        <div class="tipbtn">
            <input name="" type="button" class="sure" value="确定"/>&nbsp;
            <input name="" type="button" class="cancel" value="取消"/>
        </div>

    </div>


</div>

<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>
</body>
</html>
