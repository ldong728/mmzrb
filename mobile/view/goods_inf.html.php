<head>
    <?php include 'templates/header.php'?>
    <meta content="YES" name="apple-touch-fullscreen">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <link rel="stylesheet" href="stylesheet/swiper.3.2.0.min.css"/>
    <link rel="stylesheet" href="stylesheet/myswiper.css"/>
        <link rel="stylesheet" href="stylesheet/goods_inf.css"/>
    <script src="../js/lazyload.js"></script>

</head>
<body>
<div class="wrap">
    <header class="header">
        <div class="headerContainer">
            <a class="back" href="javascript:window.history.go(-1);"></a>
            <form class="searchBox"action="controller.php?getList=1"method="get">
                <input class="main_input" type="text" id="key-word"placeholder="输入关键字">
                <input class="search_btn" id="search-button"type="button">
            </form>
            <a class="daohang"href="#"></a>
            <nav class="head_nav">
                <a class="hn_index"href="index.php">首页</a>
                <a class="hn_sort"href="controller.php?getSort=1">分类查找</a>
                <a class="hn_cart"href="controller.php?getCart=1">购物车</a>
                <a class="hn_memb"href="controller.php?customerInf=1">个人中心</a>
                <
            </nav>
        </div>
        <script src="../js/swiper.min.js"></script>
        <script src="../js/head.js"></script>

    </header>
    <div class="pDetail">
        <div class="baseInfo">
            <div class="pd_info">
                <div class="swiper-container mpdImg"id="goods-inf-swiper">
                    <ul class="pd_imgList swiper-wrapper"style="height: 200px">
                        <?php foreach($imgQuery as $img):?>
                            <li class="swiper-slide"style="height: 200px">
                                <img class="pro_picture swiper-lazy" data-src="../<?php echo $img['url']?>"style="width:auto; height:200px; margin:0 auto;z-index:0">
                            </li>

                        <?php endforeach?>
                    </ul>
                </div>
                <script>
                    var wrapperWidth=0;
                    $('li.swiper-slide').each(function(){
                        wrapperWidth+=531;
                    });
                    $('.pd_imgList').css('width',wrapperWidth+'px');
                    var swiper = new Swiper('#goods-inf-swiper', {
                        lazyLoading: true,
                        autoplay:2000
                    });
                </script>
                <div class="pName">
                    <span class="pro_name"><?php echo $inf['name']?></span>
                </div>
                <dl>
                    <dt class="price">价格：</dt>
                    <dd class="cl_red"class="price"id="price">¥<?php echo (isset($default['price'])? $default['price'] : $default['sale'])?></dd>
                    <dd>
                        <del id="sale"><?php echo (isset($default['price'])? '¥'.$default['sale'] : '')?></del>
                        <span class="payAfter">货到付款</span>
                    </dd>
                    <dt>保障：</dt>
                    <dd>
                        <span class="zheng">正品</span>
                        <span class="tui">7天退换</span>
                        <span class="bao">正品保障</span>
                    </dd>
                    <dd class="favBox">
                        <a class="fav"id="fav"href="#">收藏</a>
                    </dd>
                </dl>
            </div>
            <div class="buy">
                <dl>
                    <dt>规格：</dt>
                    <dd class="selectBox">
                        <a class="select"id="select-display"><?php echo $default['category']?></a>
                        <select id="category-select">
                            <option id="<?php echo $default['d_id']?>"  value="<?php echo $default['d_id']?>"selected="selected">
                                <?php echo $default['category']?></option>
                            <?php foreach($detailQuery as $default):?>
                                <option id="<?php echo $default['d_id']?>" value="<?php echo $default['d_id']?>">
                                    <?php echo $default['category']?></option>
                            <?php endforeach?>
                        </select>
                    </dd>
                    <dt>数量：</dt>
                    <dd>
                        <div class="countBox">
                            <a class="minus number-button"id="minus">-</a>
                            <input class="count"id="number"value="<?php echo $number?>"maxlength="3"type="tel"/>
                            <a class="plus number-button"id="plus">+</a>
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="shelves_nav">
                <a class="shelvesNav"href="#"id="getGoodsInf">商品介绍</a>
            </div>
        </div>
        <div class="pro_desc"id="goodsInf"style="display: none">
            <?php echo $inf['inf']?>
        </div>
        <div class="fixedMenuBox">
            <div class="buttonSet">
                <a class="buyBtn"href="controller.php?settleAccounts=1">去结算</a>
                <a class="cartBtn"id="add-to-cart">放入购物车</a>
                <a class="goCart"href="controller.php?getCart=1"></a>
            </div>
        </div>
        <div class="toast"></div>
    </div>

</div>
<script>
    var g_id=<?php echo $inf['g_id']?>;
    var d_id=$('#category-select option:selected').val();
    var realPrice=<?php echo (isset($default['price'])? $default['price'] : $default['sale'])?>;//保存在js中的价格
    var number=parseInt($('#number').val());
</script>
<script src="../js/goods-inf.js"></script>
</body>

