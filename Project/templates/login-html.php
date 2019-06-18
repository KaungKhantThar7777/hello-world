<?php 
	if(isset($error)):
		echo "<div class='errors'>" .$error . "</div>";
	endif;
 ?>

 <form action="" method="post">
 	<label for='email'>Your email address</label>
 	<input type="text" id='email' name='email'>
 	<br>
 	<label for='password'>Your password</label>
 	<input type="password" id='password' name='password'>
 	<br>
 	<input type="submit" name="submit" value='Log in'>
 </form>