<?php
	/**
	*文章详情页
	*/
	require './lib/init.php';
	$art_id=$_GET['art_id']+0;

	//判断地址栏传来的art_id是否合法
	if(!is_numeric($art_id)){
		header("Location:index.php");
	}

	//如果没有这篇文章也跳转到首页
	$sql="SELECT * FROM art WHERE art_id=$art_id";
	if (!myGetRow($sql)) {
		header('Location:index.php');
	}
	//查询文章
	$sql="SELECT title,content,pubtime,catname,comm,pic,thumb FROM art INNER JOIN cat ON art.cat_id=cat.cat_id WHERE art_id=$art_id";
	$art=myGetRow($sql);

	//查询留言
	$sql="SELECT * FROM comment WHERE art_id=$art_id";
	$comms=myGetAll($sql);

	//POST非空 有留言过来
	if (!empty($_POST)) {
		$comm['nick'] = trim($_POST['nick']);
		$comm['email'] = trim($_POST['email']);
		$comm['content'] = trim($_POST['content']);
		$comm['art_id']=$art_id;
		$comm['ip']=sprintf('%u',ip2long(getRelIp()));//long2ip
		$comm['pubtime'] = time();
		$res=myEx('comment',$comm);
		if ($res) {
			//评论发布成功  art表comm要comm+1
			$sql="UPDATE art SET comm=comm+1 WHERE art_id=$art_id";
			myQuery($sql);
			$ref=$_SERVER['HTTP_REFERER'];
			header("Location: $ref");//'' ""
		}
	}
	require ROOT.'/view/home/art.html';
?>