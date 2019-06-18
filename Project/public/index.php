<?php 
	
	try
	{
		include __DIR__ . '/../includes/autoload.php';
		$route=ltrim(strtok($_SERVER['REQUEST_URI'],'?'),'/');

		$entryPoint=new \Ninja\EntryPoint($route,new \Ijdb\IjdbRoute(),$_SERVER['REQUEST_METHOD']);
		$entryPoint->run();
	}
	catch(\PDOException $e)
	{
		$title='Database error occurred.';
		$output='Error is ' . $e->getMessage() . ' in ' . $e->getFile() . ':' .$e->getLine();
	}
	
 ?>