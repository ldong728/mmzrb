<?php
include_once '../includePackage.php';
session_start();

if(isset($_SESSION['login'])) {
    if (isset($_POST['newGoods'])) {
        $query = pdoQuery('g_inf_tbl', array('id', 'name'), array('id' => $_POST['newGoods']), '');
        $row = $query->fetch();
        echo json_encode($row);
        exit;
    }
    if (isset($_POST['changeCategory'])) {
        pdoUpdate('g_detail_tbl', array('category' => $_POST['value']), array('id' => $_POST['d_id']));
        echo 'category update ok';
        exit;

    }
    if (isset($_POST['changeSale'])) {
        pdoUpdate('g_detail_tbl', array('sale' => $_POST['value']), array('id' => $_POST['d_id']));
        echo 'sale update ok';
        exit;

    }
    if (isset($_POST['changeWholesale'])) {
        pdoUpdate('g_detail_tbl', array('wholesale' => $_POST['value']), array('id' => $_POST['d_id']));
        echo 'wholesale update ok';
        exit;
    }
    if (isset($_POST['set_cover_id'])) {
        pdoUpdate('g_image_tbl', array('front_cover' => 0), array('g_id' => $_POST['g_id']));
        pdoUpdate('g_image_tbl', array('front_cover' => 1), array('id' => $_POST['set_cover_id']));
        echo 'set ok';
        exit;


    }
    if (isset($_POST['addNewCategory'])) {
        $d_id = pdoInsert('g_detail_tbl', array('g_id' => $_POST['g_id']));
        $back = '<p>规格：<input type="text" class="category" id="' . $d_id . '"value="新规格"/>
              售价：<input type="text" class="sale" id="' . $d_id . '"value="99999.99"/>
              批发价：<input type="text" class="wholesale" id="' . $d_id . '"value="99999.99"/>
              <a href="consle.php?del_detail_id=' . $d_id . '&g_id=' . $_POST['g_id'] . '">删除此规格</a>
              </p>';
        echo $back;
        exit;

    }
    if (isset($_POST['countryCheck'])) {
        if ($_POST['sc_id'] == 0) {
            $query = 'SELECT id,name FROM g_inf_tbl WHERE made_in = :country';
            $myquery = $pdo->prepare($query);
            $myquery->bindValue(':country', $_POST['countryCheck']);
            $myquery->execute();
        } else {
            $query = 'SELECT id,name FROM g_inf_tbl WHERE made_in = :country AND g_inf_tbl
            .sc_id = :sc_id';
            $myquery = $pdo->prepare($query);
            $myquery->bindValue(':country', $_POST['countryCheck']);
            $myquery->bindValue(':sc_id', $_POST['sc_id']);
            $myquery->execute();
        }
        $back = '<option value = "0">请选择商品</option>';
        foreach ($myquery as $row) {
            $back = $back . '<option value = "' . $row['id'] . '">' . $row['name'] . '</option>';
        }
        echo $back;

        exit;
    }
    if (isset($_POST['categoryCheck'])) {
        $where=array('sc_id'=>$_POST['categoryCheck']);
        if (isset($_POST['country_id'])&&$_POST['country_id'] != 'none') {
            $where['made_in']=$_POST['country_id'];
        }
        $myquery=pdoQuery('g_inf_tbl',array('id','name'),$where,null);
        $back = '<option value = "0">请选择商品</option>';
        foreach ($myquery as $row) {
            $back = $back . '<option value = "' . $row['id'] . '">' . $row['name'] . '</option>';
        }
        echo $back;
//        mylog($back);
        exit;
    }
    if (isset($_POST['filte'])) {
        $where = array();
        if ($_POST['made_in'] != 'none') {
//        mylog('post made_in:'.$_POST['made_in']);
            $where['made_in'] = $_POST['made_in'];
        }
        if ($_POST['sc_id'] != 'none') {
            $where['sc_id'] = $_POST['sc_id'];
        }
        $query = pdoQuery('g_detail_view', null, $where, 'and d_id not in (select d_id from promotions_tbl)');
        $data = array();
        foreach ($query as $row) {
            $data[] = $row;
        }
//    echo $_POST['made_in'].'and'.$_POST['sc_id'];
//    exit;
        $json = json_encode($data);
        echo $json;
        exit;
    }
    if (isset($_POST['adfilte'])) {
        $where = array();
        if ($_POST['made_in'] != 'none') {
            $where['made_in'] = $_POST['made_in'];
        }
        if ($_POST['sc_id'] != 'none') {
            $where['sc_id'] = $_POST['sc_id'];
        }
        $query = pdoQuery('g_inf_tbl', array('id', 'name', 'on_ad'), $where, null);
        $data = array();
        foreach ($query as $row) {
            $data[] = $row;
        }
        $json = json_encode($data);
        echo $json;
        exit;


    }
    if (isset($_POST["g_id"])) {
        $query = pdoQuery('g_inf_tbl', array('name', 'inf'), array('id' => $_POST['g_id']), ' limit 1');
        if ($goodsInf = $query->fetch()) {
            $back['goodsInf']=$goodsInf;
            $query = pdoQuery('g_detail_tbl', array('id', 'category', 'sale', 'wholesale'), array('g_id' => $_POST['g_id']), null);
            foreach ($query as $detailRow) {
                $back['detail'][]=$detailRow;
            }
            $img = pdoQuery('g_image_tbl', array('id', 'url', 'front_cover'), array('g_id' => $_POST['g_id']), null);
            foreach($img as $imgrow){
                $back['img'][]=$imgrow;
            }
            $jsonBack=json_encode($back,JSON_UNESCAPED_UNICODE);
//            mylog($jsonBack);
            echo $jsonBack;
            exit;

        }

    }
    if (isset($_POST['start_time_change'])) {
        pdoUpdate('promotions_tbl', array('start_time' => $_POST['value']), array('id' => $_POST['id']));
        echo $_POST['value'];
        exit;
    }
    if (isset($_POST['end_time_change'])) {
        pdoUpdate('promotions_tbl', array('end_time' => $_POST['value']), array('id' => $_POST['id']));
        echo $_POST['value'];
        exit;
    }
    if (isset($_POST['price_change'])) {
        pdoUpdate('promotions_tbl', array('price' => $_POST['value']), array('id' => $_POST['id']));
        echo $_POST['value'];
        exit;
    }
    if (isset($_POST['time_filter'])) {
        $preWhere = '';
        switch ($_POST['time_filter']) {

            case 'on': {
                $preWhere = ' where now()<end_time and now()>start_time';
                break;
            }
            case 'before': {
                $preWhere = ' where now()<start_time';
                break;
            }
            case 'after': {
                $preWhere = 'where now()>end_time';
                break;
            }
            default: {
            break;
            }
        }
        $data = array();
        $query = pdoQuery('promotions_view', null, null, $preWhere);
        foreach ($query as $row) {
            $date[] = array(
                'id' => $row['id'],
                'd_id' => $row['d_id'],
                'name' => $row['name'],
                'category' => $row['category'],
                'sale' => $row['sale'],
                'price' => $row['price'],
                'start_time' => date("Y-m-d\TH:i:s", strtotime($row['start_time'])),
                'end_time' => date("Y-m-d\TH:i:s", strtotime($row['end_time'])),
            );

        }
        $json = json_encode($date);
//    mylog($json);
        echo $json;
        exit;
    }
    if (isset($_POST['switch_ad'])) {
//    $inf=pdoUpdate('g_inf_tbl',array('on_ad'=>"on_ad+1"),array('id'=>$_POST['ad_g_id']));
        $sqlstr = 'update g_inf_tbl set on_ad=on_ad+1 where id=' . $_POST['ad_g_id'];
        $inf = exeNew($sqlstr);
        echo $inf;
        exit;
    }
    if(isset($_POST['getOrderDetail'])){
        $query=pdoQuery('user_order_view',null,array('o_id'=>$_POST['o_id']),'');
        foreach ($query as $row) {
            $detail[]=$row;
        }
        echo json_encode($detail);
    }
    if(isset($_POST['changeCateHome'])){
        $configPath=$GLOBALS['mypath'].'/mobile/config/config.json';
        pdoUpdate('category_tbl',array('remark'=>$_POST['stu']),array('id'=>$_POST['id']));
        $query=pdoQuery('category_tbl',array('count(*) as num'),array('remark'=>'home'),null);
        $num=$query->fetch();
        $config=getConfig($configPath);
        $config['cateWidth']=100/$num['num']<20? 20:100/$num['num'];
        saveConfig($configPath,$config);
        echo 'ok';
        exit;
    }
}
?>