<?php if(is_null($joke) || $userId == $joke['authorid']): ?>
<form action="" method="post">
	<input type="hidden" name="joke[id]" value="<?=$joke['id'] ?? '' ?>">
	<label for="joketext">Type your joke here:</label>
	<textarea id="joketext" name="joke[joketext]" rows="5" cols="50"><?=$joke['joketext'] ?? ''?>
	</textarea>
	<input type="submit" name="submit" value="Save">
</form>
<?php else: ?>
	<p>You can only edit your own posts</p>
<?php endif; ?>