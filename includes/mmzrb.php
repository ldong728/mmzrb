<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/11/3
 * Time: 23:20
 */

function printView($addr,$title='abc'){
    $mypath= $GLOBALS['mypath'];
    include $mypath.'/admin/templates/header.html.php';
    include $mypath.'/'.$addr;
    include $mypath.'/admin/templates/footer.html.php';
}
function init()
{
    $sub_cg = pdoQuery('category_overview_view', null, null, '');
    foreach ($sub_cg as $sl) {
        $smq[] = array(
            'id' => $sl['id'],
            'name' => $sl['father_name'] . '--' . $sl['sub_name']
        );
    }
    $father_cg = pdoQuery('category_tbl', null, null, '');
    foreach ($father_cg as $l) {
        $mq[] = array(
            'id' => $l['id'],
            'name' => $l['name']
        );
    }
    $_SESSION['mq'] = $mq;
    $_SESSION['smq'] = $smq;
}
function getOrderStu($index){
    $list=array('待付款','已付款','已发货','已完成','异常','退款中','退货中','已取消','已过期','处理中');
    return $list[$index];
}
function getProvince($pro){
    $datafile = 'config/province.inc.php';
    if(file_exists($datafile)){
        $config = include($datafile);
        return $config[$pro];
    }
}
function printViewMobile($addr,$title='abc',$hasInput=false){

    $mypath= $GLOBALS['mypath'];
    if($hasInput){
        include $mypath.'/mobile/templates/headerJs.html.php';

    }else{
        include $mypath.'/mobile/templates/header.html.php';
    }
//    echo 'header OK';

    include $mypath.'/'.$addr;
    include $mypath.'/mobile/templates/footer.html.php';
}
function getCity($pro,$city){
    $datafile = 'config/city.inc.php';
    if(file_exists($datafile)){
        $config = include($datafile);
        $province_id=$pro;
        if($province_id != ''){
            $citylist = array();
            if(is_array($config[$province_id]) && !empty($config[$province_id])){
                $citys = $config[$province_id];
                return $citys[$city];
            }
        }
    }
}
function getArea($pro,$city,$area){
    $datafile = 'config/area.inc.php';
    if(file_exists($datafile)){
        $config = include($datafile);
        $province_id = $pro;
        $city_id = $city;
        if($province_id != '' && $city_id != ''){
            $arealist = array();
            if(isset($config[$province_id][$city_id]) && is_array($config[$province_id][$city_id]) && !empty($config[$province_id][$city_id])){
                $areas = $config[$province_id][$city_id];
                return $areas[$area];
            }
        }
    }
}
function getExpressPrice($addr_id){
    $addrQuery=pdoQuery('address_tbl',array('pro_id','city_id','area_id'),array('id'=>$addr_id),' limit 1');
    $addrId=$addrQuery->fetch();
    $priceQuery=pdoQuery('express_price_tbl',null, array('pro_id'=>$addrId['pro_id']),' limit 1');
    $expressPriceList=$priceQuery->fetch();
//    $expressPrice=$expressPriceList['base_price'];
    return $expressPriceList;
}
function getConfig($path){
    $data=file_get_contents($path);
    return json_decode($data,true);
}
function saveConfig($path,array $config){
    $data=json_encode($config);
    file_put_contents($path,$data);
}