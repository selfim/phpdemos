<?php
	/**
	*文章删除
	*/
	require './lib/init.php';
	$art_id=$_GET['art_id']+0;

	//判断
	if(!is_numeric($art_id)){
		error('参数错误！');
	}
	//查询是否有文章
	$sql="SELECT * FROM art WHERE art_id=$art_id";
	if(!myGetRow($sql)){
		error('文章不存在');
	}

	//删除文章
	$sql="DELETE FROM art WHERE  art_id=$art_id";
	if(myQuery($sql)){
		succ('文章删除成功！');
		header("Location:artlist.php");
	}else{
		error('文章删除失败！');
	}