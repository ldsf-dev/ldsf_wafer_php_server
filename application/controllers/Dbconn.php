<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once "system/database/mysql_db.php";

class Dbconn extends CI_Controller {
    /**
     *
     */
    public function index() {
        $mysql_db = new mysql_db();
        if($mysql_db->init_db("")){
            echo "success";
        } else {
            echo "fail";
        }
    }
}
