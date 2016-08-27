<?php

require './conn.php';
$sql="select * from msg";
$res=mysqli_query($conn, $sql);
$data=array();
while ($row=mysqli_fetch_assoc($res)){
	$data[]=$row;
}
//print_r($data);
require './msglist.html';