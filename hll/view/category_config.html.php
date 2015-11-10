
<form action = 'consle.php' method="post">

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
<form action = 'consle.php' method="post" class = "pose">

    <div>
        <p>
            新建子分类
        </p>
        <select name = "father_cg_id">
            <option value = "0">父类</option>
            <?php foreach ($_SESSION['mq']as $row): ?>
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