<?php

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/4
 * Time: 22:42
 */
class Order_model extends CI_Model
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getOrderDetail($orderid)
    {
        $this->db->select(
            array(
                't_good.good_name',
                't_good.good_thumbnail',
                't_order.order_wxid',
                't_order.order_contact_name',
                't_order.order_contact_tel',
                't_order.order_contact_add',
                't_order.order_status',
                't_order.order_prepayid',
                't_order.order_create_datetime',
                't_order.order_pay_datetime',
                't_order.order_complete_datetime',
                't_order.order_express_no',
                't_good_spec.good_spec_price',
                't_good_spec.good_spec_name',
                'format(t_good_spec.good_spec_price/100,2) as good_spec_price_display',
                't_order_goodsinfo.order_good_id',
                't_order_goodsinfo.order_good_spec_id',
                't_order_goodsinfo.order_good_qty',
                'format(t_order.order_amount/100,2) as order_amount_display'
            )
        );
        $this->db->from('t_order');
        $this->db->join('t_order_goodsinfo', 't_order.order_id = t_order_goodsinfo.order_id');
        $this->db->join('t_good', 't_order_goodsinfo.order_good_id = t_good.good_id');
        $this->db->join('t_good_spec', 't_order_goodsinfo.order_good_id = t_good_spec.good_id and t_order_goodsinfo.order_good_spec_id = t_good_spec.good_spec_seq');
        $this->db->join('t_order_status', 't_order.order_status = t_order_status.order_status');
        $this->db->where('t_order.order_id', $orderid);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function getOrderList()
    {
        $openid = isset($_SERVER['HTTP_OPENID']) ? $_SERVER['HTTP_OPENID'] : '';
        $this->db->select(
            array(
                't_good.good_name',
                't_good.good_thumbnail',
                't_order.order_id',
                't_order.order_status',
                't_order.order_create_datetime',
                't_order_status.order_status_name',
                't_good_spec.good_spec_name',
                't_order_goodsinfo.order_good_qty',
                'format(t_order.order_amount/100,2) as order_amount_display'
            )
        );
        $this->db->from('t_order');
        $this->db->join('t_order_goodsinfo', 't_order.order_id = t_order_goodsinfo.order_id');
        $this->db->join('t_good', 't_order_goodsinfo.order_good_id = t_good.good_id');
        $this->db->join('t_good_spec', 't_order_goodsinfo.order_good_spec_id = t_good_spec.good_spec_seq and t_good.good_id = t_good_spec.good_id');
        $this->db->join('t_order_status', 't_order.order_status = t_order_status.order_status');
        $this->db->where('t_order.order_openid', $openid);
        $this->db->order_by('t_order.order_create_datetime', 'DESC');
        $query = $this->db->get();

        return $query->result_array();

    }

    public function getOrderListWithCondition($condition)
    {
        $openid = isset($_SERVER['HTTP_OPENID']) ? $_SERVER['HTTP_OPENID'] : '';
        $this->db->select(
            array(
                't_good.good_name',
                't_good.good_thumbnail',
                't_order.order_id',
                't_order.order_status',
                't_order.order_create_datetime',
                't_order_status.order_status_name',
                't_good_spec.good_spec_name',
                't_order_goodsinfo.order_good_qty',
                'format(t_order.order_amount/100,2) as order_amount_display'
            )
        );
        $this->db->from('t_order');
        $this->db->join('t_order_goodsinfo', 't_order.order_id = t_order_goodsinfo.order_id');
        $this->db->join('t_good', 't_order_goodsinfo.order_good_id = t_good.good_id');
        $this->db->join('t_good_spec', 't_order_goodsinfo.order_good_spec_id = t_good_spec.good_spec_seq and t_good.good_id = t_good_spec.good_id');
        $this->db->join('t_order_status', 't_order.order_status = t_order_status.order_status');
        $this->db->where('t_order.order_openid', $openid);
        if ($condition != '0') {
            $this->db->where('t_order.order_status', $condition);
        }
        $this->db->order_by('t_order.order_create_datetime', 'DESC');
        $query = $this->db->get();

        return $query->result_array();

    }

    public function getAllOrders($currentpage, $pagelimit)
    {
        $arr = array();

        $this->db->limit($pagelimit, ($currentpage - 1) * $pagelimit);

        $this->db->select(
            array(
                't_order.order_id',
                't_user_profile.user_nickname',
                'CONCAT(t_good.good_name," <br/> ",t_good_spec.good_spec_name) AS good_name_spec',
                't_order_goodsinfo.order_good_qty',
                'format(t_order.order_amount/100,2) AS order_amount',
                't_order.order_status',
                't_order.order_create_datetime',
                't_order.order_pay_datetime',
                't_order.order_cancel_datetime',
                't_order.order_refund_datetime',
                't_order.order_complete_datetime',
                't_order.order_contact_name',
                't_order.order_contact_tel',
                't_order.order_contact_add',
                't_order.order_express_no',
                't_order.order_remark'
            )
        );
        $this->db->from('t_order');
        $this->db->join('t_user_profile', 't_user_profile.user_openid = t_order.order_openid', 'left');
        $this->db->join('t_order_goodsinfo', 't_order_goodsinfo.order_id = t_order.order_id', 'left');
        $this->db->join('t_good', 't_good.good_id = t_order_goodsinfo.order_good_id', 'left');
        $this->db->join('t_good_spec', 't_good_spec.good_id = t_order_goodsinfo.order_good_id and t_good_spec.good_spec_seq = t_order_goodsinfo.order_good_spec_id', 'left');
        $this->db->order_by('t_order.order_create_datetime', 'DESC');
        $query = $this->db->get();

        $arr['arr'] = $query->result_array();

        $count = $this->db->count_all('t_order');
        $quotient = floor($count / $pagelimit);
        $remainder = $count % $pagelimit;

        $pagecount = $quotient + ($remainder == 0 ? 0 : 1);

        $arr['currentpage'] = $currentpage;

        $arr['pagecount'] = $pagecount;

        $arr['pagelimit'] = $pagelimit;

        if ($pagecount <= 10) {
            $arr['pagearr'] = array();
            for ($i = 1; $i <= $pagecount; $i++) {
                $arr['pagearr'][] = $i;
            }
        } else {
            if ($currentpage < 5 || $currentpage > $pagecount - 4) {
                $arr['pagearr'] = [1, 2, 3, 4, 5, '…', $pagecount - 4, $pagecount - 3, $pagecount - 2, $pagecount - 1, $pagecount];
            } else {
                $arr['pagearr'] = [1, 2, '…', $currentpage - 1, $currentpage, $currentpage + 1, '…', $pagecount - 1, $pagecount];
            }
        }

        return $arr;
    }

    public function updateOrderInfo($arr_order, $arr_goods)
    {
        $this->db->trans_start();

        $ins1 = $this->db->insert('t_order', $arr_order);
        $ins2 = $this->db->insert('t_order_goodsinfo', $arr_goods);

        $this->db->query('lock tables t_good_spec write;');
        $stock = $this->db->get_where(
            't_good_spec',
            array(
                'good_id' => $arr_goods['order_good_id'],
                'good_spec_seq' => $arr_goods['order_good_spec_id']
            )
        )->row()->good_spec_stock;
        $upd1 = $this->db->update(
            't_good_spec',
            array(
                'good_spec_stock' => $stock - $arr_goods['order_good_qty']
            ),
            array(
                'good_id' => $arr_goods['order_good_id'],
                'good_spec_seq' => $arr_goods['order_good_spec_id']
            )
        );
        $this->db->query('unlock tables;');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function updatePaySuccess($arr)
    {
        $data = array(
            'order_wxid' => $arr['transaction_id'],
            'order_status' => 2,
            'order_pay_datetime' => substr($arr['time_end'], 0, 4) . '-' .
                substr($arr['time_end'], 4, 2) . '-' .
                substr($arr['time_end'], 6, 2) . ' ' .
                substr($arr['time_end'], 8, 2) . ':' .
                substr($arr['time_end'], 10, 2) . ':' .
                substr($arr['time_end'], 12, 2)
        );

        $condition = array(
            'order_id' => $arr['out_trade_no'],
            'order_status' => '1'
        );

        $this->db->update('t_order', $data, $condition);

        return $this->db->affected_rows();
    }

    public function cancelUnpayOrder($orderid)
    {
        $this->db->update(
            't_order',
            array(
                'order_status' => 9,
                'order_cancel_datetime' => date('Y-m-d H:i:s')
            ),
            array(
                'order_id' => $orderid
            )
        );

        return $this->db->affected_rows();
    }

    public function addGoodComment($arr)
    {
        $ins = $this->db->insert('t_good_comment', $arr);

        return $ins;
    }

}