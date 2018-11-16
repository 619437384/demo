<?php
/*
分类管理
*/

switch ($act) {
	case 'index':
	    $sql = "select * from category";
	    $result = select_list($sql);
	    foreach ($result as $key => $value) {
	    	$sql = "select name from category where id={$value['cate_id']}";
	    	$name = select_one($sql);
	    	$result[$key]['cate_id'] = $name['name'];
	    	if(empty($value['cate_id'])){
	    		$result[$key]['cate_id'] = '顶级分类';
	    	}
	    	$result[$key]['is_show'] = $value['is_show']==1 ? '显示':'隐藏';
            $result[$key]['url_path'] = empty($value['url_path']) ? 'NULL':$value['url_path'];


	    }
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	
	case 'add':

	    // print_r(getList());die;
	    $tree = getList();
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	case 'postadd':
	    $data = $_POST;

	    
		$keys = array_keys($data);
        $values= array_values($data);
        $str1 = "`".implode('`,`', $keys)."`";
        $str2 = "'".implode("','", $values)."'";
        $sql = "insert into category($str1) values($str2)";
        // echo $sql;
        $id = add($sql);

        if($id){
        	// echo "<script>alert('添加成功');window.location.href='index.php?m=admin&ctl=user&act=index';</script>";
                echo "<script>alert('添加成功');window.parent.location.reload();</script>";
                
        }
        else{
        	echo "<script>alert('添加失败');</script>";
        }
	break;
	case 'update':

	     //当前ID数据
		$id = $_GET['id'];
		$sql = "select * from category where id ={$id}";
		$result = select_one($sql);
		//无限极分类
		$tree = getList();
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	case 'updatepost':
		// print_r($_POST);
	    $arr = $_POST;
	    $data = '';
        foreach ($arr as $key => $value) {
            $data .= "`".$key."`" ."='".$value."',";
        }
       // echo $data;
        $str = rtrim($data,',');
       // echo $str;
        $sql = "update category

         set $str where id={$arr['id']}";
        
        $result = update($sql);  //修改

        if($result){
                 echo "<script>alert('修改成功');window.parent.location.reload();</script>";
        }else{
            echo "<script>alert('修改失败');history.back(-1);</script>";
        }


}