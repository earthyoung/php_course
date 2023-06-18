<?php

include "../util.php";

try{
	
	$conn = mysqli_connect(servername, username, password, db_name);
	$course_id = $_GET["course_id"];
	
	if ($course_id == "") {
		alert("You have to enter course id.", course_page());
	}
	
	$sql = "SELECT course.title, instructor.name, course.category, course.description, course.open_date FROM course INNER JOIN instructor ON course.instructor = instructor.id WHERE course.id = '$course_id'";
	$query = mysqli_query($conn, $sql);
	
	if (!$query) {
		alert("An SQL error occurred.", course_page());
	}
	
	$result = mysqli_fetch_array($query);
	mysqli_close($conn);
	if ($result[0] == "" or $result[0] == NULL){
		alert("You have entered wrong course id.", course_page());
	}
	
	$form = course_detail($result[0], $result[1], $result[2], $result[3], $result[4]);
	echo basis($form, "");
	
	
} catch(Exception $e){
	alert($e->getMessage(), course_page());
}

function course_detail($course_name, $instructor_name, $category, $description, $open_date){
	$form = "
	<table class='table' align=center>
		<tr><td align=center class='table-primary'>course name</td><td align=center>$course_name</td></tr>
		<tr><td align=center class='table-primary'>instructor name</td><td align=center>$instructor_name</td></tr>
		<tr><td align=center class='table-primary'>category</td><td align=center>$category</td></tr>
		<tr><td align=center class='table-primary'>open date</td><td align=center>$open_date</td></tr>
		<tr><td align=center colspan='2' class='table-primary'>description</td></tr>
		<tr><td align=center colspan='2'>$description</td></tr>
	</table>
	<br>
	";
	return $form;
}

?>