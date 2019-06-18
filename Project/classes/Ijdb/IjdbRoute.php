<?php 
	namespace Ijdb;
	class IjdbRoute implements \Ninja\Routes
	{
		private $jokesTable;
		private $authorsTable;
		private $authentication;
		private $loginTable;
		public function __construct()
		{

			include __DIR__ .'/../../includes/databaseConnect.php';

			$this->jokesTable=new \Ninja\DatabaseTable($pdo,'joke','id');
			$this->authorsTable=new \Ninja\DatabaseTable($pdo,'author','id');
			$this->authentication=new \Ninja\Authentication($this->authorsTable,'email','password');

		}
		public function getRoutes():array
		{
			$jokeController=new \Ijdb\Controllers\Joke($this->jokesTable,$this->authorsTable,$this->authentication);
			$authorsController=new \Ijdb\Controllers\Register($this->authorsTable);
			$loginController=new \Ijdb\Controllers\Login($this->authentication);
			$routes=[
					'joke/edit'=>[
									'POST'=>[
												'controller'=>$jokeController,
												'action'=>'saveEdit'],
									'GET'=>[
												'controller'=>$jokeController,
												'action'=>'edit'],
									'login'=>true],
					''=>[
							'GET'=>[
									'controller'=>$jokeController,
									'action'=>'home']],
					'joke/delete'=>[
							'POST'=>[
									'controller'=>$jokeController,
									'action'=>'delete'],
									'login'=>true]
								,
					'joke/list'=>[
							'GET'=>[
									'controller'=>$jokeController,
									'action'=>'list']],
					'author/register'=>[
							'GET'=>[
									'controller'=>$authorsController,
									'action'=>'registrationForm'],
							'POST'=>[
									'controller'=>$authorsController,
									'action'=>'registerUser']],
					'author/success'=>[
							'GET'=>[
									'controller'=>$authorsController,
									'action'=>'success']],
					'login/error'=>[
							'GET'=>[
									'controller'=>$loginController,
									'action'=>'error']],
					'login'=>[
							'POST'=>[
									'controller'=>$loginController,
									'action'=>'processLogin'],
							'GET'=>[
									'controller'=>$loginController,
									'action'=>'showForm']],
					'login/success'=>[
							'GET'=>[
									'controller'=>$loginController,
									'action'=>'success'],
							'login'=>true],
					'logout'=>[
							'GET'=>[
									'controller'=>$loginController,
									'action'=>'logout']]
								];
			return $routes;
			

		}
	public function getAuthentication():\Ninja\Authentication
	{
		

		return $this->authentication;
	}
	}
 ?>