<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/22
 * Time: 18:13
 */
class Order extends CI_Controller
{
    /**
     *
     */
    public function index($orderid)
    {
        $this->load->model('Order_model');
        echo json_encode($this->Order_model->getOrderDetail($orderid));
    }

    public function orderlist()
    {
        $this->load->model('Order_model');
        echo json_encode($this->Order_model->getOrderList());
    }

    public function orderlistwithcondition($condition)
    {
        $this->load->model('Order_model');
        echo json_encode($this->Order_model->getOrderListWithCondition($condition));
    }

    public function cancelorder($orderid)
    {
        $this->load->model('Order_model');
        echo $this->Order_model->cancelUnpayOrder($orderid);
    }

    public function newcomment()
    {
        $orderid = isset($_SERVER['HTTP_PARAMORDERID']) ? $_SERVER['HTTP_PARAMORDERID'] : '';
        $goodid = isset($_SERVER['HTTP_PARAMGOODID']) ? $_SERVER['HTTP_PARAMGOODID'] : '';
        $goodspecid = isset($_SERVER['HTTP_PARAMGOODSPECID']) ? $_SERVER['HTTP_PARAMGOODSPECID'] : '';
        $nickname = urldecode(isset($_SERVER['HTTP_PARAMNICKNAME']) ? $_SERVER['HTTP_PARAMNICKNAME'] : '');
        $avatarurl = isset($_SERVER['HTTP_PARAMAVATARURL']) ? $_SERVER['HTTP_PARAMAVATARURL'] : '';
        $openid = isset($_SERVER['HTTP_PARAMOPENID']) ? $_SERVER['HTTP_PARAMOPENID'] : '';
        $datetime = date('Y-m-d H:i:s');
        $detail = urldecode(isset($_SERVER['HTTP_PARAMDETAIL']) ? $_SERVER['HTTP_PARAMDETAIL'] : '');
        $score = isset($_SERVER['HTTP_PARAMSCORE']) ? $_SERVER['HTTP_PARAMSCORE'] : '';

        log_message('error','newcomment');

        $arr = array(
            'good_comment_order_id' => $orderid,
            'good_comment_good_id' => $goodid,
            'good_comment_good_spec_id' => $goodspecid,
            'good_comment_nickname' => $nickname,
            'good_comment_avatar' => $avatarurl,
            'good_comment_openid' => $openid,
            'good_comment_datetime' => $datetime,
            'good_comment_detail' => $detail,
            'good_comment_score' => $score,
        );

        $this->load->model('Order_model');
        echo $this->Order_model->addGoodComment($arr);
    }
}