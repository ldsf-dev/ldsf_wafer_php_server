<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/2/27
 * Time: 18:14
 */
class Card extends CI_Controller
{
    /**
     *
     */
    public function index()
    {
        $this->load->model('Card_model');
    }

    public function generateonecard($cnosize = 10, $pwdsize = 6)
    {
        $this->load->helper('myutil');
        $this->load->model('Card_model');

        $cardno = createRandomNumStr($cnosize);
        $password = createRandomStr($pwdsize, true);

        $arr = array(
            'card_no' => $cardno,
            'card_password' => $password
        );

        echo $this->Card_model->addCard($arr);
    }

    public function generatecards($qty, $cnosize = 10, $pwdsize = 6)
    {
        $this->load->helper('myutil');
        $this->load->model('Card_model');

        $cnt = 0;
        for ($i = 0; $i < $qty; $i++) {
            $cardno = createRandomNumStr($cnosize);
            $password = createRandomStr($pwdsize, true);

            $arr = array(
                'card_no' => $cardno,
                'card_password' => $password
            );

            $ret = $this->Card_model->addCard($arr);

            $cnt = $cnt + $ret;
        }

        echo $cnt;
    }

    public function mycards()
    {
        $this->load->helper('myutil');
        $this->load->model('Card_model');

        $openid = isset($_SERVER['HTTP_OPENID']) ? $_SERVER['HTTP_OPENID'] : '';

        $arr = $this->Card_model->getCardsByUser($openid);

        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i]['card_no_display'] = formatcardno($arr[$i]['card_no']);
        }

        echo json_encode($arr);
    }

    public function all()
    {
        $this->load->model('Card_model');

        echo json_encode($this->Card_model->getAllCards());
    }

    public function createqrcode()
    {
        $this->load->helper('myutil');
        generateqrcode_individual('%2B%20%2F%3F%25%23%26%3D');
    }

    public function createqrcodebatch($startno, $endno)
    {
        $this->load->helper('myutil');
        $this->load->model('Card_model');
        $arr = $this->Card_model->getCardsBySerial($startno, $endno);

        $ret = '';
        foreach ($arr as $card) {
            $ret = $ret . generateqrcodewithencode($card['card_serialno'], $card['card_no'], $card['card_password']) . '<br/>';
        }

        echo $ret;
    }

    public function validate($cardno = '', $password = '')
    {
        $this->load->helper('myutil');
        $this->load->model('Card_model');

        $openid = isset($_SERVER['HTTP_OPENID']) ? $_SERVER['HTTP_OPENID'] : '';

        if ($cardno == '' && $password == '') {
            $str = isset($_SERVER['HTTP_VALIDATESTR']) ? $_SERVER['HTTP_VALIDATESTR'] : '';

            $arr_validate = $this->decodevalidatestr($str);

            $cardno = $arr_validate['cardno'];
            $password = $arr_validate['password'];
        }
        $ret = $this->Card_model->validateCard($openid, $cardno, $password);

        $arr = array();
        if ($ret == 1) {
            $arr['result'] = 'ok';
            $arr['cardno'] = $cardno;
            $this->Card_model->updateCardUser($openid, $cardno, $password);
        } else {
            $arr['result'] = 'ng:' . $ret;
        }

        echo json_encode($arr);
    }

    public function cardinfowithdecode()
    {
        $this->load->helper('myutil');

        $str = isset($_SERVER['HTTP_VALIDATESTR']) ? $_SERVER['HTTP_VALIDATESTR'] : '';

        $arr = $this->decodevalidatestr($str);

        echo $this->cardinfowithpassword($arr['cardno'], $arr['password']);
    }

    public function cardinfobyserial($serialno)
    {
        $this->load->model('Card_model');

        $arr = $this->Card_model->getCardnoBySerialno($serialno);

        echo $this->cardinfowithpassword($arr['card_no'], $arr['card_password']);
    }

    public function cardinfobyno($cardno)
    {
        $this->load->model('Card_model');
        $this->load->model('Good_model');

        $cardinfo = $this->Card_model->getCardByCardno($cardno);
        $goodinfo = $this->Good_model->getGood($cardinfo['card_goodid']);
        $goodspecinfo = $this->Good_model->getGoodSpec($cardinfo['card_goodid'], $cardinfo['card_goodspecid']);

        $ret = array(
            'goodinfo' => array(
                'goodname' => $goodinfo['good_name'],
                'goodspecname' => $goodspecinfo['good_spec_name']
            ),
            'cardinfo' => $cardinfo
        );

        return $ret;
    }

    public function cardinfowithpassword($cardno, $password)
    {
        $this->load->model('Card_model');
        $this->load->model('Good_model');

        $cardinfo = $this->Card_model->getCardByCardnoAndPassword($cardno, $password);
        $goodinfo = $this->Good_model->getGood($cardinfo['card_goodid']);
        $goodspecinfo = $this->Good_model->getGoodSpec($cardinfo['card_goodid'], $cardinfo['card_goodspecid']);

        $ret = array(
            'goodinfo' => array(
                'goodname' => $goodinfo['good_name'],
                'goodspecname' => $goodspecinfo['good_spec_name']
            ),
            'cardinfo' => $cardinfo
        );

        echo json_encode($ret);
    }

    public function carddeliveryinfo($cardno)
    {
        $this->load->model('Card_model');
        $this->load->model('Good_model');

        $openid = isset($_SERVER['HTTP_OPENID']) ? $_SERVER['HTTP_OPENID'] : '';

        $cardinfo = $this->Card_model->getCardByCardno($cardno);
        $carddeliinfo = $this->Card_model->getCardDeliveryInfo($cardno, $openid);
        $goodinfo = $this->Good_model->getGood($cardinfo['card_goodid']);
        $goodspecinfo = $this->Good_model->getGoodSpec($cardinfo['card_goodid'], $cardinfo['card_goodspecid']);

        $ret = array(
            'goodinfo' => array(
                'goodname' => $goodinfo['good_name'],
                'goodspecname' => $goodspecinfo['good_spec_name']
            ),
            'cardinfo' => $cardinfo,
            'carddeliinfo' => $carddeliinfo
        );

        echo json_encode($ret);
    }

    public function makedelivery()
    {
        log_message('LDSF', '>>> Card->makedelivery()');

        $this->load->helper('myutil');
        $this->load->model('Card_model');
        //file_get_contents("php://input")
        //$GLOBALS['HTTP_RAW_POST_DATA']

        $post_original = file_get_contents("php://input");
        $post = json_decode($post_original, true);

        log_message('LDSF', 'post=' . $post_original);

        if ($post['contactname'] != '' && $post['contacttel'] != '' && $post['contactaddress'] != '') {
            $now = date("YmdHis");

            $deliorderid = $now . createRandomNumStr(5) . 'c';

            if (isset($post['validatestr'])) {
                $arr_decode = $this->decodevalidatestr($post['validatestr']);
                $arr['card_deli_cardid'] = $arr_decode['cardno'];
            } else {
                $arr['card_deli_cardid'] = $post['cardno'];
            }

            $arr['card_deli_orderid'] = $deliorderid;
            $arr['card_deli_openid'] = $post['openid'];
            $arr['card_deli_contactname'] = $post['contactname'];
            $arr['card_deli_contacttel'] = $post['contacttel'];
            $arr['card_deli_contactaddress'] = str_replace("-请选择- ", "", $post['contactaddress']);;
            $arr['card_deli_expectdate'] = $post['expectdate'];
            $arr['card_deli_remark'] = $post['remark'];
            //$arr['card_deli_expressno'] = '';
            $arr['card_deli_status'] = '0';

            if ($this->Card_model->updateDelivery($arr, $arr['card_deli_cardid'], $arr['card_deli_openid']) == '1') {
                $arr_info = $this->cardinfobyno($arr['card_deli_cardid']);
                $goodname = $arr_info['goodinfo']['goodname'];
                $goodamount = 0;
                $orderid = $deliorderid;
                $orderdatetime = $now;
                $orderinfo = '收货人信息：' . $post['contactname'] . ' ' . $post['contacttel'] . ' ' . $post['contactaddress'] . ' 期望送货日期：' . $post['expectdate'];

                $token = getAccessToken();
                $data = '{"touser":"oXXigwgnK8gKdxAHhwW0Tew4xYEE","template_id":"6kvKkmkumq3-Tuw_RZxyvLWlsH5wUbESE4pX383E8PI","url":"http://weixin.qq.com/download","data":{"first":{"value":"有新的礼品券卡提货信息。","color":"#173177"},"keyword1":{"value":"' . $goodname . '","color":"#173177"},"keyword2":{"value":"' . $goodamount . '","color":"#173177"},"keyword3":{"value":"' . $orderid . '","color":"#173177"},"keyword4":{"value":"' . $orderdatetime . '","color":"#173177"},"keyword5":{"value":"' . $orderinfo . '","color":"#173177"},"remark":{"value":"请尽快处理","color":"#173177"}}}';
                $ret = https_request("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token", $data);
                echo '1';
            } else {
                echo '0';
            }
        } else {
            echo '-1';
        }

        //echo $this->Card_model->updateDelivery($arr, $arr['card_deli_cardid'], $arr['card_deli_openid']);
    }

    private function decodevalidatestr($str)
    {

        $decodedstr = encrypt($str, 'D', 'wx3c13313f866a541a');
        $pos = strpos($decodedstr, '&pwd=');
        $cardno = substr($decodedstr, 3, $pos - 3);
        $password = substr($decodedstr, $pos + 5);

        $arr = array(
            'cardno' => $cardno,
            'password' => $password
        );

        return $arr;
    }


    public function decodestr()
    {
        $this->load->helper('myutil');
        echo encrypt('BHQCN+1aC9hFOUj3OTrOa0aFDfVZQvKea9ZMqVhDh8o', 'D', 'wx3c13313f866a541a');
    }

    public function encodestr()
    {
        $this->load->helper('myutil');
        echo encrypt('no=3462501897&pwd=3CZ8JG', 'E', 'wx3c13313f866a541a');
    }


    public function escapetest()
    {
        $this->load->helper('myutil');
        echo escape_url('+ /?%#&=');
    }

}