<?php

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/18
 * Time: 20:50
 */
class User_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getUserIdFromOpenId($openid)
    {

        $this->db->select(
            array(
                't_user_profile.user_id'
            )
        );
        $this->db->from('t_user_profile');
        $this->db->where('t_user_profile.user_openid', $openid);
        $query = $this->db->get();

        return $query->row()->user_id;
    }

    public function getUserProfile($openid)
    {

        $this->db->from('t_user_profile');
        $this->db->where('t_user_profile.user_openid', $openid);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function ifUserAddressbookIsEmpty($userid)
    {
        $this->db->from('t_user_address');
        $this->db->where('t_user_address.user_address_userid', $userid);
        $query = $this->db->count_all_results();

        return $query == 0;

    }

    public function getUserAddressbook($userid)
    {

        $this->db->from('t_user_address');
        $this->db->where('t_user_address.user_address_userid', $userid);
        $this->db->order_by('t_user_address.user_address_default', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getUserDefaultAddress($userid)
    {

        $this->db->from('t_user_address');
        $this->db->where(
            array(
                't_user_address.user_address_userid' => $userid,
                't_user_address.user_address_default' => '1'
            )
        );
        $query = $this->db->get();

        return $query->row_array();
    }

    public function getUserAddress($addressid)
    {

        $this->db->from('t_user_address');
        $this->db->where('t_user_address.user_address_id', $addressid);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function createUserAddress($userid, $level1, $level2, $level3, $detail, $name, $tel, $default)
    {

        $this->db->trans_start();
        $this->db->query('lock tables t_user_address write;');

        if ($default == '1') {

            $upd_default = $this->db->update(
                't_user_address',
                array(
                    'user_address_default' => 0
                ),
                array(
                    'user_address_userid' => $userid
                )
            );
        }

        $ins = $this->db->insert(
            't_user_address',
            array(
                'user_address_userid' => $userid,
                'user_address_level1' => $level1,
                'user_address_level2' => $level2,
                'user_address_level3' => $level3,
                'user_address_detail' => $detail,
                'user_address_name' => $name,
                'user_address_tel' => $tel,
                'user_address_default' => $default,
            )
        );

        $this->db->query('unlock tables;');
        $this->db->trans_complete();

        return $ins;
    }

    public function editUserAddress($addressid, $userid, $level1, $level2, $level3, $detail, $name, $tel, $default)
    {

        $this->db->trans_start();
        $this->db->query('lock tables t_user_address write;');


        if ($default == '1') {

            $upd_default = $this->db->update(
                't_user_address',
                array(
                    'user_address_default' => 0
                ),
                array(
                    'user_address_userid' => $userid
                )
            );
        }

        $upd = $this->db->update(
            't_user_address',
            array(
                'user_address_level1' => $level1,
                'user_address_level2' => $level2,
                'user_address_level3' => $level3,
                'user_address_detail' => $detail,
                'user_address_name' => $name,
                'user_address_tel' => $tel,
                'user_address_default' => $default,
            ),
            array(
                'user_address_userid' => $userid,
                'user_address_id' => $addressid
            )
        );

        $this->db->query('unlock tables;');
        $this->db->trans_complete();

        return $upd;
    }

    public function deleteUserAddress($addressid)
    {
        $del = $this->db->delete(
            't_user_address',
            array(
                'user_address_id' => $addressid
            )
        );

        return $del;
    }

    public function newUserProfile($arr)
    {
        return $this->db->insert('t_user_profile', $arr);
    }

    public function loginRecord(
        $openid,
        $nickname,
        $avatarurl,
        $gender,
        $city,
        $province,
        $country,
        $model,
        $pixelratio,
        $windowwidth,
        $windowheight,
        $language,
        $version,
        $system,
        $platform,
        $errmsg,
        $screenwidth,
        $screenheight,
        $sdkversion
    )
    {
        $arr = array(
            'user_login_openid' => $openid,
            'user_login_nickname' => $nickname,
            'user_login_avatar' => $avatarurl,
            'user_login_sex' => $gender,
            'user_login_city' => $city,
            'user_login_province' => $province,
            'user_login_country' => $country,
            'user_login_model' => $model,
            'user_login_pixelratio' => $pixelratio,
            'user_login_windowwidth' => $windowwidth,
            'user_login_windowheight' => $windowheight,
            'user_login_language' => $language,
            'user_login_version' => $version,
            'user_login_system' => $system,
            'user_login_platform' => $platform,
            'user_login_errmsg' => $errmsg,
            'user_login_screenwidth' => $screenwidth,
            'user_login_screenheight' => $screenheight,
            'user_login_sdkversion' => $sdkversion,
        );

        $ins = $this->db->insert('t_user_login', $arr);

        return $ins;
    }
}