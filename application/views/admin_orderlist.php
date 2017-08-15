<!--<button type="button" id="searchChange" onclick="return searchChange()" href="javascript:void(0);">隐藏物流单号</button>-->
<form name="form1" method="post" enctype="application/json" action="">
<!--    <select name="oneselect" onchange="window.location=this.value;">-->
<!--        <option value ="/admin/index">Volvo</option>-->
<!--        <option value ="/admin/allcards/1"><Sa></Sa>ab</option>-->
<!--        <option value="opel" selected="true">Opel</option>-->
<!--        <option value="audi">Audi</option>-->
<!--    </select>-->
<!--    <button type="submit">更新物流信息</button>-->
    <table class="bordered">
        <tr>
<!--            <th name="expressnoth">-->
            <th>
                订单号
            </th>
            <th>
                下单用户
            </th>
            <th>
                商品·规格
            </th>
            <th>
                数量
            </th>
            <th>
                金额
            </th>
            <th>
                订单状态
            </th>
            <th>
                联系人
            </th>
            <th>
                电话
            </th>
            <th>
                地址
            </th>
            <th>
                物流编号
            </th>
            <th>
                下单时间
            </th>
            <th>
                支付时间
            </th>
            <th>
                取消时间
            </th>
            <th>
                退款时间
            </th>
            <th>
                完成时间
            </th>
            <th>
                备注
            </th>
        </tr>
        <?php

        foreach ($arr['arr'] as $record): ?>
            <tr>
                <td><?php echo $record['order_id']; ?></td>
                <td><?php echo $record['user_nickname']; ?></td>
                <td><?php echo $record['good_name_spec']; ?></td>
                <td><?php echo $record['order_good_qty']; ?></td>
                <td><?php echo $record['order_amount']; ?></td>
                <td><?php echo $record['order_status']; ?></td>
                <td><?php echo $record['order_contact_name']; ?></td>
                <td><?php echo $record['order_contact_tel']; ?></td>
                <td><?php echo $record['order_contact_add']; ?></td>
                <td><?php echo $record['order_express_no']; ?></td>
                <td><?php echo $record['order_create_datetime']; ?></td>
                <td><?php echo $record['order_pay_datetime']; ?></td>
                <td><?php echo $record['order_cancel_datetime']; ?></td>
                <td><?php echo $record['order_refund_datetime']; ?></td>
                <td><?php echo $record['order_complete_datetime']; ?></td>
                <td><?php echo $record['order_remark']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>

<input type="hidden" id="searchChangeFlg" value="0"/>