<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>麻麻去日本</title>
    <link rel="stylesheet" href="stylesheet/my-jm.min.css">
    <link rel="stylesheet" href="stylesheet/mobile.css"/>
    <link rel="stylesheet" href="stylesheet/swiper.3.2.0.min.css"/>
    <!--    <link rel="stylesheet" href="stylesheet/swiper.min.css"/>-->
    <link rel="stylesheet" href="stylesheet/myswiper.css"/>
    <link rel="stylesheet" href="stylesheet/index.css"/>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/jquery.mobile-1.3.2.min.js"></script>
    <script src="../js/lazyload.js"></script>
</head>
<body>

<div data-role="page" id="mainPage" data-theme="c">
    <div data-role="header" data-position="fixed" data-theme="b">
        <a href="#" data-role="button" data-icon="home">首页</a>

        <h1>麻麻去日本</h1>
        <a href="#searchPage" data-role="button" data-icon="search" data-rel="dialog">搜索</a>
    </div>
    <div>

        <div class="swiper-container" id="ad-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><a href="http://www.sohu.com"><img class="swiper-img"
                                                                             src="../g_img/slide_img/1.jpg"/></a></div>
                <div class="swiper-slide"><a href="http://www.sohu.com"><img class="swiper-img"
                                                                             src="../g_img/slide_img/2.jpg"/></a></div>
                <div class="swiper-slide"><a href="http://www.sohu.com"><img class="swiper-img"
                                                                             src="../g_img/slide_img/3.jpg"/></a></div>
                <div class="swiper-slide"><a href="http://www.sohu.com"><img class="swiper-img"
                                                                             src="../g_img/slide_img/4.jpg"/></a></div>
            </div>
            <div class="swiper-pagination" id="ad-pagination"></div>
        </div>
<!--        <div data-role="content">-->
            <script src="../js/swiper.min.js"></script>
            <script>
                var swiper = new Swiper('#ad-swiper', {
                    pagination: '#ad-pagination',
                    paginationClickable: true,
                    autoplay: 1000
                });
            </script>
<!--        </div>-->

    </div>
    <!--功能导航-->
<!--    <div data-role="content" class="block">-->
        <nav class="main-nav">
        <a href="#searchPage" data-rel="dialog"class="nav-link">
            <i class="cate-icon search"></i>
            <p class="nav-text">搜索</p>
        </a>
            <a data-ajax="false" href="controller.php?getCart=1"class="nav-link">
                <i class="cate-icon cart"></i>
                <p class="nav-text">购物车</p>
            </a>
            <a href="#"class="nav-link">
                <i class="cate-icon user"></i>
                <p class="nav-text">个人中心</p>
            </a>
            <a href="#"class="nav-link">
                <i class="cate-icon kf"></i>
                <p class="nav-text">客服</p>
            </a>
        </nav>
<!--    </div>-->

<!--    促销商品-->
    <?php $count = 1;
    foreach ($promotionQuery as $row): ?>
        <a data-ajax="false"
           href="controller.php?goodsdetail=1&g_id=<?php echo $row['g_id'] ?>&d_id=<?php echo $row['d_id'] ?>">
            <div class="goods-promotion <?php echo($count % 2 == 0 ? 'float-right' : 'float-left') ?>">
                <img class="promotion" src="../<?php echo $row['url'] ?>"/>

                <div class="promotion-name">
                    <?php echo $row['name'] ?>
                </div>
                <div class="promotion-sale">
                    ¥<?php echo $row['sale'] ?>
                </div>
                <div class="promotion-price">
                    ¥<?php echo $row['price'] ?>
                </div>

            </div>
        </a>
        <?php $count++ ?>
    <?php endforeach ?>
<!--分类导航-->
    <div data-role="content" class="block maincate-block">
        <?php foreach ($categoryQuery as $row): ?>
            <a href="#">
                <div class="cate-block" id="<?php echo $row['id'] ?>">
                    <div class="main-cate-text">
                        <?php echo $row['name'] ?>
                    </div>
                </div>
            </a>

        <?php endforeach ?>
    </div>
<!--广告商品-->
    <div id="dyn-goods">
    <?php $count = 1;
    foreach ($adQuery as $row): ?>
        <a data-ajax="false" href="controller.php?goodsdetail=1&g_id=<?php echo $row['g_id'] ?>">
            <div class="goods-promotion <?php echo($count % 2 == 0 ? 'float-right' : 'float-left') ?>">
                <img class="promotion" src="../img/place.jpg"data-original="../<?php echo $row['url'] ?>"width="90%"/>

                <div class="promotion-name">
                    <?php echo $row['name'] ?>
                </div>
                <div class="promotion-price">
                    ¥<?php echo $row['sale'] ?>
                </div>

            </div>
        </a>
        <?php $count++ ?>
    <?php endforeach ?>
    </div>
    <div data-role="footer" data-position="fixed" data-theme="b">
        <a data-ajax="false" href="controller.php?getCart=1" data-role="button">购物车</a>
    </div>
</div>



<div data-role="page" id="searchPage">
    <div data-role="header" data-theme="b">
        <h1>产品搜索</h1>
        <form action="controller.php?getList=1"method="get">
            <input type="text"name="name"/>
            <input type="submit"value="搜索"/>
        </form>
    </div>

    <div data-role="content">
    </div>
</div>

<script>
    $(document).ready(function(){
        $('img.promotion').lazyload();
//        $('img.ajax-img').lazeload();
        $('#dyn-goods').fadeIn(600);
       $(document).on('tap','.cate-block',function(){
           $('.cate-block').removeClass('cate-select');
           $(this).addClass('cate-select');
           $.post('ajax.php',{adFilter:1,mc_id:$(this).attr('id')},function(data){
                var d=eval('('+data+')');
               var content='';
               $.each(d,function(id,value){
                   var float=(0==value['count']%2?'float-right' : 'float-left')
                   content+=' <a data-ajax="false" href="controller.php?goodsdetail=1&g_id='+value['g_id']+'"class="ui-link">'
                   +'<div class="goods-promotion '+float+'">'
                   +'<img class="promotion ajax-img" src="../img/place.jpg"data-original="../'+value['url']+'"/>'
                   +'<div class="promotion-name">'
                   +value['name']
                   +'</div>'
                   +'<div class="promotion-price">'
                   +'¥'+value['sale']
                   +'</div></div></a>'
               })
               $('#dyn-goods').fadeOut(600,function(){
                   $(this).empty();

                   $(this).append(content);
                   $('.ajax-img').lazyload();
                   $(this).fadeIn(600);

               });

           });


       })
    });
</script>
</body>

