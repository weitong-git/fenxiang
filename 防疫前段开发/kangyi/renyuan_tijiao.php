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

if (!empty($_POST['post_bianhao'])
    and!empty($_POST['post_xingming'])
    and!empty($_POST['post_shouji'])
    and!empty($_POST['post_shenfenzheng'])
    and!empty($_POST['post_huji'])
    and!empty($_POST['post_zanzhu'])
    and!empty($_POST['post_fangdong'])){

    $post_bianhao = jinghua($_POST['post_bianhao']);
    $post_xingming = jinghua($_POST['post_xingming']);
    $post_shouji = jinghua($_POST['post_shouji']);
    $post_shenfenzheng = jinghua($_POST['post_shenfenzheng']);
    $post_huji = jinghua($_POST['post_huji']);
    $post_zanzhu = jinghua($_POST['post_zanzhu']);
    $post_fangdong = jinghua($_POST['post_fangdong']);

    $SQL_chazhao = "SELECT * FROM renyuan WHERE renyuan_id = '$post_bianhao'";

    $jieguo_chazhao = mysqli_query($shujuku_lianjie,  $SQL_chazhao);

    if ($jieguo_chazhao->num_rows<1){
        $sql_zengjia = "
    insert into renyuan 
(renyuan_id,
renyuan_xingming,
renyuan_shenfenzheng,
renyuan_dizhi,
renyuan_zanzhu,
renyuan_fangdong,
renyuan_shouji) 
value ('$post_bianhao','$post_xingming','$post_shenfenzheng','$post_huji','$post_zanzhu','$post_fangdong','$post_shouji')";

        $jieguo_zengjia = mysqli_query($shujuku_lianjie,  $sql_zengjia);
        if ($jieguo_zengjia){
            echo '添加成功';
        }else{
            echo '添加失败';
        }
    }else{
        echo '编号已使用';

    }



}else{
    echo '参数错误';
}
$shujuku_lianjie->close();



?>