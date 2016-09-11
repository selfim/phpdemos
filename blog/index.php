<?php 

	/**
	 *首页
	 * 
	 */
	require './lib/init.php';

	//查询所有的栏目
	$sql="SELECT cat_id,catname FROM cat ";
	$cats=myGetAll($sql);
	//判断地址栏是否有cat_id
	//$cat_id=isset($_GET['cat_id'])?$_GET['cat_id']:'';
	if (isset($_GET['cat_id'])) {
		$where =" and art.cat_id=$_GET[cat_id]";
	} else{
		$where='';
	}

	//分页
	$sql="SELECT COUNT(*) from art WHERE 1".$where;//
	$num=myGetOne($sql);
	$curr=isset($_GET['page'])?$_GET['page']:1;
	$cnt=4;
	$pages=getPages($num,$curr,$cnt);
	//查询所有文章
	$sql="SELECT art_id,title,content,pubtime,comm,catname,thumb FROM art INNER JOIN cat 
	ON art.cat_id=cat.cat_id WHERE 1".$where.' ORDER BY art_id DESC LIMIT '.($curr-1)*$cnt.','.$cnt;
	$arts=myGetAll($sql);
	require ROOT.'/view/home/index.html';



 ?>