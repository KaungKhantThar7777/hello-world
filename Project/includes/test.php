<?php 
	include __DIR__ .'/../includes/databaseConnect.php';
	include __DIR__ .'/../includes/databaseFunctions.php';

	$record=[
			'joketext'=>'!false,it is funny because it\'s true'
			'jokedate'=>new DateTime(),
			'authorid'=>1];
	insert($pdo,'joke',$record);
 ?>