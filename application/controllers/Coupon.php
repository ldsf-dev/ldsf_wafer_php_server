<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/5/12
 * Time: 19:00
 */
class Coupon extends CI_Controller
{
    /**
     *
     */
    public function index()
    {
        $this->load->model('Coupon_model');
    }

    public function mycoupons($goodid = null)
    {
        $this->load->model('Coupon_model');

        $openid = isset($_SERVER['HTTP_OPENID']) ? $_SERVER['HTTP_OPENID'] : '';

        $arr = $this->Coupon_model->getCouponsByUser($openid, $goodid);

        echo json_encode($arr);
    }

    public function mycoupon($goodid)
    {
        $this->load->model('Coupon_model');

        $openid = isset($_SERVER['HTTP_OPENID']) ? $_SERVER['HTTP_OPENID'] : '';

        $arr = $this->Coupon_model->getCouponByGoodId($openid, $goodid);

        echo json_encode($arr);
    }

    public function getcoupon($couponcatid)
    {
        $this->load->helper('myutil');
        $this->load->model('Coupon_model');

        if ($this->Coupon_model->ifcouponexists($couponcatid) > 0) {

            $openid = isset($_SERVER['HTTP_OPENID']) ? $_SERVER['HTTP_OPENID'] : '';

            $rnd = createRandomNumStr(5);

            $couponid = $couponcatid . date("YmdHis") . $rnd;

            $arr = array(
                'user_coupon_id' => $couponid,
                'user_coupon_userid' => $openid,
                'user_coupon_catid' => $couponcatid,
                'user_coupon_status' => '0',
            );

            echo $this->Coupon_model->addUserCoupon($arr);
        } else {
            echo '0';
        }
    }

    public function beenused($couponid){
        $this->load->model('Coupon_model');

        echo $this->Coupon_model->setCouponUsed($couponid);
    }
}