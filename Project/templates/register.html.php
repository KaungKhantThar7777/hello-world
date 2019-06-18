<?php if(!empty($errors)):?>
	<div class="errors">
	<p>Your account cannot be created,please check the following</p>
	<ul>
		<?php foreach($errors as $error): ?>
			<li><?= $error?></li>
		<?php endforeach; ?>
	</ul>
	</div>
<?php endif; ?>
<form action="" method="post">
	<label for="email">Your email address</label>
	<input type="text" name="author[email]" id="email" value="<?= $author['email'] ?? ''?>"><br>

	<label for="name">Your name</label>
	<input type="text" name="author[name]" id="name" value="<?= $author['name'] ?? ''?>"><br>

	<label for="password">Password</label>
	<input type="password" name="author[password]" id="password" value="<?= $author['password'] ?? ''?>">
	<br>

	<input type="submit" name="submit" value="Register account">
</form>