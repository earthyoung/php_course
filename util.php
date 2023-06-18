<?php

include "variable.php";

# url variables
const url_main = "http://localhost/php_program/online-lecture-site/";
const url_index = url_main."index.php";
const url_logout = url_main."logout.php";
const url_course = url_main."course.php";

# db variables

function alert($msg, $url){
	echo "<script type='text/javascript'>\n"; 
	echo "alert('$msg')\n";
	echo "document.location.href = '$url'\n";
	echo "</script>";
}

function error(){
	$url_error = url_main."error.php";
	header( 'Location: '.$url_error );
}


function basis($code, $auth){
	$type = @$_COOKIE["type"];
	$name = @$_COOKIE["name"];
	$navbar = "";
	if($type == "student") {
		$navbar = student_basis();
	} else if ($type == "instructor") {
		$navbar = instructor_basis();
	} else {
		$navbar = anonymous_basis();
	}
	
	$basis = "
	<!DOCTYPE html>
	<html lang='en'>
		<head>
			<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM' crossorigin='anonymous'>
			<title>
				Courses
			</title>
			<style>
				@import url('style.css')
			</style>
		</head>
		<body>
			<br>
			$navbar
			<br>
			$code
		</body>
	</html>
	";
	
	return $basis;
}

function student_basis(){
	$name = $_COOKIE["name"];
	$point = $_COOKIE["point"];
	$url_read = url_main.'course_student/register_read.php';
	$url_index = url_index;
	$url_logout = url_logout;
	$url_course = url_course;
	$url_charge = url_main."course_student/charge.php";
	
	$form = "
	<div class='topnav' align=center>
		<button type='button' class='btn btn-light'><a href=$url_index>Main</a></button>
		<button type='button' class='btn btn-light'><a href=$url_logout>Logout</a></button>
		<button type='button' class='btn btn-light'><a href=$url_course>Course</a></button>
		<button type='button' class='btn btn-light'><a href=$url_read>Register Records</a></button>
		<button class='btn btn-primary'><a href=$url_charge style='color:white;'>Charge</a></button>
		<button class='btn btn-outline-primary'>$point point</button>
		<br><br>
		<p>You are logined as $name, Student</p>
	</div>
	";
	
	return $form;
}

function instructor_basis(){
	$name = $_COOKIE["name"];
	$url_course = url_main.'course_instructor/course_by_instructor_list.php';
	$url_question = url_main.'course_instructor/course_create_table.php';
	$url_index = url_index;
	$url_logout = url_logout;
	$url_course = url_course;
	
	
	$form = "
	<div class='topnav' align=center>
		<button type='button' class='btn btn-light'><a href=$url_index>Main</a></button>
		<button type='button' class='btn btn-light'><a href=$url_logout>Logout</a></button>
		<button type='button' class='btn btn-light'><a href=$url_course>Course</a></button>
		<button type='button' class='btn btn-light'><a href=$url_course>Course Records</a></button>
		<button type='button' class='btn btn-light'><a href=$url_question>Install Courses</a></button>
		<br><br>
		<p>You are logined as $name, Instructor</p>
	</div>
	";
	
	return $form;
}

function anonymous_basis(){
	$url_index = url_index;
	$form = "
	<div class='topnav' align=center>
		<button type='button' class='btn btn-light'><a href=$url_index>Main</a></button>
	</div>
	";
	
	return $form;
}

?>