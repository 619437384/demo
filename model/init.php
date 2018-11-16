<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');//中国时区
session_start(); 
//路径  controller
define('CITL','controller');

define('DS','/');

define('EXT','.php');

//路径 view

define('VIEW','view');
define('PUBLICS','public'.DS.'admin'.DS);
define('HTL','.html');


define('C_PATH','controller'.DS.'admin'.DS); //admin控制器的路径的常量
define('FONTS','font'.DS);

//前端资源地址

define('HOME','public'.DS.'home'.DS);


//数据库配置

// 初始化配置

define('HOST','127.0.0.1');  //地址，域名

define('USER','root'); //数据库帐号


define('PASSWORD','root'); //数据库密码

define('DBNAME','php'); //数据库名

define('CHARSET','utf8'); //编码



include "model/db.php";
include "func.php";

db();





