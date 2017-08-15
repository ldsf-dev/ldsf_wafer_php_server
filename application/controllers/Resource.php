<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/5/16
 * Time: 23:38
 */
class Resource extends CI_Controller
{
    /**
     *
     */
    public function index()
    {
        $this->load->model('Resource_model');
    }

    public function loadstring()
    {
        //$this->load->model('Resource_model');

        echo '{"data":[{"id":1,"name":"礼券验证","submenu":[{"id":2,"name":"手动验证","submenu":[]},{"id":3,"name":"扫码验证","submenu":[]}]},{"id":4,"name":"联系我们","submenu":[{"id":5,"name":"拨打热线","submenu":[]}]}]}';

    }

}