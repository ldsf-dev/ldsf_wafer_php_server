<?php

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/4
 * Time: 22:42
 */
class Func_model extends CI_Model
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getFuncList()
    {
        $this->db->from('t_ufunc');
        $this->db->where('ufunc_visible', 1);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function addGood($jsonData)
    {
        $dataArray = json_decode($jsonData);

        return $this->db->insert('t_ufunc',$dataArray);
    }

}