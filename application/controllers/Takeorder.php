<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/16
 * Time: 23:12
 */
class Takeorder extends CI_Controller
{
    /**
     *
     */
    public function index()
    {
        $this->load->helper('myutil');

        // API说明详见：https://pay.weixin.qq.com/wiki/doc/api/wxa/wxa_api.php?chapter=9_1
        $appid = 'wx3c13313f866a541a'; // 小程序ID
        $mch_id = '1368336002'; // 商户号
        $device_info = ''; // 设备号（非必须）
        $nonce_str = createRandomStr(32); // 随机字符串
        $sign_type = 'MD5'; // 签名类型（非必须）
        $body = urldecode($_SERVER['HTTP_PARAMBODY']); // 商品描述
        $detail = urldecode($_SERVER['HTTP_PARAMDETAIL']); // 商品详情（非必须）
        $attach = ''; // 附加数据（非必须）
        $out_trade_no = date("YmdHis") . createRandomNumStr(6); // 商户订单号
        $fee_type = 'CNY'; // 货币类型（非必须）
        $total_fee = $_SERVER['HTTP_PARAMAMOUNT']; // 总金额
        $spbill_create_ip = $_SERVER["REMOTE_ADDR"]; // 终端IP
        $time_start = $_SERVER['HTTP_PARAMTIMESTAMP']; // 交易起始时间（非必须）
        $time_expire = (int)$_SERVER['HTTP_PARAMTIMESTAMP'] + 1800000; // 交易结束时间（非必须）
        $goods_tag = ''; // 商品标记（非必须）
        $notify_url = 'https://64458061.gift4fang.com/notify'; // 通知地址
        $trade_type = 'JSAPI'; // 交易类型
        $limit_pay = ''; // 指定支付方式（非必须）
        $openid = $_SERVER['HTTP_PARAMOPENID']; // 用户标识

        log_message('error', $detail);

        $array_request = array(
            "appid" => $appid,
            "mch_id" => $mch_id,
            "nonce_str" => $nonce_str,
            "body" => $body,
            "out_trade_no" => $out_trade_no,
            "total_fee" => $total_fee,
            "spbill_create_ip" => $spbill_create_ip,
            "notify_url" => $notify_url,
            "trade_type" => $trade_type,
            "openid" => $openid
        );

        if ($device_info != '') {
            $array_request['device_info'] = $device_info;
        }

        if ($sign_type != '') {
            $array_request['sign_type'] = $sign_type;
        }

        if ($detail != '') {
            $array_request['detail'] = $detail;
        }

        if ($attach != '') {
            $array_request['attach'] = $attach;
        }

        if ($fee_type != '') {
            $array_request['fee_type'] = $fee_type;
        }

        if ($time_start != '') {
            $array_request['time_start'] = date('YmdHis', substr($time_start, 0, 10));
        }

        if ($time_expire != '') {
            $array_request['time_expire'] = date('YmdHis', substr($time_expire, 0, 10));
        }

        if ($goods_tag != '') {
            $array_request['goods_tag'] = $goods_tag;
        }

        if ($limit_pay != '') {
            $array_request['limit_pay'] = $limit_pay;
        }

        $sign = generate_signature($array_request); // 签名

        $array_request['sign'] = $sign;

        $ret = FromXml(http_post('https://api.mch.weixin.qq.com/pay/unifiedorder', arrayToXml($array_request)));

        $array_ret = json_decode($ret, true);
        $array_ret['order_id'] = $out_trade_no;
        $prepayid = $array_ret['prepay_id'];

        $ret = json_encode($array_ret);

        $myfile = fopen("/data/savedfile/preorder_" . date("YmdHis") . "_" . createRandomNumStr(5) . ".xml", "w") or die("Unable to open file!");
        fwrite($myfile, $ret);
        fclose($myfile);

        $arr_order = [];

        $arr_order['order_id'] = $out_trade_no; // 订单号
        $arr_order['order_prepayid'] = $prepayid; // 预支付交易号
        $arr_order['order_amount'] = $total_fee; // 订单金额
        $arr_order['order_pay_method'] = 1; // 订单支付方式
        $arr_order['order_status'] = 1; // 订单状态
        $arr_order['order_create_datetime'] = date('Y-m-d H:i:s', substr($time_start, 0, 10)); // 订单下单时间
        $arr_order['order_openid'] = $openid; // OpenID
        $arr_order['order_contact_name'] = urldecode($_SERVER['HTTP_PARAMCONTACTNAME']); // 订单联系人
        $arr_order['order_contact_tel'] = urldecode($_SERVER['HTTP_PARAMCONTACTTEL']); // 订单联系电话
        $arr_order['order_contact_add'] = urldecode($_SERVER['HTTP_PARAMCONTACTADDRESS']); // 订单联系地址
        $arr_order['order_remark'] = urldecode($_SERVER['HTTP_PARAMREMARK']); // 订单备注


        $arrdetail = json_decode($detail, true);
        log_message('error', $arrdetail['goods_detail'][0]['goods_id']);

        $arr_goods = [];

        $arr_goods['order_id'] = $out_trade_no; // 订单ID
        $arr_goods['order_good_id'] = $arrdetail['goods_detail'][0]['goods_id']; // 订单商品ID
        $arr_goods['order_good_spec_id'] = $arrdetail['goods_detail'][0]['body']; // 订单商品规格ID
        $arr_goods['order_good_qty'] = $arrdetail['goods_detail'][0]['quantity']; // 订单商品数量

        $this->load->model('Order_model');
        $this->Order_model->updateOrderInfo($arr_order, $arr_goods);

        echo $ret;
    }

    public function fgc()
    {
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $html = file_get_contents($url);
        echo $html;
    }

}
