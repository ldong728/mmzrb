<?php

include_once '../includePackage.php';
session_start();

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

        $db=new DB(DB_NAME,DB_USER,DB_PSW);
        $query=$db->pdoQuery('express_tbl',null,null,'');
        foreach ($query as $row) {
            $expressQuery[]=$row;
        }

        $orderQuery=$db->pdoQuery('order_view',null,array('stu'=>$_GET['orders']),'');
        printView('hll/view/orderManage.html.php','订单管理');
        exit;
    }
    if(isset($_GET['wechatConfig'])){
        printView('hll/view/wechatConfig.html.php','微信公众平台');
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