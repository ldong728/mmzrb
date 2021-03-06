<head>
    <?php include 'templates/header.php'?>
    <link rel="stylesheet" href="stylesheet/address.css"/>
</head>
<body>
<div class="wrap">
    <header class="header">
        <a class="back" href="javascript:window.history.go(-1);"></a>
        <p class="hd_tit">地址管理</p>
        <a class="daohang"href="#"></a>
        <nav class="head_nav">
            <a class="hn_index"href="index.php">首页</a>
            <a class="hn_sort"href="controller.php?getSort=1">分类查找</a>
            <a class="hn_cart"href="controller.php?getCart=1">购物车</a>
            <a class="hn_memb"href="controller.php?customerInf=1">个人中心</a>
        </nav>
        <script src="../js/head.js"></script>
    </header>
    <div class="editAddress">
        <ul class="addressList">
            <?php foreach($addrlist as $row):?>
            <li id="li<?php echo $row['id']?>">
                <a class="address"href="controller.php?settleAccounts=1&addressId=<?php echo $row['id']?>">
                    <div class="address_hd">
                        <p>
                            <?php echo $row['name']?>
                            <span><?php echo $row['phone']?></span>
                        </p>
                        <span><?php echo $row['province'].$row['city'].$row['area'].'  '.$row['address']?></span>
                    </div>
                </a>
                <div class="address_ft"id="<?php echo $row['id']?>">
                    <a class="default <?php echo (1==$row['dft_a']? 'choice':'')?> setdefault"id="dft<?php echo $row['id']?>">设为默认</a>
                    <a class="revise"id="alt<?php echo $row['id']?>"></a>
                    <a class="delete"id="dlt<?php echo $row['id']?>"style="float:right;display:block;padding-top:10px "></a>
                </div>
            </li>
            <?php endforeach?>
        </ul>
        <a class="addressAdd">
            添加新地址
        </a>
    </div>
    <div class="add_Address"id="add_addr"style="display: none">
        <form action="controller.php?alterAddress=1"method="post">
            <div class="inputBox">
                <input type="hidden"name="address_id"id="address_id"value="-1">
                <input type="text" id="name"name="name"placeholder="请输入姓名">
                <input type="text" id="phone"name="phone"placeholder="请输入手机号">
            </div>
            <div class="select"id="area-select">

            </div>
            <div class="textarea">
                <textarea id="address"name="address"placeholder="请输入详细地址"></textarea>
            </div>
            <div class="b_btn">
                <input type="submit"class="btn_save"value="保存地址">
            </div>
        </form>

    </div>
    <div class="toast"></div>
    </div>
<script src="../js/ajaxcity.jquery.js"></script>
<script>
    var url = 'city.php';
    var provinceurl = url + '?a=province';
    var cityurl = url + '?a=city&pid=';
    var areaurl = url + '?a=area&pid=';
    var city_config = {
        'province':'pro',
        'city':'city',
        'area':'area'
    };
    $('#area-select').ajax_city_select(city_config);
    $('select').css('display','block');
</script>
<script>
        $(document).on('click','.revise',function(){

            $.post('ajax.php',{altAddr:1,id:$(this).attr('id').slice(3)},function(data){
                $('#add_addr').fadeIn('slow');
                value=eval('('+data+')');
                $('#address_id').val(value.id);
                $('#name').val(value.name);
                $('#phone').val(value.phone);
                $('#pro').val(value.pro_id);
                $('#city').append('<option value="'+value.city_id+'"selected="selected">'+value.city+'</option>');
                $('#area').append('<option value="'+value.area_id+'"selected="selected">'+value.area+'</option>');
                $('#address').text(value.address);
            });
        });
        $(document).on('click','.addressAdd',function(){
            $.post('ajax.php',{addrNumRequest:1},function(data){
                if(data<5){
                    $('#address_id').val(-1);
                    $('#add_addr').fadeToggle('slow');
                }else{
                    showToast('无法添加新地址');
                }
            })

        });
        $(document).on('click','.default',function(){
            var id=$(this).attr('id').slice(3);
            $('.default').removeClass('choice')
            $(this).addClass('choice');
            $.post('ajax.php',{setDefaultAdress:1,id:id},function(data){

            });

        });
        $(document).on('click','.delete',function(){
            var id=$(this).attr('id').slice(3);
            $.post('ajax.php',{deleteAddr:1,id:id},function(data){
               $('li#li'+id).fadeOut('slow');
            });
        });


</script>
</body>