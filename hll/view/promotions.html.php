<script>
    $(document).ready(function () {
//        $('#temp').append('hahahaha');
        reflashPromotion('all');
        $(".filter").change(function () {
//            $('#temp').append('hahahaha');
            $.post('ajax_request.php', {
                filte: 1,
                made_in: $("#country option:selected").val(),
                sc_id: $("#sc_id option:selected").val()
            }, function (data) {
                $('#promotions_tbl').empty();
                $('#promotions_tbl').append('<tr><td>品名</td><td>规格名</td><td>售价</td><td>操作</td></tr>');
                var list = eval('(' + data + ')');
                $.each(list, function (id, value) {
                    $('#promotions_tbl').append('<tr><td>' + value['name'] + '</td><td>'
                    + value['category'] + '</td><td>'
                    + value['sale'] + '</td><td>'
                    +'<a href="consle.php?start_promotions=1&g_id='+value['g_id']+'&d_id='+value['d_id']+'">进行促销</a></td></tr>');
                });
            });
        });

        $('.time_filter').change(function(){
            reflashPromotion($(this).val());
        });

        $(document).on('change','.start_time',function(){
            $.post('ajax_request.php',{start_time_change:1,id:$(this).attr('id'),value:$(this).val()},function(data){
            });
        });
        $(document).on('change','.end_time',function(){
            $.post('ajax_request.php',{end_time_change:1,id:$(this).attr('id'),value:$(this).val()});
        });
        $(document).on('change','.price',function(){
            $.post('ajax_request.php',{price_change:1,id:$(this).attr('id'),value:$(this).val()},function(data){
            });
        });
//        $(document).on('click','.start_promotions',function(){
//            $.post('ajax_request.php',{start_promotions:$(this).attr('id')});
//
//        });


    });
    var reflashPromotion=function(filteStr){
        $('#on_promotions').empty();
        $('#on_promotions').append('<tr><td>品名</td><td>规格名</td><td>售价</td><td>优惠价</td><td>开始日期</td><td>结束日期</td><td>操作</td></tr>');
        $.post('ajax_request.php',{time_filter:filteStr},function(data){
            var list = eval('(' + data + ')');
            $.each(list,function(id,value){
                $('#on_promotions').append(
                    '<tr><td>' + value['name'] + '</td><td>' + value['category'] + '</td><td>'+value['sale']+'</td><td>'
                    +'<input class="price"id="'+value['id']+'"value="' + value['price'] + '"></td><td>'
                    +'<input class="start_time"id="'+value['id']+'" type="datetime-local"value="'+value['start_time']+'"/></td><td>'
                    +'<input class="end_time"id="'+value['id']+'" type="datetime-local"value="'+value['end_time']+'"/></td><td>'
                    +'<a href="consle.php?delete_promotions=1&d_id='+value['d_id']+'">删除促销</a></td></tr>'
                );

            });
        });

    }
</script>
<div>
    <h3>促销列表</h3>
    <div>
        <input type="radio"name="time_filter" class="time_filter"value="all"checked="true"/>全部
        <input type="radio"name="time_filter" class="time_filter"value="on"/>促销中
        <input type="radio"name="time_filter" class="time_filter"value="after"/>已结束
        <input type="radio"name="time_filter" class="time_filter"value="before"/>未开始
    </div>
    <table id="on_promotions" border="1">

    </table>
</div>


<div>
    <h3>未促销商品</h3>

    <select class="filter" id="sc_id">
        <option value="0">分类</option>
        <?php foreach ($_SESSION['smq'] as $r): ?>
            <option value="<?php echo $r['id'] ?>"><?php htmlout($r['name']) ?></option>
        <?php endforeach; ?>
    </select>

    <select class="filter" id="country">
        <option value="none">产地</option>
        <option value="us">美国</option>
        <option value="de">德国</option>
        <option value="jp">日本</option>
    </select>

</div>



<div id="goods_table">
    <table id="promotions_tbl" border="1">
        <tr>
            <td>品名</td>
            <td>规格名</td>
            <td>售价</td>
            <td>优惠价</td>
            <td>开始日期</td>
            <td>结束日期</td>
            <td>操作</td>
        </tr>


    </table>

</div>