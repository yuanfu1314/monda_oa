<?php
//不限定得执行时间
set_time_limit(0);
//基本应用信息文件
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('Asia/Shanghai');

//增加随机数，防止被机器人爬取的时候执行了自动任务
if(!defined('EXE_CODE')){
	define('EXE_CODE','woYEOn984Ui');
}
define('APP_AUTO_PATH', dirname(__DIR__) . '/');

if (!isset($argv[1]) || EXE_CODE !== $argv[1]){
	exit(0);
}

//数据库操作文件
include("Database.php");
include(APP_AUTO_PATH."/vendor/herosphp/framework/src/files/FileUtils.php");

$db = new database();
$now = date('Y-m-d H:i:s');
//更新状态为正在使用中
$result_using = $db->update("office_apply", array('status' => 1), "time_begin <= '{$now}' AND time_end >= '{$now}' AND status = 0 ");
//更新状态为申请过期
$result_overdue = $db->update("office_apply", array('status' => 2), "time_end < '{$now}' AND status <= 1 ");

if ($result_using === false || $result_overdue === false) {
	$logDir = APP_AUTO_PATH . 'logs/'.date('Y').'/'.date('m').'/';

    if ( !file_exists($logDir) ) {
    	FileUtils::makeFileDirs($logDir);
    } 
    return file_put_contents($logDir.date("Y-m-d").'error.log', '['.date('Y-m-d H:i:s').'] '.$db->mysqli->error."\n", FILE_APPEND);
}
return;

 
