<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/10
 * Time: 19:21
 */
class Goodslist extends CI_Controller
{
    /**
     *
     */
    public function index($version)
    {
        $this->load->model('Good_model');
        echo json_encode($this->Good_model->getGoodsInfo($version));
    }

}
