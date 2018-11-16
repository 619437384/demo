<?php

$sql = "select * from category where cate_id=2";

$menu = select_list($sql); //头部菜单


require_once(VIEW.DS.$mol.DS.'header'.HTL);  //头部静态页

require_once(VIEW.DS.$mol.DS.$ctl.HTL); //当前控制下的页面

require_once(VIEW.DS.$mol.DS.'footer'.HTL); //底部页面
