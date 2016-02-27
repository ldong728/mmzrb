<head>
    <?php include 'templates/header.php'?>
    <link rel="stylesheet" href="stylesheet/order.css"/>
</head>
<body>
<div class="wrap">
    <header class="header">
        <a class="back" href="javascript:window.history.go(-1);"></a>
        <p class="hd_tit">订单确认</p>
        <a class="daohang"href="#"></a>
        <nav class="head_nav">
            <a class="hn_index"href="index.php">首页</a>
            <a class="hn_sort"href="controller.php?getSort=1">分类查找</a>
            <a class="hn_cart"href="controller.php?getCart=1">购物车</a>
            <a class="hn_memb"href="controller.php?customerInf=1">个人中心</a>
        </nav>
        <script src="../js/head.js"></script>
    </header>
    <div class="orderComfirm">
    <div>
        <h1>订单信息</h1>
    </div>
    <div>
        <h5>订单号：<?php echo $orderId?></h5>
        <h5>总金额：￥<?php echo $total_fee?></h5>
        <h6>订单状态：<?php echo getOrderStu($orderStu)?></h6>
    </div>
    <a class="orderSettle" id="readyToPay"href="#">付款</a>
    </div>
</div>
<script>
    var order_id='<?php echo $orderId?>';
    $('#readyToPay').click(function(){
//        alert('send pre pay');
        $.post('pay.php',{prePay:1,order_id:order_id},function(data){
            if('ok'==data){
                window.location.href='controller.php?preOrderOK=1';
            }
        });
//        alert('please wait');
    });
</script>
</body>