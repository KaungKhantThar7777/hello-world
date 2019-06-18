<?php 
	session_start();

	if(!isset($_SESSION['visit']))
		$_SESSION['visit']=0;

	$_SESSION['visit']=$_SESSION['visit']+1;

	if($_SESSION['visit'] > 1)
		echo "Welcome to our website $_SESSION[visit]";
	else
		echo "Welcome to our website first time.Click here to take a tour";
 ?>