<?php 
	/**
	 * 文章添加
	 */
	require './lib/init.php';

	$sql="SELECT * FROM cat";
	$res=myGetAll($sql);
	//echo "<pre>";var_dump($res);exit;
	if (empty($_POST)) {
		require ROOT.'/view/admin/artadd.html';
	}else{
		//检测标题是否为空
		$art['title'] = trim($_POST['title']);
		if($art['title'] ==''){
			error('标题不能为空！！！');
		}
		//检测栏目是否合法
		$art['cat_id']=trim($_POST['cat_id']);
		if(!is_numeric($art['cat_id'])){
			error('栏目不合法！！');
		}
		//检测内容是否为空
		$art['content'] = trim($_POST['content']);
		if ($art['content']=='') {
			error('内容不能为空');
		}
		//print_r($_FILES);exit;
		//文件上传
		if (!($_FILES['pic']['name']=='') && $_FILES['pic']['error']==0){
			$dst=createDir().'/'.randStr().getExt($_FILES['pic']['name']);
			//将 ROOT 放在 move_uploaded_file 里
			if(move_uploaded_file($_FILES['pic']['tmp_name'] , ROOT.$dst)){
				$art['pic']=$dst;
				$art['thumb'] = mThumb($dst);
			}
		}
		//插入发布时间
		$art['pubtime']=time();
		//插入tag
		$art['tag']=trim($_POST['tag']);
		//写入
		if (!myEx('art',$art)) {
			error('文章发布失败');
			header("location:artlist.php");
		}else{
			//判断是否有tag
			$art['tag'] =trim($_POST['tag']);
			if ($art['tag'] == '') {
				//cat表中的num加1
				$sql="UPDATE cat SET num=num+1 WHERE cat_id=$art[cat_id]";
				myQuery($sql);
				succ('文章发布成功');
				//header("location:artlist.php");
			}else{
				//获取上次insert操作产生的id
				$art_id=getLastId();
				$tag=explode(',', $art['tag']);
				//print_r($tag);exit;
				//$sql="insert into tag(art_id,tag) values (";
				$sql="INSERT INTO tag(art_id,tag) VALUES";
				foreach ($tag as  $value) {
					$sql.= "(".$art_id.",'".$value."'),";
				}
				$sql = rtrim($sql,",");
				//echo $sql;exit;
				if(myQuery($sql)){
				//cat表中的num加1
				$sql = "UPDATE cat SET num =num +1 WHERE cat_id =$art[cat_id]";
				myQuery($sql);
					succ('文章发布成功');
					header("location:artlist.php");
				}else{
					$sql="DELETE FROM art WHERE art_id=$art_id";
					if (myQuery($sql)) {
					//cat表中的num-1
					$sql = "UPDATE cat SET num =num -1 WHERE cat_id =$art[cat_id]";
					myQuery($sql);
						error('文章发布失败');
					}
				}
			}
			
		}
			
		
	}


 ?>