<?php
//以下为测试公众号用
//define('APP_ID','wx03393af10613da23');
//define('APP_SECRET','40751854901cc489eddd055538224e8a');
//define('MCH_ID','now is null');
//define('KEY','now is null');
//define('WEIXIN_ID','gh_964192c927cb');
//define("TOKEN", "godlee");
//define('DOMAIN',"mmzrb");
//define('NOTIFY_URL',"now is null");
//define("DB_NAME","gshop_db");
//define("DB_USER","gshopUser");
//define("DB_PSW","cT9vVpxBLQaFQYrh");
//$mypath = $_SERVER['DOCUMENT_ROOT'] . '/'.DOMAIN;   //用于直接部署

//以下为hll专用
define('APP_ID','wxd609b11762d0ba0c');
define('APP_SECRET','8c5d40fb4d7d21ea48182d8a006fb7c1');
define('MCH_ID','1301674601');
define('KEY','qex1VQe1tBCxIi3vvAToCM5OUliNuLy9');
define('WEIXIN_ID','gh_01f35fa67e06');
define("TOKEN", "godlee");
define('DOMAIN',"mmzrb");
define("DB_NAME","mmzrb_db");
define("DB_USER","mmzrb");
define("DB_PSW","godlee1394");
$mypath = $_SERVER['DOCUMENT_ROOT'] . '/'.DOMAIN;   //用于直接部署

include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
include_once $mypath.'/includes/db.class.php';
include_once $mypath . '/includes/mmzrb.php';
header("Content-Type:text/html; charset=utf-8");