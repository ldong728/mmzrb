<?php
include 'htmlHead.php';
?>

<body>
<h2><?php echo $g_name ?></h2>
<?php
for($i=0;$i<count($img);$i++){
echo '<P><img src="'.$img[$i].'"/></P>';

}
?>
<p><?php echo $g_inf ?></p>
</body>