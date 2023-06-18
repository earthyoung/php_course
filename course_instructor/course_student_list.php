<?php

include "../util.php";
include "util.php";

$conn = mysqli_connect($servername, $username, $password, $db_name);
$course_id = $_GET["course_id"];

$sql_q = "SELECT title FROM course WHERE id='$course_id'";
$query_q = mysqli_query($conn, $sql_q);
$result_q = mysqli_fetch_array($query_q)[0];

$sql = "SELECT student.name, student.email, course.title FROM enrollment INNER JOIN course ON enrollment.course = course.id INNER JOIN student ON enrollment.student = student.id WHERE course.id = $course_id";
$query = mysqli_query($conn, $sql);
$row_num = mysqli_num_rows($query);

if(!$query or !$query_q){
	mysqli_close($conn);
	alert("An SQL error occurred.", course_page());
}

$course_title = $result_q;
$form = "
<table class='table'>
	<tr align=center>
		<td align=center class='table-primary'>course title</td>
		<td align=center>$course_title</td>
	</tr>
	<tr align=center class='table-primary'>
		<td align=center>student name</td>
		<td align=center>student email</td>
	</tr>
";
for($i=1; $i<=$row_num; $i++){
	$result = mysqli_fetch_array($query);
	$form = $form.course_student_list($result[0], $result[1]);
}

mysqli_close($conn);

$form = $form."</table>";
echo basis($form, "");


function course_student_list($student_name, $student_email){
	$form = "
	<tr align=center>
		<td align=center>$student_name</td>
		<td align=center>$student_email</td>
	</tr>";
	return $form;
}


?>