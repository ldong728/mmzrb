<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>麻麻去日本</title>
    <link rel="stylesheet" href="stylesheet/jquery.mobile-1.3.2.min.css">
    <link rel="stylesheet"href="stylesheet/mobile.css"/>
    <link rel="stylesheet" href="stylesheet/swiper.min.css"/>
    <link rel="stylesheet"href="stylesheet/myswiper.css"/>
    <link rel="stylesheet"href="stylesheet/index.css"/>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/jquery.mobile-1.3.2.min.js"></script>
</head>
<body>
<div data-role="page" id="mainPage">
    <div data-role="header"data-position="fixed"data-theme="b">
        <a href="#" data-role="button" data-icon="home">首页</a>
        <h1>麻麻去日本</h1>
        <a href="#searchPage" data-role="button" data-icon="search"data-rel="dialog">搜索</a>
    </div>
    <div >

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><a href="http://www.sohu.com"><img class="swiper-img" src="../g_img/slide_img/1.jpg"/></a></div>
                <div class="swiper-slide"><a href="http://www.sohu.com"><img class="swiper-img" src="../g_img/slide_img/2.jpg"/></a></div>
                <div class="swiper-slide"><a href="http://www.sohu.com"><img class="swiper-img" src="../g_img/slide_img/3.jpg"/></a></div>
                <div class="swiper-slide"><a href="http://www.sohu.com"><img class="swiper-img" src="../g_img/slide_img/4.jpg"/></a></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div data-role="content">
        <script src="../js/swiper.min.js"></script>

        <script>
            var swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                autoplay: 1000
            });
        </script>
    </div>

    </div>
    <div data-role="content"class="block">
        <?php foreach ($categoryQuery as $row): ?>
            <a href=""><div class="maincate"id="<?php echo $row['id']?>">
                    <div class="main-cate-icon"><img class="cate-icon" src="../g_img/slide_img/1.jpg"/></div>
                    <div  class="main-cate-text">
                            <?php echo $row['name']?>
                    </div>
            </div>
            </a>

        <?php endforeach ?>
    </div>

    <div data-role="content"class="block">
            <?php foreach($promotionQuery as $row):?>
                <a data-ajax="false" href="controller.php?goodsdetail=1&g_id=<?php echo $row['g_id']?>&d_id=<?php echo $row['d_id']?>">
                <div class="goods-promotion">
                    <div class="promotion-name">
                        <?php echo $row['name']?>
                    </div>
                    <div class="promotion-sale">
                        ¥<?php echo $row['sale']?>
                    </div>
                    <div class="promotion-price">
                        ¥<?php echo $row['price']?>
                    </div>
                        <img class="promotion" src="../<?php echo $row['url']?>"/>
                </div>
                </a>
            <?php endforeach ?>
    </div>
    <div data-role="footer"data-position="fixed"data-theme="b">
        <a data-ajax="false" href="controller.php?getCart=1" data-role="button">购物车</a>
    </div>
</div>


<div data-role="page"id="searchPage">
    <div data-role="header"data-theme="b">
        <h1>产品搜索</h1>
    </div>
    <div data-role="content">
    </div>
</div>


</body>

