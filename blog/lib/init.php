<?php 
	/**
	echo __DIR__,'<br/>';
	echo __LINE__,'<br/>';
	echo __FILE__;
	*/
	header('Content-type:text/html;charset=utf-8');
	define('ROOT', dirname(__DIR__));
	//echo ROOT;exit;
	require (ROOT.'/lib/mysql.php');
	require (ROOT.'/lib/func.php');

	$_GET = _addslashes($_GET);
	$_POST = _addslashes($_POST);
	$_COOKIE = _addslashes($_COOKIE);
	
 ?>