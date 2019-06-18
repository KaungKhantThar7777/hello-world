<!DOCTYPE html>
<html>
<head>
	<title><?= $title?></title>
	<meta charset="utf-8">
	<meta name="viewpoint" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/jokes.css">
</head>
<body class="container">
	<div class="row">
		<div class="col-12 bg-success text-white" style="line-height:10">Internet Joke Database </div>
	</div>
	<nav class="text-white-50">
		<ul class="nav nav-pills nav-justified">
			<li class="nav-item"><a href="/" class="nav-link">Home</a></li>
			<li class="nav-item"><a href="/joke/list" class="nav-link">Jokes List</a></li>
			<li class="nav-item"><a href="/joke/edit" class="nav-link">Add a New Joke</a></li>

			<?php if($loggedIn): ?>
			<li class="nav-item"><a href="/logout" class="nav-link">Log out</a>
			<?php else: ?>
			<li class="nav-item"><a href="/login" class="nav-link">Log in</a>
			<?php endif; ?>
		</ul>
	</nav>
	<main>
		<?=$output?>
	</main>
	<footer class="bg-info text-white text-center">
		&copy; IJDB <?=date('Y');?>
	</footer>
</body>
</html>