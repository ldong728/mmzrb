<?php

$mypath=$_SERVER['DOCUMENT_ROOT'] . '/mmzrb';
$weixinId='gh_30f5ac5d686e';
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
include_once $mypath.'/wechat/wechat.php';
include_once $mypath.'/wechat/interfaceHandler.php';
$weixin=new wechat($weixinId);
$myHandler=new interfaceHandler($weixinId);
$weixin->valid();
$msg=$weixin->receiverFilter();
$weixin->replytext('http://115.29.202.69/mmzrb/mobile/?c_id='.$msg['from']);


