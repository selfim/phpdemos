<?php 
	/**
	 *
	 * 评论列表
	 */
	include './lib/init.php';
	$sql="SELECT * FROM comment";
	$comms=myGetAll($sql);
	//print_r($comms);exit;
	
	include (ROOT.'/view/admin/commlist.html');


 ?>