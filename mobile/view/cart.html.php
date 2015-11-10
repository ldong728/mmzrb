<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>麻麻去日本</title>
    <link rel="stylesheet" href="stylesheet/jquery.mobile-1.3.2.min.css">
    <link rel="stylesheet" href="stylesheet/mobile.css"/>
    <link rel="stylesheet" href="stylesheet/cart.css"/>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<div data-role="page"id="cart">
    <div data-role="header"data-position="fixed"data-theme="b">
        <a data-ajax="false" href="index.php" data-role="button" data-icon="home">首页</a>
        <h1>我的购物车</h1>
        <a href="#searchPage" data-role="button" data-icon="search"data-rel="dialog">搜索</a>
    </div>
    <div data-role="content"class="block">

        <ul data-role="listview">

                <?php foreach($cartlist as $row):?>
            <li id="li<?php echo $row['d_id']?>" data-icon="delete">
                <a class="inf" data-ajax="false" href="controller.php?goodsdetail=1&g_id=<?php echo $row['g_id']?>&d_id=<?php echo $row['d_id']?>&number=<?php echo $row['number']?>">
                    <img src="../<?php echo $row['url']?>">
                    <h2><?php echo $row['name']?></h2>
                    <p><?php echo $row['category']?></p>
                    <h3>¥<span  class="price"><?php echo (isset($row['price'])? $row['price']:$row['sale'])?></span></span></h3>
                    <span class="ui-li-count"><?php echo $row['number']?></span>
                </a>
                    <a class="deleteCart" id="<?php echo $row['d_id']?>" href="#">
                        从购物车中删除
                    </a>
            </li>

                <?php endforeach?>

        </ul>
    </div>
    <div data-role="footer"data-position="fixed"class="ui-bar"data-theme="b">
            <div id="price-box">总价格：<span class="totalPrice"></span></div>
        <a data-ajax="false" href="controller.php?settleAccounts=1" data-role="button" data-icon="check"id="clear">去结算</a>
    </div>

</div>


</body>
<script>
    $(document).ready(function(){
        flushPrice();
        $(document).on('tap','.deleteCart',function(){
            $.post('ajax.php',{deleteCart:1,d_id:$(this).attr('id')})
            $('#li'+$(this).attr('id')).fadeOut(750,function(){
                $(this).remove();
                flushPrice();
            });

        });
    });
    var flushPrice=function(){
        var price=0;
        $('li').each(function(){
            price+=parseInt($(this).find('.price').text())*parseInt($(this).find('.ui-li-count').text());
//            price++;
        });
        $('.totalPrice').empty();
        $('.totalPrice').append('¥'+price);
        if(price==0){
            $('#clear').attr('onclick','return false');
        }else{
        }

    }

</script>