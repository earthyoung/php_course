<?php

include "util.php";

$form = "
<h2 class='display-6'>Join as Instructor</h2><br>
<form action='join_instructor.php' method='post'>
	<table>
		<tr><td>email</td><td><div class='mb-3'><input type='email' name='email'></div></td></tr>
		<tr><td>password</td><td><div class='mb-3'><input type='password' name='password'></div></td></tr>
		<tr><td>name</td><td><div class='mb-3'><input type='text' name='name'></div></td></tr>
		<tr><td colspan='2'><input type='submit' value='Join' class='btn btn-primary'></td></tr>
	</table>
</form>
";

echo basis($form, "");

?>