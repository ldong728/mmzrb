<head>
    <?php include 'templates/header.php'?>
    <link rel="stylesheet" href="stylesheet/swiper.3.2.0.min.css"/>
    <link rel="stylesheet" href="stylesheet/myswiper.css"/>
    <link rel="stylesheet" href="stylesheet/index.css"/>
    <script src="../js/swiper.min.js"></script>
    <script src="../js/mobile-index.js"></script>
</head>


<body>
<div class="wrap">
    <header>
        <div class="headerContainer">
            <a href="" class="logo"></a>

<!--            <form class="searchBox"action="controller.php"method="post">-->
            <div class="searchBox">
<!--                <input type="hidden"name="search"value="1"/>-->
<!--                <input class="main_input" type="text" id="key-word"placeholder="输入关键字"onkeypress="if(event.keyCode == 13) return false">-->
                <input class="main_input" type="text" id="key-word"placeholder="输入关键字"onkeypress="searchGoods(event)">
                <input class="search_btn" id="search-button"type="button"onclick="searchGoods({keyCode:13})">
            </div>
<!--            </form>-->
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
        <a href="controller.php?getList=1&father_id=6" class="nav-link">
            <i class="cate-icon2 grhl"></i>

            <p class="nav-text">个人护理</p>
        </a>
        <a href="controller.php?getList=1&father_id=5" class="nav-link">
            <i class="cate-icon2 ytyp"></i>

            <p class="nav-text">婴童用品</p>
        </a>
        <a href="controller.php?getList=1&father_id=9" class="nav-link">
            <i class="cate-icon2 hzp"></i>

            <p class="nav-text">食品百货</p>
        </a>
        <a href="controller.php?getList=1&father_id=8" class="nav-link">
            <i class="cate-icon2 jkyp"></i>

            <p class="nav-text">健康用品</p>
        </a>
        <a href="controller.php?getList=1&father_id=11" class="nav-link">
            <i class="cate-icon2 fzxm"></i>

            <p class="nav-text">服装鞋帽</p>
        </a>
        <a href="controller.php?getCart=1" class="nav-link">
            <i class="cate-icon cart"></i>

            <p class="nav-text">购物车</p>
        </a>
        <a href="controller.php?customerInf=1" class="nav-link"id="temp">
            <i class="cate-icon user"></i>

            <p class="nav-text">个人中心</p>
        </a>
        <script>
            $('#temp').click(function(){
            })
        </script>
        <a href="#" class="nav-link toKf">
            <i class="cate-icon kf"></i>

            <p class="nav-text">客服</p>
        </a>
<!--        <a href="controller.php?linkKf=1" class="nav-link">-->
<!--            <i class="cate-icon2 tempp"></i>-->
<!---->
<!--            <p class="nav-text">客服</p>-->
<!--        </a>-->
    </nav>
    <div class="floor">
        <a class="rowleftimg" href="controller.php?goodsdetail=1&g_id=<?php echo $adList['rowleft'][0]['g_id']?>"><img src="../<?php echo $adList['rowleft'][0]['img_url']?>"/></a>
        <a class="rowrightimg"href="controller.php?goodsdetail=1&g_id=<?php echo $adList['rowright'][0]['g_id']?>"><img src="../<?php echo $adList['rowright'][0]['img_url']?>"/></a>
    </div>
    <div class="floor">
        <a class="leftImg"href="controller.php?goodsdetail=1&g_id=<?php echo $adList['left'][0]['g_id']?>"><img src="../<?php echo $adList['left'][0]['img_url']?>"/></a>
        <a class="rightTopImg"href="controller.php?goodsdetail=1&g_id=<?php echo $adList['top'][0]['g_id']?>"><img src="../<?php echo $adList['top'][0]['img_url']?>"/></a>
        <a class="rightBottmImg"href="controller.php?goodsdetail=1&g_id=<?php echo $adList['bottom'][0]['g_id']?>"><img src="../<?php echo $adList['bottom'][0]['img_url']?>"/></a>
    </div>
    <div class="hotsellBox">
        <div class="hsTabBox">
            <div class="hsTab"style="position: inherit; top: 50px; left: 0px; z-index: 15;">
                <?php $index=0; foreach ( $categoryQuery as $cRow):?>
                <div class="hsTabItem"id="<?php echo $index++?>"style="width:<?php echo $config['cateWidth']?>%">
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
                            <span class="bPrice">￥<?php echo $row['price']?></span>
                            <span class="mPrice">￥<?php echo $row['sale']?></span>
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
<!--        <a class="phone"href="1234">联系电话：1234567890</a>-->
    </div>


</div>
<?php include 'templates/jssdkIncluder.php'?>
<script>
    wx.ready(function(){
//        wx.onMenuShareTimeline({
//            title: '仅测试，勿点', // 分享标题
//            link: 'http://www.sohu.com', // 分享链接
//            imgUrl: '', // 分享图标
//            success: function () {
//                // 用户确认分享后执行的回调函数
//            },
//            cancel: function () {
//                // 用户取消分享后执行的回调函数
//            }
//        });
    })
</script>
<script>
    $('.toKf').click(function(){
        $.post('ajax.php',{linkKf:1},function(data){
            if(0==data){
                alert('客服已接通，请关闭当前页面以便与客服交流');
            }
            if(1==data){
                alert('客服不在线或者忙碌中，请稍候再试');
            }
            if(2==data){
                alert('当前无在线客服，请稍候再试');
            }
        })
    });
</script>
<script>
    function searchGoods(event){
        if(13==event.keyCode){
            var name=$('#key-word').val();
            window.location='controller.php?getList=1&name='+name;
            return false;
        }
    }

</script>

</body>

