<?php 
	/**
	 * 文章分类添加
	 */
	
	require './lib/init.php';
	if (empty($_POST)) {
		require './view/admin/catadd.html';
	}else{
		//如果有POST提交
		//print_r($_POST);
		//连接数据库
		/**
		$link=new mysqli('localhost','root','123456','blog');
		if ($link->connect_errno) {
			exit('Connect error:'.$link->connect_error);
		}
		$link->set_charset('utf8');
		*/

		$cat['catname'] = trim($_POST['catname']);//获取分类名
		if (empty($cat['catname'])) {
			exit('栏目名称不能为空！！！');
		}
		//检测分类名是否存在
		$sql="SELECT * FROM cat where catname='$cat[catname]'";
		//$res =$link->query($sql);
		//$row=$res->fetch_row();
		 //var_dump($row);exit;
		 if (myGetOne($sql)!=0) {
		 	exit('栏目已经存在！！！');
		 }
		 //写入cat表
		 $sql="INSERT INTO cat(catname) VALUES ('$cat[catname]')";
		 //$res=$link->query($sql);
		 if (myEx('cat',$cat)){
		 	//echo "栏目添加成功！！！";
		 	succ('栏目添加成功！');
			header("location:catlist.php");
		 }else{
		 	//exit('添加失败！！！'.getError());
		 	error('栏目添加失败！').getError();
		 }
	}
	

 ?>