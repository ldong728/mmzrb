<!DOCTYPE html>
<html lang = "cn">
<head>
    <meta charset = "utf-8"http-equiv="pragma" content="no-cache" />

    <script src="jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheet/style.css">
    <link href="../stylesheet/style.css" rel="stylesheet" type="text/css">
    <script>
        $(document).ready(function(){

        });

    </script>

</head>
<title>
妈妈在日本
</title>

<body>


<h5 id="login" class="right"><a href="?login=1">登录</a></h5>
<hr/>
<h1 class="center">妈妈在日本</h1>
<hr/>
<nav align="center">
    <ul>
        <li><a href="?country=jp">日本</a> </li>
        <li><a href="?country=us">美国</a></li>
        <li><a href="?country=de">德国</a></li>
    </ul>
</nav>
<?php
if($query!=null){
    foreach($query as $row){
        layout($row['id'],$row['name'],$row['made_in'],$row['sell'],$row['url']);

    }


}




?>

</body>