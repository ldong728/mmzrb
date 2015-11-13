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
        $arr=getCartDetail($_SESSION['customerId']);
        $totalPrice=$arr['totalPrice'];
        $totalSave=$arr['totalSave'];
        $goodsList=$arr['goodsList'];

        $addrQuery=pdoQuery('address_tbl',null,array('c_id'=>$_SESSION['customerId'],'dft_a'=>1),' limit 1');
        if($addrrow=$addrQuery->fetch()){
            $addr='<p>'.$addrrow['province'].$addrrow['city'].$addrrow['area'].'</p><p>'
                .$addrrow['address'].'</p><p>联系人：'
            .$addrrow['name'].'</p><p>联系电话：'.$addrrow['phone'].'</p>'
                .'<div data-role="controlgroup" data-type="horizontal">'
            .'<a href="#addr-alt" data-role="button"id="alter_addr">修改地址</a>'
                .'<a href="controller.php?changeAddr=1" data-role="button"id="change_addr">更换地址</a>'
            .'<a href="#addr-add" data-role="button">添加地址</a>'
            .'</div>';
        }else{
            $addrrow=array();
            $addr='<p>当前没有已保存的收货地址</p>'
            .'<a href="#addr-add" data-role="button">添加地址</a>';
        }
        include 'view/order.html.php';
        exit;
    }
    if(isset($_GET['altAddr'])){
        pdoUpdate('address_tbl',array('address'=>$_POST['address'],'name'=>$_POST['name'],'phone'=>$_POST['phone']),array('id'=>$_POST['id']));
        header('location:controller.php?settleAccounts=1');
        exit;
    }
    if(isset($_GET['changeAddr'])){
        if(isset($_GET['addressId'])){
            pdoUpdate('address_tbl',array('dft_a'=>0),array('c_id'=>$_SESSION['customerId']));
            pdoUpdate('address_tbl',array('dft_a'=>1),array('id'=>$_GET['addressId']));
            header('location:controller.php?settleAccounts=1');
        }
        $addrQuery=pdoQuery('address_tbl',null,array('c_id'=>$_SESSION['customerId'],'dft_a'=>'0'),' limit 10');
        include 'view/address.html.php';
        exit;

    }
    if(isset($_GET['orderConfirm'])){
        $orderId='dy'.time().rand(100,999);  //订单号生成，低并发情况下适用
        pdoInsert('order_tbl',array('id'=>$orderId,'c_id'=>$_SESSION['customerId'],'a_id'=>$_GET['addrId']));
        $arr=getCartDetail($_SESSION['customerId']);
        foreach ($arr['goodsList'] as $row) {
            $readyInsert[]=array(
              'o_id'=>$orderId,
                'c_id'=>$_SESSION['customerId'],
                'd_id'=>$row['d_id'],
                'number'=>$row['number'],
                'price'=>$row['price'],
                'total'=>$row['total']
            );
        }
        pdoBatchInsert('order_detail_tbl',$readyInsert);
        pdoDelete('cart_tbl',array('c_id'=>$_SESSION['customerId']));
        $orderStu=0;
        include 'view/order_inf.html.php';
        exit;


    }


}


//以下功能不需登录，不需判断$_SESSION['customerId']
if(isset($_GET['getList'])){
    $end='';
    $where=null;
    if(isset($_GET['father_id']))$where['father_id']=$_GET['father_id'];
    if(isset($_GET['sc_id']))$where['sc_id']=$_GET['sc_id'];
    if(isset($_GET['made_in']))$where['made_in']=$_GET['made_in'];
    if(isset($_GET['name'])){
        $end=(null!=$where?' and name like "%'.$_GET['name'].'%"': ' where name like "%'.$_GET['name'].'%"');
    }
    $query=pdoQuery('temp_view',null,$where,$end);
    include 'view/list.html.php';

}
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
function getCartDetail($customerId){
    $totalPrice=0;
    $totalSave=0;
    $goodsQuery=pdoQuery('user_cart_view',null,array('c_id'=>$customerId),null);
    foreach ($goodsQuery as $row) {

        if (isset($row['price'])) {
            $price = $row['price'];
            $totalSave += ($row['sale'] - $row['price']) * $row['number'];
        } else {
            $price = $row['sale'];
        }
        $thisPrice = $price * $row['number'];
        $totalPrice += $thisPrice;
        $goodsList[] = array(
            'g_id'=>$row['g_id'],
            'd_id'=>$row['d_id'],
            'name' => $row['name'],
            'category' => $row['category'],
            'price' => $price,
            'number' => $row['number'],
            'total' => $row['number'] * $price,
            'url' => $row['url']
        );
    }
    return array(
        'totalPrice'=>$totalPrice,
        'totalSave'=>$totalSave,
        'goodsList'=>$goodsList
    );
}
