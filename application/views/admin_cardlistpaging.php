<a id="searchChange" onclick="return searchChange()" href="javascript:void(0);">－</a>
<table class="bordered">
    <tr>
        <th name="qrcode">
            二维码
        </th>
        <th>
            序列号
        </th>
        <th>
            券卡编号
        </th>
        <th>
            券卡密码
        </th>
        <th>
            券卡状态
        </th>
        <th>
            持卡用户
        </th>
        <th>
            商品名称
        </th>
        <th>
            规格
        </th>
        <th>
            商品说明
        </th>
        <th>
            销售
        </th>
        <th>
            有效期起始时间
        </th>
        <th>
            有效期结束时间
        </th>
        <th>
            备注
        </th>
    </tr>
    <?php

    foreach ($arr['arr'] as $record): ?>
        <tr>
            <td name="qrcode">
                <a href="https://64458061.gift4fang.com/cardqrcode/qrcode_<?php echo $record['card_serialno']; ?>.jpg">
                    点击查看
                </a>
            </td>
            <td>
                <?php echo $record['card_serialno']; ?>
            </td>
            <td>
                <?php echo $record['card_no']; ?>
            </td>
            <td>
                <?php echo $record['card_password']; ?>
            </td>
            <td>
                <?php
                switch ($record['card_status']) {
                    case '0':
                        echo '<p style="color:grey;">未激活</p>';
                        break;
                    case '1':
                        echo '<p style="color:blue;">未出库</p>';
                        break;
                    case '2':
                        echo '<p style="color:orange;">未提货</p>';
                        break;
                    case '3':
                        echo '<p style="color:green;">已提货</p>';
                        break;
                    case '4':
                        echo '<p style="color:red;">暂停使用</p>';
                        break;
                    case '9':
                        echo '<p style="color:lightgrey;">已废弃</p>';
                        break;
                    default:
                        echo '未知';
                }
                ?>
            </td>
            <td>
                <?php echo $record['user_nickname']; ?>
            </td>
            <td>
                <?php echo $record['good_name']; ?>
            </td>
            <td>
                <?php echo $record['good_spec_name']; ?>
            </td>
            <td>
                <?php echo $record['card_goodremark']; ?>
            </td>
            <td>
                <?php echo $record['card_salesman']; ?>
            </td>
            <td>
                <?php echo $record['card_expire_starttime']; ?>
            </td>
            <td>
                <?php echo $record['card_expire_endtime']; ?>
            </td>
            <td>
                <?php echo $record['card_remark']; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<input type="hidden" id="searchChangeFlg" value="0"/>
