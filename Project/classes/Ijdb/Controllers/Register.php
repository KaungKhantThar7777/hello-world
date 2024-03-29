<?php 
	namespace Ijdb\Controllers;

	use \Ninja\DatabaseTable;

	class Register
	{
		private $authorsTable;
		public function __construct(DatabaseTable $authors)
		{
			$this->authorsTable=$authors;
		}
		public function registrationForm()
		{
			return ['template'=>'register.html.php','title'=>'Register an account'];
		}
		public function success()
		{
			return ['template'=>'registersuccess.html.php','title'=>'Registeration Successful'];
		}
		public function registerUser()
		{

			$author=$_POST['author'];
			
			$valid=true;
			$errors=[];

			if(empty($author['name']))
			{
				$valid=false;
				$errors[]="Name cannot be blank";
			}

			if(empty($author['email']))
			{
				$valid=false;
				$errors[]="Email cannot be blank";
			}
			elseif(filter_var($author['email'],FILTER_VALIDATE_EMAIL) == false)
			{
				$valid=false;
				$errors[]="Invalid email address";
			}elseif(count($this->authorsTable->find('email',$author['email']))>0)
			{
				$valid=false;
				$errors[]="That email address is already registered";
			}

			if(empty($author['password']))
			{
				$valid=false;
				$errors[]="Password cannot be blank";
			}
			if($valid)
			{
				$author['password']=password_hash($author['password'],PASSWORD_DEFAULT);
				$this->authorsTable->save($author);
			header('Location:/author/success');
			}
			else
			{
				return ['title'=>'Register an Account','template'=>'register.html.php','variables'=>['errors'=>$errors,'author'=>$author]];
			}
		}
	}
 ?>