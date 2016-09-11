<?php 
	/**
	 *
	 * 栏目编辑
	 */
	require './lib/init.php';
	$cat_id=trim($_GET['cat_id'])+0;
	//连接数据库
	/**
	$link=new mysqli('localhost','root','123456','blog');
	if ($link->connect_errno) {
		exit('Connect error:'.$link->connect_error);
	}
	$link->set_charset('utf8');
	*/

	if (empty($_POST)) {
		$sql="SELECT catname FROM  cat WHERE cat_id='$cat_id'";
		//$res=$link->query($sql);
		//$rs=$res->fetch_assoc();
		//var_dump(myGetOne($sql));exit;
		$cat=myGetOne($sql);
		require './view/admin/catedit.html';
	}else{
		$catname=trim($_POST['catname']);
		$sql="UPDATE cat SET catname='$catname' WHERE cat_id='$cat_id'";
		//$res=$link->query($sql);
		if (myQuery($sql)) {
			//echo "栏目修改成功！";
			succ('栏目修改成功！');
			header("Location:catlist.php");
		}else{
			//echo "栏目修改失败".$link->error;
			error('栏目修改失败！').getError();
		}
	}



 ?>