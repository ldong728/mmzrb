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
<div data-role="page" id="mainPage">
    <div data-role="header" data-position="fixed" data-theme="b">
        <a data-ajax="false" href="index.php" data-role="button" data-icon="home">首页</a>

        <h1>麻麻去日本</h1>
        <a href="#searchPage" data-role="button" data-icon="search" data-rel="dialog">搜索</a>
    </div>

    <div data-role="content" class="block">
        <div id="main-picture-box">
            <img id="main_img" src="../<?php echo $inf['url']?>">
        </div>
        <div id="main-title">
            <h3><?php echo $inf['name']?></h3>
        </div>
        <div id="main-made-in">
            <h5>产地：<?php echo $inf['made_in']?></h5>
        </div>
        <div id="price-box">
            <p>价格：<span id="price">¥<?php echo (isset($default['price'])? $default['price'] : $default['sale'])?></span>
            <span id="sale">¥<?php echo (isset($default['price'])? $default['sale'] : '')?></span></p>
        </div>
        <input type="hidden"id="fromCart"value="<?php echo $fromCart ?>"/>

    </div>
    <div data-role="content" class="block">

        <div class="detail-box">
            <div class="detail-name">
                <h2>规格：</h2>
            </div>
            <div class="detail-select-box">
                <select id="category-select">
                    <option id="<?php echo $default['d_id']?>"  value="<?php echo $default['d_id']?>">
                    <?php echo $default['category']?></option>
                    <?php foreach($detailQuery as $default):?>
                        <option id="<?php echo $default['d_id']?>" value="<?php echo $default['d_id']?>">
                            <?php echo $default['category']?></option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
        <div class="detail-box">
            <div class="detail-name">
                <h2>数量：</h2>
            </div>
            <div class="detail-select-box">
                <a href="#" data-role="button" data-inline="true"data-icon="minus"class="number-button"id="minus"data-iconpos="notext"></a>
                <span id="number"><?php echo $number ?></span>
                <a href="#" data-role="button" data-inline="true"data-icon="plus"class="number-button"id="plus"data-iconpos="notext"></a>
            </div>
        </div>
    </div>
    <div data-role="content" class="block">
        <ul data-role="listview">
            <li><a href="#infpage"><h2>详细信息</h2></a> </li>
        </ul>
    </div>
    <div data-role="footer"data-position="fixed"data-theme="b"class="inf-foot">
        <div data-role="controlgroup" data-type="horizontal">
        <a href="#" data-role="button" data-icon="check">去结算</a>
            <a href="#" data-role="button" data-icon="cart"id="add-to-cart">添加到购物车</a>
            <a data-ajax="false" href="controller.php?getCart=1" data-role="button"style="float: right">我的购物车</a>
            </div>

    </div>

    <script>
        $(document).ready(function(){
            var g_id=<?php echo $inf['g_id']?>;
            var d_id=$('#category-select option:selected').val();
            var realPrice=<?php echo (isset($default['price'])? $default['price'] : $default['sale'])?>;//保存在js中的价格
            var number=parseInt($('#number').text());
            $(document).on('change','#category-select',function(){
                $.post('ajax.php',{getdetailprice:1,d_id:$('#category-select option:selected').val()},function(data){
                    var inf=eval('('+data+')');
                    $('#price').empty();
                    $('#sale').empty();
                    if(inf.price==null){
                        realPrice=inf.sale;
                    }else{
                        realPrice=inf.price;
                        $('#sale').append('¥'+inf.sale);
                    }
                    $('#price').append('¥'+realPrice);
                });

            });
            $(document).on('tap','.number-button',function(){
                var currentNum=parseInt($('#number').text());
                if('plus'==$(this).attr('id')){
                    $('#number').text(currentNum+1);
                }else{
                    if(currentNum>1){
                        $('#number').text(currentNum-1);
                    }
                }
                number=parseInt($('#number').text());
                if(1==$('#fromCart').val()){
                    $.post('ajax.php',{alterCart:1,d_id:d_id,number:number});
                }

            });
            $(document).on('tap','#add-to-cart',function(){
                $.post('ajax.php',{addToCart:1,g_id:g_id,d_id:d_id,number:number},function(data){
//                    $.mobile.changePage('#add-done', 'pop', true, true);  //页面跳转
                })

            });


        });

    </script>

</div>

<div data-role="dialog" id="add-done">...</div>

<div data-role="page"id="infpage">
    <div data-role="content" class="block">
        <?php echo $inf['inf']?>

    </div>

</div>

</body>






