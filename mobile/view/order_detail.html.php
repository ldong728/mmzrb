<head>
    <?php include 'templates/header.php'?>
    <link rel="stylesheet" href="stylesheet/order-detail.css"/>
</head>
<body>
    <div class="wrap">
        <header class="header">
            <a class="back" href="javascript:window.history.go(-1);"></a>
            <p class="hd_tit">订单信息</p>
            <a class="daohang"href="#"></a>
            <nav class="head_nav">
                <a class="hn_index"href="index.php">首页</a>
                <a class="hn_sort"href="controller.php?getSort=1">分类查找</a>
                <a class="hn_cart"href="controller.php?getCart=1">购物车</a>
                <a class="hn_memb"href="controller.php?customerInf=1">个人中心</a>
            </nav>
            <script src="../js/head.js"></script>
        </header>
        <div class="ordreDetail">
            <div class="orderTransp">
                <div class="transp_hd"></div>
                <div class="address">
                    <p class="add_tit">收货地址</p>
                    <p id="address"><?php echo $order_inf['province']?>&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php echo $order_inf['city']?>&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php echo $order_inf['area']?>&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php echo $order_inf['address']?></p>
                    <p id="nameAndTel"><?php echo $order_inf['name']?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $order_inf['phone']?></p>
                </div>
                <div class="transport transp_info" style="overflow: hidden; display: none;">
                    <p class="tran_tit">物流信息读取中..</p>
                </div>
                <div class="show_wuliu"></div>
                <div class="hide_wuliu"></div>
            </div>
            <div class="orderstate">
                <div>
                    <span class="cl_sta">订单状态:</span>
                    <a class="cl_red"style="width: 20%; background: none;"><?php echo getOrderStu($order_inf['stu'])?></a>
                    <span class="drawback"></span>
                </div>
                <div>订单编号：<span id="orderno"><?php echo $order_inf['id']?></span></div>
            </div>
            <dl class="orderList">
                <?php $total=0?>
                <?php foreach($ordeDetailQuery as $row):?>
                <div id="orderLineList">
                    <dd>
                        <div class="pd_detail">
                            <a href="prodDetail.html?prod_id=734371&amp;shop_code=100294&amp;source=internal" class="pd_name">
                                <?php echo $row['name']?>
                            </a>
                            <p class="pd_guige">规格: <span class="cl_grey"><?php echo $row['category']?></span></p>
                            <p class="pd_count">数量: <span class="cl_red"><?php echo $row['number']?></span></p>
                            <p class="pd_price">总价: <span class="cl_red">￥<?php echo $row['total']?></span></p>
                        </div>
                    </dd>
                    <dd class="borderLine">

                    </dd>
                </div>
                    <?php $total=$total+$row['total']?>
                <?php endforeach?>
            </dl>
            <div class="orderInfo">
                <div>支付时间：<span id="orderTime"><?php echo $order_inf['order_time']?></span></div>
                <div>支付方式：<span id="payType">在线支付</span></div>
                <div>配送方式：<span id="deliveryCompany"><?php echo $order_inf['express_name']?></span></div>
            </div>
            <div class="order_ft">
                <span class="order_amount">
                    共计：

                <span class="cl_red">
                    ￥<?php echo $order_inf['total_fee'] ?>
                </span>
                <span class="transp">
                    含运费￥<?php echo $order_inf['express_price']?>
                </span></span></div>
            <?php if($order_inf['stu']==0){
                echo ' <div class="order_btn">
                <a class="btn_orange payOrder" id="pay_now" href="#">
                    立即付款
                </a>
                <a class="btn_white cansel_btn" id="cancel_order">
                    取消订单
                </a>
            </div>';
}?>

        </div>
        <div class="toast"></div>
   </div>
</body>
<script>
    var orderId = '<?php echo $order_inf['id']?>';
    var orderstu =<?php echo $order_inf['stu']?>;
    var totalFee=<?php echo $total ?>;
    $('#pay_now').click(function () {
        if(orderstu==0){
            window.location.href = 'controller.php?pay_order=1&order_id=' + orderId + '&order_stu=' + orderstu + '&total_fee='+totalFee;
        }else{

        }
    });
    $('#cancel_order').click(function () {
        if(orderstu<1){
            $.post('ajax.php',{cancel_order:1,order_id:orderId,order_stu:orderstu},function(data){
                if(data==0){
                    window.location.href = 'controller.php?customerInf=1';
                }else{
                    alert('此订单暂时无法删除，请联系客服处理')
                }
            });

        }

    });
</script>
