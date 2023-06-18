<?php

include "util.php";

$conn = mysqli_connect(servername, username, password, db_name);
$name = @$_GET["name"];
$sql = NULL;
$stmt = NULL;
$result = NULL;


if($name != ""){
	$sql = "select course.title, course.category, instructor.name, course.id from course inner join instructor on course.instructor=instructor.id where course.title like '%$name%' order by course.open_date desc";
	$query = mysqli_query($conn, $sql);
	$row_num = mysqli_num_rows($query);
} 
else {
	$sql = "select course.title, course.category, instructor.name, course.id from course inner join instructor on course.instructor=instructor.id order by course.open_date desc";
	$query = mysqli_query($conn, $sql);
	$row_num = mysqli_num_rows($query);
}

$type = $_COOKIE["type"];

if ($type == "student") {
	$form = "
	<form action='course.php' method='get' align=center>
		<input type='text' name='name'>
		<input type='submit' value='submit' class='btn btn-primary'>
	</form>
	<br>
	";
	
	$form = $form."
	<table class='table'>
		<tr class='table-primary'>
			<td>course title</td>
			<td>course category</td>
			<td>instructor name</td>
			<td>register</td>
		</tr>
	";

	for($i=1; $i<=$row_num; $i++){
		$array = mysqli_fetch_array($query);
		$course_name = $array[0];
		$course_category = $array[1];
		$instructor_name = $array[2];
		$course_id = $array[3];
		$url_reg = url_main."course_student/reg.php?course_id=$course_id";
		$url_read = url_main."course_instructor/course_detail.php?course_id=$course_id";
		
		$form = $form."
		<tr>
			<td><a href=$url_read text='blue'>$course_name</a></td>
			<td>$course_category</td>
			<td>$instructor_name</td>
			<td><a href=$url_reg text='blue'>Register</a></td>
		</tr>
		";
	}
	$form = $form."</table>";
	echo basis($form, "");

} else {
	$form = "
	<form action='course.php' method='get' align=center>
		<input type='text' name='name'>
		<input type='submit' value='submit' class='btn btn-primary'>
	</form>
	<br>
	";
	
	$form = $form."
	<table class='table'>
		<tr class='table-primary'>
			<td>course title</td>
			<td>course category</td>
			<td>instructor name</td>
		</tr>
	";
	
	for($i=1; $i<=$row_num; $i++){
		$array = mysqli_fetch_array($query);
		$course_name = $array[0];
		$course_category = $array[1];
		$instructor_name = $array[2];
		$course_id = $array[3];
		$url_read = url_main."course_instructor/course_detail.php?course_id=$course_id";
		
		$form = $form."
		<tr>
			<td><a href=$url_read text='blue'>$course_name</a></td>
			<td>$course_category</td>
			<td>$instructor_name</td>
		</tr>
		";
	}
	$form = $form."</table>";
	echo basis($form, "");
}


mysqli_close($conn);


?>