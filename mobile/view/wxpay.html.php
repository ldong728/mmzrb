<head>
    <?php include 'templates/header.php'?>
    <link rel="stylesheet" href="stylesheet/order.css"/>
<!--    --><?php //include_once 'templates/jsssdkIncluder.php'?>
</head>
<body>
<div class="wrap">
    <header class="header">
        <a class="back" href="javascript:window.history.go(-1);"></a>
        <p class="hd_tit">微信支付</p>
        <a class="daohang"href="#"></a>
        <nav class="head_nav">
            <a class="hn_index"href="index.php">首页</a>
            <a class="hn_sort"href="controller.php?getSort=1">分类查找</a>
            <a class="hn_cart"href="controller.php?getCart=1">购物车</a>
            <a class="hn_memb"href="controller.php?customerInf=1">个人中心</a>
        </nav>
        <script src="../js/head.js"></script>
    </header>
<!--    <div class="orderComfirm">-->
<!---->
<!--        <a class="orderSettle" id="readyToPay"href="#">付款</a>-->
<!--    </div>-->
</div>
<?php include_once 'templates/jssdkIncluder.php'?>
<script>
    wx.ready(function(){
        wx.hideOptionMenu();
        wx.chooseWXPay({
            timestamp: <?php echo $preSign['timeStamp']?>,//这里是timestamp 要小写，妈的
            nonceStr: '<?php echo $preSign['nonceStr']?>',
            package: '<?php echo $preSign['package']?>',
            signType: '<?php echo $preSign['signType']?>',
            paySign: '<?php echo $preSign['paySign']?>',
            success: function (res) {
                if('get_brand_wcpay_request:ok'==res.err_msg){
//                    alert('pay succes')

                }else{
//                    alert('false:'+res.err_msg);
                }
                window.location.href='controller.php?customerInf=1';
                // 支付成功后的回调函数
            }
        });
    })
</script>

</body>