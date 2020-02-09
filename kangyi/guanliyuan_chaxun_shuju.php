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



    $SQL_chazhao = "SELECT guanliyuan_id FROM guanliyuan WHERE guanliyuan_id = '$shoujihao' and guanliyuan_mima = '$mima'";

    $jieguo_chazhao = mysqli_query($shujuku_lianjie,  $SQL_chazhao);

    if ($jieguo_chazhao->num_rows>0){






        $SQL_chazhao = "SELECT
 sum(if(shuju.tiwen='1','1','0')) as chu,
 sum(if(shuju.tiwen='2','1','0')) as ru,
 sum(if(shuju.tiwen='3','1','0')) as yichang,
 shuju.riqi 
 FROM shuju INNER join renyuan INNER join caozuo 
 on shuju.renyuan_id = renyuan.renyuan_id 
 and caozuo.caozuo_id=shuju.caozuo_id 
 WHERE shuju.caozuo_id in 
 (SELECT caozuo.caozuo_id FROM guanliyuan INNER JOIN caozuo on  guanliyuan.guanliyuan_id=caozuo.guanliyuan_id  WHERE guanliyuan.guanliyuan_id = '$shoujihao')
  GROUP BY shuju.riqi ORDER BY shuju.riqi desc";

        $jieguo_chazhao = mysqli_query($shujuku_lianjie,  $SQL_chazhao);

        if ($jieguo_chazhao->num_rows>0){
            $array = array();
            while($shuzu = mysqli_fetch_array($jieguo_chazhao))
            {
                $array[]=$shuzu;
            }
            $jieguo =  json_encode($array);
            echo '{"zhuangtai":"1","xiangqing":'.decodeUnicode($jieguo).'}';
        }else{
            echo '{"zhuangtai":"3","xiangqing":"没有人员信息"}';
        }






    }else{
        echo '{"zhuangtai":"2","xiangqing":"账号错误"}';
    }
}else{
    echo '{"zhuangtai":"0","xiangqing":"参数错误"}';
}

$shujuku_lianjie->close();


?>