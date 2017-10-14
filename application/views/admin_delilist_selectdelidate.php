<form name="form1" method="post" enctype="application/json" action="/admin/updatedeliexpressno">
    <!--    <select name="oneselect" onchange="window.location=this.value;">-->
    <!--        <option value ="/admin/index">Volvo</option>-->
    <!--        <option value ="/admin/allcards/1"><Sa></Sa>ab</option>-->
    <!--        <option value="opel" selected="true">Opel</option>-->
    <!--        <option value="audi">Audi</option>-->
    <!--    </select>-->
    <table class="bordered" id="tabledeli">
        <tr>
            <th name="expressnoth">
                物流单号
            </th>
            <th>
                标记
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
        </tr>
        <?php

        foreach ($arr['arr'] as $record): ?>
            <tr>
                <td name="expressnotd"
                    <?php if ($record['物流单号'] != ''){ ?>style="background-color: lightgreen;"<?php } ?>><?php echo $record['物流单号']; ?>
                    <br/><input type="number" name="<?php echo $record['card_deli_orderid']; ?>" style="width:100px;">
                </td>
                <td><?php echo $record['标记']; ?></td>
                <td><?php echo $record['收货人']; ?></td>
                <td><?php echo $record['电话']; ?></td>
                <td><?php echo $record['地址']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button type="submit">更新物流单号</button>
</form>
<button class="btn" onclick="getText()">获取文本</button>
<script>
    function getText() {
        var res = '';
        var table = document.getElementById('tabledeli');
        console.log(table.rows[0].cells[0].innerHTML);
        for (var x = 1; x < table.rows.length; x++) {
            if (x > 1) {
                res = res + '\n';
            }
            for (var y = 1; y < table.rows[x].cells.length; y++) {
                sign1 = y == 1 ? '：' : '';
                sign2 = y > 1 ? '\t' : '';
                res = res + sign2 + table.rows[x].cells[y].innerText + sign1;
            }
        }
        console.log('res', res);

        var clipboard = new Clipboard('.btn', {
            text: function () {
                return res;
            }
        });
        clipboard.on('success', function (e) {
            alert('success');
            console.log(e);
        });

        clipboard.on('error', function (e) {
            alert('error:' + e.action + ',' + e.text);
            console.log(e);
        });
    }
</script>

<input type="hidden" id="searchChangeFlg" value="0"/>