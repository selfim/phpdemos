<?php 
	/**
	 * 退出登陆
	 */
	setcookie('name',null,0);
	header('Location: login.php');


 ?>