<?php


if($act=='index'){
    $sql = "select * from news";
    $result = select_list($sql);
    foreach ($result as $key => $value) {
        $result[$key]['time'] = date('Y-m-d',$value['time']);
        $result[$key]['conten'] = htmlspecialchars_decode($value['content']);
        $str =strip_tags(htmlspecialchars_decode($value['content']));//反转义，去掉标签
        $len = mb_strlen($str,'utf8');
        if($len>50){
            $result[$key]['content'] = mb_substr($str,0,50,'utf8');
        }
    }
    $file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
}

else if($act=='add'){

    $sql = "select * from category where cate_id=11";
    $result = select_list($sql);

	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
}
else if($act == 'postadd'){
   for($i=0;$i<100;$i++){
        $file = upload($_FILES);

        // print_r($file);
        // print_r($_POST);
        $data = array_merge($file,$_POST);
        $data['time'] = time();//
        $data['content'] = htmlspecialchars($data['content']);//转义 htmlspecialchars_decode() 反转 字符串变回标签 
        // print_r($data);
        $id = insertAdd('news',$data);
   }
	

    if($id){
    	// echo "<script>alert('添加成功');window.location.href='index.php?m=admin&ctl=user&act=index';</script>";
            echo "<script>alert('添加成功');window.parent.location.reload();</script>";
            
    }
    else{
    	echo "<script>alert('添加失败');</script>";
    }


	
}