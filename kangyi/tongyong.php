<?php
/**
 * Created by PhpStorm.
 * User: LHY
 * Date: 2019/11/30
 * Time: 21:27
 */
date_default_timezone_set('PRC');

function jinghua($zifuchuan){
    $zifuchuan = stripcslashes($zifuchuan);
    $zifuchuan =strip_tags($zifuchuan);
    $zifuchuan = htmlentities($zifuchuan);
    return $zifuchuan;
}


$quanju_sql_host = "localhost";
$quanju_sql_name = "lhy321";
$quanju_sql_passwd = "123456";
$quanju_sql_db = "kangyi";

function decodeUnicode($str)

{
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
}

?>