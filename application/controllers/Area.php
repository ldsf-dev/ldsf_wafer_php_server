<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 礼待四方 - 省市区列表取得接口
 * User: jumpo
 * Date: 2017/2/23
 * Time: 23:33
 */
class Area extends CI_Controller
{
    /**
     *
     */
    public function index()
    {
        $this->load->model('Area_model');
    }

    /**
     * 一级列表（省）取得接口
     */
    public function getlevel1(){
        $this->load->model('Area_model');

        echo json_encode($this->Area_model->level1());
    }

    /**
     * 二级列表（市）取得接口
     */
    public function getlevel2($level1id){
        $this->load->model('Area_model');

        echo json_encode($this->Area_model->level2($level1id));
    }

    /**
     * 三级列表（区）取得接口
     */
    public function getlevel3($level2id){
        $this->load->model('Area_model');

        echo json_encode($this->Area_model->level3($level2id));
    }

}