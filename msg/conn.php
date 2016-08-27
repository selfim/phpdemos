<?php
header("Content-type:text/html;charset=utf-8");
$conf=array(
		'host'=>'localhost',
		'user'=>'root',
		'password'=>'123456',
		'database'=>'test',
		'port'=>3306,
		'charset'=>'utf8'
);
$conn=mysqli_connect($conf['host'], $conf['user'], $conf['password'], $conf['database'], $conf['port']);
mysqli_set_charset($conn, $conf['charset']);