<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/22
 * Time: 0:53
 */
class Orderlist extends CI_Controller
{
    /**
     *
     */
    public function index()
    {
        $this->load->model('Order_model');
        echo json_encode($this->Order_model->getOrderList());
    }

}