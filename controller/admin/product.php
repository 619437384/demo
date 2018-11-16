
<?php


if($act=='index'){
    $sql = "select * from product";
    $result = select_list($sql);
    foreach ($result as $key => $value) {
    	//反转义标签
    	$result[$key]['content'] = htmlspecialchars_decode($value['content']) ;
    	// 查出上级分类名，替换product cate_id 
    	$sql = "select name from category where id= {$value['cate_id']}";
    	$name = select_one($sql);
    
    	$result[$key]['cate_id'] = $name['name']; 
    	$result[$key]['time']  = date('Y-m-d',$value['time']);
    } 
    $file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
}

else if($act=='add'){

    $sql = "select * from category where cate_id=16";
    $result = select_list($sql);

    include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
}
else if($act == 'postadd'){

	$file = upload($_FILES); //文件上传

	$data = array_merge($file,$_POST);  //表单上传
	$data['time'] = time();//
	$data['content'] = htmlspecialchars($data['content']);//转义 htmlspecialchars_decode() 反转 字符串变回标签 

	$id = insertAdd('product',$data);

    if($id){
    
        echo "<script>alert('添加成功');window.parent.location.reload();</script>";
            
    }
    else{
    	echo "<script>alert('添加失败');</script>";
    }


	
}