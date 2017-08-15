<?php

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/3/12
 * Time: 17:04
 */
class Article_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getArticleList($type)
    {
        $this->db->select(
            array(
                't_article.article_id',
                't_article.article_title',
                'left(t_article.article_create_datetime,16) as article_create_datetime',
                't_article.article_thumb',
                'replace(t_article.article_intro,"<p/>"," ") as intro_replaced',
            )
        );
        $this->db->from('t_article');
        switch ($type) {
            case 'all':
                break;
            case 'index':
                $this->db->where('article_index_show', '1');
                break;
        }
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getArticleDetail($id)
    {
        $this->db->select(
            array(
                't_article.article_id',
                't_article.article_title',
                't_article.article_author',
                'left(t_article.article_create_datetime,16) as article_create_datetime',
                't_article.article_thumb',
                't_article.article_intro',
                'replace(t_article.article_intro,"<p/>"," ") as intro_replaced',
                't_article.article_body',
            )
        );
        $this->db->from('t_article');
        $this->db->where('t_article.article_id', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

}