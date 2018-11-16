<?php

$sql = "select * from news order by id desc limit 4";
$news = select_list($sql);
// print_r($news);
// require_once('view/home/index.html');

require_once "common.php";