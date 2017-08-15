<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/17
 * Time: 20:23
 */
class Phptest extends CI_Controller
{

    public function index()
    {
        $this->load->helper('myutil');

        $date = date("YmdHis") . createRandomNumStr(6);

        echo $date;
    }

    public function xmltoarray()
    {
        $xml = '<xml><return_code>SUCCESS</return_code>
<return_msg><![CDATA[OK]]></return_msg>
<appid><![CDATA[wx3c13313f866a541a]]></appid>
<mch_id><![CDATA[1368336002]]></mch_id>
<nonce_str><![CDATA[L4wXmZGqtIwP5Q3u]]></nonce_str>
<sign><![CDATA[05E4ED4D3CE075D3C4D78D9564606F3F]]></sign>
<result_code><![CDATA[SUCCESS]]></result_code>
<prepay_id><![CDATA[wx20170117173739d932561ae40539198562]]></prepay_id>
<trade_type><![CDATA[JSAPI]]></trade_type>
</xml>';
        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);

        $val = json_decode(json_encode($xmlstring), true);

        echo var_dump($val);
    }

    public function testarray()
    {
        $arr = array('c' => 'tom','a' => 'jerry','d' => 'mike','b' => 'zorro');
        ksort($arr);
        $strA = '';

        reset($arr);

        while (list($key, $val) = each($arr)) {
            $strA = $strA . '&' . $key . '=' . $val;
        }
        $strA = substr($strA, 1, strlen($strA) - 1);

        $stringSignTemp = $strA . '&key=MsoPw1ID8q3h0GHtAGKLkJgKxMPZC6cY';

        echo $stringSignTemp;
    }

    public function testdatetime()
    {
        $str = '20170120222204';
        echo date();
    }

    public function testtimestamp()
    {
        $timestamp = '1484905225627';
        echo date("Y-m-d H:i:s", $timestamp);
    }

    public function testdb()
    {
        $this->load->database();
        $arr = Array('str' => null);
        echo $this->db->insert('test',$arr);
    }


}