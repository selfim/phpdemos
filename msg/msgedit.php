<?php
require './conn.php';

$id=$_GET['id']+0;
//print_r($id);exit;
if (empty($_POST)){
	$sql="select * from msg where id=$id";
	$res=mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($res);
	//echo '<pre>';print_r($row);exit;
	require './msgedit.html';
}else {
	$sql=" update msg set username='$_POST[username]',email='$_POST[email]',content='$_POST[content]' where id=$id ";
	//echo $sql;exit;
	$res=mysqli_query($conn, $sql);
		if(!$res){
		echo'留言修改失败'.mysqli_error($conn);
	}else{
		echo '留言修改成功';
		header("Location:msglist.php");
	}
}