<?php

include "util.php";

$email = $_POST["email"];
$password = $_POST["password"];
$sql = "SELECT id, name FROM student WHERE email='$email' AND password='$password'";

try{
	$conn = mysqli_connect(servername, username, password, db_name);
	if (mysqli_connect_errno()) {
	    echo basis('Connection error: ' . mysqli_connect_errno(), "");
	} else {
	
	}
	$query = mysqli_query($conn, $sql);
	$user = mysqli_fetch_array($query);
	
	$sql_point = "SELECT point FROM student WHERE email='$email' AND password='$password'";
	$result_point = mysqli_query($conn, $sql_point);
	$point = mysqli_fetch_array($result_point)[0];
	
	if($user[0] == "" or $user[1] == ""){
		mysqli_close($conn);
		$url_error_login = url_main."error_login.php";
		header( 'Location: '.$url_error_login );
	} else {
		$array = mysqli_fetch_array($query);
		
		setcookie("id", $user[0], time() + 3600, "/");
		setcookie("name", $user[1], time() + 3600, "/");
		setcookie("type", "student", time() + 3600, "/");
		setcookie("point", $point, time() + 3600, "/");
		
		mysqli_close($conn);
		$url_course = url_course;
		header( 'Location: '.$url_course );
		
	}
} 

catch (\Throwable $e) {
	mysqli_close($conn);
	echo basis("<h2 class='display-6'>ERROR: ".$e->getMessage()."</h2>", "");
}




?>