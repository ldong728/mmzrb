<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>麻麻去日本</title>
    <link rel="stylesheet" href="stylesheet/my-jm.min.css">
    <link rel="stylesheet" href="stylesheet/mobile.css"/>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/jquery.mobile-1.3.2.min.js"></script>
    <script src="../js/lazyload.js"></script>
</head>
<body>
<div data-role="page">
    <script>
        $(document).ready(function(){
            $('img.list-img').lazyload();
        });
    </script>
    <div data-role="header"data-theme="b"data-position="fixed">
        <a data-rel="back"data-icon="arrow-l"data-iconpos="notext"></a>
        <h1>列表</h1>
    </div>

    <ul data-role="listview">
        <?php foreach($query as $row):?>
        <li id="li<?php echo $row['g_id']?>" data-icon="plus">
            <a class="inf" data-ajax="false" href="controller.php?goodsdetail=1&g_id=<?php echo $row['g_id']?>">
                <img class="list-img" src="../img/place.jpg"data-original="../<?php echo $row['url']?>">
                <h2><?php echo $row['name']?></h2>
            </a>
        </li>
        <?php endforeach ?>

    </ul>


</div>


</body>