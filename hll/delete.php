<?php
$mypath = $_SERVER['DOCUMENT_ROOT'] .'/mmzrb';   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath.'/includes/db.inc.php';
include_once $mypath.'/includes/helpers.inc.php';
session_start();

if(isset($_SESSION['login'])) {
    if (isset($_GET['delimg'])) {
        unlink('../' . $_GET['delimg']);
        $sql = 'DELETE FROM g_image_tbl WHERE url="' . $_GET['delimg'] . '"';
//    $pdo->exec($sql);
        exeNew($sql);
        $g_id = $_GET['g_id'];
        header('location:index.php?goods-config=1&g_id=' . $g_id);
        exit;

    }


    if (isset($_GET['name'])) {
        echo $_GET['name'];
        exit;
    }
}
?>