<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/26
 * Time: 13:09
 */
include_once '../includePackage.php';;
session_start();

if(isset($_SESSION['customerId'])){
    if(isset($_POST['alterCart'])){
        pdoUpdate('cart_tbl',array('number'=>$_POST['number']),array('c_id'=>$_SESSION['customerId'],'d_id'=>$_POST['d_id']));
    }
    if(isset($_POST['deleteCart'])){
        pdoDelete('cart_tbl',array('c_id'=>$_SESSION['customerId'],'d_id'=>$_POST['d_id']));
    }
    if(isset($_POST['altAddr'])){
        $addrquery=pdoQuery('address_tbl',null,array('id'=>$_POST['id']),' limit 1');
        $addr=$addrquery->fetch();
        echo json_encode($addr);
        exit;

    }
    if(isset($_POST['deleteAddr'])){
        pdoDelete('address_tbl',array('id'=>$_POST['id']));
        echo 'ok';
        exit;
    }
    if(isset($_POST['addrNumRequest'])){
        $query=pdoQuery('address_tbl',array('count(*) as num'),array('c_id'=>$_SESSION['customerId']),'');
        $num=$query->fetch();
        echo $num['num'];
    };
    if(isset($_POST['setDefaultAdress'])){
      pdoUpdate('address_tbl',array('dft_a'=>0),array('c_id'=>$_SESSION['customerId']));
        pdoUpdate('address_tbl',array('dft_a'=>1),array('id'=>$_POST['id']));
        echo 'ok';
        exit;
    };
    if(isset($_GET['getOrderList'])){
        $where=array('c_id'=>$_SESSION['customerId']);
        foreach ($_POST as $k=>$v) {
            $where[$k]=$v;
        }

        $query=pdoQuery('order_tbl',null,$where,'');
        $list=array();
        foreach ($query as $row) {
            $list[]=array(
                'id'=>$row['id'],
                'stu'=>getOrderStu($row['stu'])
            );
        }
        echo json_encode($list);

    }
    if(isset($_POST['addToFav'])){
        pdoInsert('favorite_tbl',array('c_id'=>$_SESSION['customerId'],'g_id'=>$_POST['g_id']),'ignore');
        echo('ok');
        exit;
    }
    if(isset($_POST['deletFav'])){
        pdoDelete('favorite_tbl',array('g_id'=>$_POST['g_id'],'c_id'=>$_SESSION['customerId']));
        echo 'ok';
        exit;
    }

}

//未登录
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
//            mylog(('insert'));
            pdoInsert('cart_tbl',array('c_id'=>$_SESSION['customerId'],'g_id'=>$_POST['g_id'],'d_id'=>$_POST['d_id'],'number'=>$_POST['number']),
                ' ON DUPLICATE KEY UPDATE number='.$_POST['number']);
        if(isset($_SESSION['tempCart'])){

        }
        if(!isset($_SESSION['customerLogin'])){
            pdoInsert('custom_login_tbl',array('id'=>$_SESSION['customerId']),' ignore');
            $_SESSION['customerLogin']=true;
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