<?php
define('DEBUG',true);

function html($text)
{
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlout($text)
{
	echo html($text);
}

function output($string){
    header("Content-Type:text/html; charset=utf-8");
    echo '<p class = "warning">'. $string.'</p>';

}
function formatOutput($string){
//    $str=html($string);
    $str=preg_replace('/___/','<input type="text"/>',$string);
    return $str;

}

function printInf($p){
    echo '<br/>'.'{';
    foreach ($p as $k=>$v) {
       echo $k.':  ';
        if(is_array($v)){
            printInf($v);
        }else{
            echo $v.',';
        }

    }
    echo '}';
}
function mylog($str){
    if(DEBUG) {
        $log = date('Y.m.d.H:i:s', time()) . ':  ' . $str . "\n";
        file_put_contents($GLOBALS['mypath'] . '/log.txt', $log, FILE_APPEND);
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

function printView($addr,$title='abc'){

    $mypath= $GLOBALS['mypath'];
    include $mypath.'/hll/templates/header.html.php';
    include $mypath.'/'.$addr;
    include $mypath.'/hll/templates/footer.html.php';
}
function getRandStr($length = 16)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}
function getOrderStu($index){
    $list=array('待付款','已付款','已发货','已完成','异常','退款中','退货中','已取消','已过期');
    return $list[$index];
}
