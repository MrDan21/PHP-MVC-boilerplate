<?php

namespace Core;

class Router 
{

	private static $routes = [];

	private static $http = ['POST', 'GET'];

	public static function __callStatic($method, array $args = [])
	{
		if(! in_array($method, self::$http)) {
			throw new \Exception('Request method not defined');
		}

		$route = isset($args[0]) ? $args[0] : null;
		$controller_and_method = isset($args[1]) ? $args[1] : null;

		strpos($controller_and_method, '@') 
			? self::$routes[$route.'|'.$method] = $controller_and_method  
			: self::$routes[$route] = 'error@404';	
	}

	public function dispatch() 
	{
		if(isset($_GET['controller']) && isset($_GET['method'])) {	
			$controller = $_GET['controller'];
			$method = $_GET['method'];
			$this->arrayKeyValidate($controller, $method);
		} else {
			$this->getView('index');
		}
	}

	private function arrayKeyValidate($controller, $method)
	{
		$route = $controller.'/'.$method.'/|'.$_SERVER['REQUEST_METHOD'];

		if(array_key_exists($route, self::$routes)) {
			$controller_and_method = explode('@', self::$routes[$route]);
			$this->fileValidate($controller_and_method);
		} else {
			$this->getView('errors/404');
		}
	}


	private function fileValidate(array $controller_and_method = [])
	{
		if(file_exists('app/controllers/'.$controller_and_method[0].'Controller.php')) {
			$controller = 'App\Controllers\\'.$controller_and_method[0].'Controller';
			$method = $controller_and_method[1];
			$this->classValidate($controller, $method);
		} else {
			throw new \Exception("There is no class {$controller_and_method[0]}");
		}
	}

	private function classValidate($controller, $method)
	{
		if(class_exists($controller)) {	
			$obj_controller = new $controller();
			$this->methodValidate($obj_controller, $method);
		} else {
			throw new \Exception("There is no class {$controller}");
		}
	}

	private function methodValidate($obj_controller, $method)
	{
		if(method_exists($obj_controller, $method)) {
			$obj_controller->$method();
		} else {
			throw new \Exception("There is no class {$method}");
			
		}
	}

	private function getView($view)
	{
		include($_SERVER['DOCUMENT_ROOT'].'views/'.$view.'.php');
	}

}