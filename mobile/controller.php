<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/28
 * Time: 15:14
 */
$mypath = $_SERVER['DOCUMENT_ROOT'] . '/mmzrb';   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
header("Content-Type:text/html; charset=utf-8");
session_start();
if(isset($_SESSION['customerId'])){
    if(isset($_GET['settleAccounts'])){
        $goodsQuery=pdoQuery('user_cart_view',null,array('c_id'=>$_SESSION['customerId']),null);

        $addrQuery=pdoQuery('address_tbl',null,array('c_id'=>$_SESSION['customerId'],'dft_a'=>1),' limit 1');
        $totalPrice=0;
        $totalSave=0;
        foreach ($goodsQuery as $row) {

            if(isset($row['price'])){
                $price=$row['price'];
                $totalSave+=($row['sale']-$row['price'])*$row['number'];
            }else{
                $price=$row['sale'];
            }
            $thisPrice=$price*$row['number'];
            $totalPrice+=$thisPrice;
            $goodsList[]=array(
              'name'=>$row['name'],
                'category'=>$row['category'],
                'price'=>$price,
                'number'=>$row['number'],
                'total'=>$row['number']*$price,
                'url'=>$row['url']
            );
        }
        if($row=$addrQuery->fetch()){
            $addr='<p>'.$row['province'].$row['city'].$row['area'].'</p><p>'
                .$row['address'].'</p><p>联系人：'
            .$row['name'].'</p><p>联系电话：'.$row['phone'].'</p>'
                .'<div data-role="controlgroup" data-type="horizontal">'
            .'<a href="#" data-role="button"id="alter_addr">更换地址</a>'
            .'<a href="#addr" data-role="button"id="add_addr">添加地址</a>'
            .'</div>';
        }else{
            $addr='<p>当前没有已保存的收货地址</p>'
            .'<a href="#addr" data-role="button"id="add_addr">添加地址</a>';
        }
        include 'view/order.html.php';
        exit;
    }


}


//以下功能不需登录，不需判断$_SESSION['customerId']
if(isset($_GET['goodsdetail'])){
    $query=pdoQuery('user_g_inf_view',null,array('g_id'=>$_GET['g_id']),' limit 1');
    $inf=$query->fetch();
    $imgQuery=pdoQuery('g_image_tbl',null,array('g_id'=>$_GET['g_id']),null);
    if(isset($_GET['d_id'])){
        if(isset($_GET['number'])){
            $number=$_GET['number'];
            $fromCart=1;
        }else{
            $number=1;
            $fromCart=0;
        }
        $detailQuery=pdoQuery('user_detail_view',null,array('g_id'=>$_GET['g_id']),' and d_id != '.$_GET['d_id']);
        $query=pdoQuery('user_detail_view',null,array('d_id'=>$_GET['d_id']),null);
        $default=$query->fetch();
    }else{
        $number=1;
        $fromCart=0;
        $detailQuery=pdoQuery('user_detail_view',null,array('g_id'=>$_GET['g_id']),null);
        $default=$detailQuery->fetch();
    }
    include 'view/goods_inf.html.php';
    exit;
}
if(isset($_GET['getCart'])){
    if(isset($_SESSION['customerId'])){
        $cartlist=pdoQuery('user_cart_view',null,array('c_id'=>$_SESSION['customerId']),null);
        include 'view/cart.html.php';

    }else{
        //进入登录界面

    }
    exit;
}
