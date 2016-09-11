<?php 
	/**
	*文章编辑
	*/
	require './lib/init.php';
	$art_id=$_GET['art_id']+0;

	//判断
	if(!is_numeric($art_id)){
		error('参数错误！');
	}
	//查询是否有这篇文章
	$sql="SELECT * FROM art WHERE art_id=$art_id";
	if(!myGetRow($sql)){
		error('文章不存在');
	}
	//查询所有的栏目
	$sql="SELECT * FROM cat";
	$cats=myGetAll($sql);
	//print_r($cats);exit;
	if(empty($_POST)){

		$sql="SELECT title,content,cat_id,tag FROM art WHERE art_id=$art_id";
		$art=myGetRow($sql);
		require ROOT.'/view/admin/artedit.html';
	}else{
		//检测标题是否为空
		$art['title'] = trim($_POST['title']);
		if ($art['title']=='') {
			error('标题不能为空！');
		}

		//检测栏目是否合法
		$art['cat_id']=$_POST['cat_id'];
		if (!is_numeric($art['cat_id'])) {
			error('参数错误！');
		}
		//检测内容是否为空
		$art['content'] = trim($_POST['content']);
		if ($art['content']=='') {
			error('内容不能为空');
		}
		//
		$art['lastup']=time();
		//文件上传
		if (isset($_FILES['pic'])){
			if (!($_FILES['pic']['name']=='') && $_FILES['pic']['error']==0){
			$dst=createDir().'/'.randStr().getExt($_FILES['pic']['name']);
			//将 ROOT 放在 move_uploaded_file 里
			if(move_uploaded_file($_FILES['pic']['tmp_name'] , ROOT.$dst)){
				$art['pic']=$dst;
				//$art['thumb'] = mThumb($dst);
			}
		}
		}
		//执行
		if (!myEx('art',$art,'update',"art_id=$art_id")) {
			error('文章修改失败').getError();
		}else{
			succ('文章修改成功');
			header("Location:artlist.php");
			//删除tag表的所有tag 再insert插入进去
			
		}
	}

?>