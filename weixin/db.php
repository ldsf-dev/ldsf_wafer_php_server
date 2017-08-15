<?php
/**
 * Created by PhpStorm.
 * User: jumpo
 * Date: 2017/8/12
 * Time: 20:20
 */

function db_connect($host = "10.66.184.208", $user = "root", $password = "CEGHNi3OQS2y", $base = "ldsf")
{
    $con = mysqli_connect($host, $user, $password);

    if (!$con) {
        return false;
    } else {
        mysqli_query($con, "set names 'utf8'");
        mysqli_select_db($con, $base);

        return $con;
    }

}

function db_query($con, $query)
{
    return mysqli_query($con, $query);
}