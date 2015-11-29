<?php

$g_id=(isset($_GET['g_id'])? $_GET['g_id'] : -1);
$sc_id=(isset($_GET['sc_id'])? $_GET['sc_id'] : -1);
$m_i=(isset($_GET['made_in'])? $_GET['made_in']:-1);

?>

<script>
    var g_id = <?php echo $g_id?>;
    var sc_id=
        <?php echo $sc_id?>;
    var mi=
        <?php echo '"'.$m_i.'"' ?>;
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
            <option value = "none"selected="selected">产地</option>
            <option value = "us">美国</option>
            <option value = "de">德国</option>
            <option value = "jp">日本</option>
        </select>

        <select id = "g_name" name = "g_name"></select>
    </div>
    <div id = "g_inf"></div>
<script src="js/goodsInfEdit.js"></script>

<form name="upfile" action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="spic[]" id="v1" /><br/>
    <input type="file" name="spic[]" id="v2" /><br/>
    <input type="file" name="spic[]" id="v3" /><br/>
    <input type="file" name="spic[]" id="v4" /><br/>
    <input type="file" name="spic[]" id="v5" /><br/>
    <input type="file" name="spic[]" id="v6" /><br/>
    <input type="file" name="spic[]" id="v7" /><br/>
    <input type="file" name="spic[]" id="v8" /><br/>
    <input type="hidden" name="g_id" id="g_id_img" value="<?php echo $g_id?>"/>
    <input type="submit" name="sub" value="上传图片" onclick="return Check()" />
    <input type="reset" name="res" value="重填" />
</form>