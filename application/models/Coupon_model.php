<?php

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/5/12
 * Time: 18:58
 */
class Coupon_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function addUserCoupon($arr)
    {
        return $this->db->insert('t_user_coupon', $arr);
    }

    public function getCouponsByUser($openid, $goodid)
    {
        $this->db->select(
            array(
                't_user_coupon.user_coupon_id',
                't_coupon.coupon_name',
                't_coupon.coupon_goodid',
                't_coupon.coupon_value',
                't_coupon.coupon_expire',
                't_coupon.coupon_ifunit',
                'format(t_coupon.coupon_value/100,2) as coupon_value_display',
                't_user_coupon.user_coupon_catid',
                't_user_coupon.user_coupon_status',
                't_good.good_name'
            )
        );
        $this->db->from('t_user_coupon');
        $this->db->join('t_coupon', 't_coupon.coupon_cat_id = t_user_coupon.user_coupon_catid');
        $this->db->join('t_good', 't_good.good_id = t_coupon.coupon_goodid');
        $this->db->where('t_user_coupon.user_coupon_userid', $openid);
        if ($goodid != null) {
            $this->db->where('t_coupon.coupon_goodid', $goodid);
            $this->db->where('t_user_coupon.user_coupon_status', '0');
        }
        $this->db->order_by('t_user_coupon.user_coupon_id', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getCouponByGoodId($openid, $goodid)
    {
        $this->db->select(
            array(
                't_user_coupon.user_coupon_id',
                't_coupon.coupon_name',
                't_coupon.coupon_value',
                't_coupon.coupon_ifunit',
                'format(t_coupon.coupon_value/100,2) as coupon_value_display',
            )
        );
        $this->db->from('t_user_coupon');
        $this->db->join('t_coupon', 't_coupon.coupon_cat_id = t_user_coupon.user_coupon_catid');
        $this->db->join('t_good', 't_good.good_id = t_coupon.coupon_goodid');
        $this->db->where('t_user_coupon.user_coupon_userid', $openid);
        $this->db->where('t_good.good_id', $goodid);
        $this->db->where('t_user_coupon.user_coupon_status', '0');
        $this->db->order_by('t_coupon.coupon_expire', 'DESC');
        $query = $this->db->get();

        return $query->row();
    }

    public function ifcouponexists($couponcatid)
    {
        $this->db->from('t_coupon');
        $this->db->where('t_coupon.coupon_cat_id', $couponcatid);
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function setCouponUsed($couponid)
    {
        return $this->db->update(
            't_user_coupon',
            array(
                't_user_coupon.user_coupon_status' => '1'
            ),
            array(
                't_user_coupon.user_coupon_id' => $couponid
            )
        );
    }
}