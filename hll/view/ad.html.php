<?php $adQuery=$GLOBALS['adQuery']?>


<table border="1">
    <tr>
        <td>位置</td>
        <td>商品</td>
        <td>地址</td>
        <td>图片</td>
        <td>更新</td>
    </tr>
    <?php foreach ($adQuery as $row):?>
        <form action="upload.php"method="post"enctype="multipart/form-data">

        <tr>
            <input type="hidden"name="altAd"value="<?php echo $row['id']?>">
            <input type="hidden"name="adImg"value="../<?php echo $row['img_url']?>">
            <td><?php echo $row['category']?></td>
            <td>
                <select id = "sc_id">
                    <option value = "0">分类</option>
                    <?php foreach ($_SESSION['smq'] as $r): ?>
                        <option value = "<?php echo $r['id'] ?>"><?php  htmlout($r['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <select id="g_name" name="g_id"></select>
            </td>
            <td></td>
            <td><img src="../<?php echo $row['img_url']?>" style="width: 100px;height: 100px"> </td>
            <td><input type="file"name="adPic"><input type="submit"></td>

        </tr>
        </form>
    <?php endforeach?>



</table>

<script>
    $("#sc_id").change(function(){
        $("#g_name").load("ajax_request.php",{categoryCheck: $("#sc_id option:selected").val(),
            country_id: 'none'},$("#g_name").empty())
    });
</script>