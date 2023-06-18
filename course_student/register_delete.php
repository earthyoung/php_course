<?php

include "util.php";

$course_id = $_GET["course_id"];
$student_id = $_COOKIE["id"];
$conn = mysqli_connect(servername, username, password, db_name);


$query = mysqli_query($conn, "DELETE FROM enrollment WHERE student='$student_id' AND course='$course_id'");
mysqli_close($conn);

if(!$query){
	alert("An SQL error occurred.", url_course);
} else {
	$url_register_read = url_main."course_student/register_read.php";
	$form = "
	<h4 align=center>lecture with course_id=$course_id is successfully deleted in your course</h4>
	<div align=center><button align=center class='btn btn-light' type='button'><a href=$url_register_read>Go To MyPage</a></button></div>
	";
	mysqli_close($conn);
	
	echo basis($form, "");
}
?>