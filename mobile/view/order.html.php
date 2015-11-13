<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>麻麻去日本</title>
    <link rel="stylesheet" href="stylesheet/my-jm.min.css">
    <link rel="stylesheet" href="stylesheet/mobile.css"/>
    <link rel="stylesheet" href="stylesheet/order.css"/>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/jquery.mobile-1.3.2.min.js"></script>
    <script src="../js/ajaxcity.jquery.js"></script>
</head>
<body>
<div data-role="page"id="order-page">
    <div data-role="header"data-position="fixed"data-theme="b">
        <a data-ajax="false" href="index.php" data-role="button" data-icon="home">首页</a>
        <h1>结算</h1>
        <a href="#searchPage" data-role="button" data-icon="search"data-rel="dialog">搜索</a>
    </div>
    <div data-role="content"class="block"id="goods-list">
        <div class="title"><h3 class="title">详    情</h3></div>
        <?php foreach($goodsList as $row):?>
        <div class="goods-block">
            <h4 ><?php echo $row['name']?></h4>
            <p><?php echo $row['category'].'  ¥'.$row['price'].'X'.$row['number']?></p>
            <div class="total">¥<?php echo $row['total']?></div>
        </div>
        <?php endforeach ?>

    </div>
    <div data-role="content"class="block"id="price">
        <div class="total-price">
            <p>总计：¥<?php echo $totalPrice?>共节省：¥<?php echo $totalSave?></p>
        </div>

    </div>
    <div data-role="content"class="block"id="address-select">
        <div class="title"><h3 class="title">收货地址</h3></div>
        <div class="address-block">
            <?php echo $addr?>
        </div>
    </div>
    <div data-role="content"class="block"id="conform">
        <a href="controller.php?orderConfirm=1&addrId=<?php echo $addrrow['id']?>" data-role="button">生成订单</a>
    </div>
</div>

<div data-role="page"id="addr-add">
    <div data-role="header"data-theme="b">
        <a data-rel="back"data-icon="arrow-l"data-iconpos="notext"></a>
        <h1>添加地址</h1>
    </div>
    <div data-role="content"class="block">
        <div id="p-c-a">
        </div>
        <label for="address">地址:</label>
        <textarea name="address"id="address"/></textarea>
        <label for="neme">收件人：</label>
        <input type="text"name="name"id="name"/>
        <label for="phone">联系电话：</label>
        <input type="text"name="phone"id="phone"value="+86"/>


        <button id="submit">提交新地址</button>
    </div>
</div>
<div data-role="page"id="addr-alt">
    <div data-role="header"data-theme="b">
        <a data-rel="back"data-icon="arrow-l"data-iconpos="notext"></a>
        <h1>修改地址</h1>
    </div>
    <div data-role="content"class="block">
        <form action="controller.php?altAddr=1"method="post">
        <label for="address">地址:</label>
        <textarea name="address"id="address"/><?php echo $addrrow['address']?></textarea>
        <label for="neme">收件人：</label>
        <input type="text"name="name"id="name"value="<?php echo $addrrow['name']?>"/>
        <label for="phone">联系电话：</label>
        <input type="text"name="phone"id="phone"value="<?php echo $addrrow['phone']?>"/>
            <input type="hidden"name="id"value="<?php echo $addrrow['id']?>"/>
        <button id="submit">修改</button>
        </form>
    </div>

</div>


<script>
    var p=null;
    var c=null;
    var a=null;
    var addr=null;
    var name=null;
    var phone=null;
    var url = 'city.php';
    var provinceurl = url + '?a=province';
    var cityurl = url + '?a=city&pid=';
    var areaurl = url + '?a=area&pid=';
    var city_config = {
        'province':'pro',
        'city':'city',
        'area':'area'
    };
    $(document).ready(function(){
        $('#p-c-a').ajax_city_select(city_config);

        $(document).on('change','select',function(){
            var value=$(this).find('option:selected').text();
            switch($(this).attr('id')){
                case 'pro':{
                    p=value;
                    break;
                }
                case 'city':{
                    c=value;
                    break;
                }
                case 'area':{
                    a=value;
                    break;
                }
                default :{
                    break;
                }
            }
        });
        $(document).on('change','#name',function(){
            name=$(this).val();
        });
        $(document).on('change','#phone',function(){
            phone=$(this).val();
        });
        $(document).on('change','#address',function(){
            addr=$(this).val();
        });

        $(document).on('tap','#submit',function(){
            if(null!=addr&null!=name&null!=phone){
                $.post('ajax.php',{addAddr:1,province:p,city:c,area:a,address:addr,name:name,phone:phone},function(data){
                    window.location.href='controller.php?settleAccounts=1';
                });

            }


        });


    });


</script>



</body>



