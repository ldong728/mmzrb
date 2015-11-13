<?php
$mypath = $_SERVER['DOCUMENT_ROOT'] . '/mmzrb';   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
session_start();

if (isset($_POST['g_id']) && $_POST['g_id'] != '-1') {
    $file = $_FILES['spic'];
    $inf = '';
    for ($i = 0; $i < count($file['name']); $i++) {

        if ((($file["type"][$i] == "image/gif")
                || ($file["type"][$i] == "image/jpeg")
                || ($file["type"][$i] == "image/pjpeg"))
            && ($file["size"][$i] < 500000)
        ) {
            if ($file["error"][$i] > 0) {
                $inf= "Return Code: " . $file["error"][$i] . "<br />";
                report($inf);
                exit;
            } else {
                $inf = "Upload: " . $file["name"][$i] . "<br />".
                    "Type: " . $file["type"][$i] . "<br />". "Size: " .
                    ($file["size"][$i] / 1024) . " Kb<br />".
                    "Temp file: " . $file["tmp_name"][$i] . "<br />";
                $img_name = $_POST['g_id'] . '_' . md5($file["name"][$i]) . '.jpg';
                if (file_exists("../g_img/" . $img_name)) {
                    $inf = $inf.$file["name"][$i] . " already exists. ";
                } else {
                    move_uploaded_file($file["tmp_name"][$i],
                        "../g_img/" . $img_name);
                    $sql = 'INSERT INTO g_image_tbl SET g_id = :id, url=:url';
                    $excu= $pdo->prepare($sql);
                    $excu->bindValue(':id',$_POST['g_id']);
                    $excu->bindValue(':url','g_img/'.$img_name);
                    $excu->execute();
                    header("Content-Type:text/html;charset=utf-8");
                    $inf = $inf. "图片" . $file["name"][$i] . "上传成功 <br/>";
                }
            }
        } else {
//            header("Content-Type:text/html;charset=utf-8");
            $inf=$inf. "没有文件上传" . '<br/>';
        }


    }
} else {
   $inf = '请选择商品';
}
$g_id=$_POST['g_id'];
//printView('hll/view/goods_edit.html.php');
header('location:index.php?goods-config=1&g_id='.$g_id);
exit;

?>