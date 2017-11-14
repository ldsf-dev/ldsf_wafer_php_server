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

    public function loadstringindex()
    {
        echo '{"data":[{"id":1,"name":"礼券验证","submenu":[{"id":2,"name":"手动验证","submenu":[]},{"id":3,"name":"扫码验证","submenu":[]}]},{"id":4,"name":"联系我们","submenu":[{"id":5,"name":"拨打热线","submenu":[]}]}]}';

    }

    public function loadstringcarddetail()
    {
        echo '{"data":{"cardinfo":"礼券信息","cardno":"礼券编号","cardstatus":"礼券状态","cardexpire":"有效日期","deliinfo":"提货信息","delicontactname":"收货人","delicontacttel":"联系电话","delicontactaddress":"联系地址","deliremark":"备注","addressbook":"从地址簿中选择","provincecity":"省/市/区","deliinfo":"提货信息","delidate":"提货日期","expectdate":"期望发货日期","goodinfo":"礼品信息","goodname":"礼品名称","goodurl":"礼品详情","goodspecname":"礼品规格","goodremark":"礼品说明","expressinfo":"物流信息","expressno":"物流单号","delivercompanyname":"物流公司","delivercompanytel":"联系电话","deliverdata":"物流追踪信息","delibuttontext":"确认提货","nodelibuttontext":"暂停提货"}}';

    }
}