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
        <a class="address"href="controller.php?editAddress=1">
            <i class="iCar"></i>
            <div class="adInfo">
               <p><?php echo $addr['province'].'  '.$addr['city'].'   '.$addr['area']?></p>
                <p><?php echo $addr['address']?></p>
                <p><?php echo $addr['name']?><span class="recPhone"><?php echo $addr['phone']?></span></p>
            </div>
        </a>
        <ul class="odList">
            <?php foreach($goodsList as $row):?>
                <li>
                    <div class="orderBox">
                        <dl>
                            <dd>
                                <div class="op_detail">
                                    <h3>
                                        <?php echo $row['name']?>
                                    </h3>
                                    <p>规格：<?php echo $row['category']?></p>
                                    <p>数量：<span class="cl_red"><?php echo $row['number']?></span></p>
                                    <p>总价：<span class="cl_red">￥<?php echo $row['total']?></span></p>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </li>
            <?php endforeach?>
        </ul>
        <div class="orderCoupon">
            <h2>优惠券</h2>
            <div class="chosen chooseOpen card-button">选择优惠券</div>
        </div>
        <div class="orderOther"style="margin-top: 10px">
            <div class="orderMode">
                <h3>运费￥<?php echo $expressPrice ?></h3>
                <div class="chosen">默认快递</div>
            </div>
        </div>
        <div class="ordertotal">
            <span class="realPay">总价格：</span>
            <span class="payTotal">
                <span class="cl_red">￥</span><span class="cl_red" id="totalfee"><?php echo ($totalPrice+$expressPrice)?></span>
            </span>
        </div>
        <a class="orderSettle" id="orderConfirm"href="controller.php?orderConfirm=1&addrId=<?php echo $addr['id']?>">订单确认</a>
    </div>
    <div class="toast"></div>
</div>
<?php
include 'templates/jssdkIncluder.php';
include_once '../wechat/interfaceHandler.php';
include_once '../wechat/cardsdk.php';
$card=new card();
$sign=$card->getSignPackage("DISCOUNT CASH");
?>
<script>
    var addrId = <?php echo $addr['id']?>;
    var totalPrice =<?php echo $totalPrice ?>;
</script>
<script>
    var cardId=null;
    var cardCode='none';
    var save=0;
    wx.ready(function(){
        $('.card-button').click(function(){
            wx.chooseCard({
                cardType: '<?php echo $sign['cardType']?>', // 卡券类型
                timestamp: <?php echo $sign['timestamp']?>, // 卡券签名时间戳
                nonceStr: '<?php echo $sign['nonceStr']?>', // 卡券签名随机串
                signType: 'SHA1', // 签名方式，默认'SHA1'
                cardSign: '<?php echo $sign['cardSign']?>', // 卡券签名
                success: function (res) {
                    var cardList= res.cardList; // 用户选中的卡券列表信息
                    var cardInf=eval('('+cardList+')');
                    $.post('ajax.php?chooseCard=1',{card_id:cardInf[0].card_id,encrypt_code:cardInf[0].encrypt_code,totalPrice:totalPrice},function(data){
//                        alert(data);
                        data=eval('('+data+')');
//                        $('.card_detail').empty();
                        if(data.save<0){
                            showToast('此券无法使用')
                        }else{
//                            $('.card-detail').append('节省￥'+data.save);
                            showToast('已为您节省'+data.save+'元')
                            $('#totalfee').text((totalPrice-data.save));
                            cardId=data.cardId;
                            cardCode=data.cardCode;
                        }
                    });
                }
            });
        });
    })
</script>

</body>


