<?php
	//require './index.html';
	//print_r($_POST);
	header("Content-type:text/html;charset=utf-8");
	require './conn.php';
	if (empty($_POST)){
		require './index.html';
	}else {
		$username=trim($_POST['username']);
		$email=trim($_POST['email']);
		$content=trim($_POST['content']);
		$sql="insert into msg(username,email,content)values('$username','$email','$content')";
		//echo $sql;
		$res=mysqli_query($conn, $sql);
		if ($res){
			echo '留言成功';
			header("Location:msglist.php");
		}else {
			echo '留言失败'.mysqli_errno($conn);
		}
		
	}