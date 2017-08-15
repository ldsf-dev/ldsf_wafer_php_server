<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/10
 * Time: 19:21
 */
class FuncList extends CI_Controller {
    /**
     *
     */
    public function index() {
        $this->load->model('Func_model');
        echo json_encode($this->Func_model->getFuncList());
    }

}
