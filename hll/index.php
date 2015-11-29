<?php

$mypath = $_SERVER['DOCUMENT_ROOT'] . '/mmzrb';   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
include_once $mypath . '/includes/mmzrb.php';

if (!isset($_SESSION['mq']) || !isset($_SESSION['smq'])) {
    init();
}
if (isset($_SESSION['login'])) {
    if (isset($_GET['add-goods'])) {
        printView('hll/view/addgoods.html.php', '添加货品');
        exit;
    }
    if (isset($_GET['goods-config'])) {
        printView('hll/view/goods_edit.html.php', '货品修改');
        exit;
    }
    if (isset($_GET['category-config'])) {
        $category=pdoQuery('category_tbl',null,null,null);
        printView('hll/view/category_config.html.php', '分类修改');
        exit;
    }
    if (isset($_GET['promotions'])) {
        printView('hll/view/promotions.html.php', '促销设置');
        exit;
    }
    if (isset($_GET['ad'])) {
        $adQuery = pdoQuery('ad_tbl', null, null, '');
        printView('hll/view/ad.html.php', '广告设置');
        exit;
    }
    if(isset($_GET['orders'])){
        $query=pdoQuery('express_tbl',null,null,'');
        foreach ($query as $row) {
            $expressQuery[]=$row;
        }

        $orderQuery=pdoQuery('order_view',null,array('stu'=>$_GET['orders']),'');
        printView('hll/view/orderManage.html.php','订单管理');
        exit;
    }
    if (isset($_GET['logout'])) {//登出
        session_unset();
        include 'view/login.html.php';
        exit;
    }
    printView('hll/view/admin_index.html.php');
    exit;
} else {
    if (isset($_GET['login'])) {
//        echo md5($_POST['adminName']).md5($_POST['password']);
        if (md5($_POST['adminName']) . md5($_POST['password']) == '9f6c470eab19fdca07401196068f78d554b51a86e539d9f8f711e67826ea60d5') {
            $_SESSION['login'] = 1;
            printView('hll/view/admin_index.html.php');
        }
        exit;
    }
    include 'view/login.html.php';
    exit;
}