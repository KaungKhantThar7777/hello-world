<?php 
namespace Ninja;
class Authentication
{
	private $users;
	private $userColumn;
	private $passColumn;
	public function __construct(DatabaseTable $user,$userColumn,$passColumn)
	{
		session_start();
		$this->users=$user;
		$this->userColumn=$userColumn;
		$this->passColumn=$passColumn;
	}
	public function login($username,$password)
	{
		$user=$this->users->find($this->userColumn,strtolower($username));
		
		
		if(!empty($user) && password_verify($password,$user[0][$this->passColumn]))
		{
			session_regenerate_id();
			$_SESSION['username']=$username;
			$_SESSION['password']=$user[0][$this->passColumn];
			return true;
		}
		else
			return false;

	}
	public function isLoggedIn()
	{
		if(empty($_SESSION['username']))
			return false;

		$user=$this->users->find($this->userColumn,$_SESSION['username']);

		if(!empty($user) && $user[0][$this->passColumn] === $_SESSION['password'])
			return true;
		else
			return false;
	}
	public function getUser()
	{
		if($this->isLoggedIn())
		{
			return $this->users->find($this->userColumn,$_SESSION['username'])[0];
		}
		else
		{
			return false;
		}
	}
}
 ?>
