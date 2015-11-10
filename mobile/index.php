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
header("Content-Type:text/html; charset=utf-8");
session_start();

if(isset($_GET['c_id'])){
    $_SESSION['customerId']=$_GET['c_id'];
}


$categoryQuery=pdoQuery('category_tbl',array('id','name'),null,'');
$promotionQuery=pdoQuery('(select * from user_pro_view order by price asc) p',null,null,' group by g_id');
$adQuery=pdoQuery('(select * from user_ad_view order by sale asc) p',null,null,' group by g_id');
//$random=getRandStr(5);
include 'view/index.html.php';