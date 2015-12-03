<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/20
 * Time: 11:44
 */
include_once '../includePackage.php';
//mylog(sha1('jsapi_ticket=sM4AOVdWfPE4DxkXGEs8VHdKKGs8cBwdqT7bMLcUAz5lTVbWQ2hbLyxAz7IIJjjeCEDFTis4DZP6Sqnh92TTLw&noncestr=ugZHU96K4AK9MEVG&timestamp=1448978919&url=http://115.29.202.69/'));
//exit;
session_start();
if(isset($_GET['c_id'])){
    $_SESSION['customerId']=$_GET['c_id'];
}
$config=getConfig('config/config.json');
$categoryQuery=pdoQuery('category_tbl',array('id','name'),array('remark'=>'home'),' order by id asc limit 5');
$promotionQuery=pdoQuery('(select * from user_pro_view order by price asc) p',null,null,
    ' where father_id in (select id from category_tbl where remark="home") group by g_id order by father_id');
$adQuery=pdoQuery('ad_tbl',null,null,'');
foreach ($adQuery as $adRow) {
    $adList[$adRow['category']][]=$adRow;
}
$proList=array();
foreach ($promotionQuery as $row) {
    if(!isset($proList[$row['father_id']])){
        $proList[$row['father_id']]=array();
    }
    if(count($proList[$row['father_id']])>8){
        continue;
    }else{
        $proList[$row['father_id']][]=$row;
    }



}

//$adQuery=pdoQuery('(select * from user_ad_view order by sale asc) p',null,null,' group by g_id limit 10');
//$random=getRandStr(5);
include 'view/index.html.php';