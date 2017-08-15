<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/3/12
 * Time: 17:04
 */
class Article extends CI_Controller
{
    /**
     *
     */
    public function index()
    {
        $this->load->model('Article_model');
    }

    public function artlist($type)
    {
        $this->load->model('Article_model');

        echo json_encode($this->Article_model->getArticleList($type));
    }

    public function artdetail($id)
    {
        $this->load->model('Article_model');

        echo json_encode($this->Article_model->getArticleDetail($id));

    }

}