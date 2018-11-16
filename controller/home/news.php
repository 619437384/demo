<?php

$file = "view/rbm/output00001.html"; 
if(file_exists($file)){
	// echo 123;
	// $result = file_get_contents('view/rbm/output00001.html');
	// echo $result;
	require_once("view/rbm/output00001.html");  //缓存文件
	exit();
}
ob_start();//打开缓冲区
$pid = empty($_GET['cate_id']) ? '12' :$_GET['cate_id'];
// echo $pid;
//新闻分类菜单 表category
$sql = "select * from category where cate_id=11";
$news_menu = select_list($sql);

//分类标题  class="title"

$sql = "select name from category where id = $pid";
$cate_tit = select_one($sql);

//新闻列表数据  表news cate_id = $pid

//分页  
// select * from news where cate_id={$pid} limit 起始页,一页多少条数据 order by id desc ;
// $page 页码
$page = empty($_GET['page']) ? 1 : $_GET['page'];
$num = 10;

// 第一页page=1 0   9  第二页 page=2 10 ,19 第三页page=3  20,29
$start_page = $num*($page-1);

$sql = "select * from news where cate_id={$pid} order by id desc limit $start_page, $num";

$news = select_list($sql);

//页码跳转

//上一页

$prev = $page>1 ? $page-1 : 1;

//总条数
$sql = "select count(id) as count from news  where cate_id={$pid}";//
//聚合函数 count sum  as 重命名
$total = select_one($sql);
//总页数
$page_total = ceil($total['count']/$num); //10/3 = 3 1  ceil() 3.3 4 向上取值  floor() 向下取值  3.3 4

//下一页
$next = ($page < $page_total and $page >0) ? $page + 1 : $page_total; 

require_once "common.php";

/*
ob_start();开启缓存



*/


$content = ob_get_contents();//取得php页面输出的全部内容 
$fp = fopen("view/rbm/output00001.html", "w"); //I/O 创建一个文件，并打开，准备写入  如果文件不存在会生成新文件 w 写入读取 r 读取
fwrite($fp, $content); //把php页面的内容全部写入output00001.html，然后…… 
fclose($fp); //关闭文件

