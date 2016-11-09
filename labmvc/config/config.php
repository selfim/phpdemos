<?php 
	return[
	'db_host' => '127.0.0.1',
	'db_user' => 'root',
	'db_pwd'  => '',
	'db_name' => 'labframe',
	'db_table_prefix' => 'lab_'
	'db_charset' => 'utf8',
	'default_module' =>'home',
	'default_controller' => 'Index',
	'default_action' => 'index',
	'url_type' => 2,
	'cache_path' =>RUNTIME_PATH.'cache'.DS,
	'cache_prefix' => 'cache_',
	'cache_type' => 'file',
	'compile_path' => RUNTIME_PATH.'compile'.DS,
	'view_path' => APP_PATH.'home'.DS.'view'.DS,
	'view_suffix' => '.php',
	'auto_cache' => true,
	'url_html_suffix' => 'html',
	];


 ?>