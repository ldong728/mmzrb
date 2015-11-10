<!--<!DOCTYPE html>-->
<!--<html lang = "cn">-->
<!--<head>-->
<!--    <meta charset = "utf-8">-->
<!--    <script src="../js/jquery.js"></script>-->

<?php
$mq=$_SESSION['mq'];
$smq=$_SESSION['smq'];
?>

    <script>
        $(document).ready(function(){
            $(".pose").css("left","600px");

            $(".country").change(function(){
                $("#g_name").load("ajax_request.php",{countryCheck: $(".country option:selected").val(),
                    sc_id:$("#sc_id option:selected").val()},$("#g_name").empty())
            });
            $("#g_name").change(function(){
                $("#g_inf").load("ajax_request.php",{g_id:$("#g_name option:selected").val()});
                $("#g_id_img").val($("#g_name option:selected").val());
            });
            $("#sc_id").change(function(){
                $("#g_name").load("ajax_request.php",{categoryCheck: $("#sc_id option:selected").val(),
                    country_id: $(".country option:selected").val()},$("#g_name").empty())

            });
            $("img.demo").click(function(){
            });
        });
    </script>
    <title>货物登入</title>




<form action = '?' method="post">

    <div>
        <p>
            新建主分类
        </p>
        <label for = "category">名称：
            <input type = "text" name = "category">
        </label>
    </div>
    <div>
        <label for = "remark">备注：
            <input type = "text" name = "remark">
        </label>
    </div>
    <div>
        <input type = "submit" value = "确定">
    </div>
</form>

<form action = '?' method="post" class = "pose">

    <div>
        <p>
            新建子分类
        </p>
        <select name = "father_cg_id">
            <option value = "0">父类</option>
            <?php foreach ($mq as $row): ?>
                <option value = "<?php echo $row['id'] ?>"><?php  htmlout($row['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <br/>

        <label for = "sub_category">名称：
            <input type = "text" name = "sub_category">
        </label>
    </div>
    <div>
        <label for = "sub_remark">备注：
            <input type = "text" name = "sub_remark">
        </label>
    </div>
    <div>
        <input type = "submit" value = "确定">
    </div>
</form>

<br/>
<br/>
<form action = '?' method="post">

    <div>
        <p>
            新商品登录
        </p>
        <select name = "sc_id">
            <option value = "0">分类</option>
            <?php foreach ($smq as $r): ?>
                <option value = "<?php echo $r['id'] ?>"><?php  htmlout($r['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <select name = "made_in">
            <option value = "null">产地</option>
            <option value = "us">美国</option>
            <option value = "de">德国</option>
            <option value = "jp">日本</option>
        </select>
        <br/>
        <label for = "g_name">名称：
            <input type = "text" name = "g_name">
        </label>
    </div>
    <div>
        <label for = "inf">介绍：
            <textarea id = "textarea" name = "g_inf" rows = "15" cols = "80"></textarea>
        </label>
    </div>
    <div>
        <label for = "num">数量：
            <input type = "text" name = "num">
        </label>
        <label for = "sell">销售价：
            <input type = "text" name = "sell">
        </label>
        <label for = "wholesale">批发价：
            <input type = "text" name = "wholesale">
        </label>
    </div>

    <div>
        <input type = "hidden" name = "insert" value = "true">
        <input type = "submit" value = "确定">
    </div>

</form>
<br/>
<br/>
<form action="" method="post" id = "alter">
    <div>
        商品修改
    </div>
    <div>

        <select id = "sc_id">
            <option value = "0">分类</option>
            <?php foreach ($smq as $r): ?>
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
</form>

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