<?php

include "util.php";

$email = $_POST["email"];
$password = $_POST["password"];
$sql = "SELECT id, name FROM instructor WHERE email='$email' AND password='$password'";

try {
	$conn = mysqli_connect(servername, username, password, db_name);
	if (mysqli_connect_errno()) {
	    echo basis('Connection error: ' . mysqli_connect_errno(), "");
	} else {
	
	}
	$query = mysqli_query($conn, $sql);
	$user = mysqli_fetch_array($query);
	
	if($user[0] == "" or $user[1] == ""){
		$url_error_login = url_main."error_login";
		header( 'Location: ' .$url_error_login );
	} else {
		$array = mysqli_fetch_array($query);
		
		setcookie("id", $user[0], time() + 3600, "/");
		setcookie("name", $user[1], time() + 3600, "/");
		setcookie("type", "instructor", time() + 3600, "/");
		$name = $user["name"];
		$type = $user["type"];
		$url_course = url_course;
		
		header( 'Location: '.$url_course );
		
	}
	
} catch (\Throwable $e) {
	echo basis("<h2 class='display-6'>ERROR: ".$e->getMessage()."</h2>", "");
  //error();
}


?>