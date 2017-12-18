<?php

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/2/27
 * Time: 20:45
 */
class Card_model extends CI_Model
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function addCard($arr)
    {
        return $this->db->insert('t_card', $arr);
    }

    public function getAllCards()
    {
        $this->db->from('t_card');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getAllCardsPaging($currentpage, $pagelimit)
    {
        $arr = array();

        $this->db->limit($pagelimit, ($currentpage - 1) * $pagelimit);
        $this->db->select(
            array(
                't_card.card_serialno',
                't_card.card_no',
                't_card.card_password',
                't_card.card_status',
                't_card.card_goodremark',
                't_card.card_salesman',
                't_card.card_expire_starttime',
                't_card.card_expire_endtime',
                't_card.card_remark',
                't_user_profile.user_nickname',
                't_good.good_name',
                't_good_spec.good_spec_name'
            )
        );
        $this->db->from('t_card');
        $this->db->join('t_user_profile', 't_user_profile.user_openid = t_card.card_user', 'left');
        $this->db->join('t_good', 't_good.good_id = t_card.card_goodid', 'left');
        $this->db->join('t_good_spec', 't_good_spec.good_id = t_good.good_id and t_good_spec.good_spec_seq = t_card.card_goodspecid', 'left');
        $query = $this->db->get();
        $arr['arr'] = $query->result_array();
        $arr['data'] = $arr['arr'];

        $count = $this->db->count_all('t_card');
        $quotient = floor($count / $pagelimit);
        $remainder = $count % $pagelimit;

        $pagecount = $quotient + ($remainder == 0 ? 0 : 1);

        $arr['currentpage'] = $currentpage;

        $arr['pagecount'] = $pagecount;

        $arr['pagelimit'] = $pagelimit;

        $arr['countall'] = $count;

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

    public function getCardnoBySerialno($serialno)
    {
        $this->db->select('t_card.card_no');
        $this->db->select('t_card.card_password');
        $this->db->from('t_card');
        $this->db->where('t_card.card_serialno', $serialno);
        $query = $this->db->get();

        return $query->row_array();

    }

    public function getCardByCardno($cardno)
    {
        $this->db->select('t_card.card_goodid');
        $this->db->select('t_card.card_goodspecid');
        $this->db->select('t_card.card_status');
        $this->db->select('substring(t_card.card_expire_starttime,1,10) as card_expire_starttime');
        $this->db->select('substring(t_card.card_expire_endtime,1,10) as card_expire_endtime');
        $this->db->select('t_card.card_goodremark');
        $this->db->from('t_card');
        $this->db->where('t_card.card_no', $cardno);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function getCardByCardnoAndPassword($cardno, $password)
    {
        $this->db->select('t_card.card_goodid');
        $this->db->select('t_card.card_goodspecid');
        $this->db->select('t_card.card_status');
        $this->db->select('substring(t_card.card_expire_starttime,1,10) as card_expire_starttime');
        $this->db->select('substring(t_card.card_expire_endtime,1,10) as card_expire_endtime');
        $this->db->select('t_card.card_goodremark');
        $this->db->from('t_card');
        $this->db->where('t_card.card_no', $cardno);
        $this->db->where('t_card.card_password', $password);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function getCardsBySerial($startno, $endno)
    {
        $this->db->select(
            array(
                't_card.card_serialno',
                't_card.card_no',
                't_card.card_password'
            )
        );
        $this->db->from('t_card');
        $this->db->where('t_card.card_serialno BETWEEN ' . $startno . ' AND ' . $endno);
        $this->db->order_by('t_card.card_serialno');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getCardsByUser($openid)
    {
        $this->db->select(
            array(
                't_card.card_no',
                't_card.card_status',
                't_good.good_name',
                't_good_spec.good_spec_name'
            )
        );
        $this->db->from('t_card');
        $this->db->join('t_good', 't_good.good_id = t_card.card_goodid');
        $this->db->join('t_good_spec', 't_good_spec.good_id = t_good.good_id and t_good_spec.good_spec_seq = t_card.card_goodspecid');
        $this->db->where('t_card.card_user', $openid);
        $this->db->order_by('t_card.card_serialno', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getCardDeliveryInfo($cardno, $openid)
    {
        $this->db->from('t_card_deli');
        $this->db->where('t_card_deli.card_deli_cardid', $cardno);
        $this->db->where('t_card_deli.card_deli_openid', $openid);
        $query = $this->db->get();

        return $query->row_array();
    }


    public function getAllCardDeliveryInfo()
    {
        $this->db->select(
            array(
                't_card_deli.card_deli_expectdate AS 送货日',
                'CONCAT(t_good.good_name," / ",t_good_spec.good_spec_name) AS 商品规格',
                't_card_deli.card_deli_contactname AS 收货人',
                't_card_deli.card_deli_contacttel AS 电话',
                't_card_deli.card_deli_contactaddress AS 地址',
                't_card_deli.card_deli_cardid AS 卡号',
                't_card_deli.card_deli_datetime AS 提货时间'
            )
        );
        $this->db->from('t_card_deli');
        $this->db->join('t_card', 't_card.card_no = t_card_deli.card_deli_cardid');
        $this->db->join('t_good', 't_good.good_id = t_card.card_goodid');
        $this->db->join('t_good_spec', 't_good_spec.good_id = t_good.good_id and t_good_spec.good_spec_seq = t_card.card_goodspecid');
        $this->db->order_by('t_card_deli.card_deli_datetime', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getDeliveryInfoBySupplier($date, $supplier)
    {
        $this->db->select(
            array(
                't_card.card_suppliercd',
                't_card_deli.card_deli_contactname',
                't_card_deli.card_deli_contacttel',
                't_card_deli.card_deli_contactaddress',
            )
        );
        $this->db->from('t_card_deli');
        $this->db->where('t_card_deli.card_deli_expectdate', $date);
        $this->db->where('t_card.card_supplier', $supplier);
        $this->db->join('t_card', 't_card.card_no = t_card_deli.card_deli_cardid');
        $this->db->order_by('t_card_deli.card_deli_datetime', 'DESC');
        $query = $this->db->get();

        $res_html = '<html><body>';

        if ($query->num_rows() == 0) {
            $res_html = $res_html . '没有订单';

        } else {

            foreach ($query->result() as $row) {
                $res_html = $res_html . '<h1>' . $row->card_suppliercd . ":" . $row->card_deli_contactname . "," . $row->card_deli_contacttel . "," . $row->card_deli_contactaddress . "</h1>";
            }
        }

        $res_html = $res_html . '</body></html>';

        $res['html'] = $res_html;
        $res['num'] = $query->num_rows();

        return $res;
    }

    public function getAllCardDeliveryInfoPaging($currentpage, $pagelimit)
    {
        $arr = array();

        $this->db->limit($pagelimit, ($currentpage - 1) * $pagelimit);

        $this->db->select(
            array(
                //'t_card_deli.card_deli_orderid',
                't_card_deli.card_deli_expressno AS 物流单号',
                't_card_deli.card_deli_expectdate AS 送货日',
                'CONCAT(t_good.good_name," / ",t_good_spec.good_spec_name) AS 商品规格',
                't_card_deli.card_deli_contactname AS 收货人',
                't_card_deli.card_deli_contacttel AS 电话',
                't_card_deli.card_deli_contactaddress AS 地址',
                't_card_deli.card_deli_remark AS 备注',
                't_card_deli.card_deli_cardid AS 卡号',
                't_card.card_salesman AS 销售',
                't_card_deli.card_deli_datetime AS 提货时间'
            )
        );
        $this->db->from('t_card_deli');
        $this->db->join('t_card', 't_card.card_no = t_card_deli.card_deli_cardid');
        $this->db->join('t_good', 't_good.good_id = t_card.card_goodid');
        $this->db->join('t_good_spec', 't_good_spec.good_id = t_good.good_id and t_good_spec.good_spec_seq = t_card.card_goodspecid');
        $this->db->order_by('t_card_deli.card_deli_datetime', 'DESC');
        $query = $this->db->get();

        $arr['arr'] = $query->result_array();
        $arr['data'] = $arr['arr'];

        $count = $this->db->count_all('t_card_deli');
        $quotient = floor($count / $pagelimit);
        $remainder = $count % $pagelimit;

        $pagecount = $quotient + ($remainder == 0 ? 0 : 1);

        $arr['currentpage'] = $currentpage;

        $arr['pagecount'] = $pagecount;

        $arr['pagelimit'] = $pagelimit;

        $arr['countall'] = $count;

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

    public function getCardDeliveryInfoPagingWithCondition($currentpage, $pagelimit, $condition)
    {
        $arr = array();

        $this->db->limit($pagelimit, ($currentpage - 1) * $pagelimit);

        $this->db->select(
            array(
                't_card_deli.card_deli_orderid',
                't_card_deli.card_deli_expressno AS 物流单号',
                't_card_deli.card_deli_contactname AS 收货人',
                't_card_deli.card_deli_contacttel AS 电话',
                't_card_deli.card_deli_contactaddress AS 地址',
                't_card.card_suppliercd AS 标记'
            )
        );
        $this->db->from('t_card_deli');
        foreach ($condition as $con => $value) {
            $this->db->where($con, $value);
        }
        $this->db->join('t_card', 't_card.card_no = t_card_deli.card_deli_cardid');
        $this->db->join('t_good', 't_good.good_id = t_card.card_goodid');
        $this->db->join('t_good_spec', 't_good_spec.good_id = t_good.good_id and t_good_spec.good_spec_seq = t_card.card_goodspecid');
        $this->db->order_by('t_card_deli.card_deli_datetime', 'DESC');
        $query = $this->db->get();

        $arr['arr'] = $query->result_array();

        $count = $query->num_rows();
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


    public function validateCard($openid, $cardno, $password)
    {
        $this->db->from('t_card');
        $this->db->where('t_card.card_no', $cardno);
        $this->db->where('t_card.card_password', $password);
        $this->db->where_in(
            't_card.card_user',
            array(
                '',
                $openid
            )
        );
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function updateCardUser($openid, $cardno, $password)
    {
        return $this->db->update(
            't_card',
            array(
                't_card.card_user' => $openid
            ),
            array(
                't_card.card_no' => $cardno,
                't_card.card_password' => $password
            )
        );
    }

    public function updateDelivery($arr, $cardno, $openid)
    {
        $this->db->from('t_card_deli');
        $this->db->where('t_card_deli.card_deli_cardid', $cardno);
        $query = $this->db->count_all_results();

        if ($query == 0) {

            $this->db->trans_start();
            $ins = $this->db->insert('t_card_deli', $arr);
            $upd = $this->db->update(
                't_card',
                array(
                    't_card.card_status' => '3'
                ),
                array(
                    't_card.card_no' => $cardno,
                    't_card.card_user' => $openid
                )
            );
            $this->db->trans_complete();

            return $this->db->trans_status();
        } else {
            return 'duplicate deli';
        }
    }
}