<?php

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/4
 * Time: 22:42
 */
class Good_model extends CI_Model
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getGoodsInfo($type, $version, $conditon)
    {
        if ($type == '1') {
            if ($version == 'publish' || $version == '') {
                $this->db->from('view_goodslist');
            } elseif ($version == 'test') {
                $this->db->from('view_goodslist_test');
            }
        } else if ($type == '2') {
            if ($version == 'publish' || $version == '') {
                $this->db->from('view_cardslist');
            } elseif ($version == 'test') {
                $this->db->from('view_cardslist_test');
            }
        }
        if ($conditon != '') {
            $this->db->where($conditon);
        }
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getGood($goodid)
    {
        $this->db->from('t_good');
        $this->db->where('good_id', $goodid);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function getGoodImages($goodid)
    {
        $this->db->select('good_image_url');
        $this->db->from('t_good_image');
        $this->db->where('good_id', $goodid);
        $this->db->order_by('good_image_seq');
        $query = $this->db->get();

        return array_column($query->result_array(), 'good_image_url');
    }

    public function getGoodSpecs($goodid)
    {
        //$this->db->select('good_spec_seq,good_spec_name,format(good_spec_price/100,2) as good_spec_price,good_spec_dispatch,good_spec_stock');
        $this->db->select(
            array(
                'good_spec_seq',
                'good_spec_name',
                'format(good_spec_price/100,2) as good_spec_price',
                'good_spec_dispatch',
                'good_spec_stock'
            )
        );
        $this->db->from('t_good_spec');
        $this->db->where('good_id', $goodid);
        $this->db->order_by('good_spec_seq');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getGoodSpec($goodid, $goodspecseq)
    {
        //$this->db->select('good_spec_name,format(good_spec_price/100,2) as good_spec_price_display,good_spec_price');
        $this->db->select(
            array(
                'good_spec_name',
                'good_spec_stock',
                'format(good_spec_price/100,2) as good_spec_price_display',
                'good_spec_price'
            )
        );
        $this->db->from('t_good_spec');
        $this->db->where(
            array(
                'good_id' => $goodid,
                'good_spec_seq' => $goodspecseq
            )
        );
        $query = $this->db->get();

        return $query->row_array();
    }

    public function getGoodSpecsNameList($goodid)
    {
        $this->db->select('good_spec_name');
        $this->db->from('t_good_spec');
        $this->db->where('good_id', $goodid);
        $this->db->order_by('good_spec_seq');
        $query = $this->db->get();

        return array_column($query->result_array(), 'good_spec_name');
    }

    public function getGoodComments($goodid, $num)
    {
        //$this->db->select('good_comment_nickname,good_comment_datetime,good_comment_detail,good_comment_score');
        $this->db->select(
            array(
                'good_comment_nickname',
                'good_comment_avatar',
                'good_comment_datetime',
                'good_comment_detail',
                'good_comment_score'
            )
        );
        $this->db->from('t_good_comment');
        $this->db->where('good_comment_good_id', $goodid);
        $this->db->order_by('good_comment_datetime', 'desc');
        if ($num != 0) {
            $this->db->limit($num);
        }
        $query = $this->db->get();

        return $query->result_array();
    }

    public function addGood($jsonData)
    {
        $dataArray = json_decode($jsonData);

        return $this->db->insert('t_good', $dataArray);
    }

}