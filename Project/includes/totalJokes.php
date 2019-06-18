<?php 
	function totalJokes($pdo)
	{
		$query=query($pdo,'SELECT count(id) FROM joke');

		$row=$query->fetch();
		return $row[0];
	}
 ?>