<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/20
 * Time: 11:44
 */
$mypath = $_SERVER['DOCUMENT_ROOT'] . '/mmzrb';   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
date_default_timezone_set('Asia/Shanghai');
header("Content-Type:text/html; charset=utf-8");
session_start();

if(isset($_GET['c_id'])){
    $_SESSION['customerId']=$_GET['c_id'];
}


$categoryQuery=pdoQuery('category_tbl',array('id','name'),null,' order by id asc limit 5');
$promotionQuery=pdoQuery('(select * from user_pro_view order by price asc) p',null,null,' group by g_id order by father_id');
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