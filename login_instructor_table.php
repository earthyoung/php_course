<?php

include "util.php";

$form = "
<h2 class='display-6'>Login as Instructor</h2><br>
<form name='login_instructor' action='login_instructor.php' method='post'>
	<table>
		<tr><td>Email</td><td><div class='mb-3'><input type='text' name='email' id='email'></div></td></tr>
		<tr><td>Password</td><td><div class='mb-3'><input type='password' name='password' id='password'></div></td></tr>
		<tr><td colspan='2'><div class='mb-3'><input type='submit' value='Login' class='btn btn-primary'></div></td></tr>
	</table>
</form>";

echo basis($form, "");
	
?>