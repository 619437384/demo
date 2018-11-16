<?php
/*
用户管理

*/
switch ($act) {
	case 'index':
        //加载静态页面处理业务逻辑
                
                $sql = "select * from user order by user_id desc"; //倒斜查询
                $result = select_list($sql);
        // print_r($result);
                foreach ($result as $key => $value) {
                        $result[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
                        $result[$key]['static'] = $value['static'] == 0 ? '正常':'不正常';
                }


		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	case 'add':
        //加载静态页面处理业务逻辑
        // token 令牌
        $token = md5('欧阳');
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	case 'addpost':
        //加载静态页面处理业务逻辑
                // if($_POST['token'] != MD5('欧阳')){
                //     return false;
                // }
                $data = $_POST;

                // htmlspecialchars trip_tags trim 
                $reg = "/^[\w-]{6,16}$/"
                if(!preg_match($reg,$data['username'])){
                    echo "<script>alert('请入英文或数字、下划线，长度6-16');</script>";
                    exit();
                }
                $data['password'] = md5($data['password']);
                $data['create_time'] = time(); //时间戳 int
                $keys = array_keys($data);
                $values= array_values($data);
                $str1 = "`".implode('`,`', $keys)."`";
                $str2 = "'".implode("','", $values)."'";
                $sql = "insert into user($str1) values($str2)";
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
        case 'del':
            // print_r($_POST);
            if(empty($_GET['id'])){
                $arr = ['code'=>3,'mgs'=>'不存在的数据'];
                exit(json_encode($arr));
            }
            $user_id = intval($_GET['id']);
           
            $sql = "delete from user where user_id=$user_id";
           
            $result = del($sql);
           
            if($result){
                $arr = ['code'=>2,'mgs'=>'删除成功'];

         
                exit(json_encode($arr)); //json数据 {"name":"数据"} 字符串 对象
                // echo 2;
                // exit();
               
            }else{
                // echo 1;
                // exit();
                $arr = ['code'=>1,'mgs'=>'删除失败'];
                
                exit(json_encode($arr));
            }
            break;
        //修改页面
        case 'update':
            $id = $_GET['id']; //路由传过来
            if(!$id){
                return false;
            }
            $sql = "select * from user where user_id=$id";
            $result = select_one($sql);
            // print_r($result);die;
            include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
            break;
        //修改后提交的数据
        case "updatepost":
            $arr = $_POST; //id input hidden 传过一o
            // print_r($arr);
            $data = '';
            foreach ($arr as $key => $value) {
                $data .= "`".$key."`" ."='".$value."',";
            }
           // echo $data;
            $str = rtrim($data,',');
           // echo $str;
            $sql = "update user

             set $str where user_id={$arr['user_id']}";
            
            $result = update($sql);  //修改
            // var_dump($result);
            //成功跳转与失败返回
            if($result){
                echo "<script>alert('修改成功');window.location.href='index.php?m=admin&ctl=user&act=index';</script>";
            }else{
                echo "<script>alert('修改失败');history.back(-1);</script>";
            }
}