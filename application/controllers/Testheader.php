<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/1/11
 * Time: 2:12
 */
class Testheader extends CI_Controller {
    public function index(){
        $para1 = $_SERVER['HTTP_TESTHEADER'];
        $para2 = $_SERVER['HTTP_HEADER2'];

        echo strtoupper($para1).'_'.$para2;
    }
}