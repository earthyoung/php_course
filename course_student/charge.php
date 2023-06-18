<?php

include "util.php";

$conn = mysqli_connect(servername, username, password, db_name);
$type = @$_COOKIE["type"];

if($type != "student") {
	alert("Only students can charge their points.", "");
}

$id = $_COOKIE["id"];
$sql_r = "SELECT point FROM student WHERE id='$id'";
$query_r = mysqli_query($conn, $sql_r);
$old_point = mysqli_fetch_array($query_r)[0];
$redirect_url = url_main."course.php";

if ($old_point <= 90000) {
	$new_point = $old_point + 10000;
	$sql_u = "UPDATE student SET point='$new_point' WHERE id='$id'";
	$query_u = mysqli_query($conn, $sql_u);
	
	if(!$query_u){
		alert("An SQL error occurred.", "");
	}
	setcookie("point", $new_point, time() + 3600, "/");
	mysqli_close($conn);
	header( "Location: $redirect_url" );
} else {
	mysqli_close($conn);
	alert("Your point cannot exceed 100,000.", $redirect_url);
}



?>