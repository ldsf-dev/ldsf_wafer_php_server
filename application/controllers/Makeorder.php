<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Makeorder extends CI_Controller {
    /**
     *
     */
    public function index($id) {
        $this->load->model('Order_model');
        if($this->Order_model->mo($id) == 0)
        {
            if($this->Order_model->insert($id))
            {
                echo '1 data inserted';
            } else {
                echo 'insert error';
            }
        } else {
            echo 'data exists';
        };
    }

    public function insert($id) {
        $this->load->model('Order_model');
        $this->Order_model->insert($id);
    }

}
