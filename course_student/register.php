<?php

include "util.php";

$course_id = $_POST["course_id"];
$register_date = $_POST["register_date"];
$course_point = $_POST["course_point"];
$course_title = $_POST["course_title"];
$instructor_name = $_POST["instructor_name"];

$conn = mysqli_connect(servername, username, password, db_name);
$student_id = $_COOKIE["id"];

$sql_check = "SELECT DISTINCT student FROM enrollment WHERE enrollment.course='$course_id'";
$q_check = mysqli_query($conn, $sql_check);
$num_check = mysqli_num_rows($q_check);

if($num_check == ""){
	$num_check = 0;
}

$duplicate_register = false;

for($i=1; $i<=$num_check; $i++){
	$id_check = mysqli_fetch_array($q_check)[0];
	if($id_check == $student_id){
		$duplicate_register = true;	// student has already registered this course -> raise error
		break;
	}
}

if ($duplicate_register){
	error();
}else{
	try {
		$student_point = mysqli_fetch_array(mysqli_query($conn, "select point from student where id=$student_id"))[0];
		if (($student_point - $course_point) < 0){
			$student_point = $student_point + $course_point;
			error();
		}
		$student_point = $student_point - $course_point;
		$sql_u = "UPDATE student SET point='$student_point' WHERE id='$student_id'";
		$sql_i = "INSERT INTO enrollment (student, course, register_date) VALUES ('$student_id', '$course_id', '$register_date')";
		$query_u = mysqli_query($conn, $sql_u);
		if(!$query_u){
			throw new Exception("An SQL error occurred.");
		}
		
		$query_i = mysqli_query($conn, $sql_i);
		if(!$query_i){
			throw new Exception("An SQL error occurred.");
		}
	} catch (Exception $e) {
	    echo $e->getMessage();
	}
	
	$sql_p = "SELECT point FROM student WHERE id='$student_id'";
	$query_p = mysqli_query($conn, $sql_p);
	$point = mysqli_fetch_array($query_p);
	
	setcookie("point", $point[0], time() + 3600, "/");
	
	$pointval = $_COOKIE["point"];
	$url_register_read = url_main."course_student/register_read.php";

	$form = "
	<h3 align=center>Your registration has successfully completed!</h3>
	<div align=center><button type='button' class='btn btn-light'><a href=$url_register_read>Go to Course Page</a></button></div>
	";
	mysqli_close($conn);
	echo basis($form, "");
}
?>