<?php 
	/**
	 * 登陆页面
	 */
	require './lib/init.php';

	if (empty($_POST)) {
		require ROOT.'/view/home/login.html';
	}else{
		//print_r($_POST);exit;
		$user['name']= trim($_POST['name']);
		if (empty($user['name'])) {
			error('用户名不能为空！');

		}
		$user['password']=trim($_POST['password']);
		if (empty($user['password'])) {
			error('密码不能为空！');
		}
		//$sql="SELECT * FROM user WHERE name='$user[name]' and password='$user[password]'";
		$sql = "SELECT * FROM user WHERE name='$user[name]'";
		$row=myGetRow($sql);
		//print_r($row);exit;
		if (!$row) {
			error('用户名或密码错误！');
		}else{
			//setcookie('name',$user['name']);
			//header("Location:artlist.php");
			if(md5($user['password'].$row['salt']) === $row['password']){
			setcookie('name' , $user['name']);
			setcookie('ccode' , cCode($user['name']));
			header('Location: artlist.php');
			} else {
			error('密码错误');
			}
		}
	}


 ?>