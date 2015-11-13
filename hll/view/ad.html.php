<script>
    $(document).ready(function () {
//        reflashAd('all');
        $(".filter").change(function() {
            $.post('ajax_request.php', {
                adfilte: 1,
                made_in: $("#country option:selected").val(),
                sc_id: $("#sc_id option:selected").val()
            }, function (data) {
//                $('#temp').append(data);
                $('#ad_tbl').empty();
                $('#ad_tbl').append('<tr><td>品名</td><td>广告中</td></tr>');
                var list = eval('(' + data + ')');

                $.each(list, function (id, value) {
                    var checked='';
                    if(value['on_ad']%2!=0){
                        checked='checked=true';
                    }
                    $('#ad_tbl').append('<tr><td><a href=index.php?goods-config=1&g_id='+value['id']+'>' + value['name'] + '</a></td><td>'
                    +'<input type="checkbox"class="adSwitch"id="'+value['id']+'"'+checked+'/>');
                });
            });
        });
        $(document).on('change','.adSwitch',function(){
            $.post('ajax_request.php',{switch_ad:1,ad_g_id:$(this).attr('id')});

        });


    });
</script>

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

<table id="ad_tbl" border="1">


</table>