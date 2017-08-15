<?php

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/2/23
 * Time: 23:02
 */
class Area_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function updateAreaInfo($areainfo)
    {
        $this->db->truncate('t_area');

        $result = $areainfo['result'];

        $cnt = 0;
        foreach ($result as $area) {
            $this->db->insert('t_area', $area);
            if ($this->db->affected_rows() == 1) {
                $cnt++;
            }
        }

        return $cnt;
    }

    public function level1()
    {
        $this->db->select(
            array(
                't_area.id',
                't_area.name')
        );
        $this->db->from('t_area');
        $this->db->where('t_area.depth', '1');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function level2($level1id)
    {
        $this->db->select(
            array(
                't_area.id',
                't_area.name')
        );
        $this->db->from('t_area');
        $this->db->where(
            array(
                't_area.depth' => '2',
                't_area.parentid' => $level1id
            )
        );
        $query = $this->db->get();

        return $query->result_array();
    }

    public function level3($level2id)
    {
        $this->db->select(
            array(
                't_area.id',
                't_area.name')
        );
        $this->db->from('t_area');
        $this->db->where(
            array(
                't_area.depth' => '3',
                't_area.parentid' => $level2id
            )
        );
        $query = $this->db->get();

        return $query->result_array();
    }
}