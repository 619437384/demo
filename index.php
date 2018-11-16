<?php

include('model/init.php');  //加载初始化配置

// echo CITL;

$mol = empty($_GET['m'])? 'admin': $_GET['m']; //模块 admin后台  home 前台
$ctl = empty($_GET['ctl'])? 'index': $_GET['ctl'];//控制器文件

//再传多一个变量

$act = isset($_GET['act']) ? $_GET['act'] : 'index';

if($mol=='admin' && $ctl !='login'){
	check_login();
}

// include "controller/admin/news.php";
// include "controller/admin/pro.php";

$file_path = CITL.DS.$mol.DS.$ctl.EXT;//控制器文件

// echo $file_path;
// echo "<br>";

if(file_exists($file_path)){
	include $file_path;
}
else{
	echo "你滚，没你的份";
}

