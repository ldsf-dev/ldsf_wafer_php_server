<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/17
 * Time: 16:36
 */
class Notify extends CI_Controller
{
    /**
     *
     */
    public function index()
    {
        $this->load->helper('myutil');
        $this->load->model('Order_model');
        log_message('error', 'notify start');

        $returnResult = $GLOBALS['HTTP_RAW_POST_DATA'];
        $convertedXml = FromXml($returnResult);
        $convertedArray = json_decode($convertedXml, true);

        if ($convertedArray['return_code'] == 'SUCCESS') {
            if ($convertedArray['result_code'] == 'SUCCESS') {

                $orderdata = $this->Order_model->getOrderDetail($convertedArray['out_trade_no']);

                $keyword1 = $orderdata['good_name'] . ' ' . $orderdata['good_spec_name'] . ' × ' . $orderdata['order_good_qty'];
                $keyword2 = $convertedArray['time_end'] . '（支付时间）';
                $keyword3 = $orderdata['order_contact_add'];
                $keyword4 = $orderdata['order_contact_name'] . ' ' . $orderdata['order_contact_tel'];
                $keyword5 = '支付成功，订单号：' . $convertedArray['out_trade_no'];

                $token = getAccessToken();
                $data = '{"touser":"oXXigwgnK8gKdxAHhwW0Tew4xYEE","template_id":"HyKBODK9iTcrKTMmrdFrv1FYa4x22nTRapyOigWLXK4","url":"http://weixin.qq.com/download","data":{"first":{"value":"有新的订单。","color":"#173177"},"keyword1":{"value":"' . $keyword1 . '","color":"#173177"},"keyword2":{"value":"' . $keyword2 . '","color":"#173177"},"keyword3":{"value":"' . $keyword3 . '","color":"#173177"},"keyword4":{"value":"' . $keyword4 . '","color":"#173177"},"keyword5":{"value":"' . $keyword5 . '","color":"#173177"},"remark":{"value":"请尽快处理","color":"#173177"}}}';
                https_request("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token", $data);
                if ($this->Order_model->updatePaySuccess($convertedArray) == 1) {
                    $ret = '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
                } else {
                    $ret = '';
                }

            } else {
                $ret = '';
            }
        } else {
            $ret = '';
        }

        $myfile = fopen("/data/savedfile/savedXML_" . date("YmdHis") . "_" . createRandomNumStr(5) . ".xml", "w") or die("Unable to open file!");
        fwrite($myfile, $convertedXml);
        //fwrite($myfile, $ret);
        fclose($myfile);

        log_message('error', 'notify end, id:' . $convertedArray['out_trade_no'] . ' wx_id:' . $convertedArray['transaction_id'] . ' ret:' . $ret);

        echo $ret;
    }

    public function testwritefile()
    {
        $myfile = fopen("/data/savedfile/newfile.txt", "w") or die("Unable to open file!");
        $txt = "Bill Gates\n";
        fwrite($myfile, $txt);
        $txt = "Steve Jobs\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }

}