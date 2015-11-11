<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>麻麻去日本</title>
    <link rel="stylesheet" href="stylesheet/jquery.mobile-1.3.2.min.css">
    <link rel="stylesheet" href="stylesheet/mobile.css"/>
    <link rel="stylesheet" href="stylesheet/goods_inf.css"/>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/jquery.mobile-1.3.2.min.js"></script>
</head>

<body>

<div data-role="page">
    <div data-role="header" data-position="fixed" data-theme="b">
        <a data-ajax="false" href="index.php" data-role="button" data-icon="home">首页</a>
        <h1>订单信息</h1>
    </div>
    <div data-role="content" class="block">
        <h5>订单号：<?php echo $orderId?></h5>
        <h6>订单状态：<?php echo getOrderStu($orderStu)?></h6>


    </div>
    <div data-role="content"class="block">
        <button>付款</button>
    </div>

</div>
</body>