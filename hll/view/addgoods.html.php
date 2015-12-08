<?php
$smq=$_SESSION['smq'];
?>


<div>
    <form action="consle.php" method="post">
        <div>
            <p>
                新商品登录
            </p>
            <select name="sc_id">
                <option value="0">分类</option>
                <?php foreach ($smq as $r): ?>
                    <option value="<?php echo $r['id'] ?>"><?php htmlout($r['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <select name="made_in">
                <option value="null">产地</option>
                <option value="us">美国</option>
                <option value="de">德国</option>
                <option value="jp">日本</option>
            </select>
            <br/>
            <label for="g_name">名称：
                <input type="text" name="g_name">
            </label>
        </div>
        <div>
            <label for="inf">介绍：
                <script type="text/plain" id="myEditor" style="width:1000px;height:240px;">
    <p>这里我可以写一些输入提示</p>
</script>
            </label>
        </div>
        <div>

        </div>
        <div>
            <label for="sale">销售价：
                <input type="text" name="sale">
            </label>
            <label for="wholesale">批发价：
                <input type="text" name="wholesale">
            </label>
        </div>
        <div>


        </div>


        <div>
            <input type="hidden" name="insert" value="true">
            <input type="submit" value="确定">
        </div>

    </form>

    <!--style给定宽度可以影响编辑器的最终宽度-->
<!--    <link href="../uedit/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">-->
    <script type="text/javascript" charset="utf-8" src="../uedit/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="../uedit/umeditor.min.js"></script>

    <script type="text/javascript">
        var um = UM.getEditor('myEditor');

    </script>

</div>