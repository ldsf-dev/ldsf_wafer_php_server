<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/18
 * Time: 20:58
 */
class User extends CI_Controller
{
    /**
     *
     */
    public function index()
    {

    }

    public function profile()
    {
        log_message('LDSF', '>>> User->profile()');

        $this->load->model('User_model');

        $openid = $_SERVER['HTTP_OPENID'];

        log_message('LDSF', 'openid=' . $openid);

        echo json_encode($this->User_model->getUserProfile($openid));
    }

    public function addressbookisempty()
    {
        log_message('LDSF', '>>> User->addressbookisempty()');

        $this->load->model('User_model');

        $openid = $_SERVER['HTTP_OPENID'];

        log_message('LDSF', 'openid=' . $openid);

        $userid = $this->User_model->getUserIdFromOpenId($openid);

        echo json_encode($this->User_model->ifUserAddressbookIsEmpty($userid));

    }

    public function addressbook($opt)
    {
        log_message('LDSF', '>>> User->addressbook() opt=' . $opt);

        $this->load->model('User_model');

        $openid = $_SERVER['HTTP_OPENID'];

        log_message('LDSF', 'openid=' . $openid);

        $userid = $this->User_model->getUserIdFromOpenId($openid);

        if ($opt == "all") {
            echo json_encode($this->User_model->getUserAddressbook($userid));
        } elseif ($opt == "default") {
            echo json_encode($this->User_model->getUserDefaultAddress($userid));
        }

    }

    public function address($addressid)
    {
        log_message('LDSF', '>>> User->address() addressid=' . $addressid);

        $this->load->model('User_model');

        echo json_encode($this->User_model->getUserAddress($addressid));

    }

    public function defaultaddress($userid)
    {
        log_message('LDSF', '>>> User->defaultaddress() userid=' . $userid);

        $this->load->model('User_model');

        echo json_encode($this->User_model->getUserDefaultAddress($userid));

    }

    public function addressmodify($insupd, $addressid = '')
    {
        log_message('LDSF', '>>> User->addressmodify() insupd=' . $insupd . ' addressid=' . $addressid);

        $this->load->model('User_model');

        $userid = $this->User_model->getUserIdFromOpenId(isset($_SERVER['HTTP_PARAMOPENID']) ? $_SERVER['HTTP_PARAMOPENID'] : '');
        $level1 = urldecode(isset($_SERVER['HTTP_PARAMLEVEL1']) ? $_SERVER['HTTP_PARAMLEVEL1'] : '');
        $level2 = urldecode(isset($_SERVER['HTTP_PARAMLEVEL2']) ? $_SERVER['HTTP_PARAMLEVEL2'] : '');
        $level3 = urldecode(isset($_SERVER['HTTP_PARAMLEVEL3']) ? $_SERVER['HTTP_PARAMLEVEL3'] : '');
        $detail = urldecode(isset($_SERVER['HTTP_PARAMDETAIL']) ? $_SERVER['HTTP_PARAMDETAIL'] : '');
        $name = urldecode(isset($_SERVER['HTTP_PARAMNAME']) ? $_SERVER['HTTP_PARAMNAME'] : '');
        $tel = isset($_SERVER['HTTP_PARAMTEL']) ? $_SERVER['HTTP_PARAMTEL'] : '';
        $default = isset($_SERVER['HTTP_PARAMDEFAULT']) ? $_SERVER['HTTP_PARAMDEFAULT'] : '';

        log_message('LDSF', 'openid=' . $_SERVER['HTTP_PARAMOPENID']);
        log_message('LDSF', 'userid=' . $userid);
        log_message('LDSF', 'level1=' . $level1);
        log_message('LDSF', 'level2=' . $level2);
        log_message('LDSF', 'level3=' . $level3);
        log_message('LDSF', 'detail=' . $detail);
        log_message('LDSF', 'name=' . $name);
        log_message('LDSF', 'tel=' . $tel);
        log_message('LDSF', 'default=' . $default);

        if ($insupd == 'i') {
            if ($this->User_model->ifUserAddressbookIsEmpty($userid)) {
                $default = 1;
            }
            echo json_encode($this->User_model->createUserAddress($userid, $level1, $level2, $level3, $detail, $name, $tel, $default));
        } else {
            echo json_encode($this->User_model->editUserAddress($addressid, $userid, $level1, $level2, $level3, $detail, $name, $tel, $default));
        }

    }

    public function addressremove($addressid)
    {
        log_message('LDSF', '>>> User->addressremove() addressid=' . $addressid);

        $this->load->model('User_model');

        echo json_encode($this->User_model->deleteUserAddress($addressid));

    }

    public function loginrecord()
    {
        log_message('LDSF', '>>> User->loginrecord()');

        $openid = isset($_SERVER['HTTP_OPENID']) ? $_SERVER['HTTP_OPENID'] : '';
        $nickname = urldecode(isset($_SERVER['HTTP_NICKNAME']) ? $_SERVER['HTTP_NICKNAME'] : '');
        $avatarurl = isset($_SERVER['HTTP_AVATARURL']) ? $_SERVER['HTTP_AVATARURL'] : '';
        $gender = isset($_SERVER['HTTP_GENDER']) ? $_SERVER['HTTP_GENDER'] : '';
        $city = isset($_SERVER['HTTP_CITY']) ? $_SERVER['HTTP_CITY'] : '';
        $province = isset($_SERVER['HTTP_PROVINCE']) ? $_SERVER['HTTP_PROVINCE'] : '';
        $country = isset($_SERVER['HTTP_COUNTRY']) ? $_SERVER['HTTP_COUNTRY'] : '';
        $model = isset($_SERVER['HTTP_MODEL']) ? $_SERVER['HTTP_MODEL'] : '';
        $pixelratio = isset($_SERVER['HTTP_PIXELRATIO']) ? $_SERVER['HTTP_PIXELRATIO'] : '';
        $windowwidth = isset($_SERVER['HTTP_WINDOWWIDTH']) ? $_SERVER['HTTP_WINDOWWIDTH'] : '';
        $windowheight = isset($_SERVER['HTTP_WINDOWHEIGHT']) ? $_SERVER['HTTP_WINDOWHEIGHT'] : '';
        $language = isset($_SERVER['HTTP_LANGUAGE']) ? $_SERVER['HTTP_LANGUAGE'] : '';
        $version = isset($_SERVER['HTTP_VERSION']) ? $_SERVER['HTTP_VERSION'] : '';
        $system = isset($_SERVER['HTTP_SYSTEM']) ? $_SERVER['HTTP_SYSTEM'] : '';
        $platform = isset($_SERVER['HTTP_PLATFORM']) ? $_SERVER['HTTP_PLATFORM'] : '';
        $errmsg = isset($_SERVER['HTTP_ERRMSG']) ? $_SERVER['HTTP_ERRMSG'] : '';
        $screenwidth = isset($_SERVER['HTTP_SCREENWIDTH']) ? $_SERVER['HTTP_SCREENWIDTH'] : ''; // 1.1.0+
        $screenheight = isset($_SERVER['HTTP_SCREENHEIGHT']) ? $_SERVER['HTTP_SCREENHEIGHT'] : ''; // 1.1.0+
        $sdkversion = isset($_SERVER['HTTP_SDKVERSION']) ? $_SERVER['HTTP_SDKVERSION'] : ''; // 1.1.0+

        log_message('LDSF', 'openid=' . $openid);

        $this->load->model('User_model');

        if (count($this->User_model->getUserProfile($openid)) == 0) {
            $this->User_model->newUserProfile(
                array(
                    'user_openid' => $openid,
                    'user_nickname' => $nickname,
                    'user_sex' => $gender,
                    'user_avatar' => $avatarurl
                )
            );
        }

        echo json_encode($this->User_model->loginRecord(
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
        );

    }

}