<form name="form1" method="post" enctype="application/json"
      action="<?php echo $arr['url']; ?>/1/<?php echo $arr['pagelimit']; ?>">
    <?php if ($arr['currentpage'] == 1) { ?>
        上一页
    <?php } else { ?>
        <a href="<?php echo $arr['url']; ?>/<?php echo $arr['currentpage'] - 1; ?>/<?php echo $arr['pagelimit']; ?>">上一页</a>
    <?php } ?>
    <?php if ($arr['currentpage'] == $arr['pagecount']) { ?>
        下一页
    <?php } else { ?>
        <a href="<?php echo $arr['url']; ?>/<?php echo $arr['currentpage'] + 1; ?>/<?php echo $arr['pagelimit']; ?>">下一页</a>
    <?php } ?>
    第 <?php echo $arr['currentpage']; ?> 页，共 <?php echo $arr['pagecount']; ?> 页
    <br/>
    <?php foreach ($arr['pagearr'] as $pageno):
        if ($pageno == '…') {
            echo '…';
        } elseif ($pageno == $arr['currentpage']) {
            echo $pageno;
        } else { ?>
            <a href="<?php echo $arr['url']; ?>/<?php echo $pageno; ?>/<?php echo $arr['pagelimit']; ?>"><?php echo $pageno; ?></a>
        <?php } ?>
    <?php endforeach; ?>
    跳转到第<input name="redirectpage" style="width: 30px;"></input>页
    <button type="submit">跳转</button>
    <br/>
    每页显示
    <?php if ($arr['pagelimit'] == 10) { ?>
        10
    <?php } else { ?>
        <a href="<?php echo $arr['url']; ?>/1/10">10</a>
    <?php } ?>
    <?php if ($arr['pagelimit'] == 20) { ?>
        20
    <?php } else { ?>
        <a href="<?php echo $arr['url']; ?>/1/20">20</a>
    <?php } ?>
    <?php if ($arr['pagelimit'] == 50) { ?>
        50
    <?php } else { ?>
        <a href="<?php echo $arr['url']; ?>/1/50">50</a>
    <?php } ?>
    <?php if ($arr['pagelimit'] == 100) { ?>
        100
    <?php } else { ?>
        <a href="<?php echo $arr['url']; ?>/1/100">100</a>
    <?php } ?>
    <?php if ($arr['pagelimit'] == 200) { ?>
        200
    <?php } else { ?>
        <a href="<?php echo $arr['url']; ?>/1/200">200</a>
    <?php } ?>
    条记录
</form>