<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/15
 * Time: 18:01
 */
class Good extends CI_Controller
{
    /**
     *
     */
    public function index($goodid)
    {
        $this->load->model('Good_model');
        $result['goodinfo'] = $this->Good_model->getGood($goodid);
        $result['goodimageinfo'] = $this->Good_model->getGoodImages($goodid);
        $result['goodspecinfo'] = $this->Good_model->getGoodSpecs($goodid);
        //$result['goodspecnamelist'] = $this->Good_model->getGoodSpecsNameList($goodid);
        $result['goodcommentinfo'] = $this->Good_model->getGoodComments($goodid, 3);

        echo json_encode($result);
    }

    public function ordergoodinfo($goodid, $goodspecseq)
    {
        $this->load->model('Good_model');
        $result['goodinfo'] = $this->Good_model->getGood($goodid);
        $result['goodspecinfo'] = $this->Good_model->getGoodSpec($goodid, $goodspecseq);

        echo json_encode($result);
    }

    public function goodlist($type)
    {
        $this->load->model('Good_model');
        $this->config->load('config_ldsf');

        $version = $this->config->item('ldsf_phase');

        $post = json_decode(file_get_contents("php://input"), true);

        $condition = isset($post['searchcondition']) ? $post['searchcondition'] : '';

        if ($condition != '') {
            $condition = substr($condition, 5);
        }

        log_message('error', $condition);

        echo json_encode($this->Good_model->getGoodsInfo($type, $version, $condition));
    }

    public function test()
    {
        $this->config->load('config_ldsf');
        echo $this->config->item('ldsf_phase');
    }

}
