<div data-role="page">
    <div data-role="header"data-theme="b">
        <a data-rel="back"data-icon="arrow-l"data-iconpos="notext"></a>
        <h1>切换地址</h1>
    </div>
    <div data-role="content" class="block">
        <ul data-role="listview">
            <?php foreach($addrQuery as $row):?>
                <li data-icon="delete" id="<?php echo $row['id']?>">
                    <a href="controller.php?changeAddr=1&addressId=<?php echo $row['id']?>">
                        <p><?php echo $row['province'].$row['city'].$row['area']?></p>
                        <p><?php echo $row['address']?></p>
                        <p><?php echo $row['name']?></p>
                        <p><?php echo $row['phone']?></p>
                    </a>
                    <a href="#">

                    </a>
                </li>

            <?php endforeach?>
        </ul>

    </div>


</div>