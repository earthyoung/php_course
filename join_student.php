<?php

include "util.php";

$email = $_POST["email"];
$password = $_POST["password"];
$name = $_POST["name"];
$date = date('Y-m-d'); 

$conn = mysqli_connect(servername, username, password, db_name);
$sql = "INSERT INTO student (email, password, name, register_date) VALUES ('$email', '$password', '$name', '$date')";

if (student_check($email, $password) == false) {
	mysqli_close($conn);
	error();
} else {
	$query = mysqli_query($conn, $sql);
	$id = mysqli_insert_id($conn);

	$form = "
	<h3 class='display-6'>You are registered as a student with id=$id.</h3>
	<div align=center><button type='button' class='btn btn-outline-primary'><a href='index.php'>go to main page</a></button></div>
	";
	mysqli_close($conn);
	echo basis($form, "");
}

function student_check($email, $password){
	if ($email == "" or $password  == "") {
		return false;
	} else {
		return true;
	}
}


?>