<head>
    <?php include 'templates/header.php'?>
    <link rel="stylesheet" href="stylesheet/customer_inf.css"/>
</head>
<body>
<div class="wrap">
    <header class="header">
        <a class="back" href="javascript:window.history.go(-1);"></a>
        <p class="hd_tit">个人信息</p>
        <a class="daohang"href="#"></a>
        <nav class="head_nav">
            <a class="hn_index"href="index.php">首页</a>
            <a class="hn_sort"href="controller.php?getSort=1">分类查找</a>
            <a class="hn_cart"href="controller.php?getCart=1">购物车</a>
            <a class="hn_memb"href="controller.php?customerInf=1">个人中心</a>
        </nav>
        <script src="../js/head.js"></script>
    </header>
    <div class="memberHome">
        <div class="user_info">
            <p class="username">
                欢迎你，
                <span><?php echo $_SESSION['userInf']['nickname']?></span>
            </p>
            <a class="logout">更换帐号</a>
            <div class="memberRank mr1"></div>
        </div>
        <div class="myorder">
            <a class="allOrder"id="getOrderList">
                我的订单
                <i class="iright"></i>
            </a>
            <div class="orderMenu">
                <div class="orderItem">
                    <div>
                        <a class="filteOrderList" id="0" href="#">
                            <i class="orderIcon ipay"></i>
                            <p class="ordertxt">待付款</p>
                        </a>
                    </div>
                    <div>
                        <a  class="filteOrderList" id="1" href="#">
                            <i class="orderIcon irefund"></i>
                            <p class="ordertxt">待发货</p>
                        </a>
                    </div>
                    <div>
                        <a class="filteOrderList" id="2" href="#">
                            <i class="orderIcon irecieve"></i>
                            <p class="ordertxt">已发货</p>
                        </a>
                    </div>
                    <div>
                        <a class="filteOrderList" id="8" href="#">
                            <i class="orderIcon icomment"></i>
                            <p class="ordertxt">历史订单</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="orderList">
            </div>
        </div>
        <div class="mymanage">
            <a class="myManage1"href="controller.php?getFav=1">我的收藏
                <i class="iright"></i></a>
            <a class="myManage5">完善用户信息
                </i></a>
        </div>

    </div>

</div>
<script>
    $(document).on('click','#getOrderList',function(){
        getOrderList(null);
    });
    $(document).on('click','.filteOrderList',function(){
       getOrderList({stu:$(this).attr('id')});
    });
    function getOrderList(myjson){
        $('.orderList').slideUp('slow',function(){
                $('.orderList').empty();
                $.post('ajax.php?getOrderList=1',myjson,function(data) {
                    var receive=eval('('+data+')');
                    $.each(receive,function(id,value){
                        var d='<a href="controller.php?getOrderDetail=1&id='+value.id+'">'+value.id+'<span>'+value.stu+'</span></a>'
                        $('.orderList').append(d);
                        $('.orderList').slideDown('slow');
                    })
                });
            });
        }

</script>
</body>