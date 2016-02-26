<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/10/29
 * Time: 10:50
 */
include_once '../includePackage.php';
session_start();




if(isset($_SESSION['login'])) {
    if (isset($_POST['insert'])) {
        $g_id = pdoInsert('g_inf_tbl', array('name' => $_POST['g_name'], 'made_in' => $_POST['made_in'], 'sc_id' => $_POST['sc_id'], 'inf' => addslashes($_POST['g_inf'])));
        if ($g_id != null) {
            if (isset($_POST['sale'])) {
                $d_id = pdoInsert('g_detail_tbl', array('g_id' => $g_id, 'category' => '默认', 'sale' => $_POST['sale'], 'wholesale' => $_POST['wholesale']));
            }
            $sc_id = $_POST['sc_id'];
            $made_in = $_POST['made_in'];
//        printView('admin/view/goods_edit.html.php');
            header('location:index.php?goods-config=1&g_id=' . $g_id . '&sc_id=' . $sc_id . '&made_in=' . $made_in);
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
        printView('admin/view/category_config.html.php');
        exit;
    }
    if (isset($_POST['sub_category']) && $_POST['father_cg_id'] != '0') {
        $insert = 'INSERT INTO `sub_category_tbl`SET name = :iname, father_id = :ifather_id,remark = :iremark ';
        $s = $pdo->prepare($insert);
        $s->bindValue(':iname', $_POST['sub_category']);
        $s->bindValue(':ifather_id', $_POST['father_cg_id']);
        $s->bindValue(':iremark', $_POST['sub_remark']);
        $s->execute();
        printView('admin/view/category_config.html.php');
        exit;

    }
    if (isset($_POST['alter'])) {
        pdoUpdate('g_inf_tbl',array('name'=>$_POST['name'],'inf'=>addslashes($_POST['g_inf'])),array('id'=>$_POST['g_id']));
        $g_id = $_POST['g_id'];
        header('location:index.php?goods-config=1&g_id=' . $g_id);
        exit;
    }
    if (isset($_POST['filtOrder'])){
        if(isset($_POST['express'])&&isset($_POST['expressNumber'])&&$_POST['expressNumber']!=''){
            pdoUpdate('order_tbl',array('stu'=>$_POST['stu'],'express_id'=>$_POST['express'],'express_order'=>$_POST['expressNumber']),
                array('id'=>$_POST['filtOrder']));
            if($_POST['stu']=='2'){
                include_once '../wechat/serveManager.php';
                $query=pdoQuery('user_express_query_view',null,array('id'=>$_POST['filtOrder']),' limit 1');
                $inf=$query->fetch();
                $templateArray=array(
                    'first'=>array('value'=>'您在anmiee海外购商城的网购订单已发货：'),
                    'keyword1'=>array('value'=>$inf['express_name'],'color'=>'#0000ff'),
                    'keyword2'=>array('value'=>$inf['express_order'],'color'=>'#0000ff'),
                    'remark'=>array('value'=>'请留意物流电话通知')
                );

                sendTemplateMsg($inf['c_id'],'xXdVKXbkja5RoxRxXxAPfL8SSZlePvgDCnw6ZSXakss','http://m.kuaidi100.com/index_all.html?type='.$inf['express_id'].'&postid='.$inf['express_order'],$templateArray);

            }
        }else{
            pdoUpdate('order_tbl',array('total_fee'=>$_POST['total_fee']),array('id'=>$_POST['filtOrder']));
        }

        header('location:index.php?orders=1');
        exit;
    }
    if (isset($_GET['start_promotions'])) {
        pdoInsert('promotions_tbl', array('g_id' => $_GET['g_id'], 'd_id' => $_GET['d_id']));
        header('location: index.php?promotions=1');
        exit;

    }
    if (isset($_GET['delete_promotions'])) {
        $str = 'delete from promotions_tbl where d_id=' . $_GET['d_id'];
        exeNew($str);
        header('location: index.php?promotions=1');
        exit;
    }
    if(isset($_GET['del_detail_id'])){
        $query=pdoQuery('user_order_view',array('count(*) as num'),array('d_id'=>$_GET['del_detail_id']),' ');
        $value=$query->fetch();
        if($value['num']>0){
            echo 'cannot delete';
        }else{
            pdoDelete('g_detail_tbl',array('id'=>$_GET['del_detail_id']));
            header('location:index.php?goods-config=1&g_id=' .$_GET['g_id']);
        }
        exit;
    }
    if(isset($_GET['wechat'])){

        include_once '../wechat/serveManager.php';
        if(isset($_GET['createButton'])){
            createButtonTemp();
            exit;
        }

    }
    if(isset($_GET['imgUpdate'])){
        mylog('update');
    }
    if(isset($_GET['goodsSituation'])){
        pdoUpdate('g_inf_tbl',array('situation'=>$_GET['goodsSituation']),array('id'=>$_GET['g_id']));
        $g_id=$_GET['g_id'];
        header('location:index.php?goods-config=1&g_id=' . $g_id);
        exit;
    }
    if(isset($_GET['deleteGoods'])){
        pdoDelete('g_inf_tbl',array('id'=>$_GET['g_id']));
        pdoDelete('cart_tbl',array('g_id'=>$_GET['g_id']));
        pdoDelete('favorite_tbl',array('g_id'=>$_GET['g_id']));
        pdoDelete('g_detail_tbl',array('g_id'=>$_GET['g_id']));
        pdoDelete('g_image_tbl',array('g_id'=>$_GET['g_id']));
        header('location:index.php?goods-config=1');
        exit;
    }
}