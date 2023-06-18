<?php

include "util.php";

$conn = mysqli_connect(servername, username, password, db_name);
$student_name = $_COOKIE["name"];
$student_id = $_COOKIE["id"];
$type = $_COOKIE["type"];

if (mysqli_connect_errno()) {
	echo basis('Connection error: ' . mysqli_connect_errno(), "");
	} else {
	
	}

if ($type != "student") {
	alert("Only student can show their register records.", course_page());
}

$sql = "select course.title, course.price, instructor.id, instructor.name, enrollment.register_date, course.id 
from course inner join enrollment on course.id=enrollment.course 
inner join student on enrollment.student=student.id 
inner join instructor on course.instructor=instructor.id 
where enrollment.student='$student_id'";

$query = mysqli_query($conn, $sql);
$row_num = mysqli_num_rows($query);
if ($row_num == "") {
	$row_num = 0;
}

$form = "<p align=center>$row_num courses in total.</p>";
$form = $form."<table class='table'>
		<tr class='table-primary' align=center>
			<td>course title</td>
			<td>instructor name</td>
			<td>course point</td>
			<td>register date</td>
			<td>delete</td>
		</tr>";

if ($row_num != 0) {
	for($i=1; $i<=$row_num; $i++){
		$result = mysqli_fetch_array($query);
		$course_title = $result[0];
		$course_point = $result[1];
		$instructor_id = $result[2];
		$instructor_name = $result[3];
		$register_date = $result[4]; 
		$course_id = $result[5];
		
		$form = $form.course_read($course_title, $instructor_name, $course_point, $register_date, $course_id);
	}
}

$form = $form."</table>";

echo basis($form, "");


?>