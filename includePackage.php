<?php
define('APP_ID','wx03393af10613da23');
define('APP_SECRET','40751854901cc489eddd055538224e8a');
define('WEIXIN_ID','gh_964192c927cb');
define("TOKEN", "godlee");
$mypath = $_SERVER['DOCUMENT_ROOT'] . '/mmzrb';   //用于直接部署

include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
include_once $mypath . '/includes/mmzrb.php';
header("Content-Type:text/html; charset=utf-8");