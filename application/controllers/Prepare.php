<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/2/23
 * Time: 22:55
 */
class Prepare extends CI_Controller
{
    /**
     *
     */
    public function index()
    {

    }

    public function getareainfofromapi()
    {
        $this->load->model('Area_model');
        $host = "http://jisuarea.market.alicloudapi.com";
        $path = "/area/all";
        $method = "GET";
        $appcode = "bf7eddb49cc04cd5b0e8f20155ec8385";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "";
        $bodys = "";
        $url = $host . $path;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $areainfo = json_decode(curl_exec($curl), true);
        echo $this->Area_model->updateAreaInfo($areainfo);
    }

    public function getdelivercompanynamefromapi($no)
    {
        $host = "https://ali-deliver.showapi.com";
        $path = "/fetchCom";
        $method = "GET";
        $appcode = "bf7eddb49cc04cd5b0e8f20155ec8385";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "nu=" . $no;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $arr = json_decode(curl_exec($curl), true);
        if ($arr['showapi_res_code'] == '0' && $arr['showapi_res_body']['ret_code'] == '0') {
            return $arr['showapi_res_body']['data'];
        } else {
            return [];
        }
    }

    public function getdeliverinfofromapi($company, $no)
    {
        $arr_companyname = $this->getdelivercompanynamefromapi($no);
        $ret = $arr_companyname;
        if (count($arr_companyname) != 0) {
            foreach ($arr_companyname as $company) {
                $host = "https://ali-deliver.showapi.com";
                $path = "/showapi_expInfo";
                $method = "GET";
                $appcode = "bf7eddb49cc04cd5b0e8f20155ec8385";
                $headers = array();
                array_push($headers, "Authorization:APPCODE " . $appcode);
                $querys = "com=" . $company['simpleName'] . "&nu=" . $no;
                $bodys = "";
                $url = $host . $path . "?" . $querys;

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_FAILONERROR, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                //curl_setopt($curl, CURLOPT_HEADER, true);
                if (1 == strpos("$" . $host, "https://")) {
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                }
                $arr = json_decode(curl_exec($curl), true);

                if ($arr['showapi_res_code'] == '0' && $arr['showapi_res_body']['ret_code'] == '0' && $arr['showapi_res_body']['flag']) {
                    break;
                }
            }
            //var_dump($arr);
            $arr_detail = $arr['showapi_res_body']['data'];
            $str_detail = '';
            foreach ($arr_detail as $item) {
                $str_detail = '【' . $item['time'] . '】  ' . $item['context'] . "\r\n" . $str_detail;
            }

            $str_tel = $arr['showapi_res_body']['tel'];
            $str_companyname = $arr['showapi_res_body']['expTextName'];

            $ret = json_encode(
                array(
                    'companyname' => $str_companyname,
                    'tel' => $str_tel,
                    'detail' => $str_detail,
                )
            );
        }
        echo $ret;
    }
}