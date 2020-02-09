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

if (!empty($_POST['shoujihao'])and!empty($_POST['mima'])and!empty($_POST['bianhao'])and!empty($_POST['leixing'])) {
    $shoujihao = jinghua($_POST['shoujihao']);
    $mima = jinghua($_POST['mima']);
    $bianhao = jinghua($_POST['bianhao']);
    $leixing = jinghua($_POST['leixing']);



    $SQL_chazhao = "SELECT * FROM caozuo WHERE caozuo_id = '$shoujihao' and caozuo_mima = '$mima'";

    $jieguo_chazhao = mysqli_query($shujuku_lianjie,  $SQL_chazhao);

    if ($jieguo_chazhao->num_rows>0){


        $SQL_chazhao = "SELECT * FROM renyuan WHERE renyuan_id = '$bianhao'";

        $jieguo_chazhao = mysqli_query($shujuku_lianjie,  $SQL_chazhao);

        if ($jieguo_chazhao->num_rows>0){


            $dangqian_riqi = date("Y-m-d");
            $dangqian_shijian = date("H:i:s");

            $sql_zengjia = "
    insert into shuju 
(riqi,shijian,renyuan_id,caozuo_id,tiwen) 
value ('$dangqian_riqi','$dangqian_shijian','$bianhao','$shoujihao','$leixing')";

            $jieguo_zengjia = mysqli_query($shujuku_lianjie,  $sql_zengjia);
            if ($jieguo_zengjia){
                echo '{"zhuangtai":"1","xiangqing":"添加成功"}';
            }else{
                echo '{"zhuangtai":"3","xiangqing":"添加失败"}';
            }

        }else{
            echo '{"zhuangtai":"2","xiangqing":"编号错误"}';
        }

    }else{
        echo '{"zhuangtai":"2","xiangqing":"账号密码错误"}';
    }

}else{
    echo '{"zhuangtai":"0","xiangqing":"参数错误"}';
}
$shujuku_lianjie->close();



?>