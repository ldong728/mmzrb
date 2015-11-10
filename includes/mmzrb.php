<?php
/**
 * Created by PhpStorm.
 * User: godlee
 * Date: 2015/11/3
 * Time: 23:20
 */
$mypath = $_SERVER['DOCUMENT_ROOT'] . '/mmzrb';   //用于直接部署
include_once $mypath . '/includes/magicquotes.inc.php';
include_once $mypath . '/includes/db.inc.php';
include_once $mypath . '/includes/helpers.inc.php';
session_start();
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