<button type="button" id="searchChange" onclick="return searchChange()" href="javascript:void(0);">隐藏物流单号</button>
<form name="form1" method="post" enctype="application/json" action="/admin/updatedeliexpressno">
<!--    <select name="oneselect" onchange="window.location=this.value;">-->
<!--        <option value ="/admin/index">Volvo</option>-->
<!--        <option value ="/admin/allcards/1"><Sa></Sa>ab</option>-->
<!--        <option value="opel" selected="true">Opel</option>-->
<!--        <option value="audi">Audi</option>-->
<!--    </select>-->
    <button type="submit">更新物流信息</button>
    <table class="bordered">
        <tr>
            <th name="expressnoth">
                物流单号
            </th>
            <th>
                送货日
            </th>
            <th>
                商品规格
            </th>
            <th>
                收货人
            </th>
            <th>
                电话
            </th>
            <th>
                地址
            </th>
            <th>
                备注
            </th>
            <th>
                卡号
            </th>
            <th>
                销售
            </th>
            <th>
                提货时间
            </th>
        </tr>
        <?php

        foreach ($arr['arr'] as $record): ?>
            <tr>
                <td name="expressnotd" <?php if($record['物流单号'] != ''){ ?>style="background-color: lightgreen;"<?php } ?>><?php echo $record['物流单号']; ?><br/><input type="number" name="<?php echo $record['card_deli_orderid']; ?>" style="width:100px;"></td>
                <td><?php echo $record['送货日']; ?></td>
                <td><?php echo $record['商品规格']; ?></td>
                <td><?php echo $record['收货人']; ?></td>
                <td><?php echo $record['电话']; ?></td>
                <td><?php echo $record['地址']; ?></td>
                <td><?php echo $record['备注']; ?></td>
                <td><?php echo $record['卡号']; ?></td>
                <td><?php echo $record['销售']; ?></td>
                <td><?php echo $record['提货时间']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>

<input type="hidden" id="searchChangeFlg" value="0"/>