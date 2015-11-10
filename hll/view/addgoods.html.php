<?php
$smq=$_SESSION['smq'];
?>

<script>
    $(document).ready(function(){





    });

</script>

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
                <textarea id="textarea" name="g_inf" rows="15" cols="80"></textarea>
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

</div>