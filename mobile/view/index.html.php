<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>麻麻去日本</title>
    <link rel="stylesheet" href="stylesheet/mobile.css"/>
    <link rel="stylesheet" href="stylesheet/swiper.3.2.0.min.css"/>
    <link rel="stylesheet" href="stylesheet/myswiper.css"/>
    <link rel="stylesheet" href="stylesheet/index.css"/>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/swiper.min.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click','div.hsTabItem',function(){
                $('.hsTabItem').removeClass('curItem');
                $(this).addClass('curItem');
                swiper.slideTo($(this).attr('id'));
            });
            $('div#0').addClass('curItem');
            var swiper = new Swiper('#hotsale', {
                lazyLoading : true,
                onSlideChangeEnd: function(swiper){
                    $('.hsTabItem').removeClass('curItem');
                    $('div#'+swiper.activeIndex).addClass('curItem');
                }
            });
            $(document).scroll(function(){


            });

        });

    </script>
</head>

<body>
<div class="wrap">
    <header>
        <div class="headerContainer">
            <a href="" class="logo"></a>

            <form class="searchBox"action="controller.php?getList=1"method="get">
                <input class="main_input" type="text" id="key-word"placeholder="输入关键字">
                <input class="search_btn" id="search-button"type="button">
            </form>
            <a href="controller.php?getSort=1" class="sort"></a>
        </div>
        <script src="../js/head.js"></script>
    </header>
    <div class="swiper-container mbaner" id="ad-swiper">
        <div class="swiper-wrapper"style="width: 4368px; height: 214.5px">
            <?php foreach($adList['banner'] as $row):?>
            <div class="swiper-slide"><a href="<?php echo isset($row['url'])? $row['url']:'controller.php?goodsdetail=1&g_id='.$row['g_id']?>">
                    <img class="swiper-img swiper-lazy"data-src="../<?php echo $row['img_url']?>"/></a>
            </div>
            <?php endforeach?>
        </div>
        <div class="swiper-pagination" id="ad-pagination"></div>
    </div>

    <script>
        var swiper = new Swiper('#ad-swiper', {
            pagination: '#ad-pagination',
            paginationClickable: true,
            autoplay: 2000,
            lazyLoading : true,
            loop:true

        });
    </script>
    <nav class="main-nav">
        <a href="#searchPage" data-rel="dialog" class="nav-link">
            <i class="cate-icon search"></i>

            <p class="nav-text">搜索</p>
        </a>
        <a data-ajax="false" href="controller.php?getCart=1" class="nav-link">
            <i class="cate-icon cart"></i>

            <p class="nav-text">购物车</p>
        </a>
        <a href="controller.php?customerInf=1" class="nav-link">
            <i class="cate-icon user"></i>

            <p class="nav-text">个人中心</p>
        </a>
        <a href="#" class="nav-link">
            <i class="cate-icon kf"></i>

            <p class="nav-text">客服</p>
        </a>
    </nav>
    <div class="floor">
        <a class="rowleftimg" href=""><img src="../<?php echo $adList['rowleft'][0]['img_url']?>"/></a>
        <a class="rowrightimg"href=""><img src="../<?php echo $adList['rowright'][0]['img_url']?>"/></a>
    </div>
    <div class="floor">
        <a class="leftImg"href=""><img src="../<?php echo $adList['left'][0]['img_url']?>"/></a>
        <a class="rightTopImg"href=""><img src="../<?php echo $adList['top'][0]['img_url']?>"/></a>
        <a class="rightBottmImg"href=""><img src="../<?php echo $adList['bottom'][0]['img_url']?>"/></a>
    </div>
    <div class="hotsellBox">
        <div class="hsTabBox">
            <div class="hsTab"style="position: inherit; top: 50px; left: 0px; z-index: 15;">
                <?php $index=0; foreach ( $categoryQuery as $cRow):?>
                <div class="hsTabItem"id="<?php echo $index++?>">
                    <span class="hsItemTxt">
                        <?php echo $cRow['name']?>
                    </span>
                </div>
                <?php endforeach?>
            </div>
        </div>
        <div class="swiper-container" id="hotsale">
            <ul class="swiper-wrapper"style="width: 2496px; height: 1030px;">
                <?php foreach($proList as $key=> $catRow):?>
                <li id="<?php echo $key?>" class="swiper-slide"style="width: 624px; height: 1030px;display: list-item;background-color: #f5f3f1;">
                <?php foreach ($catRow as $row):?>
                    <a class="hsprod"href="controller.php?goodsdetail=1&g_id=<?php echo $row['g_id'] ?>&d_id=<?php echo $row['d_id']?>"style="text-align: left">
                        <div class="prodImage">
                            <img class="pd_picture swiper-lazy"data-src="../<?php echo $row['url']?>" style="height: auto; width: auto; display: inline;"/>
                        </div>
                        <p class="prodName"><?php echo $row['name']?></p>
                        <p class="prodPrice">
                            <span class="bPrice"><?php echo $row['price']?></span>
                            <span class="mPrice"><?php echo $row['sale']?></span>
                        </p>
                    </a>
                <?php endforeach?>
                </li>
                <?php endforeach?>
            </ul>
        </div>
        <a class="prodMore"href="#">查看更多</a>
    </div>
    <div class="contactBox">
        <a class="phone"href="1234">联系电话：1234567890</a>
    </div>


</div>
</body>

