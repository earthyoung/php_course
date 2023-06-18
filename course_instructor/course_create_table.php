<?php

include "../util.php";

$type = $_COOKIE["type"];

if($type != "instructor") {
	alert("Only instructor can install courses.", course_page());
}

$id = $_COOKIE["id"];
$name = $_COOKIE["name"];

$form = "
<form align=center action='course_create.php' method='post'>
	<div class='mb-3'>
		<label class='form-label'>title</label>
		<input type='text' class='form-control' name='title'>
	</div>
	<div class='mb-3'>
		<label class='form-label'>instructor name</label>
		<input type='text' class='form-control' value=$name readonly>
	</div>
	<div class='mb-3'>
		<label class='form-label'>category</label>
		<input type='text' class='form-control' name='category'>
	</div>
	<div class='mb-3'>
		<label class='form-label'>price</label>
		<input type='text' class='form-control' name='price'>
	</div>
	<div class='mb-3'>
		<label class='form-label'>description</label>
		<textarea class='form-control' name='description'></textarea>
	</div>
	<button type='submit' class='btn btn-primary'>Create</button>
</form>
";

echo basis($form, "");


?>