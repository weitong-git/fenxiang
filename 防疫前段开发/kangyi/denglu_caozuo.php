<?php
/**
 * Created by PhpStorm.
 * User: LHY
 * Date: 2019/11/30
 * Time: 22:49
 */

include_once 'tongyong.php';
$shujuku_lianjie = new mysqli($quanju_sql_host,$quanju_sql_name,$quanju_sql_passwd,$quanju_sql_db);
$shujuku_lianjie -> set_charset('utf8');

if (!empty($_POST['shoujihao'])and!empty($_POST['mima'])) {
    $shoujihao = jinghua($_POST['shoujihao']);
    $mima = jinghua($_POST['mima']);



    $SQL_chazhao = "SELECT caozuo_mingcheng FROM caozuo WHERE caozuo_id = '$shoujihao' and caozuo_mima = '$mima'";

    $jieguo_chazhao = mysqli_query($shujuku_lianjie,  $SQL_chazhao);

    if ($jieguo_chazhao->num_rows>0){
        $jieguo = '';
        while($shuzu = mysqli_fetch_array($jieguo_chazhao))
        {
            $jieguo=$shuzu['caozuo_mingcheng'];
        }
        echo '{"zhuangtai":"1","xiangqing":"'.decodeUnicode($jieguo).'"}';
    }else{
        echo '{"zhuangtai":"2","xiangqing":"没有"}';
    }
}else{
    echo '{"zhuangtai":"0","xiangqing":"参数错误"}';
}

$shujuku_lianjie->close();


?>