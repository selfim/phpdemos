<?php 
namespace core;

class Loader{

	public static function register()
	{
		spl_autoload_register('core\\Loader::loadClass');
	}

	public static function addNamespace($prefix,$base_dir,$prepend = false)
	{
		$prefix = trim($prefix,'\\').'\\';
		//
		$base_dir = rtrim($base_dir,'/').DIRECTORY_SEPARATOR;

		//INIT 
		if (isset(self::$prefix[$prefix]) === false) {
			# code...
			self::$prefix[$prefix] = [];
		}

		//save
		if ($prepend) {
			# code...
			array_unshift(self::$prefix[$prefix], $base_dir);
		}else{
			array_push(self::$prefix[$prefix],$base_dir);
		}
	}

	public static function loadClass($class)
	{
		//curent namespace prefix
		$prefix = $class;

		//from end begin list 
		while (false !== $pos = strrpos($prefix, '\\')) {
			# code...
			//save
			$prefix =substr($class, 0,$pos + 1);

			//
			$relative_class = substr($class, $pos +1);

			//
			$mapped_file = self::loadMappedFile($prefix,$relative_class);
			if ($mapped_file) {
				return $mapped_file;
			}
		}
	}

	protected static function loadMappedFile($prefix,$relative_class)
	{
		//
		if (isset(self::$prefix[$prefix]) === false) {
			return false;
		}
		//
		foreach ($self::$prefix[$prefix] as $base_dir) {
			      $file = $base_dir.str_replace('\\', DIRECTORY_SEPARATOR, $relative_class).'.php';
		          $file = $base_dir.str_replace('\\', '/', $relative_class).'.php';
		          if (self::requireFile($file)) {
		          	  //finsh load
		          	return $file;
		          }
		}
		return false;
	}

	protected static function requireFile($file)
	{
		if (file_exists($file)) {
			require $file;
			return true;
		}
		return false;
	}
}



 ?>