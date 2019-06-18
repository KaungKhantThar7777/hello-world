<?php 
namespace Ijdb\Controllers;
	class Login
	{
		private $authentication;
		public function __construct(\Ninja\Authentication $authen)
		{
			$this->authentication=$authen;
		}
		public function error()
		{
			return ['template'=>'error.html.php','title'=>'You\'re not logged in'];
		}
		public function showForm()
		{
			return ['template'=>'login-html.php','title'=>'Login Form'];
		}
		public function processLogin()
		{
			
			if($this->authentication->login($_POST['email'],$_POST['password']))
			{
				header('Location:/login/success');
			}
			else
			{

				return ['template'=>'login-html.php','title'=>'Log in','variables'=>['error'=>'Invalid Username/password']];
			}
		}
		public function success()
		{
			return ['template'=>'loginsuccess.html.php','title'=>'login successful'];
		}
		public function logout()
		{
			unset($_SESSION);
			session_destroy();
			return ['template'=>'logout.php','title'=>'logout successful'];
		}
	}
 ?>