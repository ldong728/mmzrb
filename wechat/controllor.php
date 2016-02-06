<?php

include_once '../includePackage.php';
include_once $GLOBALS['mypath'].'/wechat/interfaceHandler.php';
include_once $GLOBALS['mypath'].'/wechat/wechat.php';
$weixin=new wechat(WEIXIN_ID);
$myHandler=new interfaceHandler(WEIXIN_ID);
$weixin->valid();
$msg=$weixin->receiverFilter();
mylog($_SERVER['HTTP_HOST']);
mylog(json_encode($msg,JSON_UNESCAPED_UNICODE));
$random=rand(1000,9999);
if($msg['content']=='网店'){
    $myUrl='您的网店入口为http://'.$_SERVER['HTTP_HOST'].'/'.DOMAIN.'/mobile/?c_id='.$msg['from'].'&#38;rand='.$random.'请勿转发此网址，否则可能导致个人信息泄露';
    $weixin->replytext($myUrl);
}else{
    $weixin->replytext('欢迎访问animee海外购公众服务号');
}


