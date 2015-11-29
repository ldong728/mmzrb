<?php

$mypath=$_SERVER['DOCUMENT_ROOT'] . '/mmzrb';
$weixinId='gh_904600228e98';
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
include_once $mypath.'/wechat/wechat.php';
include_once $mypath.'/wechat/interfaceHandler.php';
$weixin=new wechat($weixinId);
$myHandler=new interfaceHandler($weixinId);
$weixin->valid();
$msg=$weixin->receiverFilter();
mylog(getArrayInf($msg));
$random=rand(1000,9999);
if($msg['content']=='网店'){
    $myUrl='您的网店入口为http://115.29.202.69/mmzrb/mobile/?c_id='.$msg['from'].'&#38;rand=5432请勿转发此网址，否则可能导致个人信息泄露';
    mylog($myUrl);
    $weixin->replytext($myUrl);
}else{
    $weixin->replytext($random);
}


