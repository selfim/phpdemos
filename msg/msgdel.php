<?php
require './conn.php';
//print_r($_GET['id']);
$id=$_GET['id']+0;
$sql="delete from msg where id =$id";
$res=mysqli_query($conn, $sql);
if (!$res){
	echo '删除失败';
}else {
	echo '删除成功';
	header("Location:msglist.php");
}