<?php

//$mypath = $_SERVER['DOCUMENT_ROOT'] ; //用于phpstorm调试
$mypath = $_SERVER['DOCUMENT_ROOT'] . '/mmzrb';   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
include_once $mypath . '/includes/mmzrb.php';


//session_start();

if (isset($_GET['add-goods'])) {

    printView('hll/view/addgoods.html.php','添加货品');
    exit;

}
if (isset($_GET['goods-config'])) {
    printView('hll/view/goods_edit.html.php','货品修改');
    exit;
}
if(isset($_GET['category-config'])){
    printView('hll/view/category_config.html.php','分类修改');
    exit;
}
if(isset($_GET['promotions'])){
    printView('hll/view/promotions.html.php','促销设置');
    exit;
}
if(isset($_GET['ad'])){
    printView('hll/view/ad.html.php','广告设置');
    exit;
}
if (!isset($_SESSION['mq']) || !isset($_SESSION['smq'])) {
    init();
}
printView('hll/view/admin_index.html.php');
