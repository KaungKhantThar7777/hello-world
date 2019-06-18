<?php 
namespace Ninja;
	class EntryPoint
	{
		private $route;
		private $routes;
		private $method;
		public function __construct($route,\Ninja\Routes $routes,$method)
		{
			$this->route=$route;
			$this->routes=$routes;
			$this->method=$method;
			$this->checkURl();
		}

		private function checkURl()
		{
			if($this->route !== strtolower($this->route))
			{
				http_response_code(301);
				header('location: ' .strtolower($this->route));
			}
		}
		private function loadTemplate($templateFilename,$variables=[])
		{
			extract($variables);

			ob_start();

			include __DIR__ .'/../../templates/' .$templateFilename;

			return ob_get_clean();
		}
		public function run()
		{
			$routes=$this->routes->getRoutes();
			if(isset($routes[$this->route]['login']) && !$this->routes->getAuthentication()->isLoggedIn())
			{
				header('Location:/login/error');
			}
			else
			{
			$controller=$routes[$this->route][$this->method]['controller'];
			$action=$routes[$this->route][$this->method]['action'];

			$page=$controller->$action();

			$title=$page['title'];

			if(isset($page['variables']))
			{
				$output=$this->loadTemplate($page['template'],$page['variables']);
			}
			else
			{
				$output=$this->loadTemplate($page['template']);
			}
			echo $this->loadTemplate('layout.html.php',['loggedIn'=>$this->routes->getAuthentication()->isLoggedIn(),'output'=>$output,'title'=>$title]);
			}
		}
	}
 ?>