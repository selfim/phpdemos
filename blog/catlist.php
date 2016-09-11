<?php 
	/**
	 * 栏目列表
	 */

	$link=new mysqli('localhost','root','123456','blog');
	if ($link->connect_errno) {
		exit('Connect error:'.$link->connect_error);
	}
	$link->set_charset('utf8');

	$sql="SELECT * FROM cat";
	$res=$link->query($sql);
	$cat=array();
    while ($row=$res->fetch_assoc()) {
    	$cat[]=$row;
    }
    //print_r($cat);exit;
	require './view/admin/catlist.html';

 ?>