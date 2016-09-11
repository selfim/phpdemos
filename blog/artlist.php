<?php
	require './lib/init.php';
	if(!acc()){
		header("Location:login.php");
	}
	$sql="SELECT a.art_id,a.content,a.pubtime,a.title,a.comm,b.catname FROM art a LEFT JOIN cat b on a.cat_id=b.cat_id";
	$arts=myGetAll($sql);
	//print_r($arts);exit;
	if (empty($_POST)) {
		include(ROOT.'/view/admin/artlist.html');
	}


?>