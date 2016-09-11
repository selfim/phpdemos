<?php 

	/**
	 *
	 * 删除栏目
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

	//检测栏目合法性
	if (!is_numeric($cat_id)) {
		exit('栏目不合法！');
	}

	$sql="SELECT COUNT(*) FROM art WHERE cat_id='$cat_id'";
	//$res=$link->query($sql);
	//$rs=$res->fetch_row();
	//var_dump($rs);exit;
	if (myGetOne($sql)!=0) {
		exit('栏目下有文章不能删除！！！');
	}

	//删除
	$sql="DELETE FROM cat WHERE cat_id='$cat_id'";
	//$res=$link->query($sql);
	if (myQuery($sql)) {
		//echo "栏目删除成功！！！";
		succ('栏目删除成功！');
	}else{
		error('栏目添加失败！').getError();
	}
 ?>