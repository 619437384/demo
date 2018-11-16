<?php

/*
  文件上传

*/

function upload($array,$upload = 'upload'){
	//文件提交 $array
	$arr = ['image/png','image/jpeg','image/gif']; //图片类型

	$data = [];
	foreach ($array as $key => $value) {
	    //判断图片
		if(!empty($value['name'])){
             //in_array() 判断数组是否存在当前变量
			if(!in_array($value['type'],$arr)){ 
				
	            echo "<script>alert('请上传图片文件');history.back(-1);</script>";
	            exit();
	   
	             
			}

			//限制大小
	        if($value['size'] > (1024*1024*2)){
	        	echo "<script>alert('请上传少于2M图片');history.back(-1);</script>";
	        	 exit();

	        }
	        $upload = 'upload'; 
	        if(!file_exists($upload)){  //生成新目录
	            mkdir($upload,777); // 777 文件最高权限 可读可写
	        }

	        //实现新文件名
	        // echo $value['name'];
	        $file_arr = explode('.',$value['name']); // 文件名拆为数组
	        // print_r($file_arr);
	        // die;

	        $len = count($file_arr); //计算数组个数

	        $ext = '.'.$file_arr[$len-1]; //取数组最后一个元素

	        // echo $ext;
            //新文件名
	        $file = date("Ymd",time()).rand(1000,9999).$ext;
	        // echo $file;	
            //上传图片到指目录
	        $res = move_uploaded_file($value['tmp_name'],$upload.'/'.$file);

	        $data[$key] =$file;
			}

        

		
	}
    return $data;

}


function check_login(){
	// session 24分钟
	if(empty($_SESSION['uname'])){
		echo "<script>alert('请先登录');window.location.href='index.php?m=admin&ctl=login&act=index';</script>";
	}
}