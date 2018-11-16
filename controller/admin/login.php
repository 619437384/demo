<?php
/*

限制不是我们网站的用户登录，用到会话控制 session cookie
1.用户名对比 数据库用户表
2.密码对比
3.session储存  开启
4.跳转

*/

if($act=='index'){

	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;

    include $file;
}

elseif($act == "checkpost"){
	// print_r($_POST);

	// IP地址判断
	$data = $_POST;
	// $data['某某数据库字段名'] = $_POST['某某前端名']
	if(strtolower($data['verify']) != $_SESSION['code']){  //strupper 转大写
		echo "<script>alert('验证码不正确，请重输');history.back(-1);</script>";
		exit();
	}
	$sql = "select * from user where username='{$data['username']}'";
    //  # 1=1
	$result = select_one($sql);
    
	if($result){
		if(Md5($data['password']) == $result['password']){
			$_SESSION['uname'] = $data['username'];
			$_SESSION['nickname'] = $result['nickname'];
			echo "<script>alert('登录成功');window.location.href='index.php?m=admin&ctl=index&act=index';</script>";
		}else{
			echo "<script>alert('用户密码不正确，请重输');history.back(-1);</script>";
		}
	}else{
		echo "<script>alert('用户信息错误，请重输');history.back(-1);</script>";
	}
}

elseif ($act=='vcode') {
	include "model/code.php";

	
	$code = new ValidateCode();  //实例化验证类
	$code->doimg(); //对外方法
	$_SESSION['code'] = $code->getCode();
}


elseif($act =='out'){
	session_destroy();
	// $_SESSION['uname'] = '';
	// $_SESSION['uname'] = null;

	echo "<script>alert('退出成功');window.location.href='index.php?m=admin&ctl=login&act=index';</script>";
}