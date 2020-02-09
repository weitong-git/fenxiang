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

if (!empty($_POST['shoujihao'])and!empty($_POST['mima'])and!empty($_POST['xingming'])and!empty($_POST['guanliyuan_zhanghao'])and!empty($_POST['guanliyuan_mima'])) {
    $shoujihao = jinghua($_POST['shoujihao']);
    $mima = jinghua($_POST['mima']);
    $xingming = jinghua($_POST['xingming']);
    $guanliyuan_zhanghao = jinghua($_POST['guanliyuan_zhanghao']);
    $guanliyuan_mima = jinghua($_POST['guanliyuan_mima']);



    $SQL_chazhao = "SELECT * FROM guanliyuan WHERE guanliyuan_id = '$guanliyuan_zhanghao' and guanliyuan_mima = '$guanliyuan_mima'";

    $jieguo_chazhao = mysqli_query($shujuku_lianjie,  $SQL_chazhao);

    if ($jieguo_chazhao->num_rows>0){


        $sql_zengjia = "
    insert into caozuo 
(guanliyuan_id,caozuo_id,caozuo_mingcheng,caozuo_mima) 
value ('$guanliyuan_zhanghao','$shoujihao','$xingming','$mima')";

        $jieguo_zengjia = mysqli_query($shujuku_lianjie,  $sql_zengjia);
        if ($jieguo_zengjia){
            echo '{"zhuangtai":"1","xiangqing":"添加成功"}';
        }else{
            echo '{"zhuangtai":"3","xiangqing":"添加失败"}';
        }

    }else{
        echo '{"zhuangtai":"2","xiangqing":"账号密码错误"}';
    }

}else{
    echo '{"zhuangtai":"0","xiangqing":"参数错误"}';
}
$shujuku_lianjie->close();



?>