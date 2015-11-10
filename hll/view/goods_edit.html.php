<?php

$g_id=(isset($GLOBALS['g_id'])? $GLOBALS['g_id'] : -1);
$sc_id=(isset($GLOBALS['sc_id'])? $GLOBALS['sc_id'] : -1);
$m_i=(isset($GLOBALS['made_in'])? $GLOBALS['made_in']:-1);

?>

<script>
    $(document).ready(function () {
        var g_id = <?php echo $g_id?>;
        var sc_id=
            <?php echo $sc_id?>;
        var mi=
            <?php echo '"'.$m_i.'"' ?>;
        if(g_id!=-1){
            $("#sc_id").val(sc_id);
            $("#made_in").val(mi);
            $.post('ajax_request.php',{newGoods:g_id},function(data){
                var inf=eval('('+data+')');
                $('#g_name').append('<option value = "'+inf.id+'">'+inf.name+'</option>');
            });
            $("#g_inf").load("ajax_request.php",{g_id:g_id});
            $("#g_id_img").val(g_id);
        }
        $(".country").change(function(){
            $("#g_name").load("ajax_request.php",{countryCheck: $(".country option:selected").val(),
                sc_id:$("#sc_id option:selected").val()},$("#g_name").empty())
        });
        $("#g_name").change(function(){
            g_id=$("#g_name option:selected").val();
            $("#g_inf").load("ajax_request.php",{g_id:$("#g_name option:selected").val()});
            $("#g_id_img").val($("#g_name option:selected").val());
        });
        $("#sc_id").change(function(){
            $("#g_name").load("ajax_request.php",{categoryCheck: $("#sc_id option:selected").val(),
                country_id: $(".country option:selected").val()},$("#g_name").empty())
        });
        $(document).on('change','.category',function(){
            $.post('ajax_request.php',{changeCategory:1,d_id:$(this).attr('id'),value:$(this).val()});

        })
        $(document).on('change','.sale',function(){
            $.post('ajax_request.php',{changeSale:1,d_id: $(this).attr("id"),value:$(this).val()});
        });
        $(document).on('change','.wholesale',function(){
            $.post('ajax_request.php',{changeWholesale:1,d_id: $(this).attr("id"),value:$(this).val()});
        });
        $(document).on('click','#add_category',function(){
            $.post('ajax_request.php',{addNewCategory:1,g_id:g_id},function(data){
                $('#category_block').append(data);
            });
        });
        $(document).on('click','.is_cover',function(){
            $.post('ajax_request.php',{set_cover_id:$(this).val(),g_id:g_id});
        });
    });
</script>
<div id="temp">


</div>


    <div>
        商品修改
    </div>
    <div>

        <select id = "sc_id">
            <option value = "0">分类</option>
            <?php foreach ($_SESSION['smq'] as $r): ?>
                <option value = "<?php echo $r['id'] ?>"><?php  htmlout($r['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <select class = "country" id = "made_in">
            <option value = "none">产地</option>
            <option value = "us">美国</option>
            <option value = "de">德国</option>
            <option value = "jp">日本</option>
        </select>

        <select id = "g_name" name = "g_name"></select>
    </div>
    <div id = "g_inf"></div>


<form name="upfile" action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="spic[]" id="v1" /><br/>
    <input type="file" name="spic[]" id="v2" /><br/>
    <input type="file" name="spic[]" id="v3" /><br/>
    <input type="file" name="spic[]" id="v4" /><br/>
    <input type="file" name="spic[]" id="v5" /><br/>
    <input type="file" name="spic[]" id="v6" /><br/>
    <input type="file" name="spic[]" id="v7" /><br/>
    <input type="file" name="spic[]" id="v8" /><br/>
    <input type="hidden" name="g_id" id="g_id_img" value="-1"/>
    <input type="submit" name="sub" value="上传图片" onclick="return Check()" />
    <input type="reset" name="res" value="重填" />
</form>