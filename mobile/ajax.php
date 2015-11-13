<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/26
 * Time: 13:09
 */
$mypath = $_SERVER['DOCUMENT_ROOT'] . '/mmzrb';   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
header("Content-Type:text/html; charset=utf-8");
session_start();

if(isset($_SESSION['customerId'])){
    if(isset($_POST['alterCart'])){
        pdoUpdate('cart_tbl',array('number'=>$_POST['number']),array('c_id'=>$_SESSION['customerId'],'d_id'=>$_POST['d_id']));
    }
    if(isset($_POST['deleteCart'])){
        pdoDelete('cart_tbl',array('c_id'=>$_SESSION['customerId'],'d_id'=>$_POST['d_id']));
    }
    if(isset($_POST['addAddr'])){

        $numbers=pdoUpdate('address_tbl',array('dft_a'=>0),array('c_id'=>$_SESSION['customerId']));
        if($numbers>9){
            pdoDelete('address_tbl',array('c_id'=>$_SESSION['customerId']),' limit 1');
        }
        $addrId=pdoInsert('address_tbl',array('c_id'=>$_SESSION['customerId'],'province'=>$_POST['province'],'city'=>$_POST['city'],
        'area'=>$_POST['area'],'address'=>$_POST['address'],'name'=>$_POST['name'],'phone'=>$_POST['phone'],'dft_a'=>1));
        echo $addrId;
        exit;

    }

}

if(isset($_POST['getdetailprice'])){
    $query=pdoQuery('user_detail_view',null,array('d_id'=>$_POST['d_id']),' limit 1');
    $row=$query->fetch();
//    $price=(null==$row['price']? -1:$row['price']);
    $inf=array(
      'price'=>$row['price'],
        'sale'=>$row['sale']
    );
    $data=json_encode($inf);
    echo $data;

}

if(isset($_POST['addToCart'])){
    if(isset($_SESSION['customerId'])){
            pdoInsert('cart_tbl',array('c_id'=>$_SESSION['customerId'],'g_id'=>$_POST['g_id'],'d_id'=>$_POST['d_id'],'number'=>$_POST['number']),
                ' ON DUPLICATE KEY UPDATE number='.$_POST['number']);
        if(isset($_SESSION['tempCart'])){

        }
    }else{
        $_SESSION['tempCart'][]=array('g_id'=>$_POST['g_id'],'d_id'=>$_POST['d_id'],'number'=>$_POST['number']);
    }
}

if(isset($_POST['adFilter'])){
    $adQuery=pdoQuery('(select * from user_ad_filt_view order by sale asc) p',null,array('mc_id'=>$_POST['mc_id']),' group by g_id limit 10');
    $inf=array();
    foreach ($adQuery as $row) {
        $inf[]=$row;
    }
    echo json_encode($inf);
    exit;

}