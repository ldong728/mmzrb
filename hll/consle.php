<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/29
 * Time: 10:50
 */
$mypath = $_SERVER['DOCUMENT_ROOT'] .'/mmzrb';   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath.'/includes/db.inc.php';
include_once $mypath.'/includes/helpers.inc.php';
session_start();





if(isset($_POST['insert'])){
    $g_id=pdoInsert('g_inf_tbl',array('name'=>$_POST['g_name'],'made_in'=>$_POST['made_in'],'sc_id'=>$_POST['sc_id'],'inf'=>$_POST['g_inf']));
    if($g_id!=null){
        if(isset($_POST['sale'])) {
            $d_id = pdoInsert('g_detail_tbl', array('g_id'=>$g_id,'category' => '默认', 'sale' => $_POST['sale'], 'wholesale' => $_POST['wholesale']));
        }
        $sc_id=$_POST['sc_id'];
        $made_in=$_POST['made_in'];
//        printView('hll/view/goods_edit.html.php');
        header('location:index.php?goods-config=1&g_id='.$g_id.'&sc_id='.$sc_id.'&made_in='.$made_in);
        exit;
    }
    exit;
}
if (isset($_POST['category'])) {
    $insert = 'INSERT INTO `category_tbl`SET name = :iname, remark = :iremark ';
    $s = $pdo->prepare($insert);
    $s->bindValue(':iname', $_POST['category']);
    $s->bindValue(':iremark', $_POST['remark']);
    $s->execute();
    printView('hll/view/category_config.html.php');
    exit;
}

if (isset($_POST['sub_category']) && $_POST['father_cg_id'] != '0') {
    $insert = 'INSERT INTO `sub_category_tbl`SET name = :iname, father_id = :ifather_id,remark = :iremark ';
    $s = $pdo->prepare($insert);
    $s->bindValue(':iname', $_POST['sub_category']);
    $s->bindValue(':ifather_id', $_POST['father_cg_id']);
    $s->bindValue(':iremark', $_POST['sub_remark']);
    $s->execute();
    printView('hll/view/category_config.html.php');
    exit;

}
if (isset($_POST['alter'])) {
    $insert = 'UPDATE g_inf_tbl SET name=:name,inf = :inf WHERE id = ' . $_POST['g_id'];
    $s = $pdo->prepare($insert);
    $s->bindValue(':name', $_POST['name']);
    $s->bindValue(':inf', $_POST['g_inf']);
    $s->execute();
    $g_id=$_POST['g_id'];
    printView('hll/view/goods_edit.html.php','货品修改');
    exit;
}
if(isset($_GET['start_promotions'])){
    pdoInsert('promotions_tbl',array('g_id'=>$_GET['g_id'],'d_id'=>$_GET['d_id']));
    header('location: index.php?promotions=1');
    exit;

}
if(isset($_GET['delete_promotions'])){
    $str='delete from promotions_tbl where d_id='.$_GET['d_id'];
    exeNew($str);
    header('location: index.php?promotions=1');
    exit;
}