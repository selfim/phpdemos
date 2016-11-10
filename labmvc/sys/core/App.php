<?php 
namespace core;
use core\Config;
use core\Router;
/**
*
*/
class App
{
	//start
	public static $router;//define a static router
	public static function run()
	{
		self::$router = new Router();
		self::$router->setUrlType(Config::get('url_type'));
		$url_array = self::$router->getUrlArray();//
		self::dispatch($url_array);
	}
	public static function dispatch($url_array = [])
	{
		$module = '';
		$controller = '';
		$action = '';
		if (isset($url_array['module'])) {
			# code...
			$module = url_array['module'];
		}else{
			$module =Config::get('default_module');//
		}

		if (isset($url_array['controller'])) {
			# code...
			$controller = ucfirst($url_array['controller']);
		}else{
			$controller = ucfirst($url_array['default_controller']);
		}

		//
		$controller_file = APP_PATH.$module.DS.'controller'.DS.$controller.'Controller.php';
		if (isset($url_array['action'])) {
		    $action = $url_array['action'];
		}else{
			$action = Config::get('default_action');
		}
		//
		if (file_exists($controller_file)) {
			require $controller_file;
			$className ='module\controller\IndexController';

			$className = str_replace('IndexController', $controller.'Controller', $className);
			$controller = new $className;
			//
			if (method_exists($controller, $action)) {
				# code...
				$controller->setTpl($action);
				$controller->$action();
			}else{
				exit('The method does not exists');
			}
		}else{
			exit('The controller does not exists');
		}

	}
}


 ?>