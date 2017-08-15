<?php

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/3/16
 * Time: 0:24
 */
class Admin_model extends CI_Model
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getUserProfiles()
    {
        $this->db->select(
            array(
                't_user_profile.user_id AS ID',
                't_user_profile.user_avatar AS 微信头像',
                't_user_profile.user_nickname AS 微信昵称',
                't_user_profile.user_mobile AS 手机号',
                't_user_profile.user_sex AS 性别',
                't_user_profile.user_openid AS OpenID',
            )
        );
        $this->db->from('t_user_profile');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getUserLoginRecords()
    {
//        $this->db->select(
//            array(
//                't_user_login.user_id',
//                't_user_login.user_id',
//            )
//        );
        $this->db->from('t_user_login');
        $this->db->where('t_user_login.user_login_openid !=', 'oPicY0cBD5ZB89KieBFSH-PNddIE');
        $this->db->where('t_user_login.user_login_openid !=', 'oPicY0dtNCjgr9ot5nWbwbBUAIFI');
        $this->db->order_by('user_login_datetime', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getGoods()
    {
        $this->db->select(
            array(
                't_good.good_id',
                't_good.good_name',
                't_good.good_status',
            )
        );
        $this->db->from('t_good');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getGoodDetail($id)
    {
        $this->db->select(
            array(
                't_good.good_id AS 商品编号|good_id',
                't_good.good_cat_id AS 分类编号|good_cat_id',
                't_good.good_cat_inner_seq AS 序号|good_cat_inner_seq',
                't_good.good_type AS 商品类别|good_type',
                't_good.good_name AS 商品名称|good_name',
                't_good.good_desc AS 商品描述|good_desc',
                't_good.good_price AS 价格|good_price',
                't_good.good_status AS 商品状态|good_',
                't_good.good_onsale_datetime AS 上架时间|good_onsale_datetime',
                't_good.good_offsale_datetime AS 下架时间|good_offsale_datetime',
                't_good.good_thumbnail AS 缩略图|good_thumbnail',
                't_good.good_class_1 AS 分类1|good_class_1',
                't_good.good_class_2 AS 分类2|good_class_2',
                't_good.good_class_3 AS 分类3|good_class_3',
                't_good.good_class_4 AS 分类4|good_class_4',
                't_good.good_class_5 AS 分类5|good_class_5',
            )
        );
        $this->db->from('t_good');
        $this->db->where('t_good.good_id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function updateGoodDetail($arr)
    {
        return $this->db->update(
            't_good',
            $arr,
            array(
                'good_id' => $arr['good_id']
            )
        );
    }

    public function insertNewGood($arr)
    {
        return $this->db->insert(
            't_good',
            $arr
        );
    }

    public function updateAreaInfo($areainfo)
    {
        $this->db->truncate('t_area');

        $result = $areainfo['result'];

        $cnt = 0;

        foreach ($result as $area) {
            $this->db->insert('t_area', $area);
            if ($this->db->affected_rows() == 1) {
                $cnt++;
            }
        }

        return $cnt;
    }

    public function updateExpressNo($arr)
    {
        $cnt = 0;

        foreach ($arr as $orderid => $expressno) {
            if ($expressno != '') {
                $this->db->update(
                    't_card_deli',
                    array(
                        'card_deli_expressno' => $expressno
                    ),
                    array(
                        'card_deli_orderid' => $orderid
                    )
                );
                if ($this->db->affected_rows() == 1) {
                    $cnt++;
                }
            }
        }

        return $cnt;
    }

}